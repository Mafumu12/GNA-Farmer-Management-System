<?php

namespace Modules\LoanManagement\Controllers;

use Inertia\Inertia;
use App\Models\Farmer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\LoanManagement\Models\Loans;

class LoanManagementController extends Controller
{
    public function index()
    {
        return Inertia::render('LoanManagement/LoanManagement.vue');
    }

    public function createLoan(Request $request)
    {
        $validated = $request->validate([
            'loan_amount' => 'required|numeric|min:1',
            'interest_rate' => 'required|numeric|min:0',
            'repayment_duration' => 'required|integer|min:1',
            'farmer_id' => 'required|exists:farmers,id',
        ]);

        $loan = Loans::create([
            'loan_amount' => $validated['loan_amount'],
            'interest_rate' => $validated['interest_rate'],
            'repayment_duration' => $validated['repayment_duration'],
            'farmer_id' => $validated['farmer_id'],
            'status' => 'pending', // Default status is 'pending'
        ]);

        return response()->json(['message' => 'Loan created successfully', 'loan' => $loan]);
    }

    public function displayLoans(Request $request)
    {
        if ($request->wantsJson()) {
            // Return JSON if the request is an API call
            return response()->json([
                'loans' => Loans::with('farmer')->get(),
                'farmers' => Farmer::all(),
            ]);
        }

        // Return the Inertia view for web navigation
        return Inertia::render('LoanManagement/LoanManagement', [
            'loans' => Loans::with('farmer')->get(),
            'farmers' => Farmer::all(),
        ]);
    }

    public function approveLoan($id)
    {
        $loan = Loans::findOrFail($id);
        $loan->status = 'approved';
        $loan->save();

        return response()->json(['message' => 'Loan approved successfully']);
    }

    public function rejectLoan($id)
    {
        $loan = Loans::findOrFail($id);
        $loan->status = 'rejected';
        $loan->save();

        return response()->json(['message' => 'Loan rejected successfully']);
    }

    public function markAsRepaid($id)
    {
        $loan = Loans::findOrFail($id);

        // Ensure that only approved loans can be marked as repaid
        if ($loan->status !== 'approved') {
            return response()->json(['message' => 'Only approved loans can be marked as repaid'], 400);
        }

        $loan->status = 'repaid';
        $loan->save();

        return response()->json(['message' => 'Loan marked as repaid successfully']);
    }
}