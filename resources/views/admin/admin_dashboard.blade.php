<x-app-layout>
    <div x-data="{ activeTab: 'staff' }" class="flex h-screen bg-gray-200">
        <!-- Sidebar -->
        <div class="w-64 h-full px-4 py-8 bg-white border-r overflow-x-hidden overflow-y-scroll">
            <h2 class="text-3xl font-semibold text-center">Dashboard</h2>
            <div class="mt-6">
                <!-- Side navbar -->
                <nav class="grid grid-flow-row">
                    <a class="bg-blue-100 py-2 px-3" :active="activeTab === 'dashboard'" @click.prevent="activeTab = 'dashboard'" href="#">Dashboard</a>
                    <a class="bg-blue-100 py-2 px-3" :active="activeTab === 'clients'" @click.prevent="activeTab = 'clients'" href="#">Clients</a>
                    <a class="bg-blue-100 py-2 px-3" :active="activeTab === 'staff'" @click.prevent="activeTab = 'staff'" href="#">Staff</a>
                    <a class="bg-blue-100 py-2 px-3" :active="activeTab === 'gallery'" @click.prevent="activeTab = 'gallery'" href="#">Gallery</a>
                    <a class="bg-blue-100 py-2 px-3" :active="activeTab === 'carousel'" @click.prevent="activeTab = 'carousel'" href="#">Carousel</a>
                    <a class="bg-blue-100 py-2 px-3" :active="activeTab === 'services'" @click.prevent="activeTab = 'services'" href="#">Services</a>
                    <a class="bg-blue-100 py-2 px-3" :active="activeTab === 'applications'" @click.prevent="activeTab = 'applications'" href="#">Applications</a>
                    <a class="bg-blue-100 py-2 px-3" :active="activeTab === 'internships'" @click.prevent="activeTab = 'internships'" href="#">Internships</a>
                    <a class="bg-blue-100 py-2 px-3" :active="activeTab === 'invoices'" @click.prevent="activeTab = 'invoices'" href="#">Invoices</a>
                    <a class="bg-blue-100 py-2 px-3" :active="activeTab === 'quotations'" @click.prevent="activeTab = 'quotations'" href="#">Quotations</a>
                    <a class="bg-blue-100 py-2 px-3" :active="activeTab === 'careermapping'" @click.prevent="activeTab = 'careermapping'" href="#">Career Mapping</a>
                    <a class="bg-blue-100 py-2 px-3" :active="activeTab === 'blogs'" @click.prevent="activeTab = 'blogs'" href="#">Blogs</a>
                </nav>
            </div>
        </div>

        {{session('id') ?? ''}}
        <!-- Content -->
        <div class="flex-1 p-4 overflow-x-hidden overflow-y-scroll">
            <div class="h-100" x-show="activeTab === 'dashboard'">
                <h3 class="text-lg font-semibold">Dashboard Panel</h3>
                <div class="grid grid-cols-3 gap-4">
                    <div class="col-span-2">
                        @include('admin.dashboard.sales._salestats')
                    </div>
                    <div class="col-span-1">
                        <!-- Leads and Clients -->
                        @include('admin.dashboard.clients._clientspanel')
                    </div>
                </div>
                <!-- Content for Dashboard -->
            </div>
            <div class="h-100" x-show="activeTab === 'clients'">
                <!-- Content for Clients -->
                @include('admin.clients')
            </div>
            <div class="h-100" x-show="activeTab === 'staff'">
                @include('admin.staff')
            </div>
            <div class="h-100" x-show="activeTab === 'gallery'">
                <!-- Content for Gallery -->
                @include('admin.dashboard.gallery')
            </div>
            <div class="h-100" x-show="activeTab === 'carousel'">
                @include('admin.dashboard.carousel.carousel')
            </div>
            <div class="h-100" x-show="activeTab === 'services'">
                @include('admin.services')
            </div>
            <div class="h-100" x-show="activeTab === 'internships'">
                @include('admin.internships')
            </div>
            <div class="h-100" x-show="activeTab === 'applications'">
                @include('admin.applications')
            </div>
            <div class="h-100" x-show="activeTab === 'invoices'">
                @include('admin.invoices')
            </div>
            <div class="h-100" x-show="activeTab === 'quotations'">
                @include('admin.quotations')
            </div>
            <div class="h-100" x-show="activeTab === 'careermapping'">
                @include('admin.dashboard.careermapping_dashboard')
            </div>
            <div class="h-100" x-show="activeTab === 'blogs'">
                @include('admin.blogs')
            </div>
            <!-- Add other content panels here -->
        </div>
    </div>
</x-app-layout>