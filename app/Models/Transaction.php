<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id', 'savings_account_id', 'loan_id', 'type', 
        'amount', 'balance_after', 'channel', 'reference', 'narration', 'status'
    ];

    public function member() { return $this->belongsTo(Member::class); }
    public function savingsAccount() { return $this->belongsTo(SavingsAccount::class); }
    public function loan() { return $this->belongsTo(Loan::class); }

    public function scopeDeposits($query)
    {
        return $query->where('type', 'deposit');
    }

    public function scopeWithdrawals($query)
    {
        return $query->where('type', 'withdrawal');
    }
}
