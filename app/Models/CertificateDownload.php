<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertificateDownload extends Model
{
    protected $table = 'certificate_downloads';

    protected $fillable = [
        'id_number',
        'name',
        'surname',
        'email',
        'storage_path',
        'download_token',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function isExpired(): bool
    {
        if ($this->expires_at === null) {
            return false;
        }

        return $this->expires_at->isPast();
    }
}
