<!-- Sales Stats -->
<div class="grid grid-cols-1 md:grid-cols-1 gap-4 mt-6">
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 pt-4">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Sales Page</h3>
            <div class="grid grid-cols-1 md:grid-cols-5 justify-items-center mx-auto py-4 gap-4">
                <div class="chart-container">
                    <div style="width: 100%; max-width: 800px; margin: auto;">
                        <canvas id="myChart"></canvas>
                    </div>

                    <script>
                        // Get the canvas element
                        var ctx = document.getElementById('myChart').getContext('2d');

                        // Create the chart
                        var myChart = new Chart(ctx, {
                            type: 'bar', // Specify the chart type (e.g., 'bar', 'line', 'pie', etc.)
                            data: {
                                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                                datasets: [{
                                    label: '# of Votes',
                                    data: [12, 19, 3, 5, 2, 3],
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(255, 159, 64, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>