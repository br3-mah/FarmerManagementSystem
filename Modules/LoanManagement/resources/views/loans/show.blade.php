@extends('loanmanagement::layouts.master')

@section('content')
<div class="content-wrapper">
    <div class="container py-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Loan Details</h2>
            <div>
                <a href="{{ route('loanmanagement.edit', $loan->id) }}" class="btn btn-outline-primary me-2">
                    <i class="material-icons align-middle">edit</i> Edit Loan
                </a>
                <a href="{{ route('loanmanagement.index') }}" class="btn btn-outline-secondary">
                    <i class="material-icons align-middle">arrow_back</i> Back to Loans
                </a>
            </div>
        </div>

        <!-- Loan Status Banner -->
        <div class="alert alert-{{ $loan->status === 'approved' ? 'success' : ($loan->status === 'pending' ? 'warning' : 'danger') }} d-flex align-items-center mb-4">
            <i class="material-icons me-2">info</i>
            <div>
                <strong>Loan Status:</strong> {{ ucfirst($loan->status) }}
                @if($loan->status === 'approved')
                    - Approved on {{ $loan->approved_at ? \Carbon\Carbon::parse($loan->approved_at)->format('M d, Y') : 'N/A' }}
                @endif
            </div>
        </div>

        <div class="row g-4">
            <!-- Left Column - Loan Summary -->
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0">Loan Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-circle bg-secondary me-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                    <i class="material-icons text-white">person</i>
                                </div>
                                <div>
                                    <h6 class="mb-1">{{ $loan->farmer->fname }} {{ $loan->farmer->lname }}</h6>
                                    <small class="text-muted">{{ $loan->farmer->farm_name ?? 'N/A' }}</small>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h6 class="text-muted mb-3">Loan Overview</h6>
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="border rounded p-3">
                                        <small class="text-muted d-block">Loan Amount</small>
                                        <strong class="fs-5">${{ number_format($loan->loan_amount, 2) }}</strong>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="border rounded p-3">
                                        <small class="text-muted d-block">Monthly Payment</small>
                                        <strong class="fs-5">${{ number_format($loan->calculateMonthlyPayment(), 2) }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                <span>Interest Rate</span>
                                <span class="badge bg-primary rounded-pill">{{ $loan->interest_rate }}%</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                <span>Term Length</span>
                                <span class="badge bg-secondary rounded-pill">{{ $loan->repayment_duration }} months</span>
                            </li>
                            @if($loan->approved_at)
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                <span>Start Date</span>
                                <span>{{ \Carbon\Carbon::parse($loan->approved_at)->format('M d, Y') }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                <span>Expected End Date</span>
                                <span>{{ \Carbon\Carbon::parse($loan->approved_at)->addMonths($loan->repayment_duration)->format('M d, Y') }}</span>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Right Column - Loan Progress and Amortization -->
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0">Loan Progress</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="border rounded p-3 text-center">
                                    <h6 class="text-muted mb-2">Total Amount</h6>
                                    <h4 class="mb-0">${{ number_format($loan->calculateTotalAmount(), 2) }}</h4>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="border rounded p-3 text-center">
                                    <h6 class="text-muted mb-2">Status</h6>
                                    <h4 class="mb-0 {{ $loan->repaid_at ? 'text-success' : 'text-warning' }}">
                                        {{ $loan->repaid_at ? 'Repaid' : 'Active' }}
                                    </h4>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="border rounded p-3 text-center">
                                    <h6 class="text-muted mb-2">Repayment Period</h6>
                                    <h4 class="mb-0">{{ $loan->repayment_duration }} Months</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0">Amortization Schedule</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Payment #</th>
                                        <th>Date</th>
                                        <th>Principal</th>
                                        <th>Interest</th>
                                        <th>Total Payment</th>
                                        <th>Balance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($loan->generateAmortizationSchedule() as $payment)
                                    <tr>
                                        <td>{{ $payment['number'] }}</td>
                                        <td>{{ $payment['date'] }}</td>
                                        <td>${{ number_format($payment['principal'], 2) }}</td>
                                        <td>${{ number_format($payment['interest'], 2) }}</td>
                                        <td>${{ number_format($payment['total'], 2) }}</td>
                                        <td>${{ number_format($payment['balance'], 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.material-icons {
    font-size: 20px;
    vertical-align: middle;
}
.progress {
    background-color: #e9ecef;
    border-radius: 0.5rem;
}
.card {
    border: none;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}
.list-group-item {
    border-left: 0;
    border-right: 0;
}
.badge {
    padding: 0.5em 0.75em;
}
.table {
    margin-bottom: 0;
    border-collapse: separate;
    border-spacing: 0;
    border-radius: 0.5rem;
}
.table th, .table td {
    vertical-align: middle;
}
.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0, 0, 0, 0.05);
}
</style>
@endsection
