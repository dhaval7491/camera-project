const lineCtx = document.getElementById('lineChart').getContext('2d');
const barCtx = document.getElementById('barChart').getContext('2d');

// Line Chart Data and Options
const lineData = {
  labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
  datasets: [
    {
      label: 'This Week',
      data: [0, 10, 20, 150, 100, 50, 100, 200, 60, 100, 70, 50],
      borderColor: 'rgba(54, 162, 235, 1)',
      backgroundColor: 'rgba(54, 162, 235, 0.1)',
      tension: 0.4,
      pointBorderColor: 'rgba(54, 162, 235, 1)',
      pointBackgroundColor: '#fff',
      pointBorderWidth: 2,
      pointRadius: 5,
    },
    {
      label: 'Last Week',
      data: [10, 100, 20, 150, 30, 20, 100, 30, 50, 100, 10, 30],
      borderColor: 'rgba(255, 99, 132, 1)',
      backgroundColor: 'rgba(255, 99, 132, 0.1)',
      tension: 0.4,
      pointBorderColor: 'rgba(255, 99, 132, 1)',
      pointBackgroundColor: '#fff',
      pointBorderWidth: 2,
      pointRadius: 5,
    },
  ],
};

const lineOptions = {
  responsive: true,
  plugins: {
    legend: { display: true, position: 'top' },
    tooltip: { enabled: true },
  },
  scales: {
    x: { grid: { display: false } },
    y: {
      beginAtZero: true,
      grid: { drawBorder: false },
      ticks: {
        stepSize: 50, // Adjust this value for smaller or larger steps
        lineHeight: 1,
      },
    },
  },
};

const barData = {
  labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
  datasets: [
    {
      label: 'Trackable A',
      data: [20, 40, 30, 70, 50, 80, 25, 60, 35, 50, 90, 100],
      backgroundColor: 'rgba(54, 162, 235, 0.8)',
      borderRadius: 10,
    },
    {
      label: 'Trackable B',
      data: [50, 60, 70, 40, 80, 60, 45, 30, 55, 70, 30, 60],
      backgroundColor: 'rgba(255, 159, 64, 0.8)',
      borderRadius: 10,
    },
  ],
};

const barOptions = {
  responsive: true,
  plugins: {
    legend: { display: true, position: 'top' },
    tooltip: { enabled: true },
  },
  scales: {
    x: { grid: { display: false } },
    y: { beginAtZero: true, grid: { drawBorder: false } },
  },
};

// Initialize Line Chart
const lineChart = new Chart(lineCtx, {
  type: 'line',
  data: lineData,
  options: lineOptions,
});

// Initialize Bar Chart
const barChart = new Chart(barCtx, {
  type: 'bar',
  data: barData,
  options: barOptions,
});
