<?php

use App\Http\Controllers\QuestionsController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function () {
    Route::get('/binaryquestions', [QuestionsController::class, 'GetBinaryQuestions']);
    Route::get('/multichoicequestions', [QuestionsController::class, 'GetMultiChoiceQuestions']);
    Route::get('/binarystatistics', [QuestionsController::class, 'GetBinaryStatistics']);
    Route::get('/multichoicetistics', [QuestionsController::class, 'GetMultiChoiceStatistics']);
    Route::post('/checkbinaryanswer', [QuestionsController::class, 'CheckBinaryAnswer']);
    Route::post('/checkmultichoicesanswer', [QuestionsController::class, 'CheckMultiChoiceAnswer']);
    Route::post('/savebinarystatistics', [QuestionsController::class, 'SaveBinaryStatistics']);
    Route::post('/savemultichoicestatistics', [QuestionsController::class, 'SaveMultiChoiceStatistics']);
});
