<?php

namespace App\Http\Controllers;

use App\DataTables\MappingDataTable;
use App\Http\Requests\MappingRequest;
use App\Models\Company;
use App\Models\Equipment;
use App\Models\Mapping;
use App\Models\Project;
use Illuminate\Http\Request;

class MappingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(MappingDataTable $dataTable)
    {
        $companies = Company::pluck('company_name', 'id')->toArray();
        $projects = Project::pluck('name', 'id')->toArray();
        $tablets = Equipment::where('type', 'tablet')->pluck('equipment_name', 'id')->toArray();
        $cameras = Equipment::where('type', 'camera')->pluck('equipment_name', 'id')->toArray();
        return $dataTable->render('mappings.index', compact('companies', 'projects', 'cameras', 'tablets'));
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
    public function store(MappingRequest $request)
    {
        $data = $request->validated();
        Mapping::create($data);
        return response()->json([
            'success' => true,
            'message' => 'Mapping created successfully',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mapping $mapping)
    {
        if (request()->ajax()) {
            return response()->json([
                'id' => $mapping->id,
                'company_id' => $mapping->company_id,
                'project_id' => $mapping->project_id,
                'camera_id' => $mapping->camera_id,
                'tablet_id' => $mapping->tablet_id,
                'status' => $mapping->status,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MappingRequest $request, Mapping $mapping)
    {
        $data = $request->validated();
        $mapping->update($data);
        return redirect()->route('settings.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mapping $mapping)
    {
        $mapping->delete();
        return redirect()->route('settings.index');
    }

    public function toggleActive(Mapping $mapping)
    {
        $mapping->is_active = !$mapping->is_active;
        $mapping->save();
        return response()->json([
            'success' => true,
            'message' => 'Mapping status updated successfully',
            'status' => $mapping->is_active
        ]);
    }

    /**
     * Get projects associated with a company via AJAX.
     */
    public function getProjects(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id'
        ]);

        $companyId = $request->input('company_id');
        $projects = Project::whereHas('companies', function ($query) use ($companyId) {
            $query->where('company_project.company_id', $companyId);
        })->pluck('name', 'id')->toArray();

        return response()->json([
            'success' => true,
            'projects' => $projects
        ]);
    }
}
