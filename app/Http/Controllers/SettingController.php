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

    public function index(){
        return view('settings.account-settings');
    }
    /**
     * Display a listing of the resource.
     */
    public function indexOld(
        EquipmentDataTable $equipment,
        MappingDatatable $mapping,
        TrackableDataTable $trackable
    ) {
        if (request()->ajax()) {
            // Check which DataTable is being requested
            $table = request()->get('table');
            if ($table === 'mappings') {
                return $mapping->ajax();
            } elseif ($table === 'trackables') {
                return $trackable->ajax();
            }
    
            return $equipment->ajax();
        }
    
        return view('settings.index', [
            'companies' => Company::pluck('company_name', 'id')->toArray(),
            'projects' => Project::pluck('name', 'id')->toArray(),
            'plants' => Project::distinct()->pluck('plant_name')->toArray(), // Or from Equipment if needed
            'equipments' => Equipment::pluck('equipment_name', 'id')->toArray(),
            'trackables' => Trackable::pluck('trackable_name', 'id')->toArray(),
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
