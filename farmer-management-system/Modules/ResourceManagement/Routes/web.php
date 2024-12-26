<?php

use Illuminate\Support\Facades\Route;
use Modules\ResourceManagement\Controllers\ResourceManagementController;

Route::get('/ResourceManagement', [ResourceManagementController::class, 'index']);