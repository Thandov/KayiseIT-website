@props([
    'title' => 'Page Title',
    'subtitle' => null,
    'description' => null,
    'backgroundImage' => null,
    'heroId' => 'default-hero',
    'overlay' => true,
    'height' => 'h-96',
    'textColor' => 'text-white'
])

<div class="relative {{ $height }} bg-cover bg-center bg-no-repeat" 
     style="background-image: @if($overlay) linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), @endif url('{{ $backgroundImage ? asset($backgroundImage) : asset('images/landing-page/banner3.png') }}');"
     id="{{ $heroId }}">
    
    <!-- Content Container -->
    <div class="absolute inset-0 flex items-center justify-center">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-4xl mx-auto">
                
                <!-- Main Title -->
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold {{ $textColor }} mb-4 drop-shadow-lg">
                    {{ $title }}
                </h1>
                
                <!-- Subtitle (optional) -->
                @if($subtitle)
                    <p class="text-lg md:text-xl {{ $textColor === 'text-white' ? 'text-blue-100' : 'text-gray-600' }} mb-4 drop-shadow-md">
                        {{ $subtitle }}
                    </p>
                @endif
                
                <!-- Description (optional) -->
                @if($description)
                    <p class="text-base md:text-lg {{ $textColor === 'text-white' ? 'text-blue-200' : 'text-gray-500' }} max-w-3xl mx-auto drop-shadow-sm">
                        {{ $description }}
                    </p>
                @endif
                
                <!-- Slot for additional content like buttons -->
                @if($slot->isNotEmpty())
                    <div class="mt-8">
                        {{ $slot }}
                    </div>
                @endif
                
            </div>
        </div>
    </div>
</div>

