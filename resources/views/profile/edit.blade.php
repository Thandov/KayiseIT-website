<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <div class="px-4 mt-4 max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 gap-4 my-4">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 pt-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Action Page</h3>
                    <div class="grid grid-cols-2 md:grid-cols-5 justify-items-center mx-auto py-4 gap-4">
                        @if(Auth::user()->hasRole('applicant'))
                        <x-dash-card name="Applications" href="#applications-tab"></x-dash-card>
                        <x-dash-card name="Settings" href="#settings-tab"></x-dash-card>
                        @else
                        <x-dash-card name="Projects" href="#projects-tab"></x-dash-card>
                        <x-dash-card name="Invoices" href="#invoices-tab"></x-dash-card>
                        <x-dash-card name="Quotations" href="#quotations-tab"></x-dash-card>
                        <x-dash-card name="Settings" href="#settings-tab"></x-dash-card>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="panelling bbg-white overflow-hidden shadow rounded-lg mb-4" style="min-height: 200px;">
            <!-- Tab panels -->
            @if(Auth::user()->hasRole('applicant'))
            <div id="applications-tab" class="panel show">
                <!-- Content for Applications tab -->
                <div class="p-5">
                    <h3 class="fw-bold panel-tit">Applications</h3>
                </div>
                @include('profile.partials.application')
            </div>
            <div id="settings-tab" class="panel hidden">
                <!-- Content for Settings tab -->
                <div class="p-5">
                    <h3 class="fw-bold panel-tit">Settings</h3>
                </div>
                @include('profile.partials.settings')
            </div>
            @else
            <div id="projects-tab" class="panel hidden">
                <!-- Content for Projects tab -->
                <div class="p-5">
                    <h3 class="fw-bold panel-tit">Projects</h3>
                </div>
            </div>
            <div id="career-tab" class="panel hidden">
                <!-- Content for Career Mapping tab -->
                <div class="p-5">
                    <h3 class="fw-bold panel-tit">Career Guide</h3>
                </div>
            </div>
            <div id="services-tab" class="panel hidden">
                <!-- Content for Services tab -->
                <div class="p-5">
                    <h3 class="fw-bold panel-tit">Services</h3>
                </div>
            </div>
            <div id="invoices-tab" class="panel hidden">
                <!-- Content for Invoices tab -->
                <div class="p-5">
                    <h3 class="fw-bold panel-tit">Invoices</h3>
                </div>
            </div>
            <div id="quotations-tab" class="panel hidden">
                <!-- Content for Quotations tab -->
                <div class="p-5">
                    <h3 class="fw-bold panel-tit">Quotations</h3>
                </div>
                @include('profile.partials.quotations')
            </div>
            <div id="settings-tab" class="panel hidden">
                <!-- Content for Settings tab -->
                <div class="p-5">
                    <h3 class="fw-bold panel-tit">Settings</h3>
                </div>
                @include('profile.partials.settings')
            </div>
            @endif
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Add 'click' event listeners to .dashcard elements
                const dashCards = document.querySelectorAll(".dashcard");
                dashCards.forEach((card) => {
                    card.addEventListener("click", (event) => {
                        event.preventDefault();

                        // Hide all tab panels
                        const panels = document.querySelectorAll(".panel");
                        panels.forEach((panel) => {
                            panel.classList.add("hidden");
                        });

                        // Get the target tab panel ID from the href attribute
                        const targetPanelId = card.getAttribute("href").substring(1);

                        // Show the selected tab panel
                        const targetPanel = document.getElementById(targetPanelId);
                        if (targetPanel) {
                            targetPanel.classList.remove("hidden");
                        }
                    });
                });
            });
        </script>
    </div>
</x-app-layout>