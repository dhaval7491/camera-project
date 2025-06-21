<?php

namespace App\Http\Controllers;

use App\DataTables\ProjectDataTable;
use App\Http\Requests\StoreProjectRequest;
use App\Models\Company;
use App\Models\Project;
use Illuminate\Http\Request;
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
            'projects' => Project::pluck('name','id')->toArray(),
            'permissions' => Permission::pluck('name', 'id')->toArray(),
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
        $trackables = Company::pluck('company_name', 'id')->toArray();
        return view('projects.show', compact('trackables'));
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
}
