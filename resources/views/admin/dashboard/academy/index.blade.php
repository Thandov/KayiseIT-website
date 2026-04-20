@extends('admin.dashboard.layout')

@section('content')
    <div class="p-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Academy — Training Courses</h2>
                    <p class="mt-1 text-sm text-gray-600">Courses shown on the public Training &amp; Skills page. Order and visibility are controlled here.</p>
                </div>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('training-skills') }}" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center px-4 py-2 text-sm font-medium text-kg-700 bg-kg-50 rounded-lg hover:bg-kg-100">
                        View public page
                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                    </a>
                    <a href="{{ route('dashboard.academy.create') }}"
                       class="inline-flex items-center px-4 py-2 bg-kg-700 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-kg-600">
                        Add course
                    </a>
                </div>
            </div>

            @if (session('success'))
                <div class="mb-4 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if ($courses->isEmpty())
                <p class="text-gray-600 py-8">No courses yet. Run <code class="text-sm bg-gray-100 px-1 rounded">php artisan db:seed --class=AcademyCoursesSeeder</code> or add a course.</p>
            @else
                <div class="bg-kg-50 border border-kg-100 rounded-lg p-4 mb-6">
                    <p class="text-sm text-gray-700">
                        Use the switch in each row to show or hide a course on the public <a href="{{ route('training-skills') }}" class="text-kg-700 font-medium underline hover:no-underline">Training &amp; Skills</a> page. Off means the course stays in the dashboard only.
                    </p>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Icon</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">On website</th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($courses as $course)
                                <tr class="academy-course-row transition-colors duration-200" data-course-row="{{ $course->id }}">
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $course->display_order }}</td>
                                    <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $course->title }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $course->category }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-500 font-mono">{{ $course->icon_key }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <label class="relative inline-flex items-center cursor-pointer select-none">
                                            <input type="checkbox"
                                                   class="sr-only peer academy-course-toggle"
                                                   data-course-id="{{ $course->id }}"
                                                   data-toggle-url="{{ route('dashboard.academy.toggle', $course) }}"
                                                   {{ $course->show_on_frontend ? 'checked' : '' }}
                                                   onchange="toggleAcademyCourse(this)">
                                            <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-kg-700"></div>
                                            <span class="ml-3 text-sm font-medium text-gray-700 academy-toggle-label">
                                                {{ $course->show_on_frontend ? 'Active' : 'Inactive' }}
                                            </span>
                                        </label>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-right text-sm font-medium space-x-3">
                                        <a href="{{ route('dashboard.academy.edit', $course) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        <form action="{{ route('dashboard.academy.destroy', $course) }}" method="POST" class="inline"
                                              onsubmit="return confirm('Delete this course?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    @if ($courses->isNotEmpty())
        <script>
            function toggleAcademyCourse(checkbox) {
                const url = checkbox.getAttribute('data-toggle-url');
                const label = checkbox.closest('label').querySelector('.academy-toggle-label');
                const row = checkbox.closest('[data-course-row]');
                const wasChecked = checkbox.checked;

                checkbox.disabled = true;

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    },
                    body: JSON.stringify({})
                })
                    .then(function (response) { return response.json(); })
                    .then(function (data) {
                        if (data.success) {
                            checkbox.checked = data.show_on_frontend;
                            if (label) {
                                label.textContent = data.show_on_frontend ? 'Active' : 'Inactive';
                            }
                            if (row) {
                                row.classList.add('bg-green-50');
                                setTimeout(function () { row.classList.remove('bg-green-50'); }, 800);
                            }
                        } else {
                            checkbox.checked = !wasChecked;
                            alert(data.message || 'Could not update the course.');
                        }
                    })
                    .catch(function () {
                        checkbox.checked = !wasChecked;
                        alert('An error occurred. Please try again.');
                    })
                    .finally(function () {
                        checkbox.disabled = false;
                    });
            }
        </script>
    @endif
@endsection
