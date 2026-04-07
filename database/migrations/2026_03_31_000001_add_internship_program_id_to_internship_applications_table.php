<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('internship_applications', function (Blueprint $table) {
            if (! Schema::hasColumn('internship_applications', 'internship_program_id')) {
                $table->foreignId('internship_program_id')
                    ->nullable()
                    ->after('field')
                    ->constrained('internship_programs')
                    ->nullOnDelete();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('internship_applications', function (Blueprint $table) {
            if (Schema::hasColumn('internship_applications', 'internship_program_id')) {
                $table->dropConstrainedForeignId('internship_program_id');
            }
        });
    }
};
