<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id', 'plan_name', 'principal', 'roi_rate', 
        'expected_returns', 'start_date', 'maturity_date', 'status'
    ];

    protected $casts = ['start_date' => 'date', 'maturity_date' => 'date'];

    public function member() { return $this->belongsTo(Member::class); }
}
