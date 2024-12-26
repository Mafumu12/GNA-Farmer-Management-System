<?php

use Illuminate\Support\Facades\Route;
use Modules\PeopleManagement\Controllers\PeopleManagementController;

Route::get('/PeopleManagement', [PeopleManagementController::class, 'index']);