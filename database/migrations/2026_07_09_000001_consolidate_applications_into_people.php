<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('people', function (Blueprint $table) {
            if (! Schema::hasColumn('people', 'record_type')) {
                $table->string('record_type')->default('enquiry')->after('id');
            }
            if (! Schema::hasColumn('people', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id');
            }
            if (! Schema::hasColumn('people', 'legacy_application_id')) {
                $table->unsignedBigInteger('legacy_application_id')->nullable();
            }
            if (! Schema::hasColumn('people', 'app_id')) {
                $table->string('app_id')->nullable();
            }
            if (! Schema::hasColumn('people', 'age')) {
                $table->string('age')->nullable();
            }
            if (! Schema::hasColumn('people', 'address')) {
                $table->text('address')->nullable();
            }
            if (! Schema::hasColumn('people', 'high_school')) {
                $table->string('high_school')->nullable();
            }
            if (! Schema::hasColumn('people', 'year_of_completion')) {
                $table->string('year_of_completion')->nullable();
            }
            if (! Schema::hasColumn('people', 'qualification')) {
                $table->string('qualification')->nullable();
            }
            if (! Schema::hasColumn('people', 'year_obtained')) {
                $table->string('year_obtained')->nullable();
            }
            if (! Schema::hasColumn('people', 'institution')) {
                $table->string('institution')->nullable();
            }
            if (! Schema::hasColumn('people', 'app_type')) {
                $table->string('app_type')->nullable();
            }
            if (! Schema::hasColumn('people', 'field')) {
                $table->string('field')->nullable();
            }
            if (! Schema::hasColumn('people', 'program_partner')) {
                $table->string('program_partner')->nullable();
            }
            if (! Schema::hasColumn('people', 'status')) {
                $table->string('status')->nullable();
            }
            if (! Schema::hasColumn('people', 'cv_path')) {
                $table->string('cv_path')->nullable();
            }
            if (! Schema::hasColumn('people', 'id_copy_path')) {
                $table->string('id_copy_path')->nullable();
            }
            if (! Schema::hasColumn('people', 'qualification_copy_path')) {
                $table->string('qualification_copy_path')->nullable();
            }
            if (! Schema::hasColumn('people', 'proof_of_payment_path')) {
                $table->string('proof_of_payment_path')->nullable();
            }
            if (! Schema::hasColumn('people', 'admin_message')) {
                $table->text('admin_message')->nullable();
            }
            if (! Schema::hasColumn('people', 'responded_at')) {
                $table->timestamp('responded_at')->nullable();
            }
            if (! Schema::hasColumn('people', 'responded_by')) {
                $table->unsignedBigInteger('responded_by')->nullable();
            }
        });

        if (Schema::hasColumn('people', 'record_type')) {
            DB::table('people')->whereNull('record_type')->update(['record_type' => 'enquiry']);
        }

        if (Schema::hasTable('internship_applications')) {
            $this->migrateApplications();
        }

        if (Schema::hasTable('interns_learners') && Schema::hasColumn('interns_learners', 'internship_application_id')) {
            Schema::table('interns_learners', function (Blueprint $table) {
                if (! Schema::hasColumn('interns_learners', 'person_id')) {
                    $table->foreignId('person_id')->nullable()->after('id')->constrained('people')->nullOnDelete();
                }
            });

            foreach (DB::table('interns_learners')->whereNotNull('internship_application_id')->get() as $row) {
                $personId = DB::table('people')
                    ->where('legacy_application_id', $row->internship_application_id)
                    ->value('id');

                if ($personId) {
                    DB::table('interns_learners')->where('id', $row->id)->update(['person_id' => $personId]);
                }
            }

            Schema::table('interns_learners', function (Blueprint $table) {
                $table->dropForeign(['internship_application_id']);
                $table->dropColumn('internship_application_id');
            });
        }

        if (Schema::hasTable('mict_beneficiaries') && Schema::hasColumn('mict_beneficiaries', 'internship_application_id')) {
            Schema::table('mict_beneficiaries', function (Blueprint $table) {
                if (! Schema::hasColumn('mict_beneficiaries', 'person_id')) {
                    $table->foreignId('person_id')->nullable()->after('id')->constrained('people')->nullOnDelete();
                }
            });

            foreach (DB::table('mict_beneficiaries')->whereNotNull('internship_application_id')->get() as $row) {
                $personId = DB::table('people')
                    ->where('legacy_application_id', $row->internship_application_id)
                    ->value('id');

                if ($personId) {
                    DB::table('mict_beneficiaries')->where('id', $row->id)->update(['person_id' => $personId]);
                }
            }

            Schema::table('mict_beneficiaries', function (Blueprint $table) {
                $table->dropForeign(['internship_application_id']);
                $table->dropColumn('internship_application_id');
            });
        }

        Schema::dropIfExists('internship_applications');
    }

    public function down(): void
    {
        Schema::create('internship_applications', function (Blueprint $table) {
            $table->id();
            $table->string('app_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('id_no');
            $table->string('age');
            $table->string('address');
            $table->string('high_school');
            $table->string('year_of_completion');
            $table->string('qualification');
            $table->string('year_obtained');
            $table->string('institution');
            $table->string('app_type')->nullable();
            $table->string('field')->nullable();
            $table->unsignedBigInteger('internship_program_id')->nullable();
            $table->string('program_partner')->nullable();
            $table->string('status')->default('pending');
            $table->string('cv_path')->nullable();
            $table->string('id_copy_path')->nullable();
            $table->string('qualification_copy_path')->nullable();
            $table->string('proof_of_payment_path')->nullable();
            $table->text('admin_message')->nullable();
            $table->timestamp('responded_at')->nullable();
            $table->unsignedBigInteger('responded_by')->nullable();
            $table->timestamps();
        });

        $applications = DB::table('people')->where('record_type', 'application')->get();
        foreach ($applications as $person) {
            $legacyId = DB::table('internship_applications')->insertGetId([
                'app_id' => $person->app_id,
                'user_id' => $person->user_id,
                'name' => trim($person->name . ' ' . ($person->surname ?? '')),
                'email' => $person->email,
                'id_no' => $person->id_number,
                'age' => $person->age ?? '',
                'address' => $person->address ?? '',
                'high_school' => $person->high_school ?? '',
                'year_of_completion' => $person->year_of_completion ?? '',
                'qualification' => $person->qualification ?? '',
                'year_obtained' => $person->year_obtained ?? '',
                'institution' => $person->institution ?? '',
                'app_type' => $person->app_type,
                'field' => $person->field,
                'internship_program_id' => $person->internship_program_id,
                'program_partner' => $person->program_partner,
                'status' => $person->status ?? 'pending',
                'cv_path' => $person->cv_path,
                'id_copy_path' => $person->id_copy_path,
                'qualification_copy_path' => $person->qualification_copy_path,
                'proof_of_payment_path' => $person->proof_of_payment_path,
                'admin_message' => $person->admin_message,
                'responded_at' => $person->responded_at,
                'responded_by' => $person->responded_by,
                'created_at' => $person->created_at,
                'updated_at' => $person->updated_at,
            ]);

            DB::table('people')->where('id', $person->id)->update(['legacy_application_id' => $legacyId]);
        }

        if (Schema::hasColumn('interns_learners', 'person_id')) {
            Schema::table('interns_learners', function (Blueprint $table) {
                $table->unsignedBigInteger('internship_application_id')->nullable();
            });
            Schema::table('interns_learners', function (Blueprint $table) {
                $table->dropForeign(['person_id']);
                $table->dropColumn('person_id');
            });
        }

        if (Schema::hasColumn('mict_beneficiaries', 'person_id')) {
            Schema::table('mict_beneficiaries', function (Blueprint $table) {
                $table->unsignedBigInteger('internship_application_id')->nullable();
            });
            Schema::table('mict_beneficiaries', function (Blueprint $table) {
                $table->dropForeign(['person_id']);
                $table->dropColumn('person_id');
            });
        }

        DB::table('people')->where('record_type', 'application')->delete();

        Schema::table('people', function (Blueprint $table) {
            $columns = [
                'record_type', 'user_id', 'legacy_application_id', 'app_id', 'age', 'address',
                'high_school', 'year_of_completion', 'qualification', 'year_obtained', 'institution',
                'app_type', 'field', 'program_partner', 'status', 'cv_path', 'id_copy_path',
                'qualification_copy_path', 'proof_of_payment_path', 'admin_message', 'responded_at', 'responded_by',
            ];
            foreach ($columns as $column) {
                if (Schema::hasColumn('people', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }

    private function migrateApplications(): void
    {
        $applications = DB::table('internship_applications')->orderBy('id')->get();

        foreach ($applications as $application) {
            $alreadyMigrated = DB::table('people')
                ->where('legacy_application_id', $application->id)
                ->exists();

            if (! $alreadyMigrated && ! empty($application->id_no)) {
                $alreadyMigrated = DB::table('people')
                    ->where('id_number', $application->id_no)
                    ->where('record_type', 'application')
                    ->exists();
            }

            if ($alreadyMigrated) {
                DB::table('people')
                    ->where('legacy_application_id', $application->id)
                    ->orWhere(function ($query) use ($application) {
                        if (! empty($application->id_no)) {
                            $query->where('id_number', $application->id_no)
                                ->where('record_type', 'application');
                        }
                    })
                    ->update(['legacy_application_id' => $application->id]);

                continue;
            }

            [$firstName, $surname] = $this->splitName($application->name ?? '');

            $cellphone = null;
            if ($application->user_id) {
                $cellphone = DB::table('users')->where('id', $application->user_id)->value('phone');
            }

            $personId = DB::table('people')->insertGetId([
                'record_type' => 'application',
                'user_id' => $application->user_id,
                'legacy_application_id' => $application->id,
                'app_id' => $application->app_id,
                'name' => $firstName,
                'surname' => $surname,
                'id_number' => $application->id_no,
                'email' => $application->email,
                'cellphone' => $cellphone,
                'country' => 'South Africa',
                'province' => null,
                'location_type' => null,
                'location_name' => null,
                'internship_program_id' => $application->internship_program_id,
                'source' => 'application',
                'age' => $application->age,
                'address' => $application->address,
                'high_school' => $application->high_school,
                'year_of_completion' => $application->year_of_completion,
                'qualification' => $application->qualification,
                'year_obtained' => $application->year_obtained,
                'institution' => $application->institution,
                'app_type' => $application->app_type,
                'field' => $application->field,
                'program_partner' => $application->program_partner,
                'status' => $application->status ?? 'pending',
                'cv_path' => $application->cv_path,
                'id_copy_path' => $application->id_copy_path,
                'qualification_copy_path' => $application->qualification_copy_path,
                'proof_of_payment_path' => $application->proof_of_payment_path ?? null,
                'admin_message' => $application->admin_message,
                'responded_at' => $application->responded_at,
                'responded_by' => $application->responded_by,
                'created_at' => $application->created_at,
                'updated_at' => $application->updated_at,
            ]);

            DB::table('people')->where('id', $personId)->update(['legacy_application_id' => $application->id]);
        }
    }

    private function splitName(string $fullName): array
    {
        $fullName = trim($fullName);
        if ($fullName === '') {
            return ['Unknown', ''];
        }

        $parts = preg_split('/\s+/', $fullName, 2);

        return [$parts[0], $parts[1] ?? ''];
    }
};
