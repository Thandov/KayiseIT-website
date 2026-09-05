<?php

use App\Models\CaseStudy;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('case_studies', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('title');
            $table->string('headline')->nullable()->after('slug');
            $table->string('sector')->nullable()->after('client_name');
            $table->string('duration')->nullable()->after('year');
            $table->text('quote')->nullable()->after('results');
            $table->string('quote_name')->nullable()->after('quote');
            $table->string('quote_role')->nullable()->after('quote_name');
        });

        CaseStudy::query()->orderBy('id')->each(function (CaseStudy $caseStudy) {
            $caseStudy->slug = CaseStudy::uniqueSlug($caseStudy->title, $caseStudy->id);
            $caseStudy->saveQuietly();
        });
    }

    public function down()
    {
        Schema::table('case_studies', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn([
                'slug',
                'headline',
                'sector',
                'duration',
                'quote',
                'quote_name',
                'quote_role',
            ]);
        });
    }
};
