<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReservationGuestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test', function () {
    $user = User::first();
    dd($user);
});

Route::get('/', function () {
    return view('welcome');
});

require __DIR__ . '/auth.php';

// Route::group(['middleware' => ['auth']], function () {
//     Route::resource('reservations', ReservationController::class);
//     Route::resource('guests', GuestController::class);
//     Route::resource('reservations.guests', ReservationGuestController::class);
// });