<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessDocument extends Model
{
    protected $fillable = [
        'name',
        'type',
        'file_path',
        'file_name',
        'file_size',
        'mime_type',
    ];
}
