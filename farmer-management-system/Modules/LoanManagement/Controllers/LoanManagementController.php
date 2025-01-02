<?php

namespace Modules\LoanManagement\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Farmer;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\LoanManagement\Models\Loan;
use Exception;
class LoanManagementController extends Controller
{
     
    public function createLoan(Request $request)
    {
        try {
            $validated = $request->validate([
                'loan_amount' => 'required|numeric|min:1',
                'interest_rate' => 'required|numeric|min:0',
                'repayment_duration' => 'required|integer|min:1',
                'farmer_id' => 'required|exists:farmers,id',
            ]);

            $loan = Loan::create([
                'loan_amount' => $validated['loan_amount'],
                'interest_rate' => $validated['interest_rate'],
                'repayment_duration' => $validated['repayment_duration'],
                'farmer_id' => $validated['farmer_id'],
                'status' => 'pending', // Default status is 'pending'
            ]);

            return response()->json(['message' => 'Loan created successfully', 'loan' => $loan]);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while creating the loan.', 'details' => $e->getMessage()], 500);
        }
    }

    public function displayLoans(Request $request)
    {
        try {
            $loans = Loan::with('farmer')->get(); // Load loans with farmer details

            $farmers = Farmer::all();
    
            if ($request->wantsJson()) {
                // Return JSON if the request is an API call
                return response()->json([
                    'loans' => $loans,
                    'farmers' => $farmers
                ]);
            }
    
            // Return the Inertia view for web navigation
            return Inertia::render('LoanManagement/LoanManagement', [
                'loans' => $loans,
                'farmers' => $farmers

            ]);
    
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while retrieving loans.', 'details' => $e->getMessage()], 500);
        }
    }
    


    public function loanReports()
    {

        try { 


         $loans = Loan::with('farmer')->get();

         return Inertia::render('LoanManagement/Reports',['loans'=>$loans]);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while retrieving loans.', 'details' => $e->getMessage()], 500);
        }


    }

    public function approveLoan($id)
    {
        try {
            $loan = Loan::findOrFail($id);
            $loan->status = 'approved';
            $loan->save();

            return response()->json(['message' => 'Loan approved successfully']);

        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while approving the loan.', 'details' => $e->getMessage()], 500);
        }
    }

    public function rejectLoan($id)
    {
        try {
            $loan = Loan::findOrFail($id);
            $loan->status = 'rejected';
            $loan->save();

            return response()->json(['message' => 'Loan rejected successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while rejecting the loan.', 'details' => $e->getMessage()], 500);
        }
    }

    public function markAsRepaid($id)
    {
        try {
            $loan = Loan::findOrFail($id);

            // Ensure that only approved loans can be marked as repaid
            if ($loan->status !== 'approved') {
                return response()->json(['message' => 'Only approved loans can be marked as repaid'], 400);
            }

            $loan->status = 'repaid';
            $loan->save();

            return response()->json(['message' => 'Loan marked as repaid successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while marking the loan as repaid.', 'details' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $loan = Loan::findOrFail($id);
            return response()->json($loan);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while retrieving the loan details.', 'details' => $e->getMessage()], 500);
        }
    }

}
