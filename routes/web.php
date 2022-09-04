<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnalyzerController;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\UrlChecksController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AnalyzerController::class, 'analyzer'])->name('start');
Route::post('/', [UrlController::class, 'store']);

Route::resource('urls', UrlController::class)
    ->only(['index', 'store', 'show']);

Route::resource('urls.checks', UrlChecksController::class)
    ->only(['store']);
