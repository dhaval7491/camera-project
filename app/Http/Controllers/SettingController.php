<?php

namespace App\Http\Controllers;

use App\DataTables\EquipmentDataTable;
use App\DataTables\MappingDataTable;
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
            'cameras' => Equipment::where('type', 'camera')->pluck('equipment_name', 'id')->toArray(),
            'tablets' => Equipment::where('type', 'tablet')->pluck('equipment_name', 'id')->toArray(),
            'statuses' => [
                1 => 'Active',
                0 => 'Inactive'
            ],
            'equipmentDataTable' => $equipment,
            'mappingDataTable' => $mapping,
            'trackableDataTable' => $trackable,
        ]);
    }

    public function index(
        EquipmentDataTable $equipmentDataTable,
        MappingDatatable $mappingDataTable,
        TrackableDataTable $trackableDataTable
    ){
        return view('settings.index', [
            'companies' => Company::pluck('company_name', 'id')->toArray(),
            'projects' => Project::pluck('name', 'id')->toArray(),
            'plants' => Project::distinct()->pluck('plant_name')->toArray(), // Or from Equipment if needed
            'equipments' => Equipment::pluck('equipment_name', 'id')->toArray(),
            'trackables' => Trackable::pluck('trackable_name', 'id')->toArray(),
            'cameras' => Equipment::where('type', 'camera')->pluck('equipment_name', 'id')->toArray(),
            'tablets' => Equipment::where('type', 'tablet')->pluck('equipment_name', 'id')->toArray(),
            'statuses' => [
                1 => 'Active',
                0 => 'Inactive'
            ],
            'equipmentTable' => $equipmentDataTable->html()->ajax(['url' => route('settings.equipments')]),
            'mappingTable' => $mappingDataTable->html()->ajax(['url' => route('settings.mappings')]),
            'trackableTable' => $trackableDataTable->html()->ajax(['url' => route('settings.trackables')]),
        ]);
    }

    public function accountSettings()
    {
        return view('settings.account-settings');
    }

    public function equipments(EquipmentDataTable $dataTable){
        return $dataTable->render('settings.index');
    }

    public function mappings(MappingDataTable $dataTable){
        return $dataTable->render('settings.index');
    }

    public function trackables(TrackableDataTable $dataTable){
        return $dataTable->render('settings.index');
    }
}
