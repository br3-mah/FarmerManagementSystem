<?php

namespace Modules\LoanManagement\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Farmer;
use Modules\LoanManagement\App\Models\Loan;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the total loan amount
        $totalLoans = Loan::sum('loan_amount');

        dd($totalLoans);
        // Get the count of active farmers
        $activeFarmers = Farmer::where('status', 'active')->count();

        // Get the count of pending loans
        $pendingLoans = Loan::where('status', 'pending')->count();

        // Get the count of repaid loans
        $repaidLoans = Loan::where('status', 'repaid')->count();

        // Pass the data to the view
        return view('loanmanagement::loans.index', compact('totalLoans', 'activeFarmers', 'pendingLoans', 'repaidLoans'));
    }
}
