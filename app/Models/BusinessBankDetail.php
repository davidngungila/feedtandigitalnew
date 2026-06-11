<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessBankDetail extends Model
{
    protected $fillable = [
        'bank_name',
        'account_name',
        'account_number',
        'mobile_money_number',
        'mpesa',
        'airtel_money',
        'tigo_pesa',
        'lipa_number',
        'payment_gateway',
        'transaction_charges',
    ];
}
