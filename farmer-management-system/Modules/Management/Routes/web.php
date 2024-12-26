<?php

use Illuminate\Support\Facades\Route;
use Modules\Management\Controllers\ManagementController;

Route::get('/Management', [ManagementController::class, 'index']);