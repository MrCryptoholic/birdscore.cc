<?php

use App\Http\Controllers\BirdScoreController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::middleware('throttle:100,1')->get('/{handle}', [BirdScoreController::class, 'score'])
    ->name('birdscore_by_handle');

Route::middleware('throttle:100,1')->get('/twitter.com/{handle}', [BirdScoreController::class, 'score'])
    ->name('birdscore_by_partial_url');

Route::middleware('throttle:100,1')->get('/https://twitter.com/{handle}', [BirdScoreController::class, 'score'])
    ->name('birdscore_by_url');
