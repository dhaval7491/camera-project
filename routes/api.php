<?php

use App\Http\Controllers\WebRTCController;
use App\Models\WebRtcSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/create-room', [WebRTCController::class, 'createRoom']);
Route::post('/join-room', [WebRTCController::class, 'joinRoom']);
Route::post('/add-candidate', [WebRTCController::class, 'addCandidate']);
Route::get('/room/{roomId}', [WebRTCController::class, 'getRoom']);
Route::post('/get-candidates', [WebRTCController::class, 'getCandidates']);
