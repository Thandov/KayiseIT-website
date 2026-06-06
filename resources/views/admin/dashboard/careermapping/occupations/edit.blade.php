@extends('admin.dashboard.layout')

@section('content')
<div class="p-6 max-w-3xl mx-auto">
    @include('admin.dashboard.careermapping._tabs', ['active' => 'occupations'])

    <a href="{{ route('dashboard.admin_viewoccupations', $occupation->occup_id) }}" class="text-sm text-indigo-600 hover:text-indigo-800">← Back to specialisations</a>
    <h3 class="text-2xl font-bold text-gray-900 mt-4 mb-2">Edit occupation</h3>
    <p class="text-sm text-gray-500 mb-6">Changes appear on <a href="{{ $occupation->slug ? route('careers.show', $occupation->slug) : '#' }}" class="text-indigo-600 underline" target="_blank" rel="noopener">public career page</a> when published.</p>

    @if ($errors->any())
        <div class="mb-4 p-3 rounded-lg bg-red-50 text-red-800 text-sm">
            <ul class="list-disc pl-5">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif
    @if (session('success'))
        <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-800 text-sm">{{ session('success') }}</div>
    @endif

    <form action="{{ route('dashboard.occupations.update', $occupation->occup_id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow rounded-lg p-6 space-y-5">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Occupation name</label>
                <input type="text" name="occupation_name" value="{{ old('occupation_name', $occupation->occupation_name) }}" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">URL slug</label>
                <input type="text" name="slug" value="{{ old('slug', $occupation->slug) }}" placeholder="software-developer"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <p class="text-xs text-gray-500 mt-1">Public URL: /careers/<em>slug</em></p>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('description', $occupation->description) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Day in the life</label>
            <input type="text" name="day_in_life" value="{{ old('day_in_life', $occupation->day_in_life) }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Entry salary min (ZAR / year)</label>
                <input type="number" name="entry_salary_min" min="0" value="{{ old('entry_salary_min', $occupation->entry_salary_min) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Entry salary max (ZAR / year)</label>
                <input type="number" name="entry_salary_max" min="0" value="{{ old('entry_salary_max', $occupation->entry_salary_max) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Display order</label>
                <input type="number" name="display_order" min="0" value="{{ old('display_order', $occupation->display_order ?? 0) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div class="flex items-end">
                <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                    <input type="hidden" name="is_published" value="0">
                    <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $occupation->is_published))>
                    Published on career guide
                </label>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Quiz tags (comma-separated)</label>
            <input type="text" name="quiz_tags" value="{{ old('quiz_tags', $occupation->quiz_tags) }}" placeholder="build,creative"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            <p class="text-xs text-gray-500 mt-1">Used by “Find your fit” quiz: build, solve, protect, lead, creative, organize, people</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">School subjects (one per line)</label>
            <textarea name="school_subjects_text" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                      placeholder="Mathematics&#10;English">{{ old('school_subjects_text', is_array($occupation->school_subjects) ? implode("\n", $occupation->school_subjects) : '') }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Video URL (YouTube / Vimeo embed)</label>
            <input type="url" name="video_url" value="{{ old('video_url', $occupation->video_url) }}"
                   placeholder="https://www.youtube.com/watch?v=..."
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>

        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Logo image</label>
                @if ($occupation->image && !str_starts_with(trim($occupation->image), '<'))
                    <img src="{{ asset('images/occupations_logo/'.$occupation->image) }}" alt="" class="h-16 w-16 object-contain mb-2">
                @endif
                <input type="file" name="image" accept="image/*" class="block w-full text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Hero banner</label>
                @if ($occupation->occupation_banner)
                    <img src="{{ asset('images/banner/'.$occupation->occupation_banner) }}" alt="" class="h-16 w-full object-cover rounded mb-2">
                @endif
                <input type="file" name="occupation_banner" accept="image/*" class="block w-full text-sm">
            </div>
        </div>

        <button type="submit" class="w-full py-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700">
            Save occupation
        </button>
    </form>
</div>
@endsection
