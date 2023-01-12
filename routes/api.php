<?php

use App\Http\Controllers\CardsController;
use App\Http\Controllers\ColumnsController;
use Illuminate\Support\Facades\Route;

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

//Column Routes
Route::get('columns', [ColumnsController::class, 'index']);
Route::post('columns', [ColumnsController::class, 'create']);
Route::put('columns/{column}', [ColumnsController::class, 'update']);
Route::delete('columns/{column}', [ColumnsController::class, 'destroy']);

//Card Routes
Route::post('columns/{column}/cards', [CardsController::class, 'create']);
Route::put('cards/{card}', [CardsController::class, 'update']);
Route::delete('cards/{card}', [CardsController::class, 'destroy']);
Route::put('cards/{card}/move', [CardsController::class, 'move']);

//Special router
Route::middleware('access-token')->get('list-cards', [CardsController::class, 'listCards']);
