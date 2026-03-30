<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('call_logs', function (Blueprint $table) {
            $table->id();
            $table->string('call_sid')->unique(); // Twilio Call SID
            $table->string('from'); // Caller number
            $table->string('to'); // Recipient number
            $table->enum('status', ['initiating', 'ringing', 'in-progress', 'completed', 'failed', 'busy', 'no-answer', 'canceled'])->default('initiating');
            $table->integer('duration')->default(0); // Duration in seconds
            $table->string('recording_url')->nullable(); // URL to call recording if available
            $table->json('metadata')->nullable(); // Additional data (menu selections, etc.)
            $table->string('transferred_to')->nullable(); // If transfered to agent
            $table->timestamp('started_at')->nullable();
            $table->timestamp('ended_at')->nullable();
            $table->timestamps();
            
            $table->index('from');
            $table->index('status');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('call_logs');
    }
};
