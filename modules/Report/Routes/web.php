<?php

use Illuminate\Support\Facades\Route;
use Modules\Report\Controllers\DistrictVulnerabilityController;
use Modules\Report\Controllers\PrioritizedActivitiesController;
use Modules\Report\Controllers\PriorityController;

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
           
        Route::resource('priority', PriorityController::class);
        Route::resource('districtvulnerability', DistrictVulnerabilityController::class);
        Route::resource('prioritizedActivities', PrioritizedActivitiesController::class);
});
