<nav class="w-full bg-white py-[15px] pl-[0px] pr-[25px] flex items-center justify-between fixed z-[9]">
    <div class="flex items-center space-x-3">
        <a href="#" class="flex items-center">
            <img src="{{ asset('admin-theme/assets/images/logo.png') }}" alt="Logo" class="w-[80px] h-[80px] object-contain">
        </a>
        <div class="pl-[30px]">
            <a href="#" class="inline-block manrope-medium text-[13px] mt-[3px] mr-[10px] text-[#437651] underline" style="text-decoration:none;">&lt; Back</a>
        </div>
        <div class="relative">
            <input type="text" placeholder="Search" class="w-[280px] md:w-64 lg:w-80 rounded-full bg-[#fff] text-black focus:outline-none text-[13px] px-[40px] py-[10px] border-[1px] border-solid border-[#D6D6D6]">
            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                <img src="{{ asset('admin-theme/assets/images/table-search.png') }}" class="w-[15px]">
            </span>
        </div>
    </div>
    <div class="flex items-center space-x-4">
        <button onclick="window.location.href='help.html';" class="relative p-2">
            <img src="{{ asset('admin-theme/assets/images/help-que.png') }}" alt="Help" class="h-6">
        </button>
        <button onclick="window.location.href='notification.html';" class="relative p-2">
            <img src="{{ asset('admin-theme/assets/images/notification.png') }}" alt="Notifications" class="h-6">
            <span class="absolute -top-1 -right-1 bg-[#fd591a] text-white text-xs w-4 h-4 flex items-center justify-center rounded-[14px]">1</span>
        </button>
        <button class="w-[30px] h-[30px] bg-[#FD8C1A] text-white text-[11px] manrope-medium rounded-[20px] flex items-center justify-center" onclick="toggleProfileDropdown(event)">
            RS
            <div class="profile-drop absolute bg-white tab-shadow rounded-md hidden top-[70px] right-[0px] w-[200px] p-[10px] z-[8]">
                <ul>
                    <li class="py-[5px]">
                        <a href="{{ route('account-settings') }}" class="flex text-[#344563] text-[13px] manrope-medium">
                            <img src="{{ asset('admin-theme/assets/images/account-detail.png') }}" class="w-[20px] mr-[11px] object-contain">
                            <p>Account Settings</p>
                        </a>
                    </li>
                    <li class="py-[5px]">
                        <a href="{{ route('superadmin.logout') }}" class="flex text-[#344563] text-[13px] manrope-medium">
                            <img src="{{ asset('admin-theme/assets/images/delete.png') }}" class="w-[22px] mr-[11px] object-contain">
                            <p>Logout</p>
                        </a>
                    </li>
                </ul>
            </div>
        </button>
    </div>
</nav>