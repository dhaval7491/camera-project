<html>

<head>
    <title>
        Guava
    </title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('admin-theme/assets/css/media.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css"
        integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.7.1/spectrum.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.6.7/css/perfect-scrollbar.min.css">
    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css'
        rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('admin-theme/assets/css/output.css')}}">
    <link rel="stylesheet" href="{{ asset('admin-theme/assets/css/custom-style.css')}}">
    <link href="{{ asset('admin-theme/assets/css/chart.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>

<body>
    <div class="wrapper">
        @include('layouts.nav-top')
        <div class="dashboard-body">
            @include('layouts.sidebar')
            <div class="ml-[110px] pt-[10px] w-[93%]">
                @yield('content')
               
            </div>
        </div>
    </div>
    </div>
</body>
<script src="{{ asset('admin-theme/assets/js/jquery-3.7.1.js')}}"></script>
<script src="{{ asset('admin-theme/assets/js/bootstrap.min.js')}}"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.9.1/cdn.js"></script>
<script src="{{ asset('admin-theme/assets/js/custom-script.js')}}"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn2.hubspot.net/hubfs/476360/Chart.js"></script>
<script src="https://cdn2.hubspot.net/hubfs/476360/utils.js"></script>
<script src="{{ asset('admin-theme/assets/js/graph-script.js')}}"></script>
<script src="{{ asset('admin-theme/assets/js/chart-script.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!---------------------- responsive sidebar collapse ------------------->
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
        $(".graph").each(function() {
            const percentage = $(this).css("--percentage").replace("%", ""); // Get percentage
            $(this).find("#label").text("Device" + percentage + "%"); // Update label text
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const segments = document.querySelectorAll(".segment");

        segments.forEach((segment) => {
            const percentage = segment.style.getPropertyValue("--percentage");
            const color = segment.style.getPropertyValue("--color");

            // Dynamically update the chart using CSS properties
            segment.style.background = `conic-gradient(
      ${color} 0% ${percentage}%,
      transparent ${percentage}% 100%
    )`;
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggleButtons = document.querySelectorAll(".toggle button");
        const bars = document.querySelectorAll(".bar");

        toggleButtons.forEach((button) => {
            button.addEventListener("click", function() {
                toggleButtons.forEach((btn) => btn.classList.remove("active"));
                this.classList.add("active");

                // Change bar heights for demonstration
                if (this.textContent === "This Week") {
                    const heights = ["40%", "20%", "80%", "60%", "30%", "50%", "40%"];
                    bars.forEach((bar, index) => bar.style.setProperty("--height", heights[index]));
                } else if (this.textContent === "Last Week") {
                    const heights = ["30%", "50%", "60%", "40%", "20%", "80%", "50%"];
                    bars.forEach((bar, index) => bar.style.setProperty("--height", heights[index]));
                }
            });
        });
    });
</script>
@stack('scripts')
</html>