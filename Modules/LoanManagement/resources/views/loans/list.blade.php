@extends('loanmanagement::layouts.master')

@section('content')
<div class="content-wrapper">
    <div class="col-lg-12 col-md-12 bg-white p-4">
        <h1>Loans</h1>
        <a href="{{ route('loanmanagement.create') }}" class="btn btn-primary shadow">Add Loan</a>
        <div class="card shadow-sm mt-2">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Farmer</th>
                        <th>Loan Amount</th>
                        <th>Interest Rate</th>
                        <th>Repayment Duration</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($loans as $loan)
                    <tr>
                        <td>{{ $loan->farmer->user->name }}</td>
                        <td>{{ $loan->loan_amount }}</td>
                        <td>{{ $loan->interest_rate }}%</td>
                        <td>{{ $loan->repayment_duration }} months</td>
                        <td>
                            <span
                                class="badge shadow
                                @if($loan->status === 'approved') bg-success text-white
                                @elseif($loan->status === 'rejected') bg-danger
                                @elseif($loan->status === 'pending') bg-warning
                                @else bg-secondary
                                @endif">
                                {{ ucfirst($loan->status) }}
                            </span>
                        </td>
                        <td>
                            {{-- Approve or Reject Loan --}}
                            <form action="{{ route('loanmanagement.updateStatus', $loan->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to update the loan status?');">
                                @csrf
                                @if ($loan->status !== 'approved')
                                    <button type="submit" class="btn-xs btn btn-success" name="status" value="approved">Approve</button>
                                @endif
                                <button type="submit" class="btn-xs btn btn-danger" name="status" value="rejected">Reject</button>
                            </form>

                            {{-- Mark Loan as Repaid --}}
                            <form action="{{ route('loanmanagement.markRepaid', $loan->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to mark this loan as repaid?');">
                                @csrf
                                @if ($loan->status === 'approved')
                                    <button type="submit" class="btn-xs btn btn-warning">Mark Repaid</button>
                                @endif
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
