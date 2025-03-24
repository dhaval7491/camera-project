<?php

use App\Models\WebRtcSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', function() {
    return view('superadmin.dashboard');
});


require __DIR__.'/superadmin.php';