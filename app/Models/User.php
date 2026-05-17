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
        'role',
        'branch',
        'phone',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
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
}
