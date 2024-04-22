<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DailyTimeRecordController;

Route::get('/', [DailyTimeRecordController::class, 'process']);