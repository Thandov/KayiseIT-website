<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $table = 'site_settings';

    protected $fillable = [
        'show_whatsapp_floating',
        'show_chatbot_floating',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'show_whatsapp_floating' => 'boolean',
        'show_chatbot_floating' => 'boolean',
    ];

    public static function current(): self
    {
        $row = static::query()->first();
        if ($row === null) {
            $row = static::query()->create([
                'show_whatsapp_floating' => true,
                'show_chatbot_floating' => true,
            ]);
        }

        return $row;
    }
}
