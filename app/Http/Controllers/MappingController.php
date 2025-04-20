<?php

namespace App\Http\Controllers;

use App\DataTables\MappingDataTable;
use App\Http\Requests\MappingRequest;
use App\Models\Company;
use App\Models\Equipment;
use App\Models\Project;

class MappingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(MappingDataTable $dataTable)
    {
        $companies = Company::pluck('company_name', 'id')->toArray();
        $projects = Project::pluck('name', 'id')->toArray();
        $equipment = Equipment::pluck('camera_name', 'id')->toArray();
        return $dataTable->render('mappings.index', compact('companies', 'projects', 'equipment'));
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
        return redirect()->route('mappings.index');
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
                'equipment_id' => $mapping->equipment_id,
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
        return response()->json([
            'success' => true,
            'message' => 'Mapping updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mapping $mapping)
    {
        $mapping->delete();
        return redirect()->route('mappings.index');
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
}
