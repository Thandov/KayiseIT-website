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
    Schema::create('quotations', function (Blueprint $table) {
        $table->id();
        $table->string('quotation_number')->unique();
        $table->unsignedBigInteger('user_id');
        $table->date('quotation_date');
        $table->decimal('total_amount', 15, 2);
        $table->string('status');
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users');
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quotations');
    }
};
