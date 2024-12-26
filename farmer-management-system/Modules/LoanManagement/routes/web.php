<?php

use Illuminate\Support\Facades\Route;
use Modules\LoanManagement\Controllers\LoanManagementController;

Route::get('/LoanManagement', [LoanManagementController::class, 'index']);