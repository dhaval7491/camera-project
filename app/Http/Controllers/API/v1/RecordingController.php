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
     * Store a new recording from Janus server
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            // Validate the request
            $validator = Validator::make($request->all(), [
                'camera_id' => 'required|integer|exists:equipments,id',
                'recording_timestamp' => 'required|string',
                'recording_name' => 'required|string',
                'file_path' => 'nullable|string',
                's3_path' => 'nullable|string',
                's3_bucket' => 'nullable|string',
                'file_size' => 'nullable|integer',
                'duration' => 'nullable|integer',
                'format' => 'nullable|string',
                'status' => 'nullable|string|in:pending,processing,completed,failed',
                'metadata' => 'nullable|json',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Check if recording already exists
            $existingRecording = Recording::where('camera_id', $request->camera_id)
                ->where('recording_timestamp', $request->recording_timestamp)
                ->first();

            if ($existingRecording) {
                // Update existing recording
                $updateData = [
                    'recording_name' => $request->recording_name
                ];

                // Add optional fields if present
                if ($request->has('file_path')) $updateData['file_path'] = $request->file_path;
                if ($request->has('s3_path')) $updateData['s3_path'] = $request->s3_path;
                if ($request->has('s3_bucket')) $updateData['s3_bucket'] = $request->s3_bucket;
                if ($request->has('file_size')) $updateData['file_size'] = $request->file_size;
                if ($request->has('duration')) $updateData['duration'] = $request->duration;
                if ($request->has('format')) $updateData['format'] = $request->format;
                if ($request->has('status')) $updateData['status'] = $request->status;
                if ($request->has('metadata')) $updateData['metadata'] = json_decode($request->metadata, true);
                if ($request->status === 'completed') $updateData['processed_at'] = now();

                $existingRecording->update($updateData);

                Log::info('Recording updated', [
                    'recording_id' => $existingRecording->id,
                    'camera_id' => $request->camera_id,
                    's3_path' => $request->recording_name
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Recording updated successfully',
                    'recording' => $existingRecording
                ], 200);
            }

            // Create new recording
            $createData = [
                'camera_id' => $request->camera_id,
                'recording_timestamp' => $request->recording_timestamp,
                'recording_name' => $request->recording_name
            ];

            // Add optional fields if present
            if ($request->has('file_path')) $createData['file_path'] = $request->file_path;
            if ($request->has('s3_path')) $createData['s3_path'] = $request->s3_path;
            if ($request->has('s3_bucket')) $createData['s3_bucket'] = $request->s3_bucket;
            if ($request->has('file_size')) $createData['file_size'] = $request->file_size;
            if ($request->has('duration')) $createData['duration'] = $request->duration;
            if ($request->has('format')) $createData['format'] = $request->format;
            if ($request->has('status')) $createData['status'] = $request->status;
            if ($request->has('metadata')) $createData['metadata'] = json_decode($request->metadata, true);
            if ($request->status === 'completed') $createData['processed_at'] = now();

            $recording = Recording::create($createData);

            Log::info('Recording created', [
                'recording_id' => $recording->id,
                'camera_id' => $request->camera_id,
                's3_path' => $request->recording_name
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Recording stored successfully',
                'recording' => $recording
            ], 201);

        } catch (Exception $e) {
            Log::error('Failed to store recording', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to store recording',
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

            // Optional: Delete from S3
            // $this->deleteFromS3($recording->recording_name);

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

    /**
     * Delete file from S3
     *
     * @param string $s3Path
     * @return bool
     */
    private function deleteFromS3($s3Path)
    {
        try {
            if (class_exists('\Aws\S3\S3Client')) {
                $s3Client = new \Aws\S3\S3Client([
                    'version' => 'latest',
                    'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
                    'credentials' => [
                        'key' => env('AWS_ACCESS_KEY_ID'),
                        'secret' => env('AWS_SECRET_ACCESS_KEY'),
                    ]
                ]);

                $bucket = env('AWS_BUCKET', 'your-camera-recordings-bucket');

                $s3Client->deleteObject([
                    'Bucket' => $bucket,
                    'Key' => $s3Path
                ]);

                return true;
            }

            return false;

        } catch (Exception $e) {
            Log::error('Failed to delete from S3', [
                's3_path' => $s3Path,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }
}