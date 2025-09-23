<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Recording;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class LiveStreamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $rawData = DB::table('projects')
        //     ->leftJoin('mapping', 'projects.id', '=', 'mapping.project_id')
        //     ->leftJoin('equipments', 'mapping.camera_id', '=', 'equipments.id')
        //     ->select(
        //         'projects.id as project_id',
        //         'projects.name as project_name',
        //         'equipments.id as camera_id',
        //         'equipments.equipment_name as camera_name'
        //     )
        //     ->get();

        // // Group by project
        // $projects = [];

        // foreach ($rawData as $row) {
        //     $projectId = $row->project_id;

        //     if (!isset($projects[$projectId])) {
        //         $projects[$projectId] = [
        //             'project_id' => $row->project_id,
        //             'project_name' => $row->project_name,
        //             'camera' => [],
        //         ];
        //     }

        //     if ($row->camera_id) {
        //         $projects[$projectId]['camera'][] = [
        //             'id' => $row->camera_id,
        //             'camera_name' => $row->camera_name,
        //         ];
        //     }
        // }

        // $projectsArray = array_values($projects); // re-index for clean output
        // // dd(auth()->user());
        // return view('streams.index', ['projects' => $projectsArray]);
        $projects = DB::table('projects')
            ->select('id as project_id', 'name as project_name')
            ->get();

        return view('streams.index', ['projects' => $projects]);
    }

    /**
     * Get cameras for a specific project via AJAX
     */
    public function getProjectCameras($projectId)
    {
        try {
            // Validate project exists
            $project = DB::table('projects')->where('id', $projectId)->first();
            
            if (!$project) {
                return response()->json([
                    'success' => false,
                    'message' => 'Project not found'
                ], 404);
            }

            // Get cameras for the project
            $cameras = DB::table('mapping')
                ->join('equipments', 'mapping.camera_id', '=', 'equipments.id')
                ->where('mapping.project_id', $projectId)
                ->select(
                    'equipments.id',
                    'equipments.equipment_name as camera_name',
                    'equipments.stream_link'
                )
                ->get();

            return response()->json([
                'success' => true,
                'project' => [
                    'project_id' => $project->id,
                    'project_name' => $project->name,
                    'cameras' => $cameras
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching project cameras: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get recording for a specific camera and date
     */
    public function getCameraRecording(Request $request, $cameraId)
    {
        try {
            // Get date parameter or use current date
            $date = $request->input('date', Carbon::now()->format('Y-m-d'));

            // Get the latest recording for the camera on the specified date
            $recording = Recording::where('camera_id', $cameraId)
                ->whereDate('created_at', $date)
                ->where('status', 'completed')
                ->whereNotNull('s3_path')
                ->orderBy('created_at', 'desc')
                ->first();

            if ($recording) {
                // Generate S3 URL
                $s3Url = $this->generateS3Url($recording);

                return response()->json([
                    'success' => true,
                    'has_recording' => true,
                    'recording' => [
                        'id' => $recording->id,
                        'camera_id' => $recording->camera_id,
                        'recording_name' => $recording->recording_name,
                        'url' => $s3Url,
                        'duration' => $recording->duration,
                        'created_at' => $recording->created_at->format('Y-m-d H:i:s'),
                        'file_size' => $recording->file_size,
                        'format' => $recording->format ?? 'video/mp4'
                    ]
                ]);
            } else {
                return response()->json([
                    'success' => true,
                    'has_recording' => false,
                    'message' => 'No recording available for this camera on ' . $date
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching recording: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Generate S3 URL for recording
     */
    private function generateS3Url($recording)
    {
        // Check if we have a full S3 URL already
        if (filter_var($recording->s3_path, FILTER_VALIDATE_URL)) {
            // If it's already a full URL but from S3, try to generate a presigned URL
            if (strpos($recording->s3_path, 's3.amazonaws.com') !== false || strpos($recording->s3_path, 's3.') !== false) {
                // Extract the path from the URL for presigned URL generation
                $parsedUrl = parse_url($recording->s3_path);
                $path = ltrim($parsedUrl['path'] ?? '', '/');

                try {
                    // Generate a presigned URL that expires in 1 hour
                    return Storage::disk('s3')->temporaryUrl($path, now()->addHour());
                } catch (\Exception $e) {
                    // If presigned URL generation fails, return the original URL
                    return $recording->s3_path;
                }
            }
            return $recording->s3_path;
        }

        // Use the s3_path if available, otherwise construct from camera_id and recording_name
        $path = $recording->s3_path ?? "recordings/{$recording->camera_id}/{$recording->recording_name}";

        try {
            // Try to generate a presigned URL with 1 hour expiration
            return Storage::disk('s3')->temporaryUrl($path, now()->addHour());
        } catch (\Exception $e) {
            // Fallback to constructing the public URL if presigned URL fails
            $bucket = $recording->s3_bucket ?? env('AWS_BUCKET');
            $region = env('AWS_DEFAULT_REGION', 'us-east-1');
            return "https://{$bucket}.s3.{$region}.amazonaws.com/{$path}";
        }
    }


    /**
     * Display the specified camera stream.
     */
    public function show($cameraId)
    {
        // Fetch camera details
        $camera = DB::table('equipments')
            ->where('id', $cameraId)
            ->select('id', 'equipment_name as camera_name', 'stream_link')
            ->first();

        if (!$camera) {
            abort(404, 'Camera not found');
        }

        // Fetch projects for sidebar (same as index)
        $rawData = DB::table('projects')
            ->leftJoin('mapping', 'projects.id', '=', 'mapping.project_id')
            ->leftJoin('equipments', 'mapping.camera_id', '=', 'equipments.id')
            ->select(
                'projects.id as project_id',
                'projects.name as project_name',
                'equipments.id as camera_id',
                'equipments.equipment_name as camera_name'
            )
            ->get();

        $projects = [];
        foreach ($rawData as $row) {
            $projectId = $row->project_id;
            if (!isset($projects[$projectId])) {
                $projects[$projectId] = [
                    'project_id' => $row->project_id,
                    'project_name' => $row->project_name,
                    'camera' => [],
                ];
            }
            if ($row->camera_id) {
                $projects[$projectId]['camera'][] = [
                    'id' => $row->camera_id,
                    'camera_name' => $row->camera_name,
                ];
            }
        }

        $projectsArray = array_values($projects);
        // dd($projectsArray);
        return view('streams.show', [
            'cameraId' => $camera->id,
            'projects' => $projectsArray,
        ]);
    }
}
