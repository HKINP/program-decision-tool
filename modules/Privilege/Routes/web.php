<?php

use Illuminate\Support\Facades\Route;
use Modules\Privilege\Controllers\UserController;
use Modules\Privilege\Controllers\PermissionController;
use Modules\Privilege\Controllers\RoleController;
use Modules\Privilege\Controllers\UserExportController;
use Modules\Privilege\Controllers\UserImportController;
use Modules\Privilege\Controllers\UserPasswordChangeController;


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

Route::middleware(['web','auth','logger'])->namespace('Modules\Privilege\Controllers')->group(function(){

    // Route::middleware('can:manage-permission')->prefix('privilege')->group(function(){
        Route::get('permission', [PermissionController::class, 'index'])->name('permission.index');
        Route::get('permission/create', [PermissionController::class, 'create'])->name('permission.create');
        Route::post('permission', [PermissionController::class, 'store'])->name('permission.store');
        Route::get('permission/{permission}/edit', [PermissionController::class, 'edit'])->name('permission.edit');
        Route::put('permission/{permission}', [PermissionController::class, 'update'])->name('permission.update');
        Route::delete('permission/{permission}', [PermissionController::class, 'destroy'])->name('permission.destroy');
        Route::get('permission/{permission}/view', [PermissionController::class, 'view'])->name('permission.view');
    // });

    
    // Route::middleware('can:manage-privilege')->prefix('privilege')->group(function(){
        Route::get('role', [RoleController::class, 'index'])->name('role.index');
        Route::get('role/create', [RoleController::class, 'create'])->name('role.create');
        Route::post('role', [RoleController::class, 'store'])->name('role.store');
        Route::get('role/{role}/edit', [RoleController::class, 'edit'])->name('role.edit');
        Route::put('role/{role}', [RoleController::class, 'update'])->name('role.update');
        Route::delete('role/{role}', [RoleController::class, 'destroy'])->name('role.destroy');
        Route::get('role/{role}/view', [RoleController::class, 'view'])->name('role.view');

        Route::get('user', [UserController::class, 'index'])->name('user.index');
        Route::get('user', [UserController::class, 'index'])->name('user.index');
        Route::get('user/create', [UserController::class, 'create'])->name('user.create');
        Route::post('user', [UserController::class, 'store'])->name('user.store');
        Route::get('user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('user/{user}', [UserController::class, 'update'])->name('user.update');
        Route::get('user/getuser', [UserController::class, 'get'])->name('user.get');
        Route::delete('user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
        Route::get('user/import/excel', [UserImportController::class, 'create'])->name('configuration.user.import.create');
        Route::post('user/import/excel', [UserImportController::class, 'store'])->name('configuration.user.import.store');
        Route::get('user/export/excel', [UserExportController::class, 'index'])->name('configuration.user.export');

        Route::put('user/change/status/{user}', [UserController::class, 'changeStatus'])->name('user.change.status');
        Route::get('user/{user}/change/password', [UserPasswordChangeController::class, 'getChangePassword'])->name('user.get.change.password');
        Route::post('user/change/password', [UserPasswordChangeController::class, 'changePassword'])->name('user.change.password');

     
    // });

    // Route::get('profile', [UserProfileController::class, 'index'])->middleware(['guideline.checker'])->name('user.profile.index');


    // Route::post('profile/update', [UserProfileController::class, 'update'])->name('user.profile.update');

    // Route::get('profile/print/leavesummary', [UserPrintController::class, 'printLeaveSummary'])->middleware(['guideline.checker'])->name('user.leavesummary.print');

    // Route::get('profile/print/inventories', [UserPrintController::class, 'printInventories'])->middleware(['guideline.checker'])->name('user.inventories.print');

    // Route::get('user/{user}/department/edit', [UserDepartmentController::class, 'edit'])->name('user.department.edit');
    // Route::put('user/department/{department}', [UserDepartmentController::class, 'update'])->name('user.department.update');

    // Route::get('authority/delegation', [UserDelegationController::class, 'index'])->name('authority.delegation.index');
    // Route::get('authority/delegation/create', [UserDelegationController::class, 'create'])->name('authority.delegation.create');
    // Route::post('authority/delegation', [UserDelegationController::class, 'store'])->name('authority.delegation.store');
    // Route::get('authority/delegation/{delegation}/edit', [UserDelegationController::class, 'edit'])->name('authority.delegation.edit');
    // Route::put('authority/delegation/{delegation}', [UserDelegationController::class, 'update'])->name('authority.delegation.update');
    // Route::put('authority/delegation/deactivate/{delegation}', [UserDelegationController::class, 'deactivate'])->name('authority.delegation.change.status');

    // Route::get('profile/inventories', [UserInventoryController::class, 'index'])->name('user.profile.inventory.index');

    // Route::get('guidelines', [UserGuidelineController::class, 'index'])->name('guideline.index');
    // Route::get('guidelinescheck', [UserGuidelineController::class, 'guidelinescheck'])->name('guideline.guidelinescheck');
    // Route::get('guidelines/{guideline}', [UserGuidelineController::class, 'show'])->name('guideline.show');
});