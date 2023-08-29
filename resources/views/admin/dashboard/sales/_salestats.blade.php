<!-- Sales Stats -->
<div class="grid grid-cols-1 md:grid-cols-1 gap-4 mt-6">
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 pt-4">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Sales Page</h3>
            <div class="grid grid-cols-1 md:grid-cols-5 justify-items-center mx-auto py-4 gap-4">
                <div class="chart-container">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const invoiceData = [{
            "date": "2023-08-01",
            "amount": 1500
        },
        {
            "date": "2023-08-05",
            "amount": 2200
        },
        {
            "date": "2023-08-10",
            "amount": 1800
        },
        {
            "date": "2023-08-15",
            "amount": 2700
        },
        {
            "date": "2023-08-20",
            "amount": 2000
        }
    ];
    const quotationData = [{
            "date": "2023-08-02",
            "amount": 3000
        },
        {
            "date": "2023-08-06",
            "amount": 2500
        },
        {
            "date": "2023-08-12",
            "amount": 3200
        },
        {
            "date": "2023-08-18",
            "amount": 2800
        },
        {
            "date": "2023-08-22",
            "amount": 3100
        }
    ];

    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: invoiceData.map(item => item.date),
            datasets: [{
                    label: 'Invoices',
                    data: invoiceData.map(item => item.amount),
                    borderColor: 'rgba(255, 99, 132, 1)',
                    fill: false
                },
                {
                    label: 'Quotations',
                    data: quotationData.map(item => item.amount),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: false
                }
            ]
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