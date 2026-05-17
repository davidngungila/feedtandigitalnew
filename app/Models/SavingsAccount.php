<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavingsAccount extends Model
{
    use HasFactory;

    protected $fillable = ['member_id', 'account_no', 'product_type', 'balance', 'target_amount', 'status'];

    public function member() { return $this->belongsTo(Member::class); }
}
