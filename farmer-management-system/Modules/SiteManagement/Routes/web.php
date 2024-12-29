<?php

use Illuminate\Support\Facades\Route;
use Modules\SiteManagement\Controllers\SiteManagementController;

Route::get('/SiteManagement', [SiteManagementController::class, 'index']);