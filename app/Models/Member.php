<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'member_no',
        'nida',
        'phone',
        'occupation',
        'employer',
        'region',
        'district',
        'ward',
        'street',
        'po_box',
        'membership_type',
        'status',
        'joined_at',
        'gender',
        'dob',
        'marital_status',
        'branch',
        'next_of_kin_name',
        'next_of_kin_relationship',
        'next_of_kin_phone',
        'passport_photo',
        'nida_card',
    ];

    protected $casts = [
        'joined_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function savingsAccounts()
    {
        return $this->hasMany(SavingsAccount::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function investments()
    {
        return $this->hasMany(Investment::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
