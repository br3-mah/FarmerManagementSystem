<?php

namespace Modules\LoanManagement\App\Models;

use App\Models\Farmer;
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
        return $this->belongsTo(Farmer::class);
    }

}
