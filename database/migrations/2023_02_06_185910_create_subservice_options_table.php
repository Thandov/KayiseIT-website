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
        Schema::create('subservice_options', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('price');
            $table->unsignedBigInteger('subservice_id');
            $table->foreign('subservice_id')->references('id')->on('subservices');
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
        Schema::dropIfExists('subservice_options');
    }
};
