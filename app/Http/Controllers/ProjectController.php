<?php

namespace App\Http\Controllers;

use App\DataTables\ProjectDataTable;
use App\Http\Requests\StoreProjectRequest;
use App\Models\Company;
use App\Models\Equipment;
use App\Models\Project;
use App\Models\Trackable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProjectDataTable $dataTable)
    {
        return $dataTable->render('projects.index', [
            'companies' => Company::pluck('company_name', 'id')->toArray(), // Pass companies for edit modal
            'projects' => Project::pluck('name', 'id')->toArray(),
            'permissions' => Permission::pluck('name', 'id')->toArray(),
            'cameras' => Equipment::where('type', 'camera')->pluck('equipment_name', 'id')->toArray(),
            'tablets' => Equipment::where('type', 'tablet')->pluck('equipment_name', 'id')->toArray(),
            'statuses' => [
                1 => 'Active',
                0 => 'Inactive'
            ]
        ]);
    }

    public function data(ProjectDataTable $dataTable)
    {
        return $dataTable->ajax();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $validated = $request->validated();
        $project = Project::create($validated);
        $project->companies()->sync($request->companies);
        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::with('companies')->findOrFail($id);
        $companyNames = $project->companies->pluck('company_name')->join(', ');
        $trackables = $project->trackables()->get();
        $users = DB::table('users')
        ->select([
            'users.id',
            'users.name',
            'users.email',
            'users.is_active',
            'users.created_at',
            'users.access_level',
            DB::raw("(SELECT GROUP_CONCAT(c.company_name SEPARATOR ', ') 
                      FROM company_user cu 
                      JOIN companies c ON c.id = cu.company_id 
                      WHERE cu.user_id = users.id) as company_name")
        ])
        ->join('project_user', 'users.id', '=', 'project_user.user_id')
        ->leftJoin('company_user', 'users.id', '=', 'company_user.user_id')
        ->leftJoin('companies', 'company_user.company_id', '=', 'companies.id')
        ->where('project_user.project_id', $id)
        ->groupBy('users.id', 'users.name', 'users.email', 'users.is_active', 'users.created_at', 'users.access_level')
        ->get();
        return view('projects.show', compact('project', 'companyNames', 'trackables', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        // Return JSON for AJAX requests
        if (request()->ajax()) {
            return response()->json([
                'id' => $project->id,
                'name' => $project->name,
                'company_ids' => $project->companies->pluck('id')->toArray(),
                'location' => $project->location,
                'plant_name' => $project->plant_name,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProjectRequest $request, string $id)
    {
        $validated = $request->validated();
        $project = Project::findOrFail($id);
        $project->update($validated);
        $project->companies()->sync($request->companies);
        return redirect()->route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index');
    }

    /**
     * Toggle the active status of a project
     */
    public function toggleActive(Project $project)
    {
        $project->is_active = !$project->is_active;
        $project->save();

        return response()->json([
            'success' => true,
            'message' => 'Project status updated successfully',
            'is_active' => $project->is_active
        ]);
    }

    public function getProjects(Request $request)
    {
        $projects = Project::pluck('name', 'id')->toArray();

        return response()->json([
            'success' => true,
            'projects' => $projects
        ]);
    }
}
