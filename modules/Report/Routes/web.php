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
        Route::put('priority/update/{did}', [PriorityController::class, 'updateBydistrict'])->name('priority.updatebydistrict');
        Route::resource('districtvulnerability', DistrictVulnerabilityController::class);
        Route::resource('prioritizedActivities', PrioritizedActivitiesController::class);

        Route::get('compiledreport', [PrioritizedActivitiesController::class, 'compiledReport'])->name('compiledreport.district');
        Route::get('workplanreport', [PrioritizedActivitiesController::class, 'workPlanReport'])->name('workPlanReport.index');
        Route::post('activiymapping', [PrioritizedActivitiesController::class, 'activityMapping'])->name('activityMapping.add');
        Route::post('activiymapping/{id}/edit', [PrioritizedActivitiesController::class, 'editctivityMapping'])->name('activityMapping.edit');
        Route::post('activiymapping/{id}/rollback', [PrioritizedActivitiesController::class, 'rollbackactivityMapping'])->name('activityMapping.rollback');
        Route::get('activiymapping/{id}/add', [PrioritizedActivitiesController::class, 'showAddForm'])->name('activityMapping.showAdd');
        Route::get('activiymapping/{id}/edit', [PrioritizedActivitiesController::class, 'showEditForm'])->name('activityMapping.showEdit');
        Route::get('activiymapping/{id}/rollback', [PrioritizedActivitiesController::class, 'showRollbackForm'])->name('activityMapping.showRollback');
        Route::post('stepremarks', [PrioritizedActivitiesController::class, 'stepRemarksadd'])->name('stepremarks.add');
        Route::get('compiledreport/province/{provinceid}', [PrioritizedActivitiesController::class, 'compiledReportProvince'])->name('compiledreport.province');
});
