<?php

namespace Modules\LoanManagement\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Farmer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\LoanManagement\App\Models\Loan;

class LoanManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('loanmanagement::loans.index');
    }

    // Display loans for a specific farmer
    public function list()
    {
        $loans = Loan::get();
        return view('loan-management::loans.list', compact('farmer', 'loans'));
    }

    // Display loans for a specific farmer
    public function history($farmerId)
    {
        $farmer = Farmer::findOrFail($farmerId);
        $loans = $farmer->loans;
        return view('loan-management::loans.history', compact('farmer', 'loans'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('loanmanagement::loans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('loanmanagement::loans.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('loanmanagement::loans.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
