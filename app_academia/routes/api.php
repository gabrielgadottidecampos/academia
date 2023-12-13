<?php

use App\Http\Controllers\AcademiaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\PlanoController;
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
Route::apiResource('cliente', ClienteController::class);
Route::apiResource('academia', AcademiaController::class);
Route::apiResource('plano', PlanoController::class);
Route::apiResource('matricula', MatriculaController::class);