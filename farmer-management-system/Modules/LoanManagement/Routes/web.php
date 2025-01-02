<?php

use Illuminate\Support\Facades\Route;
use Modules\LoanManagement\Controllers\LoanManagementController;

Route::post('/create-loan', [LoanManagementController::class, 'createLoan']); // Create a new loan
Route::get('/LoanManagement', [LoanManagementController::class, 'displayLoans']); // Display all loans
Route::put('{id}/approve', [LoanManagementController::class, 'approveLoan']); // Approve a loan
Route::put('{id}/reject', [LoanManagementController::class, 'rejectLoan']); // Reject a loan
Route::put('{id}/repaid', [LoanManagementController::class, 'markAsRepaid']); // Mark a loan as repaid
Route::get('/loans/{id}', [LoanManagementController::class, 'show']);
Route::get('/loan-reports', [LoanManagementController::class, 'loanReports']);
