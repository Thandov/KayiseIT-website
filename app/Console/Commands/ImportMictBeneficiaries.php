<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MictBeneficiary;
use App\Models\InternshipProgram;
use App\Models\InternsLearner;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ImportMictBeneficiaries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mict:import-beneficiaries {file : Path to the CSV file} {--program= : Program name or ID to link beneficiaries to}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import MICT SETA beneficiaries from CSV file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $filePath = $this->argument('file');

        if (!File::exists($filePath)) {
            $this->error("File not found: {$filePath}");
            return Command::FAILURE;
        }

        $this->info("Reading CSV file: {$filePath}");

        // Get program if specified
        $program = null;
        if ($this->option('program')) {
            $programId = $this->option('program');
            if (is_numeric($programId)) {
                $program = InternshipProgram::find($programId);
            } else {
                $program = InternshipProgram::where('name', $programId)->first();
            }
            
            if (!$program) {
                $this->error("Program not found: {$programId}");
                return Command::FAILURE;
            }
            $this->info("Linking to program: {$program->name} (ID: {$program->id})");
        }

        $handle = fopen($filePath, 'r');
        if (!$handle) {
            $this->error("Could not open file: {$filePath}");
            return Command::FAILURE;
        }

        // Skip first row (section headers)
        $firstRow = fgetcsv($handle, 0, ';');
        
        // Read actual header row
        $headers = fgetcsv($handle, 0, ';');
        if (!$headers) {
            $this->error("Could not read CSV headers");
            fclose($handle);
            return Command::FAILURE;
        }

        $this->info("Found " . count($headers) . " columns");
        
        $imported = 0;
        $skipped = 0;
        $rowNumber = 2; // Start at 2 since we skipped first row

        DB::beginTransaction();
        try {
            while (($row = fgetcsv($handle, 0, ';')) !== false) {
                $rowNumber++;
                
                // Skip empty rows
                if (empty(array_filter($row))) {
                    continue;
                }

                // Map CSV columns to database fields
                $data = $this->mapRowToData($headers, $row);
                
                // Skip if no first name or email (required fields)
                if (empty($data['first_name']) || empty($data['email_address'])) {
                    $this->warn("Row {$rowNumber}: Skipping - missing first name or email");
                    $skipped++;
                    continue;
                }

                // Check if beneficiary already exists by email or ID number
                $exists = MictBeneficiary::where('email_address', $data['email_address'])
                    ->orWhere(function($query) use ($data) {
                        if (!empty($data['id_number'])) {
                            $query->where('id_number', $data['id_number']);
                        }
                    })
                    ->exists();

                if ($exists) {
                    $this->warn("Row {$rowNumber}: Skipping - already exists (Email: {$data['email_address']})");
                    $skipped++;
                    continue;
                }

                // Add program_id if program is specified
                if ($program) {
                    $data['program_id'] = $program->id;
                }

                $beneficiary = MictBeneficiary::create($data);
                
                // Create InternsLearner record if program is specified
                if ($program && $beneficiary) {
                    try {
                        InternsLearner::create([
                            'program_id' => $program->id,
                            'first_name' => $data['first_name'],
                            'middle_name' => $data['middle_name'] ?? null,
                            'surname' => $data['surname'],
                            'email' => $data['email_address'],
                            'phone' => $data['cellphone'] ?? $data['telephone'] ?? null,
                            'id_number' => $data['id_number'] ?? null,
                            'date_of_birth' => $data['date_of_birth'] ?? null,
                            'gender' => $data['gender'] ?? null,
                            'address' => $this->formatAddress($data),
                            'status' => 'active',
                            'start_date' => $data['program_start_date'] ?? $data['learner_agreement_start_date'] ?? null,
                            'end_date' => $data['learner_agreement_end_date'] ?? null,
                        ]);
                    } catch (\Exception $e) {
                        $this->warn("Could not create InternsLearner for row {$rowNumber}: " . $e->getMessage());
                    }
                }
                
                $imported++;

                if ($imported % 10 == 0) {
                    $this->info("Imported {$imported} records...");
                }
            }

            DB::commit();
            $this->info("\nImport completed!");
            $this->info("Imported: {$imported}");
            $this->info("Skipped: {$skipped}");
            $this->info("Total rows processed: " . ($rowNumber - 1));

        } catch (\Exception $e) {
            DB::rollBack();
            $this->error("Error importing: " . $e->getMessage());
            $this->error("Row: {$rowNumber}");
            return Command::FAILURE;
        } finally {
            fclose($handle);
        }

        return Command::SUCCESS;
    }

    /**
     * Map CSV row to database fields
     */
    private function mapRowToData($headers, $row)
    {
        $data = [];
        
        // Helper function to get value by header name
        $getValue = function($headerName) use ($headers, $row) {
            $index = array_search($headerName, $headers);
            return $index !== false && isset($row[$index]) ? trim($row[$index]) : null;
        };

        // Learner Details
        $data['learner_title'] = $getValue('LEARNER TITLE');
        $data['first_name'] = $getValue('FIRST NAME OF LEARNER');
        $data['middle_name'] = $getValue('MIDDLE NAME OF LEARNER');
        $data['surname'] = $getValue('SURNAME OF  LEARNER');
        $data['maiden_name'] = $getValue('MAIDEN NAME');
        $data['type_of_id'] = $getValue('TYPE OF ID');
        $data['id_number'] = $getValue('ID NUMBER OF THE LEARNER');
        
        // Date of birth - handle various formats
        $dob = $getValue('DATE OF BIRTH (yyyy/mm/dd)');
        if ($dob) {
            $dob = str_replace(['(', ')'], '', $dob);
            $data['date_of_birth'] = $this->parseDate($dob);
        }
        
        $data['residence_status'] = $getValue('RESIDENCE STATUS');
        $data['marital_status'] = $getValue('MARITAL STATUS');
        $data['gender'] = $getValue('GENDER');
        $data['race'] = $getValue('RACE');
        $data['disabled'] = strtolower($getValue('DISABLED?')) === 'yes';
        $data['type_of_disability'] = $getValue('TYPE OF DISABILITY');
        $age = $getValue('AGE');
        $data['age'] = $age ? (int)$age : null;
        $data['sa_citizen'] = strtolower($getValue('SA CITIZEN?')) === 'yes';
        $data['nationality'] = $getValue('Nationality of Learner');
        $data['first_language'] = $getValue('FIRST LANGUAGE');
        $data['employed'] = strtolower($getValue('EMPLOYED?')) === 'yes';
        
        $unemploymentYears = $getValue('LENGTH OF UNEMPLOYMENT (in years)');
        $data['length_of_unemployment_years'] = $unemploymentYears ? (int)$unemploymentYears : null;
        
        $empStartDate = $getValue('IF EMPLOYED, WHAT WAS THE STARTING DATE OF THE EMPLOYMENT? (yyyy/mm/dd)');
        if ($empStartDate) {
            $data['employment_start_date'] = $this->parseDate($empStartDate);
        }
        
        $agreementStart = $getValue('START DATE AS PER LEARNER AGREEMENT (yyyy/mm/dd)');
        if ($agreementStart) {
            $data['learner_agreement_start_date'] = $this->parseDate($agreementStart);
        }
        
        $agreementEnd = $getValue('END DATE AS PER LEARNER AGREEMENT (yyyy/mm/dd)');
        if ($agreementEnd) {
            $data['learner_agreement_end_date'] = $this->parseDate($agreementEnd);
        }
        
        $programStart = $getValue('START DATE OF PROGRAM (yyyy/mm/dd)');
        if ($programStart) {
            $data['program_start_date'] = $this->parseDate($programStart);
        }
        
        $amount = $getValue('AMOUNT ALLOCATED');
        $data['amount_allocated'] = $amount ? (float)str_replace(',', '', $amount) : null;
        $data['previous_internship'] = strtolower($getValue('PREVIOUS INTERNSHIP')) === 'yes';
        $data['year_of_study'] = $getValue('YEAR OF STUDY');

        // Physical Address
        $data['physical_address_1'] = $getValue('PHYSICAL ADDRESS 1');
        $data['physical_address_2'] = $getValue('PHYSICAL ADDRESS 2');
        $data['physical_address_3'] = $getValue('PHYSICAL ADDRESS 3');
        $data['physical_postal_code'] = $getValue('PHYSICAL POSTAL CODE (use the autocomplete)');

        // Postal Address
        $data['postal_address_1'] = $getValue('POSTAL ADDRESS 1');
        $data['postal_address_2'] = $getValue('POSTAL ADDRESS 2');
        $data['postal_address_3'] = $getValue('POSTAL ADDRESS 3');
        $data['postal_address_postal_code'] = $getValue('POSTAL ADDRESS POSTAL CODE');
        $data['type_of_area'] = $getValue('TYPE OF AREA');
        $data['email_address'] = $getValue('EMAIL ADDRESS');
        $data['cellphone'] = $getValue('CELLPHONE');
        $data['telephone'] = $getValue('TELEPHONE');
        $data['fax'] = $getValue('FAX');

        // Highest Level of Qualification
        $data['highest_nqf_qualification'] = $getValue('HIGHEST LEVEL OF NQF QUALIFICATION');
        $data['other_qualification'] = $getValue('OTHER (if not found in previous column)');
        $data['title_of_highest_qualification'] = $getValue('TITLE OF YOUR HIGHEST QUALIFICATION');
        $data['has_matriculated'] = strtolower($getValue('HAS THE LEARNER MATRICULATED FROM HIGH SCHOOL')) === 'yes';
        $data['matriculated_in_sa'] = strtolower($getValue('DID THE LEARNER MATRICULATE IN SOUTH AFRICA')) === 'yes';
        $data['province_of_high_school'] = $getValue('PROVINCE OF HIGH SCHOOL MARTICULATED FROM');
        $data['year_of_national_senior_certificate'] = $getValue('YEAR OF NATIONAL SENIOR CERTIFICATE');

        // Parents/Guardian Details
        $data['guardian_first_name'] = $getValue('FIRST NAME');
        $data['guardian_last_name'] = $getValue('LAST NAME');
        $data['guardian_type_of_id'] = $getValue('TYPE OF ID - Parent');
        $data['guardian_id_number'] = $getValue('ID NUMBER');
        $data['guardian_telephone'] = $getValue('TELEPHONE4');
        $data['guardian_cellphone'] = $getValue('CELLPHONE5');
        $data['guardian_home_address'] = $getValue('HOME ADDRESS');
        $data['guardian_postal_address'] = $getValue('POSTAL ADDRESS');
        $data['guardian_email_address'] = $getValue('EMAIL ADDRESS - Parent');

        return array_filter($data, function($value) {
            return $value !== null && $value !== '';
        });
    }

    /**
     * Parse date from various formats
     */
    private function parseDate($dateString)
    {
        if (empty($dateString)) {
            return null;
        }

        // Remove parentheses if present
        $dateString = trim(str_replace(['(', ')'], '', $dateString));
        
        // Try different date formats
        $formats = ['Y-m-d', 'Y/m/d', 'd/m/Y', 'm/d/Y', 'Y-m-d H:i:s'];
        
        foreach ($formats as $format) {
            $date = \DateTime::createFromFormat($format, $dateString);
            if ($date !== false) {
                return $date->format('Y-m-d');
            }
        }

        // Try strtotime as fallback
        $timestamp = strtotime($dateString);
        if ($timestamp !== false) {
            return date('Y-m-d', $timestamp);
        }

        return null;
    }

    /**
     * Format address from data array
     */
    private function formatAddress($data)
    {
        $parts = [];
        if (!empty($data['physical_address_1'])) $parts[] = $data['physical_address_1'];
        if (!empty($data['physical_address_2'])) $parts[] = $data['physical_address_2'];
        if (!empty($data['physical_address_3'])) $parts[] = $data['physical_address_3'];
        if (!empty($data['physical_postal_code'])) $parts[] = $data['physical_postal_code'];
        
        return implode(', ', $parts);
    }
}
