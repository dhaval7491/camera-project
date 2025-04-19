@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex flex-wrap h-full">
        <!-- Sidebar -->
        <div class="w-full sm:w-1/6 md:w-1/6 lg:w-1/6">
            <div class="h-full bg-white shadow-md py-4 px-6">
                <button class="tab-button block text-gray-600 font-medium text-base py-2 pl-4 mb-2 w-full text-left active" onclick="openTab(event, 'account')">
                    Account
                </button>
                <button class="tab-button block text-gray-600 font-medium text-base py-2 pl-4 mb-2 w-full text-left" onclick="openTab(event, 'login')">
                    Login and Security
                </button>
                <button class="tab-button block text-gray-600 font-medium text-base py-2 pl-4 mb-2 w-full text-left" onclick="openTab(event, 'platform')">
                    Platform
                </button>
                <button class="tab-button block text-gray-600 font-medium text-base py-2 pl-4 mb-2 w-full text-left" onclick="openTab(event, 'event')">
                    Event Type
                </button>
            </div>
        </div>

        <!-- Main Content -->
        <div class="w-full sm:w-5/6 md:w-5/6 lg:w-5/6 p-6">
            <div class="tab-content">
                <!-- Account Tab -->
                <div class="tab-prop block" id="account">
                    <div class="account-detail">
                        <h4 class="text-lg font-semibold text-gray-800">Account Details</h4>
                        <div class="account-form mt-10">
                            <p class="text-base font-medium text-black mb-4">Upload Profile Picture</p>
                            <form action="" method="POST" enctype="multipart/form-data" class="flex flex-col gap-6">
                                @csrf
                                @method('PUT')
                                <div class="relative w-24 mb-10">
                                    <img src="{{ asset('admin-theme/assets/images/profile-edit.png') }}" class="w-full rounded-full" alt="Profile Picture">
                                    <label for="file-input" class="absolute bottom-2 right-2 bg-white p-1 rounded-full shadow-md cursor-pointer flex items-center justify-center">
                                        <img src="{{ asset('admin-theme/assets/images/camera.png') }}" class="w-6 h-6 object-contain" alt="Upload Icon">
                                    </label>
                                    <input type="file" id="file-input" name="profile_picture" accept="image/*" class="hidden">
                                </div>
                                <div class="w-full md:w-3/5">
                                    <label class="text-base font-medium text-black">Full Name</label>
                                    <div class="mt-4 mb-6 flex flex-col sm:flex-row gap-4">
                                        <input type="text" name="first_name" class="w-full border border-gray-300 rounded-full py-2 px-6 focus:outline-none focus:ring-2 focus:ring-gray-200" placeholder="First Name">
                                        <input type="text" name="last_name" class="w-full border border-gray-300 rounded-full py-2 px-6 focus:outline-none focus:ring-2 focus:ring-gray-200" placeholder="Last Name">
                                    </div>
                                    <label class="text-base font-medium text-black">Email</label>
                                    <input type="email" name="email" class="mt-4 w-full border border-gray-300 rounded-full py-2 px-6 focus:outline-none focus:ring-2 focus:ring-gray-200" placeholder="Email">
                                    <button type="submit" class="mt-6 bg-gray-800 text-white rounded-full py-2 px-6 font-medium hover:bg-gray-700">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Login and Security Tab -->
                <div class="tab-prop hidden" id="login">
                    <div class="account-detail">
                        <h4 class="text-lg font-semibold text-gray-800">Login and Security</h4>
                        <h5 class="text-base font-medium mt-4">Two Factor Authentication Options</h5>
                        <div class="w-full md:w-3/5">
                            <!-- Text Message Security -->
                            <div class="border-l-4 border-green-600 shadow-md py-6 px-8 mb-8 mt-10">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h5 class="text-lg font-semibold">Text Message</h5>
                                        <p class="text-gray-500 text-sm mt-2">Use your mobile phone to receive verification code</p>
                                    </div>
                                    <label class="flex items-center cursor-pointer">
                                        <input type="checkbox" id="text-toggle" class="hidden peer" onchange="toggleSwitch(this)">
                                        <div class="w-10 h-5 bg-gray-300 rounded-full peer-checked:bg-orange-400 relative transition">
                                            <div class="absolute left-1 top-1 w-3 h-3 bg-white rounded-full peer-checked:left-6 transition"></div>
                                        </div>
                                    </label>
                                </div>
                                <div class="flex justify-between items-center mt-4">
                                    <span class="text-gray-500 text-sm"><input type="checkbox" class="mr-2" disabled> Verified, January 03</span>
                                    <span class="text-gray-500 text-sm">+91 8425621XXX <a href="#" class="text-blue-400 ml-4" onclick="toggleModalphone()">Edit</a></span>
                                </div>
                            </div>

                            <!-- Google Authenticator -->
                            <div class="shadow-md py-6 px-8 mb-8">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h5 class="text-lg font-semibold">Google Authenticator</h5>
                                        <p class="text-gray-500 text-sm mt-2">Use the Google Authenticator app to generate one-time security code</p>
                                    </div>
                                    <label class="flex items-center cursor-pointer">
                                        <input type="checkbox" id="google-toggle" class="hidden peer" onchange="toggleSwitch(this)">
                                        <div class="w-10 h-5 bg-gray-300 rounded-full peer-checked:bg-orange-400 relative transition">
                                            <div class="absolute left-1 top-1 w-3 h-3 bg-white rounded-full peer-checked:left-6 transition"></div>
                                        </div>
                                    </label>
                                </div>
                                <div class="flex justify-between items-center mt-4">
                                    <span class="text-gray-500 text-sm"><input type="checkbox" class="mr-2" disabled> Verified, January 03</span>
                                    <span class="text-gray-500 text-sm">Google App <a href="#" class="text-blue-400 ml-4" onclick="toggleModalwebsite()">Edit</a></span>
                                </div>
                            </div>

                            <!-- Password Section -->
                            <div class="shadow-md py-6 px-8 mb-8">
                                <h5 class="text-lg font-semibold">Update Password</h5>
                                <form action="{{ route('password.update') }}" method="POST" class="mt-4">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-4">
                                        <label class="text-base font-medium text-black">New Password</label>
                                        <input type="password" name="new_password" class="w-full border border-gray-300 rounded-full py-2 px-6 mt-2 focus:outline-none focus:ring-2 focus:ring-gray-200" placeholder="New Password">
                                    </div>
                                    <div class="mb-4">
                                        <label class="text-base font-medium text-black">Confirm Password</label>
                                        <input type="password" name="new_password_confirmation" class="w-full border border-gray-300 rounded-full py-2 px-6 mt-2 focus:outline-none focus:ring-2 focus:ring-gray-200" placeholder="Confirm Password">
                                    </div>
                                    <button type="submit" class="bg-gray-800 text-white rounded-full py-2 px-6 font-medium hover:bg-gray-700">Update Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Platform Tab -->
                <div class="tab-prop hidden" id="platform">
                    <div>
                        <h5 class="text-lg font-semibold text-gray-800">Project Details</h5>
                        <div class="p-6 w-full mt-4 shadow-md">
                            <p class="text-base font-semibold text-gray-800">London Bridge</p>
                            <table class="w-full text-sm text-left">
                                <tbody>
                                    <tr>
                                        <td class="py-2 px-4 text-base text-gray-800">Crane 01</td>
                                        <td class="py-2 px-4 text-base text-gray-800">#637282929</td>
                                        <td class="py-2 px-4 text-base text-gray-800">Device Name</td>
                                        <td class="py-2 px-4 text-base text-gray-800">https://www.example.com/api/v1/resources/data/fetch?user</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-4 text-base text-gray-800">Crane 01</td>
                                        <td class="py-2 px-4 text-base text-gray-800">#637282929</td>
                                        <td class="py-2 px-4 text-base text-gray-800">Device Name</td>
                                        <td class="py-2 px-4 text-base text-gray-800">https://www.example.com/api/v1/resources/data/fetch?user</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="text-right mt-4">
                                <button class="bg-gray-800 text-white rounded-full py-2 px-6 font-medium mr-4 hover:bg-gray-700">Remove</button>
                                <a href="#"><i class="fas fa-edit"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Event Type Tab -->
                <div class="tab-prop hidden" id="event">
                    <div class="account-detail">
                        <div class="flex flex-wrap items-center">
                            <div class="w-full md:w-1/2">
                                <h3 class="text-lg font-medium text-gray-800">
                                    <a href="#" class="inline-block text-sm text-green-600 underline mr-4">Back</a>Event Type
                                </h3>
                            </div>
                            <div class="w-full md:w-1/2 text-right">
                                <button class="flex items-center bg-gray-800 text-white rounded-lg py-2 px-6 font-medium hover:bg-gray-700" onclick="toggleModalevent()">
                                    <img src="{{ asset('admin-theme/assets/images/add.png') }}" class="w-4 mr-2" alt="Add Icon"> Add New
                                </button>
                            </div>
                        </div>
                        <div class="mt-6">
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left">
                                    <thead class="bg-gray-200">
                                        <tr>
                                            <th class="px-6 py-3 text-base font-medium text-gray-800"></th>
                                            <th class="px-6 py-3 text-base font-medium text-gray-800 text-center">Event Name</th>
                                            <th class="px-6 py-3 text-base font-medium text-gray-800 text-center">Condition</th>
                                            <th class="px-6 py-3 text-base font-medium text-gray-800 text-center">Wind Threshold</th>
                                            <th class="px-6 py-3 text-base font-medium text-gray-800 text-center">Height Threshold</th>
                                            <th class="px-6 py-3 text-base font-medium text-gray-800 text-center">Alert</th>
                                            <th class="px-6 py-3 text-base font-medium text-gray-800 text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="bg-white hover:bg-gray-100">
                                            <td class="text-center">
                                                <input type="checkbox" class="text-blue-600">
                                            </td>
                                            <td class="px-6 py-4 text-center text-base text-gray-800">Lifting</td>
                                            <td class="px-6 py-4 text-center text-base text-gray-800">Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                                            <td class="px-6 py- whisky-4 text-center text-base text-gray-800">38 Km/hr</td>
                                            <td class="px-6 py-4 text-center text-base text-gray-800">38 Km/hr</td>
                                            <td class="px-6 py-4 text-center text-base text-gray-800">Alert Text</td>
                                            <td class="flex justify-center relative">
                                                <a href="#" onclick="toggleDotDropdown(event)">
                                                    <img src="{{ asset('admin-theme/assets/images/table-menu.png') }}" class="w-5 mr-4" alt="Menu Icon">
                                                </a>
                                                <div class="dot-drop absolute bg-white shadow-md rounded-md hidden top-10 right-10 w-40 p-2 z-10">
                                                    <ul>
                                                        <li class="py-2">
                                                            <a href="#" class="flex text-gray-800 text-sm">
                                                                <img src="{{ asset('admin-theme/assets/images/edit-opt.png') }}" class="w-4 mr-2" alt="Edit Icon"> Edit
                                                            </a>
                                                        </li>
                                                        <li class="py-2">
                                                            <a href="#" class="flex text-gray-800 text-sm">
                                                                <img src="{{ asset('admin-theme/assets/images/delete.png') }}" class="w-4 mr-2" alt="Delete Icon"> Delete
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="bg-gray-50 hover:bg-gray-100">
                                            <td class="text-center">
                                                <input type="checkbox" class="text-blue-600">
                                            </td>
                                            <td class="px-6 py-4 text-center text-base text-gray-800">Waiting</td>
                                            <td class="px-6 py-4 text-center text-base text-gray-800">Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                                            <td class="px-6 py-4 text-center text-base text-gray-800">38 Km/hr</td>
                                            <td class="px-6 py-4 text-center text-base text-gray-800">38 Km/hr</td>
                                            <td class="px-6 py-4 text-center text-base text-gray-800">Alert Text</td>
                                            <td class="flex justify-center relative">
                                                <a href="#" onclick="toggleDotDropdown(event)">
                                                    <img src="{{ asset('admin-theme/assets/images/table-menu.png') }}" class="w-5 mr-4" alt="Menu Icon">
                                                </a>
                                                <div class="dot-drop absolute bg-white shadow-md rounded-md hidden top-10 right-10 w-40 p-2 z-10">
                                                    <ul>
                                                        <li class="py-2">
                                                            <a href="#" class="flex text-gray-800 text-sm">
                                                                <img src="{{ asset('admin-theme/assets/images/edit-opt.png') }}" class="w-4 mr-2" alt="Edit Icon"> Edit
                                                            </a>
                                                        </li>
                                                        <li class="py-2">
                                                            <a href="#" class="flex text-gray-800 text-sm">
                                                                <img src="{{ asset('admin-theme/assets/images/delete.png') }}" class="w-4 mr-2" alt="Delete Icon"> Delete
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleSwitch(checkbox) {
        const isChecked = checkbox.checked;
        const toggleDiv = checkbox.nextElementSibling;
        const verificationCheckbox = checkbox.closest('div').nextElementSibling.querySelector('input[type="checkbox"]');

        // Update the toggle state visually (optional, as Tailwind handles this with peer-checked)
        if (isChecked) {
            toggleDiv.classList.add('bg-orange-400');
            toggleDiv.querySelector('div').classList.add('left-6');
            verificationCheckbox.disabled = false; // Enable verification checkbox
        } else {
            toggleDiv.classList.remove('bg-orange-400');
            toggleDiv.querySelector('div').classList.remove('left-6');
            verificationCheckbox.disabled = true; // Disable verification checkbox
            verificationCheckbox.checked = false; // Uncheck verification
        }
    }

    // Initialize toggle state on page load
    document.addEventListener("DOMContentLoaded", function() {
        const toggles = document.querySelectorAll('input[id^="toggle"]');
        toggles.forEach(toggle => {
            toggleSwitch(toggle); // Set initial state
        });
    });
    function openTab(evt, tabName) {
        // Hide all tab content
        var tabcontent = document.getElementsByClassName("tab-prop");
        for (var i = 0; i < tabcontent.length; i++) {
            tabcontent[i].classList.add("hidden");
            tabcontent[i].classList.remove("block");
        }

        // Remove active class from all buttons
        var tablinks = document.getElementsByClassName("tab-button");
        for (var i = 0; i < tablinks.length; i++) {
            tablinks[i].classList.remove("active");
        }

        // Show the current tab and add active class to the clicked button
        document.getElementById(tabName).classList.remove("hidden");
        document.getElementById(tabName).classList.add("block");
        evt.currentTarget.classList.add("active");
    }

    function toggleDotDropdown(event) {
        var dropdown = event.currentTarget.nextElementSibling;
        dropdown.classList.toggle("hidden");
    }

    // Open the first tab by default
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementsByClassName("tab-button")[0].click();
    });
</script>
@endsection