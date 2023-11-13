<!-- resources/views/components/dashboard.blade.php -->
<x-app-layout>
    
    <div x-data="{ activeTab: 'clients' }" class="flex h-screen bg-gray-200">
        <!-- Sidebar -->
        <div class="w-64 h-full px-4 py-8 bg-white border-r">
            <h2 class="text-3xl font-semibold text-center">Dashboard</h2>
            <div class="mt-6">
                <nav>
                    <x-dash-card name="Clients" :active="activeTab === 'clients'" @click.prevent="activeTab = 'clients'" href="#"></x-dash-card>
                    <x-dash-card name="Staff" :active="activeTab === 'staff'" @click.prevent="activeTab = 'staff'" href="#"></x-dash-card>
                    <x-dash-card name="Gallery" :active="activeTab === 'gallery'" @click.prevent="activeTab = 'gallery'" href="#"></x-dash-card>
                    <x-dash-card name="Career Mapping" :active="activeTab === 'careerMapping'" @click.prevent="activeTab = 'careerMapping'" href="#"></x-dash-card>
                    <x-dash-card name="Carousel" :active="activeTab === 'carousel'" @click.prevent="activeTab = 'carousel'" href="#"></x-dash-card>
                    <x-dash-card name="Blogs" :active="activeTab === 'blogs'" @click.prevent="activeTab = 'blogs'" href="#"></x-dash-card>
                    <x-dash-card name="Services" :active="activeTab === 'services'" @click.prevent="activeTab = 'services'" href="#"></x-dash-card>
                    <x-dash-card name="Invoices" :active="activeTab === 'invoices'" @click.prevent="activeTab = 'invoices'" href="#"></x-dash-card>
                    <x-dash-card name="Quotations" :active="activeTab === 'quotations'" @click.prevent="activeTab = 'quotations'" href="#"></x-dash-card>
                </nav>
            </div>
        </div>
        <!-- Content -->
        <div class="flex-1 p-4">
            <div x-show="activeTab === 'clients'">
                <h3 class="text-lg font-semibold">Clients Panel</h3>
                <!-- Content for Clients -->
            </div>
            <div x-show="activeTab === 'staff'">
                <h3 class="text-lg font-semibold">Staff Panel</h3>
                <!-- Content for Staff -->
            </div>
            <div x-show="activeTab === 'gallery'">
                <h3 class="text-lg font-semibold">gallery Panel</h3>
                <!-- Content for gallery -->
            </div>
            <div x-show="activeTab === 'careerMapping'">
                <h3 class="text-lg font-semibold">careerMapping Panel</h3>
                <!-- Content for careerMapping -->
            </div>
            <div x-show="activeTab === 'carousel'">
                <h3 class="text-lg font-semibold">carousel Panel</h3>
                <!-- Content for carousel -->
            </div>
            <div x-show="activeTab === 'blogs'">
                <h3 class="text-lg font-semibold">blogs Panel</h3>
                <!-- Content for blogs -->
            </div>
            <div x-show="activeTab === 'services'">
                <h3 class="text-lg font-semibold">services Panel</h3>
                <!-- Content for services -->
            </div>
            <div x-show="activeTab === 'invoices'">
                <h3 class="text-lg font-semibold">invoices Panel</h3>
                <!-- Content for invoices -->
            </div>
            <div x-show="activeTab === 'quotations'">
                <h3 class="text-lg font-semibold">quotations Panel</h3>
                <!-- Content for quotations -->
            </div>
        </div>
    </div>

</x-app-layout>