<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AmlAlert extends Model
{
    protected $fillable = [
        'member_id', 'transaction_id', 'alert_type', 'risk_score', 'status', 'description'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
