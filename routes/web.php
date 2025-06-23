<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyController;

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
Route::get('/charts', [SurveyController::class, 'showSurveyCharts'])->name('survey.charts');
Route::get('/logs', [SurveyController::class, 'logs'])->name('survey.logs');

Route::post('/check-employee', [SurveyController::class, 'checkEmployee']);
