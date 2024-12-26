<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\FarmersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CreateModuleController;
use App\Http\Controllers\MonduleStateController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//Dashboard
Route::get('/admin-dashboard',  [FarmersController::class, 'index']);
Route::post('/register-farmer', [FarmersController::class, 'store'])->name('farmer.create');
Route::put('/farmers/{id}', [FarmersController::class, 'update'])->name('farmers.update');

// Delete a farmer
Route::delete('/farmers/{id}', [FarmersController::class, 'destroy'])->name('farmers.destroy');
//modules
Route::get('/module-management', [MonduleStateController::class, 'getModules']);
Route::post('/upload-zip', [ModuleController::class, 'upload'])->name('module.upload');
Route::post('/create-Module', [CreateModuleController::class, 'create'])->name('module.create');
Route::post('/module/{moduleName}/toggle', [MonduleStateController::class, 'toggleActivation']);
Route::delete('/module/{moduleName}', [MonduleStateController::class, 'deleteModule']);





require __DIR__.'/auth.php';
