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
            if (!Schema::hasColumn('announcements', 'title')) {
                $table->string('title')->nullable();
            }
            if (!Schema::hasColumn('announcements', 'message')) {
                $table->text('message')->nullable();
            }
            if (!Schema::hasColumn('announcements', 'image')) {
                $table->string('image')->nullable();
            }
            if (!Schema::hasColumn('announcements', 'is_active')) {
                $table->boolean('is_active')->default(true);
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
            if (Schema::hasColumn('announcements', 'title')) {
                $table->dropColumn('title');
            }
            if (Schema::hasColumn('announcements', 'message')) {
                $table->dropColumn('message');
            }
            if (Schema::hasColumn('announcements', 'image')) {
                $table->dropColumn('image');
            }
            if (Schema::hasColumn('announcements', 'is_active')) {
                $table->dropColumn('is_active');
            }
        });
    }
};
