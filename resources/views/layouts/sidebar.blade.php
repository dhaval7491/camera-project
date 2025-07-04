<div class="sidebar fixed h-full w-[70px] sidebar-shadow sidebar-desktop">
    <ul class="list-unstyled">
        <li class="mx-[4px] my-[5px] p-[3px]  hover:bg-[#4376511c]  rounded-r-[5px] {{ request()->routeIs('superadmin.dashboard') ? 'bg-[#4376511c] border-l-[2px] border-l-solid border-l-[#437651]' : 'hover:bg-[#f1f1f1]' }}">
            <a href="{{ route('superadmin.dashboard') }}" class="border-l-[2px] border-l-solid border-l-transparent">
                <img src="{{ asset('admin-theme/assets/images/dashboard.png') }}" class="w-[20px] my-0 mx-auto mb-[2px] mt-[-18px]">
                <p class="manrope-medium text-[11px] text-[#344563] text-center" style="font-size:9px;">Dashboard</p>
            </a>
        </li>
        <li class="mx-[4px] my-[5px] p-[3px]  hover:bg-[#4376511c]  rounded-r-[5px] {{ request()->routeIs('companies.index') ? 'bg-[#4376511c] border-l-[2px] border-l-solid border-l-[#437651]' : 'hover:bg-[#f1f1f1]' }}">
            <a href="{{ route('companies.index') }}" class="border-l-[2px] border-l-solid border-l-transparent">
                <img src="{{ asset('admin-theme/assets/images/company.png') }}" class="w-[20px] my-0 mx-auto mb-[2px] mt-[-18px]">
                <p class="manrope-medium text-[11px] text-[#344563] text-center" style="font-size:9px;">Company</p>
            </a>
        </li>
        <li class="mx-[4px] my-[5px] p-[3px]  hover:bg-[#4376511c]  rounded-r-[5px] {{ request()->routeIs('projects.index') ? 'bg-[#4376511c] border-l-[2px] border-l-solid border-l-[#437651]' : 'hover:bg-[#f1f1f1]' }}">
            <a href="{{ route('projects.index') }}" class="border-l-[2px] border-l-solid border-l-transparent">
                <img src="{{ asset('admin-theme/assets/images/project.png') }}" class="w-[20px] my-0 mx-auto mb-[2px] mt-[-18px]">
                <p class="manrope-medium text-[11px] text-[#344563] text-center" style="font-size:9px;">Project</p>
            </a>
        </li>
        <li class="mx-[4px] my-[5px] p-[3px]  hover:bg-[#4376511c]  rounded-r-[5px] {{ request()->routeIs('streams.index') ? 'bg-[#4376511c] border-l-[2px] border-l-solid border-l-[#437651]' : 'hover:bg-[#f1f1f1]' }}">
            <a href="{{ route('streams.index') }}" class="border-l-[2px] border-l-solid border-l-transparent">
                <img src="{{ asset('admin-theme/assets/images/live.png') }}" class="w-[20px] my-0 mx-auto mb-[2px] mt-[-18px]">
                <p class="manrope-medium text-[11px] text-[#344563] text-center" style="font-size:9px;">Live Stream</p>
            </a>
        </li>
        <li class="mx-[4px] my-[5px] p-[3px]  hover:bg-[#4376511c]  rounded-r-[5px] {{ request()->routeIs('users.index') ? 'bg-[#4376511c] border-l-[2px] border-l-solid border-l-[#437651]' : 'hover:bg-[#f1f1f1]' }}">
            <a href="{{ route('users.index') }}" class="border-l-[2px] border-l-solid border-l-transparent">
                <img src="{{ asset('admin-theme/assets/images/users.png') }}" class="w-[20px] my-0 mx-auto mb-[2px] mt-[-18px]">
                <p class="manrope-medium text-[11px] text-[#344563] text-center" style="font-size:9px;">Users</p>
            </a>
        </li>
        <li class="mx-[4px] my-[5px] p-[3px]  hover:bg-[#4376511c]  rounded-r-[5px] {{ request()->routeIs('analytics.index') ? 'bg-[#4376511c] border-l-[2px] border-l-solid border-l-[#437651]' : 'hover:bg-[#f1f1f1]' }}">
            <a href="{{ route('analytics.index') }}" class="border-l-[2px] border-l-solid border-l-transparent">
                <img src="{{ asset('admin-theme/assets/images/analytics.png') }}" class="w-[20px] my-0 mx-auto mb-[2px] mt-[-18px]">
                <p class="manrope-medium text-[11px] text-[#344563] text-center" style="font-size:9px;">Analytics</p>
            </a>
        </li>
        <li class="mx-[4px] my-[5px] p-[3px]  hover:bg-[#4376511c]  rounded-r-[5px] {{ request()->routeIs('settings.index') ? 'bg-[#4376511c] border-l-[2px] border-l-solid border-l-[#437651]' : 'hover:bg-[#f1f1f1]' }}">
            <a href="{{ route('settings.index') }}" class="border-l-[2px] border-l-solid border-l-transparent">
                <img src="{{ asset('admin-theme/assets/images/settings.png') }}" class="w-[20px] my-0 mx-auto mb-[2px] mt-[-18px]">
                <p class="manrope-medium text-[11px] text-[#344563] text-center" style="font-size:9px;">Settings</p>
            </a>
        </li>
    </ul>
