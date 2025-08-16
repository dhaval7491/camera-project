<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
