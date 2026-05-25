<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterestRule extends Model
{
    protected $fillable = [
        'savings_product_id', 'rule_name', 'min_amount', 'max_amount', 
        'interest_rate', 'effective_date', 'expiry_date', 'is_active'
    ];

    public function savingsProduct()
    {
        return $this->belongsTo(SavingsProduct::class);
    }
}
