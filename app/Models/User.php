<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'pin',
        'role',
        'branch',
        'phone',
        'is_active',
        'last_login_at',
        'two_factor_enabled',
        'two_factor_type',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'profile_image',
    ];

    protected $appends = ['role_label', 'last_login'];

    protected $hidden = [
        'password',
        'pin',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'last_login_at' => 'datetime',
            'two_factor_enabled' => 'boolean',
        ];
    }

    public function getRoleLabelAttribute()
    {
        return ucfirst($this->role);
    }

    public function getLastLoginAttribute()
    {
        return $this->last_login_at ? $this->last_login_at->diffForHumans() : 'Never';
    }

    public function member()
    {
        return $this->hasOne(Member::class);
    }

    public function isAdmin() { return $this->role === 'admin'; }
    public function isManager() { return $this->role === 'manager'; }
    public function isTeller() { return $this->role === 'teller'; }
    public function isMember() { return $this->role === 'member'; }
    public function isAuditor() { return $this->role === 'auditor'; }
    public function isDepositOfficer() { return $this->role === 'deposit_officer'; }
    public function isLoanOfficer() { return $this->role === 'loan_officer'; }
    public function isSwfOfficer() { return $this->role === 'swf_officer'; }
    public function isMarketingOfficer() { return $this->role === 'marketing_officer'; }
    public function isSecretary() { return $this->role === 'secretary'; }
    public function isChairperson() { return $this->role === 'chairperson'; }
    public function isAccountant() { return $this->role === 'accountant'; }
}
