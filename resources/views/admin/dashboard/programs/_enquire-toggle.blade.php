<div class="rounded border border-sky-200 bg-sky-50/60 px-2 py-2" x-data="{ open: false }">
    <div class="flex items-center justify-between gap-2">
        <label class="flex items-center gap-2 cursor-pointer min-w-0">
            <input type="checkbox" name="allows_enquiry" value="1"
                   {{ old('allows_enquiry', $program->allows_enquiry ?? false) ? 'checked' : '' }}
                   class="rounded border-gray-300 text-kb-600 focus:ring-kb-500 shrink-0">
            <span class="text-xs font-medium text-gray-900 truncate">Enquire mode</span>
            <span class="text-[11px] text-gray-500 hidden sm:inline truncate">— interest only, not officially running</span>
        </label>
        <button type="button" @click="open = !open" class="text-[11px] text-sky-700 hover:underline shrink-0">
            <span x-text="open ? 'Hide' : 'Info'"></span>
        </button>
    </div>
    <p x-show="open" x-cloak class="text-[11px] text-gray-600 mt-2 leading-snug">
        <strong class="text-sky-800">On:</strong> shown on
        <a href="{{ route('programs') }}" target="_blank" class="text-kb-600 underline">/programs</a> for interest registration.
        <strong class="text-emerald-800 ml-1">Off:</strong> live programme; learners apply via Opportunities.
    </p>
</div>
