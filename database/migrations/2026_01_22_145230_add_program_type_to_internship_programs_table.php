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
        Schema::table('internship_programs', function (Blueprint $table) {
            $table->string('program_type')->default('Internship')->after('name'); // Internship, TVET Placement, Short Program, etc.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('internship_programs', function (Blueprint $table) {
            $table->dropColumn('program_type');
        });
    }
};
