<?php

use Illuminate\Support\Facades\Route;
use Modules\InventoryManagement\Controllers\InventoryManagementController;

Route::get('/InventoryManagement', [InventoryManagementController::class, 'index']);