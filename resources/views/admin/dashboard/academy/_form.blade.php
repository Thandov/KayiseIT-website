@php
    /** @var \App\Models\AcademyCourse|null $course */
    $course = $course ?? null;
    $iconOptions = [
        'monitor' => 'Monitor (ICT / digital foundations)',
        'drone_hex' => 'Hexagon (STEM / drone)',
        'document' => 'Document (Office)',
        'bars' => 'Lines (Productivity / workflow)',
        'shield' => 'Shield (Cyber security)',
        'plus' => 'Plus (Entrepreneurship)',
    ];
@endphp

<div class="space-y-6">
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title <span class="text-red-500">*</span></label>
        <input type="text" name="title" id="title" value="{{ old('title', $course?->title) }}" required
               class="mt-1 focus:ring-kg-500 focus:border-kg-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('title') border-red-500 @enderror">
        @error('title')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description <span class="text-red-500">*</span></label>
        <textarea name="description" id="description" rows="5" required
                  class="mt-1 focus:ring-kg-500 focus:border-kg-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('description') border-red-500 @enderror">{{ old('description', $course?->description) }}</textarea>
        @error('description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category tag <span class="text-red-500">*</span></label>
        <input type="text" name="category" id="category" value="{{ old('category', $course?->category) }}" required placeholder="e.g. Digital Foundations"
               class="mt-1 focus:ring-kg-500 focus:border-kg-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('category') border-red-500 @enderror">
        @error('category')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="icon_key" class="block text-sm font-medium text-gray-700 mb-1">Icon <span class="text-red-500">*</span></label>
        <select name="icon_key" id="icon_key" required
                class="mt-1 focus:ring-kg-500 focus:border-kg-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('icon_key') border-red-500 @enderror">
            @foreach ($iconOptions as $value => $label)
                <option value="{{ $value }}" {{ old('icon_key', $course?->icon_key) === $value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        @error('icon_key')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="display_order" class="block text-sm font-medium text-gray-700 mb-1">Display order</label>
        <input type="number" name="display_order" id="display_order" min="0" value="{{ old('display_order', $course?->display_order ?? 0) }}"
               class="mt-1 focus:ring-kg-500 focus:border-kg-500 block w-full max-w-xs shadow-sm sm:text-sm border-gray-300 rounded-md @error('display_order') border-red-500 @enderror">
        @error('display_order')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center">
        <input type="hidden" name="show_on_frontend" value="0">
        <input type="checkbox" name="show_on_frontend" id="show_on_frontend" value="1"
               class="rounded border-gray-300 text-kg-700 shadow-sm focus:ring-kg-500"
               {{ old('show_on_frontend', $course?->show_on_frontend ?? true) ? 'checked' : '' }}>
        <label for="show_on_frontend" class="ml-2 block text-sm text-gray-700">Show on Training &amp; Skills page</label>
    </div>
</div>
