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
        Schema::create('specializations', function (Blueprint $table) {
            $table->increments('spec_id');  //PK
            $table->integer('occup_id')->nullable()->unsigned();    //FK
			$table->integer('u_id')->nullable()->unsigned(); //FK
            $table->string('specialization_name');
            $table->timestamps();
        });
        //link Foreign Key
        Schema::table('specializations', function (Blueprint $table) {
            $table->foreign('u_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');             
            $table->foreign('occup_id')->references('occup_id')->on('occupations')->onUpdate('cascade')->onDelete('cascade');             
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specializations');
    }
};
