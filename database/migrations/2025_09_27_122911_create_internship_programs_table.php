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
        Schema::create('internship_programs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('image_path')->nullable();
            $table->json('gallery')->nullable(); // Store array of image paths
            $table->string('duration'); // e.g., "6 months", "1 year"
            $table->date('recruitment_start_date');
            $table->date('recruitment_end_date');
            $table->integer('number_needed');
            $table->json('sponsors_partners')->nullable(); // Store array of sponsors/partners
            $table->boolean('has_stipend')->default(false);
            $table->decimal('stipend_amount', 10, 2)->nullable();
            $table->string('stipend_currency', 3)->default('ZAR');
            $table->boolean('has_accreditation')->default(false);
            $table->string('accreditation_body')->nullable();
            $table->boolean('youth_beneficiaries')->default(false);
            $table->text('requirements');
            $table->string('qr_code_path')->nullable();
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('internship_programs');
    }
};
