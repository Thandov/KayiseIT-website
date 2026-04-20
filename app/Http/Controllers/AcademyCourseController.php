<?php

namespace App\Http\Controllers;

use App\Models\AcademyCourse;
use Illuminate\Http\Request;

class AcademyCourseController extends Controller
{
    public function index()
    {
        $courses = AcademyCourse::query()->ordered()->get();
        $isAdmin = true;
        $pageTitle = 'Academy — Training Courses';

        return view('admin.dashboard.academy.index', compact('courses', 'isAdmin', 'pageTitle'));
    }

    public function create()
    {
        $isAdmin = true;
        $pageTitle = 'Add Academy Course';

        return view('admin.dashboard.academy.create', compact('isAdmin', 'pageTitle'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'icon_key' => 'required|string|in:' . implode(',', AcademyCourse::ICON_KEYS),
            'display_order' => 'nullable|integer|min:0',
            'show_on_frontend' => 'nullable|boolean',
        ]);

        $validated['show_on_frontend'] = $request->boolean('show_on_frontend');
        $validated['display_order'] = $validated['display_order'] ?? 0;

        AcademyCourse::create($validated);

        return redirect()->route('dashboard.academy.index')
            ->with('success', 'Course created successfully.');
    }

    public function edit(AcademyCourse $academy_course)
    {
        $course = $academy_course;
        $isAdmin = true;
        $pageTitle = 'Edit Academy Course';

        return view('admin.dashboard.academy.edit', compact('course', 'isAdmin', 'pageTitle'));
    }

    public function update(Request $request, AcademyCourse $academy_course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'icon_key' => 'required|string|in:' . implode(',', AcademyCourse::ICON_KEYS),
            'display_order' => 'nullable|integer|min:0',
            'show_on_frontend' => 'nullable|boolean',
        ]);

        $validated['show_on_frontend'] = $request->boolean('show_on_frontend');
        $validated['display_order'] = $validated['display_order'] ?? 0;

        $academy_course->update($validated);

        return redirect()->route('dashboard.academy.index')
            ->with('success', 'Course updated successfully.');
    }

    public function destroy(AcademyCourse $academy_course)
    {
        $academy_course->delete();

        return redirect()->route('dashboard.academy.index')
            ->with('success', 'Course deleted.');
    }

    public function toggleFrontend(AcademyCourse $academy_course)
    {
        $academy_course->show_on_frontend = ! $academy_course->show_on_frontend;
        $academy_course->save();

        return response()->json([
            'success' => true,
            'show_on_frontend' => $academy_course->show_on_frontend,
            'message' => $academy_course->show_on_frontend
                ? 'Course will show on the Training & Skills page.'
                : 'Course is hidden from the public page.',
        ]);
    }
}
