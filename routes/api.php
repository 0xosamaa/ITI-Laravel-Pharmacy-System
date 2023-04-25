<?php

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\MedicineController;
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
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/api/medicines');
    Route::get('/api/medicines', [MedicineController::class, 'index']);
    Route::get('/api/medicines/{medicine}', [MedicineController::class, 'show']);
    Route::get('/api/cart', [CartController::class, 'index']);
});

