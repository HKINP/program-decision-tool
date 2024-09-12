<?php

use Illuminate\Support\Facades\Route;
use Modules\Configuration\Controllers\ActivitiesController;
use Modules\Configuration\Controllers\ActorsController;
use Modules\Configuration\Controllers\DistrictController;
use Modules\Configuration\Controllers\DistrictProfileController;
use Modules\Configuration\Controllers\IndicatorsController;
use Modules\Configuration\Controllers\OutcomesController;
use Modules\Configuration\Controllers\PlatformsController;
use Modules\Configuration\Controllers\ProvinceController;
use Modules\Configuration\Controllers\ProvinceProfileController;
use Modules\Configuration\Controllers\QuestionController;
use Modules\Configuration\Controllers\StagesController;
use Modules\Configuration\Controllers\TagsController;
use Modules\Configuration\Controllers\TargetGroupController;
use Modules\Configuration\Controllers\ThematicAreaController;
use Modules\Configuration\Controllers\ThresholdController;

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
    Route::get('targetgroup', [TargetGroupController::class, 'index'])->name('targetgroup.index');
    Route::get('targetgroup/create', [TargetGroupController::class, 'create'])->name('targetgroup.create');
    Route::post('targetgroup', [TargetGroupController::class, 'store'])->name('targetgroup.store');
    Route::get('targetgroup/{targetgroup}/edit', [TargetGroupController::class, 'edit'])->name('targetgroup.edit');
    Route::put('targetgroup/{targetgroup}', [TargetGroupController::class, 'update'])->name('targetgroup.update');
    Route::delete('targetgroup/{targetgroup}', [TargetGroupController::class, 'destroy'])->name('targetgroup.destroy');
    Route::get('targetgroup/{targetgroup}/view', [TargetGroupController::class, 'view'])->name('targetgroup.view');
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
    Route::post('stages/reset', [StagesController::class, 'resetStageStatus'])->name('stages.resetStatus');
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

    // Route::middleware('can:manage-thematicarea')->prefix('privilege')->group(function(){
    Route::get('platforms', [PlatformsController::class, 'index'])->name('platform.index');
    Route::get('platforms/create', [PlatformsController::class, 'create'])->name('platform.create');
    Route::post('platforms', [PlatformsController::class, 'store'])->name('platform.store');
    Route::get('platforms/{tags}/edit', [PlatformsController::class, 'edit'])->name('platform.edit');
    Route::put('platforms/{tags}', [PlatformsController::class, 'update'])->name('platform.update');
    Route::delete('platforms/{tags}', [PlatformsController::class, 'destroy'])->name('platform.destroy');
    Route::get('platforms/{tags}/view', [PlatformsController::class, 'view'])->name('platform.view');
    // });

    // Route::middleware('can:manage-thematicarea')->prefix('privilege')->group(function(){
    Route::get('actors', [ActorsController::class, 'index'])->name('actors.index');
    Route::get('actors/create', [ActorsController::class, 'create'])->name('actors.create');
    Route::post('actors', [ActorsController::class, 'store'])->name('actors.store');
    Route::get('actors/{actors}/edit', [ActorsController::class, 'edit'])->name('actors.edit');
    Route::put('actors/{actors}', [ActorsController::class, 'update'])->name('actors.update');
    Route::delete('actors/{actors}', [ActorsController::class, 'destroy'])->name('actors.destroy');
    Route::get('actors/{actors}/view', [ActorsController::class, 'view'])->name('actors.view');
    // });


    // Route::middleware('can:manage-thematicarea')->prefix('privilege')->group(function(){
    Route::get('activities', [ActivitiesController::class, 'index'])->name('activities.index');
    Route::get('activities/program', [ActivitiesController::class, 'programActivities'])->name('activities.program');
    Route::get('workplan', [ActivitiesController::class, 'workPlan'])->name('activities.workPlan');
    Route::get('activities/create', [ActivitiesController::class, 'create'])->name('activities.create');
    Route::post('activities', [ActivitiesController::class, 'store'])->name('activities.store');
    Route::get('activities/{actors}/edit', [ActivitiesController::class, 'edit'])->name('activities.edit');
    Route::put('activities/{actors}', [ActivitiesController::class, 'update'])->name('activities.update');
    Route::delete('activities/{actors}', [ActivitiesController::class, 'destroy'])->name('activities.destroy');
    Route::get('activities/{actors}/view', [ActivitiesController::class, 'view'])->name('activities.view');
    // });


    // Route::middleware('can:manage-thematicarea')->prefix('privilege')->group(function(){
    Route::get('threshold/question/{questionId}', [ThresholdController::class, 'getThresholdbyQuestionId'])->name('threshold.questionid');
    Route::get('threshold/create', [ThresholdController::class, 'create'])->name('threshold.create');
    Route::post('threshold', [ThresholdController::class, 'store'])->name('threshold.store');
    Route::get('threshold/{tags}/edit', [ThresholdController::class, 'edit'])->name('threshold.edit');
    Route::put('threshold/{tags}', [ThresholdController::class, 'update'])->name('threshold.update');
    Route::delete('threshold/{tags}', [ThresholdController::class, 'destroy'])->name('threshold.destroy');
    Route::get('threshold/{threshold}/view', [ThresholdController::class, 'view'])->name('threshold.view');
    // });

    // Route::middleware('can:manage-thematicarea')->prefix('privilege')->group(function(){
    Route::get('indicators', [IndicatorsController::class, 'index'])->name('indicators.index');
    Route::get('indicators/create', [IndicatorsController::class, 'create'])->name('indicators.create');
    Route::post('indicators', [IndicatorsController::class, 'store'])->name('indicators.store');
    Route::get('indicators/{indicators}/edit', [IndicatorsController::class, 'edit'])->name('indicators.edit');
    Route::put('indicators/{indicators}', [IndicatorsController::class, 'update'])->name('indicators.update');
    Route::delete('indicators/{indicators}', [IndicatorsController::class, 'destroy'])->name('indicators.destroy');
    Route::get('indicators/{indicators}/view', [IndicatorsController::class, 'view'])->name('indicators.view');
    // });

    // Route::middleware('can:manage-thematicarea')->prefix('privilege')->group(function(){
    Route::get('provinceprofile', [ProvinceProfileController::class, 'index'])->name('provinceprofile.index');
    Route::get('provinceprofile/create', [ProvinceprofileController::class, 'create'])->name('provinceprofile.create');
    Route::post('provinceprofile', [ProvinceprofileController::class, 'store'])->name('provinceprofile.store');
    Route::get('provinceprofile/{provinceprofile}/edit', [ProvinceprofileController::class, 'edit'])->name('provinceprofile.edit');
    Route::put('provinceprofile/{provinceprofile}', [ProvinceprofileController::class, 'update'])->name('provinceprofile.update');
    Route::delete('provinceprofile/{provinceprofile}', [ProvinceprofileController::class, 'destroy'])->name('provinceprofile.destroy');
    Route::get('provinceprofile/{provinceprofile}/view', [ProvinceprofileController::class, 'view'])->name('provinceprofile.view');
    // });


    // Route::middleware('can:manage-thematicarea')->prefix('privilege')->group(function(){
    Route::get('districtprofile', [DistrictProfileController::class, 'index'])->name('districtprofile.index');
    Route::get('districtprofile/create', [DistrictprofileController::class, 'create'])->name('districtprofile.create');
    Route::post('districtprofile', [DistrictprofileController::class, 'store'])->name('districtprofile.store');
    Route::get('districtprofile/{districtprofile}/edit', [DistrictprofileController::class, 'edit'])->name('districtprofile.edit');
    Route::put('districtprofile/{districtprofile}', [DistrictprofileController::class, 'update'])->name('districtprofile.update');
    Route::delete('districtprofile/{districtprofile}', [DistrictprofileController::class, 'destroy'])->name('districtprofile.destroy');
    Route::get('districtprofile/{districtprofile}/view', [DistrictprofileController::class, 'view'])->name('districtprofile.view');
    // });

    
    // Route::middleware('can:manage-thematicarea')->prefix('privilege')->group(function(){
        Route::get('outcomes', [OutcomesController::class, 'index'])->name('outcomes.index');
        Route::get('outcomes/create', [OutcomesController::class, 'create'])->name('outcomes.create');
        Route::post('outcomes', [OutcomesController::class, 'store'])->name('outcomes.store');
        Route::get('outcomes/{districtprofile}/edit', [OutcomesController::class, 'edit'])->name('outcomes.edit');
        Route::put('outcomes/{districtprofile}', [OutcomesController::class, 'update'])->name('outcomes.update');
        Route::delete('outcomes/{districtprofile}', [OutcomesController::class, 'destroy'])->name('outcomes.destroy');
        Route::get('outcomes/{districtprofile}/view', [OutcomesController::class, 'view'])->name('outcomes.view');
        // });


});
