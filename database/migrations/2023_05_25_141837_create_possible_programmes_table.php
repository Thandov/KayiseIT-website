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
        Schema::create('possible_programmes', function (Blueprint $table) {
            $table->id()->primary();//match SRS
            $table->string('programme_name');
            $table->timestamps();
            //Foreign Key
            $table->unsignedBigInteger('specialization _id');
            $table->foreign('specialization _id')->references('id')->on('specializations')->onUpdate('cascade')->onDelete('cascade');         
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('possible_programmes');
    }
};
