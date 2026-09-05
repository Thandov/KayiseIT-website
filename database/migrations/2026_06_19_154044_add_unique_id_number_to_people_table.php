<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Remove duplicate id_number entries, keeping the earliest (lowest id) record
        DB::statement('
            DELETE p1 FROM people p1
            INNER JOIN people p2
            ON p1.id_number = p2.id_number AND p1.id > p2.id
        ');

        Schema::table('people', function (Blueprint $table) {
            $table->unique('id_number');
        });
    }

    public function down(): void
    {
        Schema::table('people', function (Blueprint $table) {
            $table->dropUnique(['id_number']);
        });
    }
};
