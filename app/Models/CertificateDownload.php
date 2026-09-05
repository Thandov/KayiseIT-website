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
        'downloaded_at',
        'certificate_pdf_emailed_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'downloaded_at' => 'datetime',
        'certificate_pdf_emailed_at' => 'datetime',
    ];

    public function isExpired(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }
}
