<?php

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TokenController;
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

// Route::get('/', [HomeController::class, 'index']);

Route::get('/', [HomeController::class, 'index']);
Route::post('/', [HomeController::class, 'store']);

Route::get('/vote/{token:token}', [HomeController::class, 'indexVote']);
Route::post('/vote/{token:token}', [HomeController::class, 'storeVote']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::post('/dashboard/reset', [DashboardController::class, 'reset']);

    Route::resource('/token', TokenController::class);
    Route::post('/token/reset', [TokenController::class, 'reset']);

    Route::resource('/calon', CandidateController::class);
    Route::post('/calon/reset', [CandidateController::class, 'reset']);

    Route::get('/settings', [LoginController::class, 'settings']);
    Route::put('/settings/change-password', [LoginController::class, 'changePassword']);

    Route::get('/logout', [LoginController::class, 'logout']);
});
