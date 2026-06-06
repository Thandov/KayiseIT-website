<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::orderBy('title')->paginate(20);
        $pageTitle = 'Training Modules';

        return view('admin.dashboard.modules.index', compact('modules', 'pageTitle'));
    }

    public function create()
    {
        $pageTitle = 'Add Module';

        return view('admin.dashboard.modules.form', [
            'module' => new Module(),
            'pageTitle' => $pageTitle,
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['title']);

        Module::create($data);

        return redirect()->route('dashboard.modules.index')->with('success', 'Module created.');
    }

    public function edit(Module $module)
    {
        $pageTitle = 'Edit Module';

        return view('admin.dashboard.modules.form', compact('module', 'pageTitle'));
    }

    public function update(Request $request, Module $module)
    {
        $data = $this->validated($request);
        if ($module->title !== $data['title']) {
            $data['slug'] = $this->uniqueSlug($data['title'], $module->id);
        }

        $module->update($data);

        return redirect()->route('dashboard.modules.index')->with('success', 'Module updated.');
    }

    public function destroy(Module $module)
    {
        $module->delete();

        return redirect()->route('dashboard.modules.index')->with('success', 'Module deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'nqf_level' => 'nullable|integer|min:1|max:10',
            'duration_months' => 'nullable|integer|min:1|max:120',
            'description' => 'nullable|string',
            'registration_url' => 'nullable|string|max:500',
            'accreditation_body' => 'required|in:QCTO,MICT_SETA,NONE',
            'accreditation_status' => 'required|in:accredited,pending,not_accredited',
            'accreditation_number' => 'nullable|string|max:255',
            'accreditation_expires_at' => 'nullable|date',
            'is_registration_open' => 'sometimes|boolean',
        ]) + [
            'is_registration_open' => $request->boolean('is_registration_open'),
        ];
    }

    private function uniqueSlug(string $title, ?int $exceptId = null): string
    {
        $slug = Str::slug($title);
        $base = $slug;
        $i = 1;

        while (Module::where('slug', $slug)->when($exceptId, fn ($q) => $q->where('id', '!=', $exceptId))->exists()) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }
}
