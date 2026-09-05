<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('case_studies', function (Blueprint $table) {
            if (! Schema::hasColumn('case_studies', 'type')) {
                $table->string('type', 32)->default('website')->after('sector');
            }
            if (! Schema::hasColumn('case_studies', 'type_meta')) {
                $table->json('type_meta')->nullable()->after('type');
            }
        });

        $map = [
            'web' => 'website',
            'training' => 'training',
            'skills' => 'training',
            'infrastructure' => 'infrastructure',
            'network' => 'infrastructure',
            'software' => 'software',
            'lms' => 'software',
            'repair' => 'repair',
            'support' => 'support',
        ];

        foreach (DB::table('case_studies')->select('id', 'sector')->get() as $row) {
            $sector = strtolower((string) $row->sector);
            $type = 'website';
            foreach ($map as $needle => $value) {
                if ($sector !== '' && str_contains($sector, $needle)) {
                    $type = $value;
                    break;
                }
            }
            DB::table('case_studies')->where('id', $row->id)->update(['type' => $type]);
        }
    }

    public function down(): void
    {
        Schema::table('case_studies', function (Blueprint $table) {
            if (Schema::hasColumn('case_studies', 'type_meta')) {
                $table->dropColumn('type_meta');
            }
            if (Schema::hasColumn('case_studies', 'type')) {
                $table->dropColumn('type');
            }
        });
    }
};
