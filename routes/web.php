<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SurveyController;

Route::get('/', [SurveyController::class, 'create'])->name('create'); 
Route::post('/', [SurveyController::class, 'store'])->name('store');
Route::get('/logs', [SurveyController::class, 'logs'])->name('logs');
Route::get('/charts', [SurveyController::class, 'showSurveyCharts']);

