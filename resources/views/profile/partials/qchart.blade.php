        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="px-4 pt-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Quotations</h3>
            </div>
            <input type="hidden" name="data-chartquotations" id="data-chartquotations" value="{{ json_encode($quotations) }}">
            <div class="graphicing" style="">
                <canvas id="qChart"></canvas>
            </div>
        </div>
        <script>
            const chartquotations = JSON.parse(document.getElementById('data-chartquotations').value);

            // Create an array of all month names
            const allMonths = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

            // Initialize objects to store the counts for each month
            const monthlyQuotationCounts = {};

            // Loop through the quotation data and count chartquotations for each month
            chartquotations.forEach(item => {
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

            // Create arrays for months and counts, ensuring all months are included
            const months = allMonths; // Include all months
            const quotationCounts = allMonths.map(month => monthlyQuotationCounts[month] || 0);

            // Create a canvas element to display the chart
            const ctx = document.getElementById('qChart').getContext('2d');
            const canvas = document.getElementById('qChart');

            // Define the primary color (#22c55e)
            const primaryColor = '#22c55e';

            // Create a slightly darker shade of the primary color
            const slightlyDarkerColor = '#1c9a4c';

            // Create gradients for the fill colors with an elegant fade-out effect
            const quotationGradient = ctx.createLinearGradient(0, 0, 0, 400);
            quotationGradient.addColorStop(0, primaryColor); // Primary color at the top
            quotationGradient.addColorStop(1, 'rgba(255, 255, 255, 0.4)'); // Transparent color at the bottom

            // Create the chart with fill: true and gradient fill
            const qChart = new Chart(ctx, {
                type: 'line', // Use a line chart for monthly counts
                data: {
                    labels: months, // Month names on the x-axis
                    datasets: [{
                        label: 'Quotation Count',
                        data: quotationCounts, // Number of quotations on the y-axis
                        borderColor: slightlyDarkerColor, // Line color (primary color)
                        borderWidth: 2, // Line width
                        backgroundColor: quotationGradient, // Gradient fill color with elegant fade-out for quotations
                        pointBackgroundColor: primaryColor, // Point color (primary color)
                        pointRadius: 0, // Point radius
                        pointHoverRadius: 5, // Point hover radius
                        fill: true, // Enable fill for quotations
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false, // Hide the legend
                        },
                    },
                    scales: {
                        x: {
                            display: false, // Hide x-axis labels and grid lines
                        },
                        y: {
                            display: false, // Hide y-axis labels and grid lines
                        },
                    },
                    elements: {
                        line: {
                            tension: 0.4,
                        },
                    },
                }

            });

            // Create a tooltip element
            const tooltip = document.createElement('div');
            tooltip.classList.add('chart-tooltip');
            document.body.appendChild(tooltip);

            // Add event listeners to the canvas element
            canvas.addEventListener('mouseover', showTooltip);
            canvas.addEventListener('mousemove', updateTooltip);
            canvas.addEventListener('mouseout', hideTooltip);

            // Function to display the tooltip
            function showTooltip(event) {
                tooltip.style.display = 'block';
                updateTooltip(event);
            }

            // Function to update the tooltip's content and position
            function updateTooltip(event) {
                const {
                    clientX,
                    clientY
                } = event;
                const chartArea = canvas.getBoundingClientRect();
                const offsetX = clientX - chartArea.left;
                const offsetY = clientY - chartArea.top;

                // You can update the tooltip content here based on cursor position or chart data
                // For example, you can display the corresponding data point's value.

                tooltip.style.left = `${offsetX}px`;
                tooltip.style.top = `${offsetY}px`;
            }

            // Function to hide the tooltip
            function hideTooltip() {
                tooltip.style.display = 'none';
            }
        </script>