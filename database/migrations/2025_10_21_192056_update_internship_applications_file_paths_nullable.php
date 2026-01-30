<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE internship_applications MODIFY cv_path VARCHAR(255) NULL');
        DB::statement('ALTER TABLE internship_applications MODIFY id_copy_path VARCHAR(255) NULL');
        DB::statement('ALTER TABLE internship_applications MODIFY qualification_copy_path VARCHAR(255) NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE internship_applications MODIFY cv_path VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE internship_applications MODIFY id_copy_path VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE internship_applications MODIFY qualification_copy_path VARCHAR(255) NOT NULL');
    }
};
