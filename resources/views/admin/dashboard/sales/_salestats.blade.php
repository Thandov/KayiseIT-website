<!-- Sales Stats -->
<div class="grid grid-cols-1 md:grid-cols-1 gap-4 mt-6">
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 pt-4">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Sales Page</h3>
            <div class="">

            </div>
        </div>
        <div class="chart-container">
            <div class="graphicing" style="min-height: 200px;">
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

                const myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: months,
                        datasets: [{
                            label: 'Quotation Count',
                            data: quotationCounts,
                            borderColor: slightlyDarkerColor,
                            borderWidth: 3,
                            backgroundColor: 'rgba(34, 197, 94, 0.12)',
                            pointBackgroundColor: primaryColor,
                            pointRadius: 0,
                            pointHoverRadius: 6,
                            fill: true,
                        }, {
                            label: 'Invoice Count',
                            data: invoiceCounts,
                            borderColor: lighterColor,
                            borderWidth: 3,
                            backgroundColor: 'rgba(24, 62, 164, 0.10)',
                            pointBackgroundColor: primaryColor,
                            pointRadius: 0,
                            pointHoverRadius: 6,
                            fill: true,
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: false,
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
        </div>
    </div>
</div>