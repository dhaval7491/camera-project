@extends('layouts.app')

@section('content')
<div class="analytics-container pb-[30px]">
    <!-- Donut Charts -->
    <div class="flex flex-wrap">
        <div class="lg:w-2/6 md:w-3/6 w-full pl-[10px] pr-[10px]">
            <div class="analytics-circle-chart  h-[340px]">
                <h3 class="manrope-semibold text-[20px] text-[#374557]">Utilization</h3>
                <div class="flex justify-between mt-[40px]">
                    <div class="pt-[30px] w-[150px] h-[150px] bg-[#FFF6F6] text-center">
                        <p class="text-[#84818A] manrope-medium text-[14px] mb-[20px]">Lifting</p>
                        <h4 class="manrope-semibold text-[20px] text-[#344563]">50 Hours</h4>
                    </div>
                    <div class="pt-[30px] w-[150px] h-[150px] bg-[#F2FFF4] text-center">
                        <p class="text-[#84818A] manrope-medium text-[14px] mb-[20px]">Waiting Time</p>
                        <h4 class="manrope-semibold text-[20px] text-[#344563]">25 Hours</h4>
                    </div>
                    <div class="pt-[30px] w-[150px] h-[150px] bg-[#F5F9FF] text-center">
                        <p class="text-[#84818A] manrope-medium text-[14px] mb-[20px]">Idle</p>
                        <h4 class="manrope-semibold text-[20px] text-[#344563]">10 Hours</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:w-4/6 md:w-4/6 w-full pl-[10px] pr-[10px]">
            <div class="analytics-bar-chart">
                <div class="flex justify-between">
                    <h3 class="manrope-semibold text-[20px] text-[#374557]">Trackable Usage</h3>
                    <select class="border-none focus-visible:ring-0 px-[15px] manrope-medium text-[14px] focus-visible:outline-none tab-shadow rounded-[5px]">
                        <option>2025</option>
                        <option>2024</option>
                        <option>2023</option>
                        <option>2022</option>
                    </select>
                </div>
                <canvas id="barChart" style="width: 100%; height: 250px;"></canvas>
            </div>
        </div>
    </div>
    <div class="flex flex-wrap">
        <div class="lg:w-6/6 md:w-6/6 w-full pl-[10px] pr-[10px] pt-[40px]">
            <div class="chart-container p-[20px] chart-shadow rounded-[10px]">
                <div class="chart-header">
                    <h4 class="manrope-medium text-[16px] text-black">Number of Lifts</h4>
                </div>
                <canvas id="lineChart" style="width: 100%; height: 300px;"></canvas>
            </div>
        </div>
    </div>


    <!-- Bar Chart -->


    <!-- Line Chart -->

</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        // Donut Charts Data
        const donutData = [{
                id: 'donutChart1',
                value: 81,
                color: '#FF8A80',
                label: 'Total Agent'
            },
            {
                id: 'donutChart2',
                value: 22,
                color: '#80CBC4',
                label: 'New Agent'
            },
            {
                id: 'donutChart3',
                value: 62,
                color: '#FFAB91',
                label: 'Projects Done'
            }
        ];

        // Create Donut Charts
        donutData.forEach(chart => {
            new Chart(document.getElementById(chart.id), {
                type: 'doughnut',
                data: {
                    labels: ['Completed', 'Remaining'],
                    datasets: [{
                        data: [chart.value, 100 - chart.value],
                        backgroundColor: [chart.color, '#E0E0E0'],
                        borderRadius: 10 // Adds rounded edges to segments
                    }]
                },
                options: {
                    responsive: false, // Disable automatic resizing
                    animation: false, // Disable animation
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            enabled: false
                        }
                    },
                    cutout: '70%', // Inner cutout size
                }
            });
        });

        // Bar Chart
        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: ['A', 'B', 'A', 'B', 'A', 'B'],
                datasets: [{
                        label: 'Trackable A', // Updated from 'Category A'
                        data: [40, 60, 50, 70, 80, 90],
                        backgroundColor: '#FFA726'
                    },
                    {
                        label: 'Trackable B', // Updated from 'Category B'
                        data: [60, 80, 70, 90, 100, 110],
                        backgroundColor: '#42A5F5'
                    }
                ]
            },
            options: {
                responsive: true,
                animation: false,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                },
                scales: {
                    x: {
                        stacked: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Line Chart
        new Chart(document.getElementById('lineChart'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                        label: 'This Week',
                        data: [500, 300, 400, 600, 800, 700, 900, 600, 400, 500, 800, 1000],
                        borderColor: '#FF5252',
                        tension: 0.4,
                        fill: false
                    },
                    {
                        label: 'Last Week',
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
                    legend: {
                        position: 'top'
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        const sidepanel = $("#mySidepanel");
        const openButton = $("#openButton");

        function openNav() {
            sidepanel.css("width", "80px");
            openButton.html('<i class="fas fa-times"></i>'); // Change to close icon
            $(document).on("click", closeOnClickOutside);
        }

        function closeNav() {
            sidepanel.css("width", "0");
            openButton.html('<i class="fas fa-bars"></i>'); // Change back to open icon
            $(document).off("click", closeOnClickOutside);
        }

        function closeOnClickOutside(event) {
            if (!sidepanel.is(event.target) && sidepanel.has(event.target).length === 0 && !openButton.is(event.target)) {
                closeNav();
            }
        }
        openButton.on("click", function(event) {
            event.stopPropagation(); // Prevent click from propagating to document
            if (sidepanel.css("width") === "80px") {
                closeNav();
            } else {
                openNav();
            }
        });
        sidepanel.on("click", function(event) {
            event.stopPropagation(); // Prevent click inside the sidebar from closing it
        });
    });
</script>
<!------------------------- responsive sidebar collapse end ------------------>
<!--------------------- Sidebar Hover effect --------------------------->
<script>
    $(document).ready(function() {
        $(".sidebar li").each(function() {
            const img = $(this).find("img");
            const originalSrc = img.attr("src");
            const hoverSrc = originalSrc.replace(".png", "-green.png");

            $(this).on("mouseenter", function() {
                img.attr("src", hoverSrc);
            });

            $(this).on("mouseleave", function() {
                if (!$(this).hasClass("active")) {

                    img.attr("src", originalSrc);
                }
            });
        });

        // Add active class dynamically
        const currentPage = window.location.pathname.split("/").pop();

        $(".sidebar li a").each(function() {
            if ($(this).attr("href") === currentPage) {
                const parentLi = $(this).parent();

                // Add active styles
                parentLi.addClass("bg-[#f1f1f1] border-l-[2px] border-l-solid border-l-[#437651]");

                // Change the image source to "-green.png"
                const img = parentLi.find("img");
                let imgSrc = img.attr("src");

                if (imgSrc && !imgSrc.includes("-green.png")) {
                    img.attr("src", imgSrc.replace(".png", "-green.png"));
                }
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.circle').each(function() {
            const percent = $(this).data('percent');
            $(this).css('--percent', `${percent}%`);
        });
    });
</script>
@endpush