<x-app-layout title="Home">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="jumbotron bg-gray-400 bg-gradient position-relative">
        <img src="/images/logo.png" alt="logo" srcset="/images/logo.png" class="landinglogo animate__animated animate__fadeInUp">
        <div class="owl-carousel owl-theme" id="headercara">
            <x-carousel-item pic="../images/carousel/banner1.png" topTitle="Aaaa" mainTitle="asasA" bottomTitle="dddd" />
            <x-carousel-item pic="../images/carousel/banner2.png" topTitle="We specialize" mainTitle="Commercial Cleaning" bottomTitle="dddd" />
            <x-carousel-item pic="../images/carousel/banner3.png" topTitle="We specialize" mainTitle="Event Cleaning" bottomTitle="asd" />
        </div>
    </div>
    <div class="max-w-7xl mx-auto py-12 sm:px-6 lg:px-8">
        <h2 class="text-center font-bold text-2xl md:text-3xl">Kayise IT Services</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-1 md:gap-4 max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-service-card href="services/software" pic="soft1.png" servicename="Software Development" />
            <x-service-card href="services/website" pic="web2.png" servicename="Website Development" />
            <x-service-card href="services/kit" pic="kit.png" servicename="KIT Invoicing Software" />
        </div>
    </div>
</x-app-layout>