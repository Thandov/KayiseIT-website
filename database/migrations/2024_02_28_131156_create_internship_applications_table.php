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
        Schema::create('internship_applications', function (Blueprint $table) {
            $table->id();
            $table->string('app_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_no');
            $table->string('address');
            $table->string('id_no');
            $table->string('age');
            $table->string('qualification');
            $table->string('year_obtained');
            $table->string('institution');
            $table->string('cv_path');
            $table->string('id_copy_path');
            $table->string('qualification_copy_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('internship_applications');
    }
};
