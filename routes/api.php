<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\PersonaController;

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

Route::get('/savesource', [ApiController::class, 'saveFromExternalSource']);
Route::get('/getPersons', [PersonaController::class, 'index']);
Route::post('/createPerson', [PersonaController::class, 'store']);
Route::delete('/deletePerson/{persona}', [PersonaController::class, 'destroy']);