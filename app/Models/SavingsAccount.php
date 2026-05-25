<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavingsAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id', 'savings_product_id', 'account_no', 'product_type', 
        'balance', 'opening_balance', 'currency', 'target_amount', 
        'status', 'last_interest_posting_date'
    ];

    public function member() { return $this->belongsTo(Member::class); }
    
    public function savingsProduct()
    {
        return $this->belongsTo(SavingsProduct::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function interestPostings()
    {
        return $this->hasMany(InterestPosting::class);
    }

    public function withdrawalRequests()
    {
        return $this->hasMany(WithdrawalRequest::class);
    }
}
