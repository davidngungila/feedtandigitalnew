<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'action', 'module', 'ip_address', 'user_agent', 'success'];

    protected $appends = ['time', 'user_name', 'browser', 'os'];

    public function user() { return $this->belongsTo(User::class); }

    public function getTimeAttribute()
    {
        return $this->created_at->format('d M, H:i A');
    }

    public function getUserNameAttribute()
    {
        return $this->user ? $this->user->name : 'System/Guest';
    }

    public function getBrowserAttribute()
    {
        if (!$this->user_agent) return 'Unknown';
        $ua = strtolower($this->user_agent);
        if (strpos($ua, 'chrome') !== false) return 'Chrome';
        if (strpos($ua, 'firefox') !== false) return 'Firefox';
        if (strpos($ua, 'safari') !== false) return 'Safari';
        if (strpos($ua, 'edge') !== false) return 'Edge';
        return 'Other';
    }

    public function getOsAttribute()
    {
        if (!$this->user_agent) return 'Unknown';
        $ua = strtolower($this->user_agent);
        if (strpos($ua, 'windows') !== false) return 'Windows';
        if (strpos($ua, 'macintosh') !== false) return 'MacOS';
        if (strpos($ua, 'linux') !== false) return 'Linux';
        if (strpos($ua, 'iphone') !== false || strpos($ua, 'ipad') !== false) return 'iOS';
        if (strpos($ua, 'android') !== false) return 'Android';
        return 'Other';
    }
}
