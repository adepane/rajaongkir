<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RajaOnkirController;
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

Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/search/provinces', [RajaOnkirController::class, 'getProvinces']);
Route::middleware('auth:sanctum')->get('/search/cities', [RajaOnkirController::class, 'getCities']);