</div>

<div class="sidebar fixed h-full w-[100px] sidebar-shadow sidebar-mobile">
    <ul class="list-unstyled">
        <li class="mx-[4px] my-[5px] p-[3px]  hover:bg-[#4376511c]  rounded-r-[5px] {{ request()->routeIs('superadmin.dashboard') ? 'bg-[#4376511c] border-l-[2px] border-l-solid border-l-[#437651]' : 'hover:bg-[#f1f1f1]' }}">
            <a href="{{ route('superadmin.dashboard') }}" class="border-l-[2px] border-l-solid border-l-transparent">
                <img src="{{ asset('admin-theme/assets/images/dashboard.png') }}" class="w-[20px] my-0 mx-auto mb-[2px] mt-[-18px]">
                <p class="manrope-medium text-[11px] text-[#344563] text-center" style="font-size:9px;">Dashboard</p>
            </a>
        </li>
        <li class="mx-[4px] my-[5px] p-[3px]  hover:bg-[#4376511c]  rounded-r-[5px] {{ request()->routeIs('companies.index') ? 'bg-[#4376511c] border-l-[2px] border-l-solid border-l-[#437651]' : 'hover:bg-[#f1f1f1]' }}">
            <a href="{{ route('companies.index') }}" class="border-l-[2px] border-l-solid border-l-transparent">
                <img src="{{ asset('admin-theme/assets/images/company.png') }}" class="w-[20px] my-0 mx-auto mb-[2px] mt-[-18px]">
                <p class="manrope-medium text-[11px] text-[#344563] text-center" style="font-size:9px;">Company</p>
            </a>
        </li>
        <li class="mx-[4px] my-[5px] p-[3px]  hover:bg-[#4376511c]  rounded-r-[5px] {{ request()->routeIs('projects.index') ? 'bg-[#4376511c] border-l-[2px] border-l-solid border-l-[#437651]' : 'hover:bg-[#f1f1f1]' }}">
            <a href="{{ route('projects.index') }}" class="border-l-[2px] border-l-solid border-l-transparent">
                <img src="{{ asset('admin-theme/assets/images/project.png') }}" class="w-[20px] my-0 mx-auto mb-[2px] mt-[-18px]">
                <p class="manrope-medium text-[11px] text-[#344563] text-center" style="font-size:9px;">Project</p>
            </a>
        </li>
        <li class="mx-[4px] my-[5px] p-[3px]  hover:bg-[#4376511c]  rounded-r-[5px] {{ request()->routeIs('streams.index') ? 'bg-[#4376511c] border-l-[2px] border-l-solid border-l-[#437651]' : 'hover:bg-[#f1f1f1]' }}">
            <a href="{{ route('streams.index') }}" class="border-l-[2px] border-l-solid border-l-transparent">
                <img src="{{ asset('admin-theme/assets/images/live.png') }}" class="w-[20px] my-0 mx-auto mb-[2px] mt-[-18px]">
                <p class="manrope-medium text-[11px] text-[#344563] text-center" style="font-size:9px;">Live Stream</p>
            </a>
        </li>
        <li class="mx-[4px] my-[5px] p-[3px]  hover:bg-[#4376511c]  rounded-r-[5px] {{ request()->routeIs('users.index') ? 'bg-[#4376511c] border-l-[2px] border-l-solid border-l-[#437651]' : 'hover:bg-[#f1f1f1]' }}">
            <a href="{{ route('users.index') }}" class="border-l-[2px] border-l-solid border-l-transparent">
                <img src="{{ asset('admin-theme/assets/images/users.png') }}" class="w-[20px] my-0 mx-auto mb-[2px] mt-[-18px]">
                <p class="manrope-medium text-[11px] text-[#344563] text-center" style="font-size:9px;">Users</p>
            </a>
        </li>
        <li class="mx-[4px] my-[5px] p-[3px]  hover:bg-[#4376511c]  rounded-r-[5px] {{ request()->routeIs('analytics.index') ? 'bg-[#4376511c] border-l-[2px] border-l-solid border-l-[#437651]' : 'hover:bg-[#f1f1f1]' }}">
            <a href="{{ route('analytics.index') }}" class="border-l-[2px] border-l-solid border-l-transparent">
                <img src="{{ asset('admin-theme/assets/images/analytics.png') }}" class="w-[20px] my-0 mx-auto mb-[2px] mt-[-18px]">
                <p class="manrope-medium text-[11px] text-[#344563] text-center" style="font-size:9px;">Analytics</p>
            </a>
        </li>
        <li class="mx-[4px] my-[5px] p-[3px]  hover:bg-[#4376511c]  rounded-r-[5px] {{ request()->routeIs('settings.index') ? 'bg-[#4376511c] border-l-[2px] border-l-solid border-l-[#437651]' : 'hover:bg-[#f1f1f1]' }}">
            <a href="{{ route('settings.index') }}" class="border-l-[2px] border-l-solid border-l-transparent">
                <img src="{{ asset('admin-theme/assets/images/settings.png') }}" class="w-[20px] my-0 mx-auto mb-[2px] mt-[-18px]">
                <p class="manrope-medium text-[11px] text-[#344563] text-center" style="font-size:9px;">Settings</p>
            </a>
        </li>
    </ul>
</div>