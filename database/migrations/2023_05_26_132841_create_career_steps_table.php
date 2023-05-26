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
        Schema::create('career_steps', function (Blueprint $table) {
            $table->increments('steps_id');
            $table->unsignedBigInteger('c_id'); //FK
            $table->string('qualification');
            $table->string('level');
            $table->integer('step_number');
            //$table->timestamps();
        });
        //link Foreign Key
        Schema::table('career_steps', function (Blueprint $table) {
            $table->foreign('c_id')->references('c_id')->on('career_maps')->onUpdate('cascade')->onDelete('cascade');             
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('career_steps');
    }
};
