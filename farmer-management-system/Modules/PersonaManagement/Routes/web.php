<?php

use Illuminate\Support\Facades\Route;
use Modules\PersonaManagement\Controllers\PersonaManagementController;

Route::get('/PersonaManagement', [PersonaManagementController::class, 'index']);