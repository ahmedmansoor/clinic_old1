<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PatientController;
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
    Route::get('/patients', [PatientController::class, 'index'])->name('patients');
    Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors');
    Route::get('/users', [HomeController::class, 'home'])->name('users');
});