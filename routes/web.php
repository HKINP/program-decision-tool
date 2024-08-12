<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataFeedController;
use App\Http\Controllers\DashboardController;
// // use App\Http\Controllers\CustomerController;
// use App\Http\Controllers\OrderController;
// use App\Http\Controllers\InvoiceController;
// use App\Http\Controllers\MemberController;
// use App\Http\Controllers\TransactionController;
// use App\Http\Controllers\JobController;
// use App\Http\Controllers\CampaignController;

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

    // Route for the getting the data feed
    Route::get('/json-data-feed', [DataFeedController::class, 'getDataFeed'])->name('json_data_feed');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/documentation', [DashboardController::class, 'documentation'])->name('documentation');
    Route::get('steplist', [DashboardController::class, 'stageRecord'])->name('steplist.create');
    Route::get('dataentry', [DashboardController::class, 'stages'])->name('dataentrystage.create'); 
});
