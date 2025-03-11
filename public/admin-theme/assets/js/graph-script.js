$(document).ready(function () {
    // Donut Charts Data
    const donutData = [
        { id: 'donutChart1', value: 81, color: '#FF8A80', label: 'Total Agent' },
        { id: 'donutChart2', value: 22, color: '#80CBC4', label: 'New Agent' },
        { id: 'donutChart3', value: 62, color: '#FFAB91', label: 'Projects Done' }
    ];

    // Create Donut Charts
    donutData.forEach(chart => {
        new Chart(document.getElementById(chart.id), {
            type: 'doughnut',
            data: {
                labels: ['Completed', 'Remaining'],
                datasets: [
                    {
                        data: [chart.value, 100 - chart.value],
                        backgroundColor: [chart.color, '#E0E0E0']
                    }
                ]
            },
            options: {
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: false }
                },
                cutout: '70%'
            }
        });
    });

    // Bar Chart
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: ['A', 'B', 'A', 'B', 'A', 'B'],
            datasets: [
                {
                    label: 'Contractor A',
                    data: [40, 60, 50, 70, 80, 90],
                    backgroundColor: '#FFA726'
                },
                {
                    label: 'Contractor B',
                    data: [60, 80, 70, 90, 100, 110],
                    backgroundColor: '#42A5F5'
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' }
            },
            scales: {
                x: { stacked: true },
                y: { beginAtZero: true }
            }
        }
    });

    // Line Chart
    new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [
                {
                    label: 'Jan - Dec',
                    data: [500, 300, 400, 600, 800, 700, 900, 600, 400, 500, 800, 1000],
                    borderColor: '#FF5252',
                    tension: 0.4,
                    fill: false
                },
                {
                    label: 'Lifts',
                    data: [400, 500, 300, 700, 500, 800, 700, 800, 600, 700, 400, 900],
                    borderColor: '#00ACC1',
                    tension: 0.4,
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                tooltip: { mode: 'index', intersect: false }
            },
            interaction: {
                mode: 'index',
                intersect: false
            },
            scales: {
                x: { beginAtZero: true },
                y: { beginAtZero: true }
            }
        }
    });
});
