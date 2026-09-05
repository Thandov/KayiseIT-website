<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $table = 'site_settings';

    protected $fillable = [
        'show_whatsapp_floating',
        'show_chatbot_floating',
        'lmis_enabled',
        'lmis_base_url',
        'lmis_api_token',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'show_whatsapp_floating' => 'boolean',
        'show_chatbot_floating' => 'boolean',
        'lmis_enabled' => 'boolean',
        'lmis_api_token' => 'encrypted',
    ];

    public static function current(): self
    {
        $row = static::query()->first();
        if ($row === null) {
            $row = static::query()->create([
                'show_whatsapp_floating' => true,
                'show_chatbot_floating' => true,
                'lmis_enabled' => false,
                'lmis_base_url' => 'http://localhost:3010',
            ]);
        }

        return $row;
    }
}
