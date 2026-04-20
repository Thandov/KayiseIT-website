<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('show_whatsapp_floating')->default(true);
            $table->boolean('show_chatbot_floating')->default(true);
            $table->timestamps();
        });

        DB::table('site_settings')->insert([
            'show_whatsapp_floating' => true,
            'show_chatbot_floating' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
