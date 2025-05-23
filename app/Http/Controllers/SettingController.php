<?php

namespace App\Http\Controllers;

use App\DataTables\EquipmentDataTable;
use App\DataTables\MappingDatatable;
use App\DataTables\TrackableDataTable;
use App\Models\Company;
use App\Models\Equipment;
use App\Models\Project;
use App\Models\Trackable;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(EquipmentDataTable $equipment,
    MappingDatatable $mapping,
    TrackableDataTable $trackable,)
    {
        return view('settings.index', [
            'companies' => Company::pluck('company_name', 'id')->toArray(),
            'projects' => Project::pluck('name', 'id')->toArray(),
            'plants' => Project::distinct()->pluck('plant_name')->toArray(), // Adjust based on your Equipment model
            'equipments' => Equipment::pluck('equipment_name', 'id')->toArray(), // Assuming Equipment has a 'name' field
            'trackables' => Trackable::pluck('trackable_name', 'id')->toArray(), // Assuming Trackable has a 'name' field
            'statuses' => [
                1 => 'Active',
                0 => 'Inactive'
            ],
            'equipmentDataTable' => $equipment,
        'mappingDataTable' => $mapping,
        'trackableDataTable' => $trackable,
        ]);
    }

    public function accountSettings()
    {
        return view('settings.account-settings');
    }
}
