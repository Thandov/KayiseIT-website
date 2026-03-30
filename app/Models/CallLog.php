<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallLog extends Model
{
    use HasFactory;

    protected $table = 'call_logs';

    protected $fillable = [
        'call_sid',
        'from',
        'to',
        'status',
        'duration',
        'recording_url',
        'metadata',
        'transferred_to',
        'started_at',
        'ended_at',
    ];

    protected $casts = [
        'metadata' => 'array',
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    /**
     * Scope: Get completed calls
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope: Get failed calls
     */
    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    /**
     * Scope: Get calls from last N days
     */
    public function scopeLastDays($query, int $days = 7)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    /**
     * Get average call duration
     */
    public function scopeAverageDuration($query)
    {
        return $query->avg('duration');
    }

    /**
     * Get total calls
     */
    public function scopeTotalCalls($query)
    {
        return $query->count();
    }

    /**
     * Get busiest hour
     */
    public static function getBusiestHour()
    {
        return self::selectRaw('HOUR(created_at) as hour, COUNT(*) as count')
            ->groupBy('hour')
            ->orderByDesc('count')
            ->first();
    }

    /**
     * Format duration for display
     */
    public function getFormattedDurationAttribute()
    {
        $seconds = $this->duration;
        $minutes = floor($seconds / 60);
        $seconds = $seconds % 60;
        
        return sprintf('%02d:%02d', (int) $minutes, (int) $seconds);
    }

    /**
     * Get caller name or number
     */
    public function getCallerDisplayAttribute()
    {
        return $this->from ?? 'Unknown';
    }

    /**
     * Check if call was transferred to agent
     */
    public function wereTransferredAttribute()
    {
        return !empty($this->transferred_to);
    }
}
