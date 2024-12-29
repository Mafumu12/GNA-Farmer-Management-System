<?php

use Illuminate\Support\Facades\Route;
use Modules\FarmManagement\Controllers\FarmManagementController;

Route::get('/FarmManagement', [FarmManagementController::class, 'index']);