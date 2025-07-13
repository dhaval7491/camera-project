<?php

namespace App\Http\Controllers;

use App\Models\WeatherData;
use Illuminate\Http\Request;

class WeatherDataController extends Controller
{
    public function store(Request $request)
    {
        // Get equipment_id from the authenticated user
        $equipmentId = auth()->user()->id;

        // Validate only temp and wind, since equipment_id is not from request
        $validated = $request->validate([
            'temp' => 'required|numeric',
            'wind' => 'required|numeric',
        ]);

        // Merge equipment_id into the validated data
        $validated['equipment_id'] = $equipmentId;

        // Create the record
        $data = WeatherData::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Weather data inserted successfully.',
            'data' => $data
        ]);
    }

    // Fetch all weather data
    public function getWeatherData($equiment)
    {
        $data = WeatherData::where('equipment_id', $equiment)->first();

        return response()->json([
            'success' => true,
            'message' => 'Weather data retreived successfully.',
            'data' => $data
        ]);
    }
}
