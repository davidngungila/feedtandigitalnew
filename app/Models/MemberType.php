<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberType extends Model
{
    protected $fillable = ['name', 'description', 'status'];
    
    public function members()
    {
        return $this->hasMany(Member::class, 'membership_type', 'name');
    }
}
