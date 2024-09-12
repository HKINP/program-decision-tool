<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

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

Route::redirect('/', 'login');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/documentation', [DashboardController::class, 'documentation'])->name('documentation');
    Route::middleware('can:manage-data-entry')->group(function () {
        Route::get('steplist', [DashboardController::class, 'stageRecord'])->name('steplist.create');
    });
    Route::get('dataentry', [DashboardController::class, 'stages'])->name('dataentrystage.create');
    Route::get('/unauthorized', function () {
        return view('pages.utility.unauthorized'); // Path to the view
    })->name('unauthorized');
});


Route::get('/debug-session', function () {
    return session()->all();
});