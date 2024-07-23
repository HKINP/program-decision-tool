<?php

use Illuminate\Support\Facades\Route;
use Modules\Report\Controllers\PrioritiesController;

/*
|--------------------------------------------------------------------------
| Application Routes for User Module
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::middleware(['web', 'auth', 'logger'])->group(function () {

    // Route::middleware('can:manage-district')->prefix('privilege')->group(function(){
     Route::get('priorities', [PrioritiesController::class, 'index'])->name('priorities.index');
    Route::get('priorities/create', [PrioritiesController::class, 'create'])->name('priorities.create');
    Route::post('priorities', [PrioritiesController::class, 'store'])->name('priorities.store');
    Route::get('priorities/{priorities}/edit', [PrioritiesController::class, 'edit'])->name('priorities.edit');
    Route::put('priorities/{priorities}', [PrioritiesController::class, 'update'])->name('priorities.update');
    Route::delete('priorities/{priorities}', [PrioritiesController::class, 'destroy'])->name('priorities.destroy');
    Route::get('priorities/{priorities}/view', [PrioritiesController::class, 'view'])->name('priorities.view');
    // });

});
