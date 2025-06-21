<?php

namespace App\Http\Controllers;

use App\DataTables\EquipmentDataTable;
use App\Http\Requests\EquipmentRequest;
use App\Models\Company;
use App\Models\Equipment;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
     * Generate a unique equipment code via POST
     */
    public function generateEquipmentCode(Request $request)
    {
        $request->validate([
            'type' => ['required', 'in:camera,tablet']
        ]);

        $type = $request->input('type');
        $code = $this->generateUniqueEquipmentCode($type);
        return response()->json(['equipment_code' => $code]);
    }

    /**
     * Generate a unique equipment code
     */
    private function generateUniqueEquipmentCode($type): string
    {
        $prefix = $type === 'camera' ? 'CAM' : 'TAB';
        do {
            $number = rand(100, 999);
            $letters = strtoupper(Str::random(3));
            $code = "$prefix-$number-$letters";
        } while (Equipment::where('equipment_code', $code)->exists());
        return $code;
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
        return redirect()->route('settings.index');
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
                'equipment_name' => $equipment->equipment_name,
                'equipment_code' => $equipment->equipment_code,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EquipmentRequest $request, Equipment $equipment)
    {
        $data = $request->validated();
        // Hash the password before storing
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        $equipment->update($data);
        return redirect()->route('settings.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipment $equipment)
    {
        $equipment->delete();
        return redirect()->route('settings.index');
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
