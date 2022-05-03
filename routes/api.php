<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\ColumnController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('columns', [ColumnController::class, 'index']);
Route::get('columns/{id}', [ColumnController::class, 'get']);
Route::post('columns', [ColumnController::class, 'create']);
Route::delete('columns/{id}', [ColumnController::class, 'delete']);

Route::put('columns-seq', [ColumnController::class, 'updateSequences']);
Route::post('cards', [CardController::class, 'save']);
Route::delete('cards/{id}', [CardController::class, 'delete']);
