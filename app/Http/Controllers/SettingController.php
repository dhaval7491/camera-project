<?php

namespace App\Http\Controllers;

use App\DataTables\EquipmentDataTable;
use App\DataTables\MappingDatatable;
use App\Models\Equipment;
use App\Models\Mapping;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('settings.index');
    }

    public function accountSettings()
    {
        return view('settings.account-settings');
    }
}
