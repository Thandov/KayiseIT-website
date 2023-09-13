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
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->string('unq_id');
            $table->string('subservice_id');
            $table->string('name');
            $table->boolean('quantified')->nullable();
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
        Schema::table('options', function (Blueprint $table) {
            $table->foreign('unq_id')->references('subserv_id')->on('subservices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('options');
    }
};