@php
    $employee = $employee ?? null;
    $documentTypes = \App\Helpers\StaffFolderHelper::DOCUMENT_TYPES;
@endphp
<div class="md:col-span-2">
    <h3 class="text-sm font-semibold text-gray-900">Documents</h3>
    <p class="mt-1 text-xs text-gray-500">PDF, JPG, PNG, WebP, DOC, or DOCX up to 10MB. Each file is stored in its own folder under Staff/name_surname.</p>
    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($documentTypes as $field => $meta)
            @php
                $currentPath = $employee->{$meta['column']} ?? null;
                $currentUrl = $currentPath ? \App\Helpers\StaffFolderHelper::url($currentPath) : null;
            @endphp
            <div>
                <label for="{{ $field }}" class="block text-sm font-medium text-gray-700">{{ $meta['label'] }}</label>
                <input type="file" name="{{ $field }}" id="{{ $field }}"
                       accept=".pdf,.jpg,.jpeg,.png,.webp,.doc,.docx,application/pdf,image/*"
                       class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-kb-50 file:text-kb-100 hover:file:bg-kb-100 @error($field) border-red-500 @enderror">
                <p class="mt-1 text-xs text-gray-500">Folder: {{ $meta['folder'] }}</p>
                @error($field)
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                @if($currentUrl)
                    <p class="mt-2 text-sm text-gray-500">
                        Current:
                        <a href="{{ $currentUrl }}" target="_blank" rel="noopener" class="text-kb-100 hover:text-kb-200">View {{ $meta['label'] }}</a>
                    </p>
                @endif
            </div>
        @endforeach
    </div>
</div>
