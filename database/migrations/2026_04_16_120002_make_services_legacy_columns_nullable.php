<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $driver = Schema::getConnection()->getDriverName();
        if ($driver === 'mysql') {
            DB::statement('ALTER TABLE `services` MODIFY `service_type` VARCHAR(32) NULL');
            DB::statement('ALTER TABLE `services` MODIFY `price` DECIMAL(10,2) NULL');
        } else {
            Schema::table('services', function (Blueprint $table) {
                $table->string('service_type', 32)->nullable()->change();
                $table->decimal('price', 10, 2)->nullable()->change();
            });
        }
    }

    public function down(): void
    {
        $driver = Schema::getConnection()->getDriverName();
        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE `services` MODIFY `service_type` ENUM('static','dynamic') NOT NULL DEFAULT 'dynamic'");
            DB::statement('ALTER TABLE `services` MODIFY `price` DECIMAL(10,2) NOT NULL DEFAULT 0');
        } else {
            Schema::table('services', function (Blueprint $table) {
                $table->string('service_type', 32)->default('dynamic')->nullable(false)->change();
                $table->decimal('price', 10, 2)->default(0)->nullable(false)->change();
            });
        }
    }
};
