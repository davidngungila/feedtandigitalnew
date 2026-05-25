<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IpRestriction extends Model
{
    protected $fillable = ['label', 'ip_address', 'added_by', 'is_active'];

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
}
