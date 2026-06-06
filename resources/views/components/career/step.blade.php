@props(['step', 'open' => false])

<div class="relative pl-12 pb-8 last:pb-0" data-aos="fade-up">
    <span class="absolute left-0 top-0 flex h-9 w-9 items-center justify-center rounded-full bg-kb-100 text-white text-sm font-bold ring-4 ring-white shadow">
        {{ $step->step_number }}
    </span>
    <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden"
         x-data="{ open: {{ $open ? 'true' : 'false' }} }">
        <button type="button"
                @click="open = !open"
                class="w-full text-left px-5 py-4 flex items-center justify-between gap-3 min-h-[44px]">
            <div>
                <h4 class="font-bold text-kb-700">{{ $step->displayTitle() }}</h4>
                @if ($step->duration || $step->nqf_level)
                    <p class="text-xs text-gray-500 mt-1">
                        @if ($step->duration){{ $step->duration }}@endif
                        @if ($step->duration && $step->nqf_level) · @endif
                        @if ($step->nqf_level)NQF {{ $step->nqf_level }}@endif
                    </p>
                @endif
            </div>
            <svg class="w-5 h-5 text-kb-100 shrink-0 transition-transform" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </button>
        <div x-show="open" x-transition class="px-5 pb-5 border-t border-gray-100">
            @if ($step->summary)
                <p class="text-sm text-gray-600 mt-3">{{ $step->summary }}</p>
            @endif
            @if ($step->typical_cost)
                <p class="text-sm mt-2"><span class="font-semibold text-kb-700">Typical cost:</span> {{ $step->typical_cost }}</p>
            @endif
            @if ($step->prerequisites && count($step->prerequisites))
                <p class="text-sm mt-2"><span class="font-semibold text-kb-700">You need:</span> {{ implode(', ', $step->prerequisites) }}</p>
            @endif
            @if ($step->next_action)
                <p class="text-sm mt-3 p-3 rounded-lg bg-kg-50 text-kg-800 font-medium">{{ $step->next_action }}</p>
            @endif
            <x-career.register-cta :step="$step" />
        </div>
    </div>
</div>
