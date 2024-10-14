<?php

declare(strict_types=1);

use App\Http\Controllers\MovieController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ScreeningController;
use Illuminate\Support\Facades\Route;

// Movies
Route::apiResource('/movies', MovieController::class);

// Screenings
Route::apiResource('/screenings', ScreeningController::class);

// Schedule
Route::apiResource('/schedule', ScheduleController::class)->only('index');
