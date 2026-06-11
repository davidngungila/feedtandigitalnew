<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
        'pin',
        'pin_is_set',
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
            'pin_is_set' => 'boolean',
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

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function getAllPermissions()
    {
        $rolePermissions = $this->roles->load('permissions')->pluck('permissions')->flatten();
        $userPermissions = $this->permissions;

        return $rolePermissions->merge($userPermissions)->unique('id');
    }

    public function hasRole(string $roleSlug): bool
    {
        return $this->roles()->where('slug', $roleSlug)->exists();
    }

    public function hasAnyRole(array $roleSlugs): bool
    {
        return $this->roles()->whereIn('slug', $roleSlugs)->exists();
    }

    public function hasAllRoles(array $roleSlugs): bool
    {
        foreach ($roleSlugs as $role) {
            if (!$this->hasRole($role)) {
                return false;
            }
        }
        return true;
    }

    public function hasPermission(string $permissionSlug): bool
    {
        // Check direct permissions
        if ($this->permissions()->where('slug', $permissionSlug)->exists()) {
            return true;
        }

        // Check permissions via roles
        foreach ($this->roles as $role) {
            if ($role->hasPermission($permissionSlug)) {
                return true;
            }
        }

        return false;
    }

    public function hasAnyPermission(array $permissionSlugs): bool
    {
        foreach ($permissionSlugs as $perm) {
            if ($this->hasPermission($perm)) {
                return true;
            }
        }
        return false;
    }

    public function assignRole(Role $role): void
    {
        $this->roles()->attach($role);
    }

    public function removeRole(Role $role): void
    {
        $this->roles()->detach($role);
    }

    public function syncRoles(array $roleIds): void
    {
        $this->roles()->sync($roleIds);
    }

    public function givePermission(Permission $permission): void
    {
        $this->permissions()->attach($permission);
    }

    public function revokePermission(Permission $permission): void
    {
        $this->permissions()->detach($permission);
    }

    public function isAdmin() { return $this->role === 'admin' || $this->hasRole('admin'); }
    public function isManager() { return $this->role === 'manager' || $this->hasRole('manager'); }
    public function isTeller() { return $this->role === 'teller' || $this->hasRole('teller'); }
    public function isMember() { return $this->role === 'member' || $this->hasRole('member'); }
    public function isAuditor() { return $this->role === 'auditor' || $this->hasRole('auditor'); }
    public function isDepositOfficer() { return $this->role === 'deposit_officer' || $this->hasRole('deposit_officer'); }
    public function isLoanOfficer() { return $this->role === 'loan_officer' || $this->hasRole('loan_officer'); }
    public function isSwfOfficer() { return $this->role === 'swf_officer' || $this->hasRole('swf_officer'); }
    public function isMarketingOfficer() { return $this->role === 'marketing_officer' || $this->hasRole('marketing_officer'); }
    public function isSecretary() { return $this->role === 'secretary' || $this->hasRole('secretary'); }
    public function isChairperson() { return $this->role === 'chairperson' || $this->hasRole('chairperson'); }
    public function isAccountant() { return $this->role === 'accountant' || $this->hasRole('accountant'); }
}
