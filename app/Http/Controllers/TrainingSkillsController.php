<?php

namespace App\Http\Controllers;

use App\Models\AcademyCourse;

class TrainingSkillsController extends Controller
{
    /**
     * Public Training & Skills page (courses from Academy).
     */
    public function __invoke()
    {
        $courses = AcademyCourse::query()
            ->visibleOnFrontend()
            ->ordered()
            ->get();

        return view('training-skills', compact('courses'));
    }
}
