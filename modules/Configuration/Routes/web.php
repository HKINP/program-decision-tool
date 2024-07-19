<?php

use Illuminate\Support\Facades\Route;
use Modules\Configuration\Controllers\DistrictController;
use Modules\Configuration\Controllers\ProvinceController;


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
Route::middleware(['web','auth', 'logger'])->group(function(){

    // Route::middleware('can:manage-district')->prefix('privilege')->group(function(){
        Route::get('province', [ProvinceController::class, 'index'])->name('province.index');
        Route::get('province/create', [ProvinceController::class, 'create'])->name('province.create');
        Route::post('province', [ProvinceController::class, 'store'])->name('province.store');
        Route::get('province/{province}/edit', [ProvinceController::class, 'edit'])->name('province.edit');
        Route::put('province/{province}', [ProvinceController::class, 'update'])->name('province.update');
        Route::delete('province/{province}', [ProvinceController::class, 'destroy'])->name('province.destroy');
        Route::get('province/{province}/view', [ProvinceController::class, 'view'])->name('province.view');
    // });

     
    // Route::middleware('can:manage-district')->prefix('privilege')->group(function(){
        Route::get('district', [DistrictController::class, 'index'])->name('district.index');
        Route::get('district/create', [DistrictController::class, 'create'])->name('district.create');
        Route::post('district', [DistrictController::class, 'store'])->name('district.store');
        Route::get('district/{province}/edit', [DistrictController::class, 'edit'])->name('district.edit');
        Route::put('district/{province}', [DistrictController::class, 'update'])->name('district.update');
        Route::delete('district/{province}', [DistrictController::class, 'destroy'])->name('district.destroy');
        Route::get('district/{province}/view', [DistrictController::class, 'view'])->name('district.view');
    // });
    
    
 
});