<?php

use App\Http\Controllers\API\AmenityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\RatePlanController;
use App\Http\Controllers\API\ReservationController;
use App\Http\Controllers\API\RoomController;
use App\Http\Controllers\API\RoomTypeController;
use App\Http\Controllers\API\CountryController;
use App\Http\Controllers\API\GuestController;
use App\Http\Controllers\API\RoomAvailabiliyController;
use App\Http\Controllers\API\RoomAvailabilityController;
use App\Http\Controllers\API\RatePlanRoomTypeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return response()->json([
        'message' => 'Welcome to the API',
    ]);
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::resource('room-availabilities', RoomAvailabilityController::class);
    Route::resource('guests', GuestController::class);
    Route::resource('countries', CountryController::class);
    Route::resource('room-types', RoomTypeController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('reservations', ReservationController::class);
    Route::resource('rate-plans', RatePlanController::class);
    Route::resource('amenities', AmenityController::class);

    Route::post('/check-availability', [ReservationController::class, 'checkAvailability'])->name('reservations.check-availability');
});
