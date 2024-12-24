@extends('loanmanagement::layouts.master')

@section('content')
<div class="content-wrapper">

    <p>Module: {!! config('loanmanagement.name') !!}</p>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #2e7c3d 0%, #1acbe2 100%);
            --sidebar-width: 250px;
        }

        .stats-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: transform 0.3s;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .stats-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--primary-gradient);
            color: white;
        }

        .loan-table {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .loan-table th {
            background: #f8f9fa;
            border: none;
        }

        .btn-gradient {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 8px 20px;
        }

        .btn-gradient:hover {
            opacity: 0.9;
            color: white;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
    </style>
    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Loan Management Overview</h2>
            <a href="{{ route('loanmanagement.create') }}" class="btn btn-gradient">
                <i class="fas fa-plus me-2"></i>New Loan
            </a>
        </div>

        <!-- Stats Row -->
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="text-muted mb-0">Total Loans</h6>
                            <h3 class="mb-0">K{{ number_format($totalLoans, 2) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="text-muted mb-0">Active Farmers</h6>
                            <h3 class="mb-0">{{ $activeFarmers }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="text-muted mb-0">Pending Approval</h6>
                            <h3 class="mb-0">{{ $pendingLoans }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="text-muted mb-0">Repaid Loans</h6>
                            <h3 class="mb-0">{{ $repaidLoans }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Loans Table -->
        <div class="loan-table p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0">Recent Loan Applications</h5>
                <div class="d-flex gap-2">
                    <a href="{{ route('loanmanagement.index') }}" class="btn btn-light">
                        View More
                    </a>

                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Farmer Name</th>
                            <th>Loan Amount</th>
                            <th>Interest Rate</th>
                            <th>Duration</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loans as $loan)
                        <tr>
                            <td>{{ $loan->farmer->user->name }}</td>
                            <td>K{{ number_format($loan->loan_amount, 2) }}</td>
                            <td>{{ $loan->interest_rate }}%</td>
                            <td>{{ $loan->repayment_duration }} months</td>
                            <td>
                                <span class="status-badge
                                    @if($loan->status == 'pending') bg-warning text-dark
                                    @elseif($loan->status == 'approved') bg-success text-white
                                    @elseif($loan->status == 'rejected') bg-danger text-white
                                    @elseif($loan->status == 'repaid') bg-info text-white
                                    @endif">
                                    {{ ucfirst($loan->status) }}
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary me-1">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-success me-1">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-times"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
