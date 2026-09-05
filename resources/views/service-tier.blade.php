<x-app-layout>
    @section('meta')
        <title>{{ $serviceTier->page?->meta_title ?? $serviceTier->page?->hero_heading ?? $service->name }}</title>
        @if($serviceTier->page?->meta_description)
            <meta name="description" content="{{ e($serviceTier->page->meta_description) }}">
        @endif
    @endsection

    @php
        $slug = \Illuminate\Support\Str::slug($services['service']);
        $componentNameSubfolder = 'components.services.' . $slug;
        $componentNameFlat = 'components.' . $slug;
        $componentName = view()->exists($componentNameSubfolder) ? $componentNameSubfolder : $componentNameFlat;
        $componentExists = view()->exists($componentName);
    @endphp

    <div id="service-tier" class="pb-12">
        <x-page-header
            :title="$serviceTier->page?->hero_heading ?? $service->name"
            hero-id="service-hero"
            background-image="images/banner/softwareDeveloper.png"
            height="h-96" />

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 relative z-10">
            <nav class="flex flex-wrap gap-2 mb-6" aria-label="Business size">
                @foreach(['small' => 'Small', 'medium' => 'Medium', 'enterprise' => 'Enterprise'] as $tk => $label)
                    <a href="{{ route('service.show.tier', ['slug' => $publicSlug, 'tier' => $tk]) }}"
                       class="inline-flex items-center rounded-full px-4 py-2 text-sm font-medium border transition
                       {{ $tierKey === $tk ? 'bg-kb-600 text-white border-kb-600' : 'bg-white text-gray-700 border-gray-200 hover:border-kb-500' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </nav>

            @if($serviceTier->page?->hero_subheading)
                <p class="text-lg text-gray-600 mb-6">{{ $serviceTier->page->hero_subheading }}</p>
            @endif

            @if($serviceTier->page?->body)
                <div class="prose prose-sm max-w-none text-gray-700 mb-10">
                    {!! nl2br(e($serviceTier->page->body)) !!}
                </div>
            @endif

            <div id="pricing" class="rounded-2xl border border-gray-200 bg-white shadow-sm p-6 mb-10">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Pricing</h2>

                @if($serviceTier->pricing_mode === \App\Models\ServiceTier::MODE_FIXED && $serviceTier->tierPrice)
                    <p class="text-2xl font-bold text-kb-600">R {{ number_format((float) $serviceTier->tierPrice->amount, 2) }}</p>
                    <p class="text-sm text-gray-500 mt-1">Fixed price for small business.</p>
                @elseif($serviceTier->pricing_mode === \App\Models\ServiceTier::MODE_PACKAGES)
                    @if($serviceTier->packages->isNotEmpty())
                        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 mb-6">
                            @foreach($serviceTier->packages as $package)
                                <div class="rounded-xl border border-gray-100 p-4 flex flex-col">
                                    <h3 class="font-semibold text-gray-900">{{ $package->name }}</h3>
                                    <p class="text-2xl font-bold text-kb-600 mt-2">R {{ number_format((float) $package->price, 2) }}</p>
                                    @if($package->description)
                                        <p class="text-sm text-gray-600 mt-2 flex-1">{{ $package->description }}</p>
                                    @endif
                                    @if($package->features->isNotEmpty())
                                        <ul class="mt-3 text-sm text-gray-600 list-disc list-inside space-y-1">
                                            @foreach($package->features as $f)
                                                <li>{{ $f->feature }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @if($serviceTier->addons->isNotEmpty())
                        <h3 class="text-sm font-semibold text-gray-800 mb-2">Add-ons</h3>
                        <ul class="divide-y divide-gray-100 border border-gray-100 rounded-lg overflow-hidden">
                            @foreach($serviceTier->addons as $addon)
                                <li class="flex items-center justify-between px-4 py-3 text-sm">
                                    <span>
                                        {{ $addon->name }}
                                        @if($addon->pricing_type === \App\Models\ServiceAddon::PRICING_QUANTITY && $addon->unit_label)
                                            <span class="text-gray-500">({{ $addon->unit_label }})</span>
                                        @endif
                                    </span>
                                    <span class="font-medium text-gray-900">R {{ number_format((float) $addon->price, 2) }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                @elseif($serviceTier->pricing_mode === \App\Models\ServiceTier::MODE_QUOTE)
                    <p class="text-gray-700">Enterprise engagements are scoped per tender. Request a tailored quote for your organisation.</p>
                @endif

                @if($serviceTier->page?->primary_cta_label && $serviceTier->page?->primary_cta_href)
                    <a href="{{ $serviceTier->page->primary_cta_href }}"
                       class="mt-6 inline-flex items-center justify-center rounded-lg bg-kb-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-kb-500">
                        {{ $serviceTier->page->primary_cta_label }}
                    </a>
                @endif
            </div>

            @if($componentExists)
                @component($componentName)
                    @slot('service', $services['service'])
                    @slot('subservices', $services['subservices'])
                @endcomponent
            @else
                <div class="container grid sm:grid-flow-row md:grid-cols-1 pb-4">
                    <div class="px-0 mt-4">
                        <x-titlestyle smheading="Explore" bgheading="Sub-services" alignment="text-left" smheadingcolor="" bgheadingcolor=""></x-titlestyle>
                        <div class="grid sm:grid-cols-1 md:grid-cols-4 gap-4 my-4">
                            @foreach($services['subservices'] ?? [] as $subservice)
                                @php
                                    $subslug = str_replace(' ','-', strtolower($subservice['subservice_name'] ?? ''));
                                    $uniqueId = 'subserv_card_'.$subslug;
                                @endphp
                                <div class="subserv_card justify-center" id="{{ $uniqueId }}">
                                    <div class="overflow-hidden shadow-md rounded-lg p-4">
                                        <div class="flex justify-center">
                                            <div class="h-16 w-16 rounded-md bg-green-500 flex items-center justify-center">
                                                @if(isset($subservice['icon']))
                                                    <img class="w-12" src="{{ asset('images/subservices/'.$subservice['icon']) }}" alt="">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex justify-center">
                                            <h2 class="mt-4 text-xl text-center font-bold smalltxt">{{ $subservice['subservice_name'] ?? 'Subservice' }}</h2>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
