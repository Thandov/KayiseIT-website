<?php

namespace App\Http\Controllers;

use App\Models\Occupations;
use App\Models\Specializations;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class OccupationsController extends Controller
{
    public function occupations()
    {
        $occupations = Occupations::all();

        return view('/admin/dashboard/careermapping_dashboard', compact('occupations'));
    }

    public function addoccupations()
    {
        return view('admin/addoccupations');
    }

    public function addoccupation(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'occupation_banner' => 'required|image|mimes:jpeg,png,jpg,gif|max:5048',
            'occupation_name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:occupations,slug',
            'description' => 'nullable|string',
            'day_in_life' => 'nullable|string|max:500',
            'entry_salary_min' => 'nullable|integer|min:0',
            'entry_salary_max' => 'nullable|integer|min:0',
            'display_order' => 'nullable|integer|min:0',
            'quiz_tags' => 'nullable|string|max:255',
            'video_url' => 'nullable|url|max:500',
        ]);

        $slug = $request->filled('slug')
            ? Str::slug($request->slug)
            : Str::slug($request->occupation_name);

        $newImageName = $slug.'-logo.'.$request->image->extension();
        $newBannerName = $slug.'-banner.'.$request->occupation_banner->extension();

        $request->image->move(public_path('images/occupations_logo'), $newImageName);
        $request->occupation_banner->move(public_path('images/banner'), $newBannerName);

        $occupation = new Occupations();
        $occupation->image = $newImageName;
        $occupation->occupation_banner = $newBannerName;
        $occupation->occupation_name = $request->occupation_name;
        $occupation->slug = $slug;
        $occupation->description = $request->description;
        $occupation->day_in_life = $request->day_in_life;
        $occupation->entry_salary_min = $request->entry_salary_min;
        $occupation->entry_salary_max = $request->entry_salary_max;
        $occupation->display_order = $request->input('display_order', 0);
        $occupation->quiz_tags = $request->quiz_tags;
        $occupation->video_url = $request->video_url;
        $occupation->school_subjects = $this->parseSchoolSubjects($request->input('school_subjects_text'));
        $occupation->is_published = $request->boolean('is_published', true);
        $occupation->u_id = auth()->id();
        $occupation->save();

        return redirect()->route('dashboard.careermapping')->with('success', 'Occupation added successfully');
    }

    public function showoccupations()
    {
        $occupations = Occupations::published()
            ->orderBy('display_order')
            ->orderBy('occupation_name')
            ->get();

        return view('career-mapping', compact('occupations'));
    }

    public function showCareerBySlug(string $slug)
    {
        $occupations = Occupations::published()
            ->where('slug', $slug)
            ->with(['specializations.careerSteps.modules'])
            ->firstOrFail();

        $specializations = $occupations->specializations;
        $careerStepsArray = [];

        foreach ($specializations as $specialization) {
            $careerStepsArray[$specialization->spec_id] = $specialization->careerSteps;
        }

        return view('viewoccupations', compact('occupations', 'specializations', 'careerStepsArray'));
    }

    public function redirectLegacyOccupation($occup_id)
    {
        $occupation = Occupations::findOrFail($occup_id);

        if ($occupation->slug) {
            return redirect()->route('careers.show', ['slug' => $occupation->slug], 301);
        }

        return redirect()->route('career-mapping');
    }

    public function showviewoccupations(Request $request, $occup_id)
    {
        return $this->redirectLegacyOccupation($occup_id);
    }

    public function showadmin_viewoccupations(Request $request, $occup_id)
    {
        $occupations = Occupations::findOrFail($occup_id);
        $specializations = Specializations::where('occup_id', $occupations->occup_id)->get();

        return view('admin.admin_viewoccupations', compact('occupations', 'specializations'));
    }

    public function editOccupation($occup_id)
    {
        $occupation = Occupations::findOrFail($occup_id);
        $pageTitle = 'Edit Occupation';

        return view('admin.dashboard.careermapping.occupations.edit', compact('occupation', 'pageTitle'));
    }

    public function updateOccupation(Request $request, $occup_id)
    {
        $occupation = Occupations::findOrFail($occup_id);

        $request->validate([
            'occupation_name' => 'required|string|max:255',
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('occupations', 'slug')->ignore($occupation->occup_id, 'occup_id'),
            ],
            'description' => 'nullable|string',
            'day_in_life' => 'nullable|string|max:500',
            'entry_salary_min' => 'nullable|integer|min:0',
            'entry_salary_max' => 'nullable|integer|min:0|gte:entry_salary_min',
            'display_order' => 'nullable|integer|min:0',
            'quiz_tags' => 'nullable|string|max:255',
            'video_url' => 'nullable|url|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'occupation_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);

        $slug = $request->filled('slug')
            ? Str::slug($request->slug)
            : Str::slug($request->occupation_name);

        $occupation->occupation_name = $request->occupation_name;
        $occupation->slug = $slug;
        $occupation->description = $request->description;
        $occupation->day_in_life = $request->day_in_life;
        $occupation->entry_salary_min = $request->entry_salary_min;
        $occupation->entry_salary_max = $request->entry_salary_max;
        $occupation->display_order = $request->input('display_order', 0);
        $occupation->quiz_tags = $request->quiz_tags;
        $occupation->video_url = $request->video_url;
        $occupation->school_subjects = $this->parseSchoolSubjects($request->input('school_subjects_text'));
        $occupation->is_published = $request->boolean('is_published');

        if ($request->hasFile('image')) {
            $newImageName = $slug.'-logo.'.$request->image->extension();
            $request->image->move(public_path('images/occupations_logo'), $newImageName);
            $occupation->image = $newImageName;
        }

        if ($request->hasFile('occupation_banner')) {
            $newBannerName = $slug.'-banner.'.$request->occupation_banner->extension();
            $request->occupation_banner->move(public_path('images/banner'), $newBannerName);
            $occupation->occupation_banner = $newBannerName;
        }

        $occupation->save();

        return redirect()
            ->route('dashboard.occupations.edit', $occupation->occup_id)
            ->with('success', 'Occupation updated successfully.');
    }

    public function delete($occup_id)
    {
        $occupation = Occupations::find($occup_id);

        if (!$occupation) {
            return redirect()->back()->withErrors('Occupation not found.');
        }

        $occupation->delete();

        return redirect()->back()->with('success', 'Occupation deleted successfully.');
    }

    private function parseSchoolSubjects(?string $text): ?array
    {
        if ($text === null || trim($text) === '') {
            return null;
        }

        $lines = preg_split('/\r\n|\r|\n/', $text);

        return array_values(array_filter(array_map('trim', $lines)));
    }
}
