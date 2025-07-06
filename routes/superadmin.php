<?php

use App\Http\Controllers\AlertController;
use App\Http\Controllers\AnalyticController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Equipment;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\LiveStreamController;
use App\Http\Controllers\MappingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SignalingController;
use App\Http\Controllers\Superadmin\DashboardController;
use App\Http\Controllers\Superadmin\LoginController;
use App\Http\Controllers\TrackableController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('superadmin',function() {
    return view('superadmin.webrtc');
});
Route::get('/superadmin/reset_password', function() {
    return view('superadmin.reset_password');
});
Route::get('/superadmin/login',[LoginController::class,'showLoginPage'])->name('superadmin.login.page');
Route::post('/superadmin/login',[LoginController::class,'login'])->name('superadmin.login');
Route::get('password/reset', [ResetPasswordController::class, 'showLinkRequestForm'])->name('password.request');

// Handle email submission
Route::post('password/email', [ResetPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Show form to reset password
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

// Handle password reset
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::middleware(['superadmin_auth'])->group(function(){
    Route::get('/superadmin/dashboard',[DashboardController::class,'index'])->name('superadmin.dashboard');
    Route::get('/superadmin/logout',[DashboardController::class,'logout'])->name('superadmin.logout');
    Route::resource('companies', CompanyController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('users', UserController::class);
    Route::resource('equipments', EquipmentController::class);
    Route::resource('mappings', MappingController::class);
    Route::resource('trackables', TrackableController::class);
    Route::get('/alerts',[AlertController::class,'index'])->name('alerts.index');
    Route::get('/settings',[SettingController::class,'index'])->name('settings.index');
    Route::get('/settings/equipments', [SettingController::class, 'equipments'])->name('settings.equipments');
    Route::get('/settings/mappings', [SettingController::class, 'mappings'])->name('settings.mappings');
    Route::get('/settings/trackables', [SettingController::class, 'trackables'])->name('settings.trackables');
    Route::get('/account-settings',[SettingController::class,'accountSettings'])->name('account-settings');
    Route::get('/live-stream',[LiveStreamController::class,'index'])->name('streams.index');
    Route::get('/analytics',[AnalyticController::class,'index'])->name('analytics.index');
    Route::get('/alerts/load-more', [AlertController::class, 'loadMore'])->name('alerts.load-more');
    Route::get('/get-company-data', [CompanyController::class, 'data'])->name('companies.data');
    Route::get('/get-project-data', [ProjectController::class, 'data'])->name('projects.data');
    Route::get('/get-user-data', [UserController::class, 'data'])->name('users.data');
    // New routes for toggling active status
    Route::post('/companies/{company}/toggle-active', [CompanyController::class, 'toggleActive'])->name('companies.toggle-active');
    Route::post('/projects/{project}/toggle-active', [ProjectController::class, 'toggleActive'])->name('projects.toggle-active');
    Route::post('/equipments/{equipment}/toggle-active', [EquipmentController::class, 'toggleActive'])->name('equipments.toggle-active');
    Route::post('/trackables/{trackable}/toggle-active', [TrackableController::class, 'toggleActive'])->name('trackables.toggle-active');
    Route::post('/mapping/{mapping}/toggle-active', [MappingController::class, 'toggleActive'])->name('mapping.toggle-active');
    Route::post('/users/{user}/toggle-active', [UserController::class, 'toggleActive'])->name('users.toggle-active');
    Route::post('/mappings/{mapping}/toggle-active', [MappingController::class, 'toggleActive'])->name('mappings.toggle-active');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::get('/streams/{camera_id}', [LiveStreamController::class, 'show'])->name('streams.show');
    Route::post('/equipments/generate-code', [EquipmentController::class, 'generateEquipmentCode'])->name('equipments.generate-code');
    Route::post('/mappings/get-projects', [MappingController::class, 'getProjects'])->name('mappings.get-projects');
    Route::post('/mappings/get-companies', [MappingController::class, 'getCompanies'])->name('mappings.get-companies');
    Route::get('/get-companies', [CompanyController::class, 'getCompanies'])->name('get-companies');
});

Route::prefix('signaling')->group(function () {
    Route::get('room/{roomId}', [SignalingController::class, 'getRoom']);
    Route::post('room/{roomId}/answer', [SignalingController::class, 'setAnswer']);
    Route::post('room/{roomId}/callee-candidate', [SignalingController::class, 'addCalleeCandidate']);
    Route::get('room/{roomId}/caller-candidates', [SignalingController::class, 'getCallerCandidates']);
});