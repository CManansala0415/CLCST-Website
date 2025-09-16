<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DefaultsController;

Route::middleware('api')->group(function () {
    Route::post('/add-applicant', [DefaultsController::class, 'addApplicant']);
    Route::get('/get-demograph', [DefaultsController::class, 'getDemograph']);
    Route::get('/get-applicant/{id}', [DefaultsController::class, 'getApplicant']);
});