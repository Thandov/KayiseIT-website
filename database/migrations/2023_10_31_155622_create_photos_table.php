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
        // Create 'photos' table
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->nullable();
            $table->text('description')->nullable();
            $table->string('path');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });

        // Create 'gallery_groups' table
        Schema::create('gallery_groups', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });

        // Create 'group_photo' pivot table
        Schema::create('group_photo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('photo_id');
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('gallery_groups');
            $table->foreign('photo_id')->references('id')->on('photos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photos');
        Schema::dropIfExists('groups');
        Schema::dropIfExists('group_photo');
    }
};
