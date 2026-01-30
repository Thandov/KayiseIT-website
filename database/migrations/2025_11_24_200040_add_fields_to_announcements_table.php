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
        Schema::table('announcements', function (Blueprint $table) {
            // Only add columns that don't already exist
            if (!Schema::hasColumn('announcements', 'description')) {
                $table->text('description')->nullable();
            }
            if (!Schema::hasColumn('announcements', 'link')) {
                $table->string('link')->nullable();
            }
            if (!Schema::hasColumn('announcements', 'badge')) {
                $table->string('badge')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('announcements', function (Blueprint $table) {
            if (Schema::hasColumn('announcements', 'description')) {
                $table->dropColumn('description');
            }
            if (Schema::hasColumn('announcements', 'link')) {
                $table->dropColumn('link');
            }
            if (Schema::hasColumn('announcements', 'badge')) {
                $table->dropColumn('badge');
            }
        });
    }
};
