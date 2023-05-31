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
            $table->increments('steps_id');  //PK
            $table->integer('u_id')->nullable()->unsigned(); //FK
            $table->integer('occup_id')->nullable()->unsigned();    //FK
            $table->integer('spec_id')->nullable()->unsigned(); //FK
            $table->string('step_number');
            $table->string('qualification');
            $table->timestamps();
        });
        //link Foreign Key
        Schema::table('career_steps', function (Blueprint $table) {
            $table->foreign('u_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');             
            $table->foreign('occup_id')->references('occup_id')->on('occupations')->onUpdate('cascade')->onDelete('cascade'); 
            $table->foreign('spec_id')->references('spec_id')->on('specializations')->onUpdate('cascade')->onDelete('cascade');                         
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
