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
        Schema::create('occupations', function (Blueprint $table) {
            $table->increments('o_id');
            $table->string('name');
            $table->string('image');
            $table->unsignedBigInteger('id');
            $table->timestamps();
        });
        //link Foreign Key
        Schema::table('occupations', function (Blueprint $table) {
            $table->foreign('id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');             
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('occupations');
    }
};
