<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Survey Routes
Route::get('/', [SurveyController::class, 'create'])->name('survey.create');
Route::get('/survey', [SurveyController::class, 'create'])->name('survey.create');
Route::post('/survey', [SurveyController::class, 'store'])->name('store');
Route::get('/completed', [SurveyController::class, 'completed'])->name('completed');

// Additional routes if you have them
Route::get('/charts', [SurveyController::class, 'showSurveyCharts'])->name('charts');
Route::get('/logs', [SurveyController::class, 'logs'])->name('logs');
Route::post('/charts/email', [SurveyController::class, 'submitChartEmail'])->name('charts.email');
Route::post('/logs/email', [SurveyController::class, 'submitLogsEmail'])->name('logs.email');

Route::post('/check-employee', [SurveyController::class, 'checkEmployee']);
