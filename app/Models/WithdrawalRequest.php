<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WithdrawalRequest extends Model
{
    protected $fillable = [
        'member_id', 'savings_account_id', 'amount', 'channel', 'reason', 
        'status', 'approved_by', 'approved_at', 'rejected_by', 
        'rejected_at', 'rejection_reason', 'reference'
    ];

    public function member() { return $this->belongsTo(Member::class); }
    public function savingsAccount() { return $this->belongsTo(SavingsAccount::class); }
    public function approver() { return $this->belongsTo(User::class, 'approved_by'); }
    public function rejecter() { return $this->belongsTo(User::class, 'rejected_by'); }
}
