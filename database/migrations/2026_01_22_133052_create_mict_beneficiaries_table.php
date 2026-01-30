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
        Schema::create('mict_beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('internship_application_id')->nullable()->constrained('internship_applications')->onDelete('cascade');
            $table->foreignId('program_id')->nullable()->constrained('internship_programs')->onDelete('set null');
            
            // Learner Details
            $table->string('learner_title')->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('surname');
            $table->string('maiden_name')->nullable();
            $table->string('type_of_id')->nullable();
            $table->string('id_number')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('residence_status')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('gender')->nullable();
            $table->string('race')->nullable();
            $table->boolean('disabled')->default(false);
            $table->string('type_of_disability')->nullable();
            $table->integer('age')->nullable();
            $table->boolean('sa_citizen')->default(true);
            $table->string('nationality')->nullable();
            $table->string('first_language')->nullable();
            $table->boolean('employed')->default(false);
            $table->integer('length_of_unemployment_years')->nullable();
            $table->date('employment_start_date')->nullable();
            $table->date('learner_agreement_start_date')->nullable();
            $table->date('learner_agreement_end_date')->nullable();
            $table->date('program_start_date')->nullable();
            $table->decimal('amount_allocated', 10, 2)->nullable();
            $table->boolean('previous_internship')->default(false);
            $table->string('year_of_study')->nullable();
            
            // Physical Address
            $table->string('physical_address_1')->nullable();
            $table->string('physical_address_2')->nullable();
            $table->string('physical_address_3')->nullable();
            $table->string('physical_postal_code')->nullable();
            
            // Postal Address
            $table->string('postal_address_1')->nullable();
            $table->string('postal_address_2')->nullable();
            $table->string('postal_address_3')->nullable();
            $table->string('postal_address_postal_code')->nullable();
            $table->string('type_of_area')->nullable(); // Urban/Rural
            $table->string('email_address');
            $table->string('cellphone')->nullable();
            $table->string('telephone')->nullable();
            $table->string('fax')->nullable();
            
            // Highest Level of Qualification
            $table->string('highest_nqf_qualification')->nullable();
            $table->string('other_qualification')->nullable();
            $table->string('title_of_highest_qualification')->nullable();
            $table->boolean('has_matriculated')->default(false);
            $table->boolean('matriculated_in_sa')->default(false);
            $table->string('province_of_high_school')->nullable();
            $table->string('year_of_national_senior_certificate')->nullable();
            
            // Parents/Guardian Details
            $table->string('guardian_first_name')->nullable();
            $table->string('guardian_last_name')->nullable();
            $table->string('guardian_type_of_id')->nullable();
            $table->string('guardian_id_number')->nullable();
            $table->string('guardian_telephone')->nullable();
            $table->string('guardian_cellphone')->nullable();
            $table->text('guardian_home_address')->nullable();
            $table->text('guardian_postal_address')->nullable();
            $table->string('guardian_email_address')->nullable();
            
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
        Schema::dropIfExists('mict_beneficiaries');
    }
};
