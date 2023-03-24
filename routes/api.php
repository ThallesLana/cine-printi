<?php

use App\Http\Controllers\MoviesController;
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

Route::get('/list', [MoviesController::class, 'listMovies']);
Route::get('/list/{id}', [MoviesController::class, 'listMoviesById']);
Route::post('/create',[MoviesController::class, 'createMovies']);
Route::put('/update', [MoviesController::class, 'updateMovies']);
Route::delete('/delete', [MoviesController::class, 'deleteMovies']);
