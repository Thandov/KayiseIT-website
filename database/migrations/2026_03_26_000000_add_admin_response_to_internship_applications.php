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
        Schema::table('internship_applications', function (Blueprint $table) {
            if (! Schema::hasColumn('internship_applications', 'admin_message')) {
                $table->text('admin_message')->nullable()->after('status');
            }
            if (! Schema::hasColumn('internship_applications', 'responded_at')) {
                $table->timestamp('responded_at')->nullable()->after('admin_message');
            }
            if (! Schema::hasColumn('internship_applications', 'responded_by')) {
                $table->unsignedInteger('responded_by')->nullable()->after('responded_at');
                $table->foreign('responded_by')->references('id')->on('users')->onDelete('set null');
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
        Schema::table('internship_applications', function (Blueprint $table) {
            $table->dropForeignIdFor('responded_by');
            $table->dropColumn(['admin_message', 'responded_at', 'responded_by']);
        });
    }
};
