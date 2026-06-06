@props(['subjects' => null])

@php
    $list = $subjects && count($subjects) ? $subjects : null;
@endphp

@if ($list)
<div class="bg-kb-50 rounded-2xl p-5" data-aos="fade-right">
    <h3 class="font-bold text-kb-700 mb-3">Subjects you need at school</h3>
    <ul class="flex flex-wrap gap-2">
        @foreach ($list as $subject)
            <li class="px-3 py-2 rounded-full bg-white text-sm text-kb-700 border border-kb-100/30 shadow-sm">
                {{ $subject }}
            </li>
        @endforeach
    </ul>
</motion>
@endif
