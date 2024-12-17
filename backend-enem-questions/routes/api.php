<?php

use App\Http\Controllers\Api\AnswersController;
use App\Http\Controllers\Api\QuestionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('questions', QuestionsController::class)->except([
    'create', 'edit'
    ]);
Route::apiResource('answers', AnswersController::class)->except([
    'create', 'edit', 'show'
    ]);
