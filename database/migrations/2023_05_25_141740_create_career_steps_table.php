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
            $table->id(); //might need to remove
            $table->string('steps_id ')->primary(); //need to esure data matches the SRS doc
            //Foreign Key
            $table->unsignedBigInteger('career_id');
            $table->foreign('career_id')->references('id')->on('career_maps')->onUpdate('cascade')->onDelete('cascade');            
            $table->string('qualification');
            $table->string('level');
            $table->integer('step_number'); 
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
