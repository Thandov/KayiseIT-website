@extends('admin.dashboard.layout')

@section('page-title', $pageTitle ?? 'Edit Announcement')

@section('content')
    <div class="p-6">
        <div class="max-w-4xl mx-auto">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-900">Edit Announcement</h2>
                <p class="mt-1 text-sm text-gray-600">Update announcement details.</p>
            </div>

            <form action="{{ route('admin.dashboard.announcements.update', $announcement->id) }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           value="{{ old('title', $announcement->title) }}"
                           required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Description <span class="text-red-500">*</span>
                    </label>
                    <textarea name="description" 
                              id="description" 
                              rows="4"
                              required
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">{{ old('description', $announcement->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Link -->
                <div class="mb-6">
                    <label for="link" class="block text-sm font-medium text-gray-700 mb-2">
                        Link URL (Optional)
                    </label>
                    <input type="url" 
                           name="link" 
                           id="link" 
                           value="{{ old('link', $announcement->link) }}"
                           placeholder="https://example.com"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    @error('link')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Badge -->
                <div class="mb-6">
                    <label for="badge" class="block text-sm font-medium text-gray-700 mb-2">
                        Badge Text (Optional)
                    </label>
                    <input type="text" 
                           name="badge" 
                           id="badge" 
                           value="{{ old('badge', $announcement->badge) }}"
                           placeholder="NEW, UPDATE, OPPORTUNITY"
                           maxlength="50"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    @error('badge')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Expiration Date -->
                <div class="mb-6">
                    <label for="expires_at" class="block text-sm font-medium text-gray-700 mb-2">
                        Expiration Date (Optional)
                    </label>
                    <input type="datetime-local" 
                           name="expires_at" 
                           id="expires_at" 
                           value="{{ old('expires_at', $announcement->expires_at ? $announcement->expires_at->format('Y-m-d\TH:i') : '') }}"
                           min="{{ now()->format('Y-m-d\TH:i') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    @error('expires_at')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">
                        Set when this announcement should stop displaying. Leave empty to keep it active indefinitely.
                        @if($announcement->expires_at)
                            <br><strong>Current expiration:</strong> {{ $announcement->expires_at->format('F d, Y g:i A') }}
                            @if($announcement->expires_at->isPast())
                                <span class="text-red-600 font-semibold">(EXPIRED)</span>
                            @elseif($announcement->expires_at->isToday())
                                <span class="text-orange-600 font-semibold">(Expires today)</span>
                            @endif
                        @endif
                    </p>
                </div>

                <!-- Current Image -->
                @if($announcement->image)
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Current Image</label>
                    <div class="relative w-48 h-48 rounded-lg overflow-hidden border border-gray-300">
                        <img src="{{ asset($announcement->image) }}" alt="Current image" class="w-full h-full object-cover">
                    </div>
                </div>
                @endif

                <!-- Image -->
                <div class="mb-6">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ $announcement->image ? 'Replace Image (Optional)' : 'Image (Optional)' }}
                    </label>
                    <input type="file" 
                           name="image" 
                           id="image" 
                           accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Maximum file size: 2MB. Allowed formats: JPEG, PNG, GIF, WebP</p>
                </div>

                <!-- Submit Buttons -->
                <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-200">
                    <a href="{{ route('admin.dashboard.announcements.index') }}" 
                       class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                        Update Announcement
                    </button>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection

