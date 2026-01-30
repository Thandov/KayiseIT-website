<div class="teamcard bg-white shadow-lg rounded-lg overflow-hidden">
    <a href="{{$linking}}">
        <img src="{{ asset($image) }}" alt="Employee Picture" class="w-full h-40 object-cover">
        <div class="p-4">
            <h3 class="text-xl font-semibold text-gray-800">{{ $name }} {{ $surname }}</h3>
            <p class="text-gray-600">{{ $position }}</p>
        </div>
    </a>
</div>