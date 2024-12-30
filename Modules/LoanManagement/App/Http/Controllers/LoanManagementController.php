<?php

namespace Modules\LoanManagement\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Farmer;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Modules\LoanManagement\App\Models\Loan;

class LoanManagementController extends Controller
{
    /**
     * Display a listing of loans.
     */
    public function index()
    {
               // Get the total loan amount
               $totalLoans = Loan::sum('loan_amount');

               // Get the count of active farmers
               $activeFarmers = 0;
            //    $activeFarmers = Farmer::where('status', 'active')->count();

               // Get the count of pending loans
               $pendingLoans = Loan::where('status', 'pending')->count();

               // Get the count of repaid loans
               $repaidLoans = Loan::where('status', 'repaid')->count();

               $loans = Loan::with('farmer')->get();
               // Pass the data to the view
               return view('loanmanagement::loans.index', compact('loans','totalLoans', 'activeFarmers', 'pendingLoans', 'repaidLoans'));

    }
    /**
     * Display a listing of loans.
     */
    public function list()
    {
        $loans = Loan::with('farmer.user')->get();
        return view('loanmanagement::loans.list', compact('loans'));
    }

    /**
     * Display loans for a specific farmer.
     */
    public function history($farmerId)
    {
        $farmer = Farmer::findOrFail($farmerId);
        $loans = $farmer->loans;
        return view('loanmanagement::loans.history', compact('farmer', 'loans'));
    }

    /**
     * Show the form for creating a new loan.
     */
    public function create()
    {
        $farmers = Farmer::with('user')->get();
        return view('loanmanagement::loans.create', compact('farmers'));
    }

    /**
     * Store a newly created loan.
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $validated = $request->validate([
                // 'farmer_id' => 'required|exists:farmers,id',
                'farmer_id' => 'required',
                'loan_amount' => 'required|numeric|min:0',
                'interest_rate' => 'required|numeric|min:0',
                'repayment_duration' => 'required|integer|min:1',
                'loan_type' => 'required',
            ]);

            Loan::create($validated);

            return redirect()->route('loanmanagement.index')->with('success', 'Loan created successfully.');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Approve or reject loans.
     */
    public function updateStatus(Request $request, $id): RedirectResponse
    {
        $loan = Loan::findOrFail($id);
        $loan->update(['status' => $request->status]);
        return redirect()->route('loanmanagement.list')->with('success', 'Loan status updated.');
    }

    /**
     * Mark loan as repaid.
     */
    public function markRepaid($id): RedirectResponse
    {
        $loan = Loan::findOrFail($id);
        $loan->update(['repaid_at' => now(), 'status' => 'repaid']);
        return redirect()->route('loanmanagement.list')->with('success', 'Loan marked as repaid.');
    }
}
