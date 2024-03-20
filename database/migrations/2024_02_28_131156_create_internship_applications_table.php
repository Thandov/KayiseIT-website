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
            $table->integer('user_id')->unsigned()->nullable();
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
        Schema::table('internship_applications', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
