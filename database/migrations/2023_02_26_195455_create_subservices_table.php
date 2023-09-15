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
        Schema::create('subservices', function (Blueprint $table) {
            $table->id();
            $table->string('subserv_id')->unique();
            $table->string('service_id');
            $table->string('name');
            $table->string('slug');
            $table->string('icon')->nullable();
            $table->enum('subservice_type', ['static', 'dynamic']);
            $table->decimal('price', 10, 2);
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
        Schema::dropIfExists('subservices');
    }
};