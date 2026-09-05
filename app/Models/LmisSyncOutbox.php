<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LmisSyncOutbox extends Model
{
    public const STATUS_PENDING = 'pending';
    public const STATUS_SYNCED = 'synced';
    public const STATUS_FAILED = 'failed';

    public const ENTITY_PROGRAM = 'program';

    protected $table = 'lmis_sync_outbox';

    protected $fillable = [
        'entity_type',
        'entity_id',
        'external_id',
        'payload',
        'status',
        'attempts',
        'last_error',
        'lmis_id',
        'synced_at',
    ];

    protected $casts = [
        'payload' => 'array',
        'attempts' => 'integer',
        'synced_at' => 'datetime',
    ];
}
