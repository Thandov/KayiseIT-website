<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="graphicing bg-slate-100" style="min-height: 200px;">
            <canvas id="myChart"></canvas>
        </div>
        <input type="hidden" name="data-quotations" id="data-quotations" value="{{ json_encode($quotations) }}">
        <input type="hidden" name="data-invoices" id="data-invoices" value="{{ json_encode($invoices) }}">
        <script>
            const quotations = JSON.parse(document.getElementById('data-quotations').value);
            const invoices = JSON.parse(document.getElementById('data-invoices').value);

            // Create an array of all month names
            const allMonths = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

            // Initialize objects to store the counts for each month
            const monthlyQuotationCounts = {};
            const monthlyInvoiceCounts = {};

            // Loop through the quotation data and count quotations for each month
            quotations.forEach(item => {
                const date = new Date(item.created_at);
                const month = date.toLocaleString('default', {
                    month: 'long'
                }); // Get month name

                if (!monthlyQuotationCounts[month]) {
                    monthlyQuotationCounts[month] = 1;
                } else {
                    monthlyQuotationCounts[month]++;
                }
            });

            // Loop through the invoice data and count invoices for each month
            invoices.forEach(item => {
                const date = new Date(item.created_at);
                const month = date.toLocaleString('default', {
                    month: 'long'
                }); // Get month name

                if (!monthlyInvoiceCounts[month]) {
                    monthlyInvoiceCounts[month] = 1;
                } else {
                    monthlyInvoiceCounts[month]++;
                }
            });

            // Create arrays for months and counts, ensuring all months are included
            const months = allMonths; // Include all months
            const quotationCounts = allMonths.map(month => monthlyQuotationCounts[month] || 0);
            const invoiceCounts = allMonths.map(month => monthlyInvoiceCounts[month] || 0);

            // Create a canvas element to display the chart
            const ctx = document.getElementById('myChart').getContext('2d');

            // Define the primary color (#22c55e)
            const primaryColor = '#22c55e';

            // Create a lighter shade of the primary color
            const lighterColor = '#56e98e';

            // Create a slightly darker shade of the primary color
            const slightlyDarkerColor = '#1c9a4c';

            // Create gradients for the fill colors with an elegant fade-out effect
            const quotationGradient = ctx.createLinearGradient(0, 0, 0, 400);
            quotationGradient.addColorStop(0, primaryColor); // Primary color at the top
            quotationGradient.addColorStop(1, 'rgba(255, 255, 255, 0.4)'); // Transparent color at the bottom

            const invoiceGradient = ctx.createLinearGradient(0, 0, 0, 400);
            invoiceGradient.addColorStop(0, primaryColor); // Primary color at the top
            invoiceGradient.addColorStop(1, 'rgba(255, 255, 255, 0)'); // Transparent color at the bottom

            // Create the chart with fill: true and gradient fill
            const myChart = new Chart(ctx, {
                type: 'line', // Use a line chart for monthly counts
                data: {
                    labels: months, // Month names on the x-axis
                    datasets: [{
                        label: 'Quotation Count',
                        data: quotationCounts, // Number of quotations on the y-axis
                        borderColor: "blue", // Line color (primary color)
                        borderWidth: 5, // Line width
                        backgroundColor: quotationGradient, // Gradient fill color with elegant fade-out for quotations
                        pointBackgroundColor: primaryColor, // Point color (primary color)
                        pointRadius: 4, // Point radius
                        pointHoverRadius: 6, // Point hover radius
                        fill: true, // Enable fill for quotations
                    }, {
                        label: 'Invoice Count',
                        data: invoiceCounts, // Number of invoices on the y-axis
                        borderColor: slightlyDarkerColor, // Line color (primary color)
                        borderWidth: 5, // Line width
                        backgroundColor: invoiceGradient, // Gradient fill color with elegant fade-out for invoices
                        pointBackgroundColor: primaryColor, // Point color (primary color)
                        pointRadius: 4, // Point radius
                        pointHoverRadius: 6, // Point hover radius
                        fill: true, // Enable fill for invoices
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Count'
                            },
                            ticks: {
                                precision: 0
                            }
                        }
                    },
                    elements: {
                        line: {
                            tension: 0.4,
                        }
                    }
                }
            });
        </script>


        <div class="grid grid-cols-1 md:grid-cols-1 gap-4 my-4">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 pt-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Action Page</h3>
                    <div class="grid grid-cols-1 md:grid-cols-5 justify-items-center mx-auto py-4 gap-4">
                        <!-- <x-dash-card name="Career Mapping" href="#career-tab"></x-dash-card>
                        <x-dash-card name="Services" href="#services-tab"></x-dash-card> -->
                        <x-dash-card name="Invoices" href="#invoices-tab"></x-dash-card>
                        <x-dash-card name="Quotations" href="#quotations-tab"></x-dash-card>
                        <x-dash-card name="Settings" href="#settings-tab"></x-dash-card>
                    </div>
                </div>
            </div>
        </div>

        <div class="panelling bg-slate-100" style="min-height: 200px;">
            <!-- Tab panels -->
            <div id="career-tab" class="panel hidden">afds
                <!-- Content for Career Mapping tab -->
            </div>
            <div id="services-tab" class="panel hidden">2345
                <!-- Content for Services tab -->
            </div>
            <div id="invoices-tab" class="panel hidden">dsfgh5
                <!-- Content for Invoices tab -->
            </div>
            <div id="quotations-tab" class="panel hidden">
                <!-- Content for Quotations tab -->
                @include('profile.partials.quotations')
            </div>
            <div id="settings-tab" class="panel hidden">
                <!-- Content for settings tab -->
                @include('profile.partials.settings')
            </div>
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