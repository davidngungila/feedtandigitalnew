<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterestPosting extends Model
{
    protected $fillable = [
        'savings_account_id', 'amount', 'posting_date', 'period_start', 'period_end', 'status'
    ];

    public function savingsAccount()
    {
        return $this->belongsTo(SavingsAccount::class);
    }
}
