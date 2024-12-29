<?php

use Illuminate\Support\Facades\Route;
use Modules\RoadManagement\Controllers\RoadManagementController;

Route::get('/RoadManagement', [RoadManagementController::class, 'index']);