<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavingsProduct extends Model
{
    protected $fillable = [
        'name', 'code', 'description', 'interest_rate', 'min_balance', 
        'interest_calculation_method', 'interest_posting_frequency', 
        'allow_overdraft', 'overdraft_limit', 'status'
    ];

    public function savingsAccounts()
    {
        return $this->hasMany(SavingsAccount::class);
    }

    public function interestRules()
    {
        return $this->hasMany(InterestRule::class);
    }
}
