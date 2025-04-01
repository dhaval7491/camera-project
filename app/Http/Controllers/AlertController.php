<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use Illuminate\Http\Request;

class AlertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recentAlerts = Alert::where('created_at', '>=', now()->subDays(7))->latest()->get();
        $allAlerts = Alert::orderBy('created_at', 'desc')->get();

        return view('alerts.index', compact('recentAlerts', 'allAlerts'));
    }
}
