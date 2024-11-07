<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\EmiController;
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


Auth::routes();

Route::get('/', [EmiController::class, 'showLoanDetails']);
Route::get('/process-data', [EmiController::class, 'showProcessPage']);
Route::post('/process-data', [EmiController::class, 'processData'])->name("process-data");
Route::get('/emidetails', [EmiController::class, 'showEmiDetails']);