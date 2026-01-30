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
                        borderColor: slightlyDarkerColor, // Line color (primary color)
                        borderWidth: 5, // Line width
                        backgroundColor: quotationGradient, // Gradient fill color with elegant fade-out for quotations
                        pointBackgroundColor: primaryColor, // Point color (primary color)
                        pointRadius: 4, // Point radius
                        pointHoverRadius: 6, // Point hover radius
                        fill: true, // Enable fill for quotations
                    }, {
                        label: 'Invoice Count',
                        data: invoiceCounts, // Number of invoices on the y-axis
                        borderColor: lighterColor, // Line color (primary color)
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