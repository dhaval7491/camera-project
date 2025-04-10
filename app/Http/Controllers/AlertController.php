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
        // $recentAlerts = Alert::where('created_at', '>=', now()->subDays(7))->latest()->get();
        // $allAlerts = Alert::orderBy('created_at', 'desc')->get();

        // return view('alerts.index', compact('recentAlerts', 'allAlerts'));
        return view('alerts.index');
    }

    /**
     * Load more alerts via AJAX
     */
    public function loadMore(Request $request)
    {
        $type = $request->query('type');
        $page = $request->query('page', 1);
        $perPage = $request->query('per_page', 10);

        if ($type === 'recent') {
            $alerts = Alert::where('created_at', '>=', now()->subDays(7))
                ->latest()
                ->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get();
        } else {
            $alerts = Alert::orderBy('created_at', 'desc')
                ->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get();
        }

        $formattedAlerts = $alerts->map(function ($alert) {
            return [
                'title' => $alert->title,
                'description' => $alert->description,
                'created_at' => $alert->created_at->format('h:i A')
            ];
        });

        return response()->json(['alerts' => $formattedAlerts]);
    }
}
