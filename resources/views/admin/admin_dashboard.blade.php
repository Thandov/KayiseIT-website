<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ADMIN DASHBOARD') }}
        </h2>
    </x-slot>


    <div class="max-w-7xl mx-auto py-12 sm:px-6 lg:px-8">
    <div class="row m-2">
             <div class="col">
                 <div class="d-flex align-items-center justify-content-start">
                 <a href="admin/testimonials" class="btn btn-primary me-3">Testimonials</a>
                 </div>
             </div>
         </div>
        <div
            class="grid grid-cols-2 md:grid-cols-3 gap-1 md:gap-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <x-service-card href="admin/quotations" pic="soft1.png" servicename="Quotations" />
            <x-service-card href="admin/users" pic="web2.png" servicename="Users" />
            <x-service-card href="admin/services" pic="kit.png" servicename="Services" />

        </div>
    </div>


</x-app-layout>