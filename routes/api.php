<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\GameGenreController;
use App\Http\Controllers\GenreController;
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

// genres api
Route::get("/genres", [GenreController::class, "index"]);
Route::post("/genres/create", [GenreController::class, "create"]);
Route::get("/genres/{id}", [GenreController::class, "view"]);
Route::post("/genres/{id}/update", [GenreController::class, "update"]);
Route::post("/genres/{id}/delete", [GenreController::class, "delete"]);

// games api
Route::get("/games", [GameController::class, "index"]);
Route::post("/games/create", [GameController::class, "create"]);
Route::get("/games/{id}", [GameController::class, "view"]);
Route::post("/games/{id}/update", [GameController::class, "update"]);
Route::post("/games/{id}/delete", [GameController::class, "delete"]);

// view games by genre
Route::get("/genre/{genre_id}/games", [GameGenreController::class, "index"]);
Route::get("/genre/{genre_id}/games/{game_id}", [GameGenreController::class, "view"]);

