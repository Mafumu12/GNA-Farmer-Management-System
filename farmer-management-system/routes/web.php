<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CreateModuleController;

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

//modules

Route::post('/upload-zip', [ModuleController::class, 'upload'])->name('module.upload');
Route::post('/create-Module', [CreateModuleController::class, 'create'])->name('module.create');
Route::get('/admin', function () {
    return Inertia::render('FarmerManagementSystem/Dashboard/Overview');
});

Route::get('/upload', function () {
    return Inertia::render('FarmerManagementSystem/Upload/Upload'); // Adjust path as per your directory
})->name('upload');


require __DIR__.'/auth.php';
