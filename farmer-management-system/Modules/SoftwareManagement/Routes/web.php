<?php

use Illuminate\Support\Facades\Route;
use Modules\SoftwareManagement\Controllers\SoftwareManagementController;

Route::get('/SoftwareManagement', [SoftwareManagementController::class, 'index']);