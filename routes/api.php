<?php

use App\Http\Controllers\API\v1\EquipmentController;
use App\Http\Controllers\API\v1\LoginController;
use App\Http\Controllers\SignalingController;
use App\Http\Controllers\WebRTCController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::post('/login', [LoginController::class, 'login']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [LoginController::class, 'logout']);
        Route::post('/refresh', [LoginController::class, 'refresh']);
    });

    // Equipment routes
    Route::post('/equipment/login', [EquipmentController::class, 'login']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/equipment/logout', [EquipmentController::class, 'logout']);
        Route::post('/equipment/refresh', [EquipmentController::class, 'refresh']);
        Route::get('get-camera-list', [EquipmentController::class, 'getCameraList']);
    });
});

Route::post('/create-room', [WebRTCController::class, 'createRoom']);
Route::post('/join-room', [WebRTCController::class, 'joinRoom']);
Route::post('/add-candidate', [WebRTCController::class, 'addCandidate']);
Route::get('/room', [WebRTCController::class, 'getRoom']);
Route::post('/get-candidates', [WebRTCController::class, 'getCandidates']);
Route::post('/init-room', [WebRTCController::class, 'initRoom']);

Route::prefix('signaling')->group(function () {
    Route::get('room/{roomId}', [SignalingController::class, 'getRoom']);
    Route::post('room/{roomId}/answer', [SignalingController::class, 'setAnswer']);
    Route::post('room/{roomId}/callee-candidate', [SignalingController::class, 'addCalleeCandidate']);
    Route::get('room/{roomId}/caller-candidates', [SignalingController::class, 'getCallerCandidates']);
});
