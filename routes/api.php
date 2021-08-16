<?php

use App\Http\Controllers\Ranking\MovementRankingController;
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

Route::prefix('v1')->group(function () {
    Route::get('/ranking/movement/{id}', [MovementRankingController::class, 'index'])->name('ranking.movement.index');
});

Route::fallback(function(){
    return response()->json([
        'message' => 'Page not found.'], 404);
});
