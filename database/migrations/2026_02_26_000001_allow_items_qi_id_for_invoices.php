<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Allow items.QI_id to reference either quotation_no or invoice_no
     * (drop FK to quotations so we can store invoice line items in the same table).
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropForeign(['QI_id']);
        });
    }

    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->foreign('QI_id')->references('quotation_no')->on('quotations')->onDelete('cascade');
        });
    }
};
