<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CareerStepModuleTableSeeder extends Seeder
{
    public function run(): void
    {
        if (DB::table('career_step_module')->exists()) {
            return;
        }

        $moduleId = DB::table('modules')->where('slug', 'systems-development-nqf-5')->value('id');
        if (!$moduleId) {
            return;
        }

        $stepId = DB::table('career_steps')
            ->where('spec_id', 1)
            ->where('step_number', 1)
            ->value('steps_id');

        if ($stepId) {
            DB::table('career_step_module')->insert([
                'steps_id' => $stepId,
                'module_id' => $moduleId,
            ]);
        }
    }
}
