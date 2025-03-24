<?php

use App\Models\WebRtcSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Store WebRTC session
Route::post('/webrtc-sessions', function (Request $request) {
    // dd($request);
    $validated = $request->validate([
        'room_id' => 'required|string|unique:web_rtc_sessions,room_id',
        'offer' => 'nullable|string',
        'answer' => 'nullable|string',
    ]);

    $session = WebRtcSession::create($validated);

    return response()->json(['message' => 'WebRTC session created', 'data' => $session], 201);
});

// Get WebRTC session by room_id
Route::get('/webrtc-sessions', function () {
    $session = WebRtcSession::first();

    if (!$session) {
        return response()->json(['message' => 'Session not found'], 404);
    }

    return response()->json($session);
});
