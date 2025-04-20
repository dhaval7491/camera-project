<?php

use App\Http\Controllers\AlertController;
use App\Http\Controllers\AnalyticController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Equipment;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\LiveStreamController;
use App\Http\Controllers\MappingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Superadmin\DashboardController;
use App\Http\Controllers\Superadmin\LoginController;
use App\Http\Controllers\TrackableController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('superadmin',function() {
    return view('superadmin.dashboard');
});

Route::get('/superadmin/login',[LoginController::class,'showLoginPage'])->name('superadmin.login.page');
Route::post('/superadmin/login',[LoginController::class,'login'])->name('superadmin.login');
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
    Route::get('/live-stream',[LiveStreamController::class,'index'])->name('streams.index');
    Route::get('/analytics',[AnalyticController::class,'index'])->name('analytics.index');
    Route::get('/alerts/load-more', [AlertController::class, 'loadMore'])->name('alerts.load-more');
    Route::get('/get-company-data', [CompanyController::class, 'data'])->name('companies.data');
    Route::get('/get-project-data', [ProjectController::class, 'data'])->name('projects.data');
    // New routes for toggling active status
    Route::post('/companies/{company}/toggle-active', [CompanyController::class, 'toggleActive'])->name('companies.toggle-active');
    Route::post('/projects/{project}/toggle-active', [ProjectController::class, 'toggleActive'])->name('projects.toggle-active');
    Route::post('/equipments/{equipment}/toggle-active', [EquipmentController::class, 'toggleActive'])->name('equipments.toggle-active');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');
});
