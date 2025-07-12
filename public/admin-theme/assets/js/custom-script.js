
document.getElementById("search-toggle").addEventListener("click", function () {
    let searchInput = document.getElementById("search-input");

    if (searchInput.classList.contains("w-0")) {
        searchInput.classList.remove("w-0", "p-0");
        searchInput.classList.add("w-[202px]", "p-[5px]");
    } else {
        searchInput.classList.remove("w-[202px]", "p-[5px]");
        searchInput.classList.add("w-0", "p-0");
    }
});
//-------------------- Sidebar Hover effect --------------------------->
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

   //--------------------------- Sidebar Hover effect end ----------------------->

        function toggleModalp() {
            document.getElementById('addproject').classList.toggle('hidden')
        }
        function toggleModalpeople() {
            document.getElementById('addpeople').classList.toggle('hidden')
        }
        function toggleModalcont() {
            document.getElementById('addcontractor').classList.toggle('hidden')
        }
        function toggleModalc() {
            document.getElementById('addcompany').classList.toggle('hidden')
        }
        function toggleModale() {
            document.getElementById('addequipment').classList.toggle('hidden')
        }
        function toggleModalu() {
            document.getElementById('adduser').classList.toggle('hidden')
        }
        function toggleModalm() {
            document.getElementById('addmapping').classList.toggle('hidden')
        }
        function toggleModalcont() {
            document.getElementById('addcontractor').classList.toggle('hidden')
        }
        function toggleModalassigntrackable() {
            document.getElementById('assigntrackable').classList.toggle('hidden')
        }
        function toggleModalphone() {
            document.getElementById('editphone').classList.toggle('hidden')
        }
        function toggleModalwebsite() {
            document.getElementById('editwebsite').classList.toggle('hidden')
        }
        function toggleModalevent() {
            document.getElementById('addevent').classList.toggle('hidden')
        }
        function toggleModaladdai() {
            document.getElementById('addai').classList.toggle('hidden')
        }
        
    function toggleDotDropdown(event) {
        event.preventDefault();
        event.stopPropagation(); // Prevent click from closing immediately

        const dropdown = event.target.closest('td').querySelector('.dot-drop');
        dropdown.classList.toggle('hidden');

        // Close all other dropdowns
        document.querySelectorAll('.dot-drop').forEach(drop => {
            if (drop !== dropdown) {
                drop.classList.add('hidden');
            }
        });
    }

    // Close dropdown when clicking outside
    document.addEventListener("click", function(event) {
        document.querySelectorAll('.dot-drop').forEach(drop => {
            if (!drop.classList.contains('hidden') && !drop.closest('td').contains(event.target)) {
                drop.classList.add('hidden');
            }
        });
    });

    function toggleProfileDropdown(event) {
        event.stopPropagation(); // Prevents event bubbling

        let dropdown = event.currentTarget.querySelector('.profile-drop');
        dropdown.classList.toggle('hidden');

        // Close all other profile dropdowns
        document.querySelectorAll('.profile-drop').forEach(drop => {
            if (drop !== dropdown) {
                drop.classList.add('hidden');
            }
        });
    }

    // Close profile dropdown when clicking outside
    document.addEventListener('click', function(event) {
        document.querySelectorAll('.profile-drop').forEach(dropdown => {
            if (!dropdown.classList.contains('hidden') && !dropdown.closest('button').contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    });
   //------------------------------ nab tabs ----------------------------------
    function openTab(event, tabId) {
        // Hide all tabs
        document.querySelectorAll('.tab-prop').forEach(tab => tab.classList.add('hidden'));
        document.getElementById(tabId).classList.remove('hidden');

        // Remove active class from all buttons
        document.querySelectorAll('.tab-button').forEach(button => button.classList.remove('underline', 'font-bold'));

        // Add active class to clicked button
        event.currentTarget.classList.add('underline', 'font-bold');
    }
   //-------------------------------nav tab end ----------------------------------
