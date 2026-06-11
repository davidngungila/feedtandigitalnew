<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessLeader extends Model
{
    protected $fillable = [
        'name',
        'role',
        'phone',
        'email',
        'official_contact',
    ];
}
