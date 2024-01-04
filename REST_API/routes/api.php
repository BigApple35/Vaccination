<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConsultationsController;
use App\Http\Controllers\SpotsController;
use App\Http\Controllers\VaccinationsController;
use App\Http\Middleware\AuthMiddleware;
use App\Models\Vaccinations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('v1/auth/login', [AuthController::class,'login']);

Route::middleware(AuthMiddleware::class)->group(function () {
    Route::post('v1/auth/logout',[AuthController::class, 'logout']);
});

Route::middleware(AuthMiddleware::class)->group(function () {
    Route::resource('v1/consultations', ConsultationsController::class);
});

Route::middleware(AuthMiddleware::class)->group(function () {
    Route::resource('v1/spots', SpotsController::class);
});

Route::middleware(AuthMiddleware::class)->group(function () {
    Route::resource('v1/vaccinations', VaccinationsController::class);
});