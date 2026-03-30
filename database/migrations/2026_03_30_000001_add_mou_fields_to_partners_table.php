<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('partners', function (Blueprint $table) {
            $table->boolean('mou_signed')->default(false)->after('is_active');
            $table->date('mou_date')->nullable()->after('mou_signed');
            $table->string('mou_document')->nullable()->after('mou_date'); // path to PDF
        });
    }

    public function down(): void
    {
        Schema::table('partners', function (Blueprint $table) {
            $table->dropColumn(['mou_signed', 'mou_date', 'mou_document']);
        });
    }
};
