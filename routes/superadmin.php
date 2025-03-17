<?php

use App\Http\Controllers\Superadmin\CompanyController;
use App\Http\Controllers\Superadmin\DashboardController;
use App\Http\Controllers\Superadmin\LoginController;
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
});
