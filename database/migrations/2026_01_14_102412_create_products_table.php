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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('status')->default('available'); // available, coming_soon
            $table->string('icon_color')->default('green'); // green, blue, purple, indigo, teal
            $table->text('features')->nullable(); // JSON array of features
            $table->string('cta_text')->default('Learn More');
            $table->string('cta_route')->nullable(); // Route name for CTA button
            $table->boolean('show_on_frontend')->default(true);
            $table->integer('display_order')->default(0);
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
        Schema::dropIfExists('products');
    }
};
