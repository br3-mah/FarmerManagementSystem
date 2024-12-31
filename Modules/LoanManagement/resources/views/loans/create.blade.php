@extends('loanmanagement::layouts.master')

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <h2 class="mb-4">Add Loan</h2>

        <div class="row">
            <!-- Left side - Loan Form -->
            <div class="col-md-6 border-end">
                <form action="{{ route('loanmanagement.store') }}" method="POST" id="loanForm">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="farmer_id" class="form-label">Farmer</label>
                        <select name="farmer_id" id="farmer_id" class="form-control">
                            @foreach ($farmers as $farmer)
                            <option value="{{ $farmer->user->id }}">{{ $farmer->user->fname.' '.$farmer->user->lname }} {{ $farmer->farmer_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="loan_type" class="form-label">Loan Type</label>
                        <select name="loan_type" id="loan_type" class="form-control">
                            <option value="Personal Loan">Personal Loan</option>
                            <option value="Business Loan">Business Loan</option>
                            <option value="Farmer Loan">Farmer Loan</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="loan_amount" class="form-label">Loan Amount</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" name="loan_amount" id="loan_amount" class="form-control" min="0" step="100">
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="interest_rate" class="form-label">Interest Rate (%)</label>
                        <div class="input-group">
                            <input type="number" name="interest_rate" id="interest_rate" class="form-control" min="0" max="100" step="0.1">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="repayment_duration" class="form-label">Repayment Duration</label>
                        <div class="input-group">
                            <input type="number" name="repayment_duration" id="repayment_duration" class="form-control" min="1" max="60">
                            <span class="input-group-text">Months</span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Loan</button>
                </form>
            </div>

            <!-- Right side - Live Preview -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-light">
                        <h4 class="card-title mb-0">Loan Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <h5>Monthly Payment Breakdown</h5>
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h6 class="card-subtitle mb-2 text-muted">Monthly Payment</h6>
                                            <h4 class="card-title text-primary" id="monthlyPayment">$0.00</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h6 class="card-subtitle mb-2 text-muted">Total Interest</h6>
                                            <h4 class="card-title text-danger" id="totalInterest">$0.00</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5>Loan Details</h5>
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Principal Amount
                                    <span id="principalDisplay" class="badge bg-primary rounded-pill">K0.00</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Interest Rate
                                    <span id="interestRateDisplay" class="badge bg-info rounded-pill">0%</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Loan Term
                                    <span id="loanTermDisplay" class="badge bg-secondary rounded-pill">0 months</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Total Repayment
                                    <span id="totalRepayment" class="badge bg-success rounded-pill">K0.00</span>
                                </li>
                            </ul>
                        </div>

                        <div>
                            <h5>Amortization Preview</h5>
                            <div class="table-responsive">
                                <table class="table table-sm" id="amortizationTable">
                                    <thead>
                                        <tr>
                                            <th>Month</th>
                                            <th>Payment</th>
                                            <th>Principal</th>
                                            <th>Interest</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- First 3 months preview -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get all input elements
    const loanAmount = document.getElementById('loan_amount');
    const interestRate = document.getElementById('interest_rate');
    const repaymentDuration = document.getElementById('repayment_duration');

    // Add input event listeners
    const inputs = [loanAmount, interestRate, repaymentDuration];
    inputs.forEach(input => {
        input.addEventListener('input', updateLoanPreview);
    });

    function updateLoanPreview() {
        const principal = parseFloat(loanAmount.value) || 0;
        const rate = (parseFloat(interestRate.value) || 0) / 100 / 12; // Monthly interest rate
        const periods = parseInt(repaymentDuration.value) || 0;

        // Calculate monthly payment using PMT formula
        let monthlyPayment = 0;
        if (rate > 0 && periods > 0) {
            monthlyPayment = principal * (rate * Math.pow(1 + rate, periods)) / (Math.pow(1 + rate, periods) - 1);
        }

        // Calculate total interest
        const totalAmount = monthlyPayment * periods;
        const totalInterest = totalAmount - principal;

        // Update display elements
        document.getElementById('monthlyPayment').textContent = formatCurrency(monthlyPayment);
        document.getElementById('totalInterest').textContent = formatCurrency(totalInterest);
        document.getElementById('principalDisplay').textContent = formatCurrency(principal);
        document.getElementById('interestRateDisplay').textContent = `${interestRate.value || 0}%`;
        document.getElementById('loanTermDisplay').textContent = `${periods} months`;
        document.getElementById('totalRepayment').textContent = formatCurrency(totalAmount);

        // Update amortization table
        updateAmortizationTable(principal, rate, monthlyPayment, periods);
    }

    function updateAmortizationTable(principal, monthlyRate, monthlyPayment, periods) {
        const tbody = document.getElementById('amortizationTable').querySelector('tbody');
        tbody.innerHTML = '';

        let balance = principal;
        // Show first 3 months as preview
        for (let month = 1; month <= Math.min(3, periods); month++) {
            const interest = balance * monthlyRate;
            const principalPayment = monthlyPayment - interest;
            balance -= principalPayment;

            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${month}</td>
                <td>${formatCurrency(monthlyPayment)}</td>
                <td>${formatCurrency(principalPayment)}</td>
                <td>${formatCurrency(interest)}</td>
                <td>${formatCurrency(Math.max(0, balance))}</td>
            `;
            tbody.appendChild(row);
        }
    }

    function formatCurrency(amount) {
        return new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'ZMW',
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }).format(amount);
    }

    // Initialize preview
    updateLoanPreview();
});
</script>

<style>
    .form-label {
        font-weight: 500;
    }
    .card {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    .list-group-item {
        padding: 0.75rem 1.25rem;
    }
    .table-sm td, .table-sm th {
        padding: 0.3rem;
    }
    .badge {
        font-size: 0.875rem;
        font-weight: 500;
        color: #ffff;
    }
</style>
@endsection
