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
            $table->text('accreditation_details')->nullable()->after('accreditation_body');
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
            $table->dropColumn('accreditation_details');
        });
    }
};
