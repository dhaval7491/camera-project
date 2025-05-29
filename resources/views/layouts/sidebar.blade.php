<div class="sidebar fixed h-full w-[100px] sidebar-shadow">
    <ul class="list-unstyled">
        <li class="mx-[4px] my-[5px] p-[3px]  hover:bg-[#4376511c]  rounded-r-[5px] {{ request()->routeIs('superadmin.dashboard') ? 'bg-[#f1f1f1] border-l-[2px] border-l-solid border-l-[#437651]' : 'hover:bg-[#f1f1f1]' }}">
            <a href="{{ route('superadmin.dashboard') }}" class="border-l-[2px] border-l-solid border-l-transparent">
                <img src="{{ asset('admin-theme/assets/images/dashboard.png') }}" class="w-[20px] my-0 mx-auto mb-[2px] mt-[-18px]">
                <p class="manrope-medium text-[12px] text-[#344563] text-center">Dashboard</p>
            </a>
        </li>
        <li class="mx-[4px] my-[5px] p-[3px]  hover:bg-[#4376511c]  rounded-r-[5px] {{ request()->routeIs('companies.index') ? 'bg-[#f1f1f1] border-l-[2px] border-l-solid border-l-[#437651]' : 'hover:bg-[#f1f1f1]' }}">
            <a href="{{ route('companies.index') }}" class="border-l-[2px] border-l-solid border-l-transparent">
                <img src="{{ asset('admin-theme/assets/images/company.png') }}" class="w-[20px] my-0 mx-auto mb-[2px] mt-[-18px]">
                <p class="manrope-medium text-[12px] text-[#344563] text-center">Company</p>
            </a>
        </li>
        <li class="mx-[4px] my-[5px] p-[3px]  hover:bg-[#4376511c]  rounded-r-[5px] {{ request()->routeIs('projects.index') ? 'bg-[#f1f1f1] border-l-[2px] border-l-solid border-l-[#437651]' : 'hover:bg-[#f1f1f1]' }}">
            <a href="{{ route('projects.index') }}" class="border-l-[2px] border-l-solid border-l-transparent">
                <img src="{{ asset('admin-theme/assets/images/project.png') }}" class="w-[20px] my-0 mx-auto mb-[2px] mt-[-18px]">
                <p class="manrope-medium text-[12px] text-[#344563] text-center">Project</p>
            </a>
        </li>
        <li class="mx-[4px] my-[5px] p-[3px]  hover:bg-[#4376511c]  rounded-r-[5px] {{ request()->routeIs('streams.index') ? 'bg-[#f1f1f1] border-l-[2px] border-l-solid border-l-[#437651]' : 'hover:bg-[#f1f1f1]' }}">
            <a href="{{ route('streams.index') }}" class="border-l-[2px] border-l-solid border-l-transparent">
                <img src="{{ asset('admin-theme/assets/images/live.png') }}" class="w-[20px] my-0 mx-auto mb-[2px] mt-[-18px]">
                <p class="manrope-medium text-[12px] text-[#344563] text-center">Live Stream</p>
            </a>
        </li>
        <li class="mx-[4px] my-[5px] p-[3px]  hover:bg-[#4376511c]  rounded-r-[5px] {{ request()->routeIs('users.index') ? 'bg-[#f1f1f1] border-l-[2px] border-l-solid border-l-[#437651]' : 'hover:bg-[#f1f1f1]' }}">
            <a href="{{ route('users.index') }}" class="border-l-[2px] border-l-solid border-l-transparent">
                <img src="{{ asset('admin-theme/assets/images/users.png') }}" class="w-[20px] my-0 mx-auto mb-[2px] mt-[-18px]">
                <p class="manrope-medium text-[12px] text-[#344563] text-center">Users</p>
            </a>
        </li>
        <li class="mx-[4px] my-[5px] p-[3px]  hover:bg-[#4376511c]  rounded-r-[5px] {{ request()->routeIs('analytics.index') ? 'bg-[#f1f1f1] border-l-[2px] border-l-solid border-l-[#437651]' : 'hover:bg-[#f1f1f1]' }}">
            <a href="{{ route('analytics.index') }}" class="border-l-[2px] border-l-solid border-l-transparent">
                <img src="{{ asset('admin-theme/assets/images/analytics.png') }}" class="w-[20px] my-0 mx-auto mb-[2px] mt-[-18px]">
                <p class="manrope-medium text-[12px] text-[#344563] text-center">Analytics</p>
            </a>
        </li>
        <li class="mx-[4px] my-[5px] p-[3px]  hover:bg-[#4376511c]  rounded-r-[5px] {{ request()->routeIs('settings.index') ? 'bg-[#f1f1f1] border-l-[2px] border-l-solid border-l-[#437651]' : 'hover:bg-[#f1f1f1]' }}">
            <a href="{{ route('settings.index') }}" class="border-l-[2px] border-l-solid border-l-transparent">
                <img src="{{ asset('admin-theme/assets/images/settings.png') }}" class="w-[20px] my-0 mx-auto mb-[2px] mt-[-18px]">
                <p class="manrope-medium text-[12px] text-[#344563] text-center">Settings</p>
            </a>
        </li>
    </ul>
</div>