<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\Recording;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Exception;

class RecordingController extends Controller
{
    /**
     * Store/Update recording from Janus server (called when video is uploaded to S3)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            // Validate the request
            $validator = Validator::make($request->all(), [
                'camera_id' => 'required|integer',
                'recording_name' => 'required|string',
                's3_path' => 'required|string',
                's3_bucket' => 'required|string',
                'file_size' => 'required|integer',
                'duration' => 'nullable|integer',
                'format' => 'required|string',
                'metadata' => 'nullable|json',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Find existing recording by camera_id and recording_name
            $recording = Recording::where('camera_id', $request->camera_id)
                ->where('recording_name', $request->recording_name)
                ->first();

            if (!$recording) {
                Log::warning('Recording not found for S3 upload update', [
                    'camera_id' => $request->camera_id,
                    'recording_name' => $request->recording_name
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Recording not found. Please create recording first via start-streaming.'
                ], 404);
            }

            // Update recording with completed status and S3 details
            $recording->update([
                'status' => 'completed',
                's3_path' => $request->s3_path,
                's3_bucket' => $request->s3_bucket,
                'file_size' => $request->file_size,
                'duration' => $request->duration,
                'format' => $request->format,
                'metadata' => $request->metadata ? json_decode($request->metadata, true) : null,
                'processed_at' => now()
            ]);

            Log::info('Recording completed and updated via S3 upload', [
                'recording_id' => $recording->id,
                'camera_id' => $request->camera_id,
                's3_path' => $request->s3_path
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Recording completed successfully',
                'recording' => $recording
            ], 200);

        } catch (Exception $e) {
            Log::error('Failed to update recording', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to update recording',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get recordings by camera ID
     *
     * @param int $cameraId
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByCameraId($cameraId, Request $request)
    {
        try {
            // Validate camera exists
            $camera = Equipment::find($cameraId);

            if (!$camera) {
                return response()->json([
                    'success' => false,
                    'message' => 'Camera not found'
                ], 404);
            }

            // Get date range from request
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            // Build query
            $query = Recording::where('camera_id', $cameraId);

            if ($startDate) {
                $query->where('recording_timestamp', '>=', $startDate);
            }

            if ($endDate) {
                $query->where('recording_timestamp', '<=', $endDate);
            }

            // Order by timestamp descending and paginate
            $recordings = $query->orderBy('recording_timestamp', 'desc')
                ->paginate(20);

            return response()->json([
                'success' => true,
                'camera_id' => $cameraId,
                'recordings' => $recordings
            ], 200);

        } catch (Exception $e) {
            Log::error('Failed to get recordings', [
                'camera_id' => $cameraId,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to get recordings',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get a single recording by ID
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $recording = Recording::with('camera')->find($id);

            if (!$recording) {
                return response()->json([
                    'success' => false,
                    'message' => 'Recording not found'
                ], 404);
            }

            // Generate presigned URL for S3 access (optional)
            $s3Url = $this->generateS3Url($recording->recording_name);

            return response()->json([
                'success' => true,
                'recording' => $recording,
                's3_url' => $s3Url
            ], 200);

        } catch (Exception $e) {
            Log::error('Failed to get recording', [
                'recording_id' => $id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to get recording',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete a recording
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $recording = Recording::find($id);

            if (!$recording) {
                return response()->json([
                    'success' => false,
                    'message' => 'Recording not found'
                ], 404);
            }

            $recording->delete();

            Log::info('Recording deleted', [
                'recording_id' => $id,
                'camera_id' => $recording->camera_id
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Recording deleted successfully'
            ], 200);

        } catch (Exception $e) {
            Log::error('Failed to delete recording', [
                'recording_id' => $id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete recording',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Generate direct S3 URL for public access
     *
     * @param string $s3Path
     * @return string|null
     */
    private function generateS3Url($s3Path)
    {
        try {
            // Get bucket and region from environment
            $bucket = env('AWS_BUCKET', 'your-camera-recordings-bucket');
            $region = env('AWS_DEFAULT_REGION', 'us-east-1');

            // Return direct public S3 URL - no signed URLs
            return "https://{$bucket}.s3.{$region}.amazonaws.com/{$s3Path}";

        } catch (Exception $e) {
            Log::error('Failed to generate S3 URL', [
                's3_path' => $s3Path,
                'error' => $e->getMessage()
            ]);
            return null;
        }
    }

}