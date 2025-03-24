<?php

use App\Models\WebRtcSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Store WebRTC session
Route::post('/webrtc-sessions', function (Request $request) {
    $validated = $request->validate([
        'room_id' => 'required|string',
        'offer' => 'nullable|string',
        'answer' => 'nullable|string',
    ]);

    $session = WebRtcSession::updateOrCreate(
        ['room_id' => $validated['room_id']], // Find by room_id
        ['offer' => $validated['offer'] ?? null, 'answer' => $validated['answer'] ?? null] // Update values
    );

    return response()->json(['message' => 'WebRTC session stored', 'data' => $session], 200);
});

// Get WebRTC session by room_id
Route::get('/webrtc-sessions', function () {
    $session = WebRtcSession::first();

    if (!$session) {
        return response()->json(['message' => 'Session not found'], 404);
    }

    return response()->json($session);
});
