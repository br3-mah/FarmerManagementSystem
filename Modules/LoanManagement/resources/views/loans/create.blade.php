@extends('loanmanagement::layouts.master')

@section('content')
<div class="content-wrapper">
    <div>
        <h2>Add Loan</h2>
    </div>

    <form action="{{ route('loanmanagement.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="farmer_id">Farmer</label>
            <select name="farmer_id" id="farmer_id" class="form-control">
                @foreach ($farmers as $farmer)
                <option value="{{ $farmer->user->id }}">{{ $farmer->user->fname.' '.$farmer->user->lname }} {{ $farmer->farmer_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="farmer_id">Loan Type</label>
            <select name="loan_type" id="loan_type" class="form-control">
                <option value="Personal Loan">Personal Loan</option>
                <option value="Business Loan">Business Loan</option>
                <option value="Farmer Loan">Farmer Loan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="loan_amount">Loan Amount</label>
            <input type="number" name="loan_amount" id="loan_amount" class="form-control">
        </div>

        <div class="form-group">
            <label for="interest_rate">Interest Rate (%)</label>
            <input type="number" name="interest_rate" id="interest_rate" class="form-control">
        </div>

        <div class="form-group">
            <label for="repayment_duration">Repayment Duration (Months)</label>
            <input type="number" name="repayment_duration" id="repayment_duration" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
