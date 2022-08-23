<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnalyzerController;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [AnalyzerController::class, 'analyzer']);
Route::post('/', [AnalyzerController::class, 'urls'])->name('start');
Route::get('/urls', [AnalyzerController::class, 'index'])->name('index');
Route::get('/urls/{id}', [AnalyzerController::class, 'domain'])->name('urls');
