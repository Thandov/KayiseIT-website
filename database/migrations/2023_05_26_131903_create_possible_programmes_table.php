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
            $table->increments('pp_id');
            $table->string('programme_name');
            $table->integer('uid')->nullable()->unsigned(); //FK
			$table->integer('s_id')->nullable()->unsigned();    //FK
			$table->integer('o_id')->nullable()->unsigned();    //FK
            $table->timestamps();
        });
        //link Foreign Key
        Schema::table('possible_programmes', function (Blueprint $table) {
            $table->foreign('uid')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');             
            $table->foreign('s_id')->references('s_id')->on('specializations')->onUpdate('cascade')->onDelete('cascade');             
            $table->foreign('o_id')->references('o_id')->on('occupations')->onUpdate('cascade')->onDelete('cascade');             
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
