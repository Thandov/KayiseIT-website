<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MictBeneficiary;
use App\Models\InternshipProgram;
use App\Models\InternsLearner;
use Illuminate\Support\Facades\DB;

class LinkMictBeneficiariesToProgram extends Command
{
    protected $signature = 'mict:link-to-program {program : Program name or ID}';

    protected $description = 'Link existing MICT beneficiaries to a program and create InternsLearner records';

    public function handle()
    {
        $programId = $this->argument('program');
        
        $program = is_numeric($programId) 
            ? InternshipProgram::find($programId)
            : InternshipProgram::where('name', $programId)->first();
        
        if (!$program) {
            $this->error("Program not found: {$programId}");
            return Command::FAILURE;
        }

        $this->info("Linking MICT beneficiaries to program: {$program->name} (ID: {$program->id})");

        // Get all beneficiaries (or filter as needed)
        $beneficiaries = MictBeneficiary::all();
        
        $linked = 0;
        $learnersCreated = 0;
        $learnersSkipped = 0;

        DB::beginTransaction();
        try {
            foreach ($beneficiaries as $beneficiary) {
                // Update program_id
                $beneficiary->program_id = $program->id;
                $beneficiary->save();
                $linked++;

                // Create InternsLearner if doesn't exist
                $existingLearner = InternsLearner::where('email', $beneficiary->email_address)
                    ->orWhere(function($query) use ($beneficiary) {
                        if ($beneficiary->id_number) {
                            $query->where('id_number', $beneficiary->id_number);
                        }
                    })
                    ->first();

                if (!$existingLearner) {
                    try {
                        InternsLearner::create([
                            'program_id' => $program->id,
                            'first_name' => $beneficiary->first_name,
                            'middle_name' => $beneficiary->middle_name,
                            'surname' => $beneficiary->surname,
                            'email' => $beneficiary->email_address,
                            'phone' => $beneficiary->cellphone ?? $beneficiary->telephone,
                            'id_number' => $beneficiary->id_number,
                            'date_of_birth' => $beneficiary->date_of_birth,
                            'gender' => $beneficiary->gender,
                            'address' => $this->formatAddress($beneficiary),
                            'status' => 'active',
                            'start_date' => $beneficiary->program_start_date ?? $beneficiary->learner_agreement_start_date,
                            'end_date' => $beneficiary->learner_agreement_end_date,
                        ]);
                        $learnersCreated++;
                    } catch (\Exception $e) {
                        $this->warn("Could not create InternsLearner for {$beneficiary->email_address}: " . $e->getMessage());
                        $learnersSkipped++;
                    }
                } else {
                    // Update existing learner to link to program
                    if (!$existingLearner->program_id || $existingLearner->program_id != $program->id) {
                        $existingLearner->program_id = $program->id;
                        $existingLearner->save();
                    }
                    $learnersSkipped++;
                }
            }

            DB::commit();
            $this->info("\nLinking completed!");
            $this->info("Linked beneficiaries: {$linked}");
            $this->info("Created InternsLearner records: {$learnersCreated}");
            $this->info("Skipped/Updated existing learners: {$learnersSkipped}");

        } catch (\Exception $e) {
            DB::rollBack();
            $this->error("Error: " . $e->getMessage());
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }

    private function formatAddress($beneficiary)
    {
        $parts = [];
        
        if ($beneficiary->physical_address_1) {
            $parts[] = $beneficiary->physical_address_1;
        }
        if ($beneficiary->physical_address_2) {
            $parts[] = $beneficiary->physical_address_2;
        }
        if ($beneficiary->physical_address_3) {
            $parts[] = $beneficiary->physical_address_3;
        }
        if ($beneficiary->physical_postal_code) {
            $parts[] = $beneficiary->physical_postal_code;
        }
        
        return !empty($parts) ? implode(', ', $parts) : null;
    }
}
