<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KycVerification extends Model
{
    protected $fillable = [
        'member_id', 'document_type', 'document_number', 'document_path',
        'risk_level', 'status', 'verified_by', 'verified_at', 'notes'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
