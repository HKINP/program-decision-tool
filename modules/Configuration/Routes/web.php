<?php

use Illuminate\Support\Facades\Route;
use Modules\Configuration\Controllers\DistrictController;
use Modules\Configuration\Controllers\ProvinceController;
use Modules\Configuration\Controllers\QuestionController;
use Modules\Configuration\Controllers\StagesController;
use Modules\Configuration\Controllers\TagsController;
use Modules\Configuration\Controllers\targetgroupController;
use Modules\Configuration\Controllers\ThematicAreaController;

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
    Route::get('district/{district}/edit', [DistrictController::class, 'edit'])->name('district.edit');
    Route::put('district/{district}', [DistrictController::class, 'update'])->name('district.update');
    Route::delete('district/{district}', [DistrictController::class, 'destroy'])->name('district.destroy');
    Route::get('district/{district}/view', [DistrictController::class, 'view'])->name('district.view');
    // });

    // Route::middleware('can:manage-targetgroup')->prefix('privilege')->group(function(){
    Route::get('targetgroup', [TargetgroupController::class, 'index'])->name('targetgroup.index');
    Route::get('targetgroup/create', [TargetgroupController::class, 'create'])->name('targetgroup.create');
    Route::post('targetgroup', [TargetgroupController::class, 'store'])->name('targetgroup.store');
    Route::get('targetgroup/{targetgroup}/edit', [TargetgroupController::class, 'edit'])->name('targetgroup.edit');
    Route::put('targetgroup/{targetgroup}', [TargetgroupController::class, 'update'])->name('targetgroup.update');
    Route::delete('targetgroup/{targetgroup}', [TargetgroupController::class, 'destroy'])->name('targetgroup.destroy');
    Route::get('targetgroup/{targetgroup}/view', [TargetgroupController::class, 'view'])->name('targetgroup.view');
    // });

    // Route::middleware('can:manage-thematicarea')->prefix('privilege')->group(function(){
    Route::get('thematicarea', [ThematicAreaController::class, 'index'])->name('thematicarea.index');
    Route::get('thematicarea/create', [ThematicAreaController::class, 'create'])->name('thematicarea.create');
    Route::post('thematicarea', [ThematicAreaController::class, 'store'])->name('thematicarea.store');
    Route::get('thematicarea/{thematicarea}/edit', [ThematicAreaController::class, 'edit'])->name('thematicarea.edit');
    Route::put('thematicarea/{thematicarea}', [ThematicAreaController::class, 'update'])->name('thematicarea.update');
    Route::delete('thematicarea/{thematicarea}', [ThematicAreaController::class, 'destroy'])->name('thematicarea.destroy');
    Route::get('thematicarea/{thematicarea}/view', [ThematicAreaController::class, 'view'])->name('thematicarea.view');
    // });

    // Route::middleware('can:manage-thematicarea')->prefix('privilege')->group(function(){
    Route::get('stages', [StagesController::class, 'index'])->name('stages.index');
    Route::get('stages/create', [StagesController::class, 'create'])->name('stages.create');
    Route::post('stages', [StagesController::class, 'store'])->name('stages.store');
    Route::get('stages/{thematicarea}/edit', [StagesController::class, 'edit'])->name('stages.edit');
    Route::put('stages/{thematicarea}', [StagesController::class, 'update'])->name('stages.update');
    Route::delete('stages/{thematicarea}', [StagesController::class, 'destroy'])->name('stages.destroy');
    Route::get('stages/{thematicarea}/view', [StagesController::class, 'view'])->name('stages.view');
    // });

    // Route::middleware('can:manage-thematicarea')->prefix('privilege')->group(function(){
    Route::get('questions', [QuestionController::class, 'index'])->name('question.index');
    Route::get('questions/create', [QuestionController::class, 'create'])->name('question.create');
    Route::post('questions', [QuestionController::class, 'store'])->name('question.store');
    Route::get('questions/{question}/edit', [QuestionController::class, 'edit'])->name('question.edit');
    Route::put('questions/{question}', [QuestionController::class, 'update'])->name('question.update');
    Route::delete('questions/{question}', [QuestionController::class, 'destroy'])->name('question.destroy');
    Route::get('questions/{question}/view', [QuestionController::class, 'view'])->name('question.view');
    // });

    // Route::middleware('can:manage-thematicarea')->prefix('privilege')->group(function(){
        Route::get('tags', [TagsController::class, 'index'])->name('tags.index');
        Route::get('tags/create', [TagsController::class, 'create'])->name('tags.create');
        Route::post('tags', [TagsController::class, 'store'])->name('tags.store');
        Route::get('tags/{tags}/edit', [TagsController::class, 'edit'])->name('tags.edit');
        Route::put('tags/{tags}', [TagsController::class, 'update'])->name('tags.update');
        Route::delete('tags/{tags}', [TagsController::class, 'destroy'])->name('tags.destroy');
        Route::get('tags/{tags}/view', [TagsController::class, 'view'])->name('tags.view');
        // });
    




});
