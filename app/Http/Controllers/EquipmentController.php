<?php

namespace App\Http\Controllers;

use App\DataTables\EquipmentDataTable;
use App\Http\Requests\EquipmentRequest;
use App\Models\Company;
use App\Models\Equipment;
use App\Models\Project;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(EquipmentDataTable $dataTable)
    {
        return $dataTable->render('equipments.index');
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
    public function store(EquipmentRequest $request)
    {
        $data = $request->validated();
        // Hash the password before storing
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        Equipment::create($data);
        return redirect()->route('equipments.index');
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
    public function edit(Equipment $equipment)
    {
        if (request()->ajax()) {
            return response()->json([
                'id' => $equipment->id,
                'type' => $equipment->type,
                'camera_name' => $equipment->camera_name,
                'stream_link' => $equipment->stream_link,
                'camera_code' => $equipment->camera_code,
                'map_tablet' => $equipment->map_tablet,
                'company_id' => $equipment->company_id,
                'project_id' => $equipment->project_id,
                'plant_name' => $equipment->plant_name,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EquipmentRequest $request, Equipment $equipment)
    {
        $data = $request->validated();
        $equipment->update($data);
        return redirect()->route('equipments.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipment $equipment)
    {
        $equipment->delete();
        return redirect()->route('equipments.index');
    }

    /**
     * Toggle the active status of equipment
     */
    public function toggleActive(Equipment $equipment)
    {
        $equipment->is_active = !$equipment->is_active;
        $equipment->save();

        return response()->json([
            'success' => true,
            'message' => 'Equipment status updated successfully',
            'is_active' => $equipment->is_active
        ]);
    }
}
