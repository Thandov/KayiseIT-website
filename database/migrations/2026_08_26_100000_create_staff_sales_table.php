<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('staff_sales', function (Blueprint $table) {
            $table->increments('id');
            // employees.id / users.id are int(10) unsigned on this DB
            $table->unsignedInteger('employee_id');
            $table->decimal('amount', 12, 2);
            $table->decimal('commission', 12, 2)->nullable();
            $table->date('sale_date');
            $table->string('client_name')->nullable();
            $table->string('notes')->nullable();
            $table->unsignedInteger('recorded_by')->nullable();
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('recorded_by')->references('id')->on('users')->onDelete('set null');
            $table->index(['employee_id', 'sale_date']);
            $table->index('sale_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('staff_sales');
    }
};
