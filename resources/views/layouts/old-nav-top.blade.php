<nav class="navbar fixed top-0 left-0 right-0 z-50 px-6 py-4 flex items-center justify-between">
    <div class="flex items-center space-x-4">
        <button id="toggleSidebar" class="text-gray-600 md:hidden">
            <i class="fas fa-bars text-2xl"></i>
        </button>
        <img src="{{ asset('admin-theme/assets/images/logo.png')}}" alt="Logo" class="h-8">
        <!-- <a href="#" class="flex items-center">
            <img src="{{ asset('admin-theme/assets/images/logo.png')}}" alt="Logo" class="h-8">
        </a> -->
        <div class="relative ml-[110px]">
            <input type="text" placeholder="Search" class="w-[280px] md:w-64 lg:w-80 rounded-full bg-[#fff] text-black focus:outline-none text-[15px] px-[40px] py-[10px] border-[1px] border-solid border-[#D6D6D6]">
            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"><img
                    src="{{ asset('admin-theme/assets/images/search-icon.png')}}" class="w-[20px]"></span>
        </div>
    </div>
    <div class="flex items-center space-x-4">
        <button onclick="window.location.href='help.html';" class="relative p-2">
            <img src="{{ asset('admin-theme/assets/images/help-que.png')}}" alt="Help" class="h-6">
        </button>
        <button onclick="window.location.href='notification.html';" class="relative p-2">
            <img src="{{ asset('admin-theme/assets/images/notification.png')}}" alt="Notifications" class="h-6">
            <span
                class="absolute -top-1 -right-1 bg-[#fd591a] text-white text-xs w-4 h-4 flex items-center justify-center rounded-[14px]">1</span>
        </button>
        <button class="w-[30px] h-[30px] bg-[#FD8C1A] text-white text-[13px] manrope-medium rounded-[20px] flex items-center justify-center">
            RS
        </button>
        <button class="p-2 relative" onclick="toggleProfileDropdown(event)">
            <img src="{{ asset('admin-theme/assets/images/topbar-arrow.png')}}" alt="Dropdown" class="w-[25px] ">
            <div class="profile-drop absolute bg-white tab-shadow rounded-md hidden top-[40px] right-[0px] w-[170px] p-[10px] z-[8]">
                <ul>
                    <li class="py-[5px]">
                        <a href="{{ route('settings.index') }}" class="flex text-[#344563] text-[16px] manrope-medium">
                            <img src="{{ asset('admin-theme/assets/images/people-2.png')}}" class="w-[16px] mr-[11px] object-contain">
                            <p>Settings</p>
                        </a>
                    </li>
                    <li class="py-[5px]">
                        <a href="{{ route('superadmin.logout') }}" class="flex text-[#344563] text-[16px] manrope-medium">
                            <img src="{{ asset('admin-theme/assets/images/delete.png')}}" class="w-[16px] mr-[11px] object-contain">
                            <p>Logout</p>
                        </a>
                    </li>
                </ul>
            </div>
        </button>
    </div>
</nav>