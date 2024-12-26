<?php

use Illuminate\Support\Facades\Route;
use Modules\ProjectManagement\Controllers\ProjectManagementController;

Route::get('/ProjectManagement', [ProjectManagementController::class, 'index']);