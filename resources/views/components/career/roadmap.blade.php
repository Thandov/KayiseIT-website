@props(['steps'])

<div class="relative">
    <div class="absolute left-[18px] top-2 bottom-2 w-0.5 bg-kb-100/30" aria-hidden="true"></div>
    @forelse ($steps as $index => $step)
        <x-career.step :step="$step" :open="$index === 0" />
    @empty
        <p class="text-gray-500 text-sm pl-12">Career steps for this path are being added. Check back soon or <a href="{{ route('contact') }}" class="text-kb-100 underline">contact us</a>.</p>
    @endforelse
</div>
