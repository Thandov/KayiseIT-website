@extends('admin.dashboard.layout')

@section('page-title', $pageTitle ?? 'In-House Products')

@section('content')
    <div class="p-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">In-House Developed Software</h2>
                    <p class="mt-1 text-sm text-gray-600">Manage and showcase your in-house software products</p>
                </div>
                <a href="{{ route('home') }}#software" target="_blank" class="text-sm text-blue-600 hover:text-blue-700 inline-flex items-center">
                    View on Website
                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                </a>
            </div>
            
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-yellow-600 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <h3 class="text-sm font-semibold text-yellow-800 mb-1">Software Products Management</h3>
                        <p class="text-sm text-yellow-700">Toggle the switch on each product card to control whether it appears on the frontend homepage. Only products with the toggle ON will be displayed to visitors.</p>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($products as $product)
                    @php
                        $colorClasses = [
                            'green' => 'bg-green-100 text-green-600',
                            'blue' => 'bg-blue-100 text-blue-600',
                            'purple' => 'bg-purple-100 text-purple-600',
                            'indigo' => 'bg-indigo-100 text-indigo-600',
                            'teal' => 'bg-teal-100 text-teal-600',
                        ];
                        $iconColor = $colorClasses[$product->icon_color] ?? $colorClasses['green'];
                    @endphp
                    <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow relative">
                        <!-- Toggle Switch - Top Right -->
                        <div class="absolute top-4 right-4">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" 
                                       class="sr-only peer" 
                                       data-product-id="{{ $product->id }}"
                                       {{ $product->show_on_frontend ? 'checked' : '' }}
                                       onchange="toggleProduct({{ $product->id }}, this)">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                                <span class="ml-3 text-sm font-medium text-gray-700">
                                    {{ $product->show_on_frontend ? 'Visible' : 'Hidden' }}
                                </span>
                            </label>
                        </div>

                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 {{ $iconColor }} rounded-lg flex items-center justify-center mr-4">
                                @if($product->slug === 'kit-accounting')
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                @elseif($product->slug === 'qr-code-generator')
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                                    </svg>
                                @elseif($product->slug === 'asset-management')
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                @elseif($product->slug === 'project-management')
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                @elseif($product->slug === 'document-management')
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                @endif
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 text-lg">{{ $product->name }}</h3>
                                <p class="text-xs text-gray-500 capitalize">{{ str_replace('_', ' ', $product->status) }}</p>
                            </div>
                        </div>
                        <p class="text-sm text-gray-600 mb-4">{{ $product->description }}</p>
                        @if($product->status === 'available')
                            <div class="flex items-center text-xs text-gray-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Active Product
                            </div>
                        @else
                            <span class="inline-block px-3 py-1 text-xs font-medium text-orange-600 bg-orange-100 rounded-full">Coming Soon</span>
                        @endif
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500">No products found. Please run the seeder to populate products.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        function toggleProduct(productId, checkbox) {
            const isChecked = checkbox.checked;
            const label = checkbox.closest('label').querySelector('span');
            
            // Disable checkbox during request
            checkbox.disabled = true;
            
            fetch(`/dashboard/products/${productId}/toggle`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    label.textContent = data.show_on_frontend ? 'Visible' : 'Hidden';
                    // Show a brief success message
                    const card = checkbox.closest('.border');
                    const originalBorder = card.classList.contains('border-green-300') ? '' : 'border-green-300';
                    card.classList.add('border-green-300');
                    setTimeout(() => {
                        card.classList.remove('border-green-300');
                    }, 1000);
                } else {
                    // Revert checkbox on error
                    checkbox.checked = !isChecked;
                    alert('Failed to update product visibility. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                checkbox.checked = !isChecked;
                alert('An error occurred. Please try again.');
            })
            .finally(() => {
                checkbox.disabled = false;
            });
        }
    </script>
@endsection
