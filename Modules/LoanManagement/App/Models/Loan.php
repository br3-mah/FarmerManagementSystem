<?php

namespace Modules\LoanManagement\App\Models;

use App\Models\Farmer;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\LoanManagement\Database\factories\LoanFactory;

class Loan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */

     protected $fillable = [
        'farmer_id',
        'loan_amount',
        'interest_rate',
        'repayment_duration',
        'status',
        'approved_at',
        'repaid_at',
    ];
    protected static function newFactory(): LoanFactory
    {
        //return LoanFactory::new();
    }

    // Relationship to Farmer
    public function farmer()
    {
        return $this->belongsTo(User::class, 'farmer_id');
    }

    public function generateAmortizationSchedule()
    {
        $schedule = [];
        $balance = $this->loan_amount;
        $monthlyPayment = $this->calculateMonthlyPayment();
        $interestRate = $this->interest_rate / 100 / 12; // Assuming interest_rate is annual

        for ($i = 1; $i <= $this->repayment_duration; $i++) {
            $interest = $balance * $interestRate;
            $principal = $monthlyPayment - $interest;
            $balance -= $principal;

            $schedule[] = [
                'number' => $i,
                'date' => \Carbon\Carbon::parse($this->approved_at)->addMonths($i)->format('M d, Y'),
                'principal' => $principal,
                'interest' => $interest,
                'total' => $monthlyPayment,
                'balance' => max($balance, 0),
            ];
        }

        return $schedule;
    }


    public function calculateMonthlyPayment()
    {
        $principal = $this->loan_amount;
        $monthlyInterest = $this->interest_rate / 100 / 12;
        $numberOfPayments = $this->repayment_duration;

        // Calculate monthly payment using amortization formula
        if ($monthlyInterest == 0) {
            return $principal / $numberOfPayments;
        }

        return $principal * ($monthlyInterest * pow(1 + $monthlyInterest, $numberOfPayments))
            / (pow(1 + $monthlyInterest, $numberOfPayments) - 1);
    }

    public function calculateTotalAmount()
    {
        return $this->calculateMonthlyPayment() * $this->repayment_duration;
    }
}
