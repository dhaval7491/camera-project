<?php

use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', function() {
    return view('superadmin.dashboard');
});

require __DIR__.'/superadmin.php';