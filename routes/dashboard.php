<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Configuration;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LabRequestController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard Navigation Routes
|--------------------------------------------------------------------------
*/

// Dashboard sidebar
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'home'])->name('home');

    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments');

    // 
    Route::get('/patients', [PatientController::class, 'index'])->name('patients');

    // 
    Route::get('/laboratory', [LabRequestController::class, 'index'])->name('laboratory');

    // 
    Route::get('/scans', [ScanController::class, 'index'])->name('scans');

    // 
    Route::get('/users', [HomeController::class, 'home'])->name('users');

    // Doctors
    Route::name('doctors.')
        ->prefix('doctors')
        ->group(
            function () {
                Route::get('/', [DoctorController::class, 'index'])->name('index');
                Route::get('/create', [DoctorController::class, 'create'])->name('create');
                Route::post('/store', [DoctorController::class, 'store'])->name('store');
            }
        );

    // 
    Route::get('/sessions', [SessionController::class, 'index'])->name('sessions');

    // 
    Route::get('/configuration', Configuration::class)->name('configuration');

    // 
    // Route::post('/sessions/store', [SessionController::class, 'store'])->name('sessions.create');

    // 
});