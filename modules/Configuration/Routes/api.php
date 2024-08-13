<?php
use Illuminate\Support\Facades\Route;
use Modules\Configuration\Controllers\Api\QuestionApiController;
use Modules\Configuration\Controllers\Api\ThematicAreaApiController;
use Modules\Configuration\Controllers\OutcomesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('api')->group(function() {
    Route::get('thematicarea/{targetGroupId}', [ThematicAreaApiController::class, 'getbytargetId'])->name('targetgroup.getbytargetId');
    Route::get('priorities/questions/{thematicAreaId}', [QuestionApiController::class, 'getbythematicareaID'])->name('question.getbythematicareaID');
    Route::get('outcomes/ir/{ir_id}', [OutcomesController::class, 'getOutcomesByIrid'])->name('outcomes.getOutcomesByIrid');
});
