<div class="md:col-span-2 rounded-lg border border-sky-200 bg-sky-50/50 p-4">
    <label class="flex items-start gap-3 cursor-pointer">
        <input type="checkbox" name="allows_enquiry" value="1"
               {{ old('allows_enquiry', $program->allows_enquiry ?? false) ? 'checked' : '' }}
               class="mt-1 rounded border-gray-300 text-kb-600 focus:ring-kb-500">
        <span>
            <span class="block text-sm font-semibold text-gray-900">Enquire toggle</span>
            <span class="block text-sm text-gray-600 mt-2 space-y-2">
                <span class="block">
                    <strong class="text-sky-800">On — collecting data (not started):</strong>
                    Programme is <em>not</em> officially running. It appears on
                    <a href="{{ route('programs') }}" target="_blank" class="text-kb-600 underline">kayiseit.com/programs</a>
                    for interest registration only. KAYISE IT cannot promise placement, dates, or outcomes until launch.
                </span>
                <span class="block">
                    <strong class="text-emerald-800">Off — programme active:</strong>
                    Programme is officially running. It appears as a live programme on the public page; learners may apply via Opportunities where relevant.
                </span>
            </span>
        </span>
    </label>
</div>
