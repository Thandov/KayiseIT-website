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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('name');
            $table->decimal('price');
            $table->integer('qty')->nullable();
            $table->decimal('sub_total')->nullable();
            $table->string('QI_id');
            $table->foreign('QI_id')->references('quotation_no')->on('quotations')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::table('items', function (Blueprint $table) {
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
        Schema::dropIfExists('items');
    }
};