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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->nullable();

            $table->string('name');
            $table->string('surname');
            $table->string('dob');
            $table->string('gender');
            $table->integer('age');

            
            $table->string('highest_level');
            $table->string('School_name');

            $table->string('number');
            $table->string('address');

            $table->string('guardian_name');
            $table->string('relation');
            $table->string('guardian_number');
            $table->string('guardian_email');
            $table->string('guardian_address');

            $table->string('kin_name');
            $table->string('kin_relation');
            $table->string('kin_number');

            $table->string('course');
            $table->boolean('paid');
            $table->string('payment_date');

            $table->timestamps();
        });
        Schema::table('applications', function (Blueprint $table) {
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
        Schema::dropIfExists('applications');
    }
};
