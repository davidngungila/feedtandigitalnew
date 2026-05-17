<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id', 'loan_no', 'loan_type', 'principal', 'interest_rate', 
        'term_months', 'balance', 'installment_amount', 'status', 'purpose', 
        'disbursed_at', 'next_due_date'
    ];

    protected $casts = ['disbursed_at' => 'datetime', 'next_due_date' => 'date'];

    public function member() { return $this->belongsTo(Member::class); }
}
