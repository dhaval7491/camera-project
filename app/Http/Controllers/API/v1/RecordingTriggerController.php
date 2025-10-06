<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\Recording;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Exception;

class RecordingTriggerController extends Controller
{
    /**
     * Start streaming and create recording entry
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function startStreaming(Request $request)
    {
        try {
            // Validate the request
            $validator = Validator::make($request->all(), [
                'camera_id' => 'required|integer|exists:equipments,id',
                'recording_name' => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Extract timestamp from recording_name (format: 23_Publisher_2025-09-23T18-04-54)
            $recordingName = $request->recording_name;
            $timestampPattern = '/(\d{4}-\d{2}-\d{2}T\d{2}-\d{2}-\d{2})/';

            if (preg_match($timestampPattern, $recordingName, $matches)) {
                $timestampString = $matches[1];
                // Convert format from 2025-09-23T18-04-54 to 2025-09-23 18:04:54
                $recordingTimestamp = str_replace('T', ' ', str_replace('-', ':', substr($timestampString, 0, 10) . ' ' . substr($timestampString, 11)));
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid recording name format. Expected format: XX_Publisher_YYYY-MM-DDTHH-MM-SS'
                ], 422);
            }

            // Create new recording entry with null values for other fields
            $recording = Recording::create([
                'camera_id' => $request->camera_id,
                'recording_timestamp' => $recordingTimestamp,
                'recording_name' => $recordingName
            ]);

            Log::info('Recording started', [
                'recording_id' => $recording->id,
                'camera_id' => $request->camera_id,
                'recording_name' => $recordingName,
                'recording_timestamp' => $recordingTimestamp
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Recording started successfully',
                'recording' => $recording
            ], 201);

        } catch (Exception $e) {
            Log::error('Failed to start recording', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to start recording',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Stop streaming and notify Node server
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function stopStreaming(Request $request)
    {
        try {
            // Validate the request
            $validator = Validator::make($request->all(), [
                'camera_id' => 'required|integer',
                'recording_name' => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $nodeServerUrl = env('NODE_SERVER_URL');
            $endpoint = $nodeServerUrl . '/api/stop-recording';

            Log::info('Mobile app triggered stop streaming', [
                'node_url' => env('NODE_SERVER_URL'),
                'endpoint' => $endpoint,
                'timestamp' => now(),
                'camera_id' => $request->camera_id,
                'recording_name' => $request->recording_name
            ]);

            // Make HTTP request to Node server with camera_id and recording_name
            $response = Http::timeout(10)->post($endpoint, [
                'camera_id' => $request->camera_id,
                'recording_name' => $request->recording_name
            ]);

            if ($response->successful()) {
                $data = $response->json();

                Log::info('Node server responded successfully', [
                    'response' => $data
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Recording stopped successfully',
                    'node_response' => $data
                ], 200);
            } else {
                Log::error('Node server request failed', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Failed to notify Node server',
                    'error' => 'Node server returned error',
                    'status_code' => $response->status()
                ], 500);
            }

        } catch (Exception $e) {
            Log::error('Failed to stop streaming', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to stop streaming',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Check Node server health status
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkNodeServerStatus()
    {
        try {
            $nodeServerUrl = env('NODE_SERVER_URL', 'http://localhost:3000');
            $endpoint = $nodeServerUrl . '/health';

            $response = Http::timeout(5)->get($endpoint);

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Node server is running',
                    'server_status' => $response->json()
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Node server is not responding properly',
                    'status_code' => $response->status()
                ], 500);
            }

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot connect to Node server',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
