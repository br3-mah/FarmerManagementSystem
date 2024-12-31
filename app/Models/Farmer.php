<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'farm_name',
        'farm_address',
        'farm_size',
        'type_of_farming',
        'phone',
        'dob',
        'country',
        'gender',
        'committee',
        'mobile_money_number',
        'bank_account_number',
        'bank_name',
        'is_prospect',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
