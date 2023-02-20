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
        Schema::table('subservices', function (Blueprint $table) {
            //
            
            $table->dropColumn('option_name');
            $table->dropColumn('option_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subservices', function (Blueprint $table) {
            //
            $table->addColumn('option_name', 'string');
            $table->addColumn('option_price', 'double');
        });
    }
};
