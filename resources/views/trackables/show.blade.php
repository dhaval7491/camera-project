@extends('layouts.app')

@section('content')
<div class="flex flex-wrap justify-between">
    <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
        <h3 class="manrope-medium text-[#344563] text-[18px] mt-[17px]">Trackable</h3>
    </div>
</div>

<div class="profile-detail alert-shadow pt-[20px] pr-[25px] pb-[1px] pl-[20px] mt-[10px]">
    <div class="flex justify-between pl-[5px] pr-[5px]">
        <h4 class="manrope-medium text-[18px] mb-[20px]">Trackable Detail</h4>
    </div>
    <div class="flex flex-wrap mb-[30px]">
        <div class="lg:w-1/9 w-full pl-[5px] pr-[15px] border-r-[#e4e4e4] border-r-[1px] border-r-solid flex items-center justify-center">
            <div class="text-center inline-block w-[140px] h-[140px] mr-[10px] text-[50px] bg-gradient-to-b from-[#844EBC] to-[#AA55AA] text-[#fff] manrope-semibold rounded-[6px] py-[10px] px-[10px] items-center justify-center pt-[30px]">
                {{ strtoupper(substr($trackable->trackable_name, 0, 2)) }}
            </div>
        </div>
        <div class="lg:w-8/9 w-full pl-[15px] pr-[10px]">
            <h3 class="manrope-regular text-[16px] ml-[5px] font-semibold">{{ $trackable->trackable_name }}</h3>
            <div class="flex flex-wrap mb-[30px]">
                <div class="lg:w-2/6 w-full pl-[5px] pr-[5px] pt-[10px]">
                    <div class="profile-detail">
                        <p class="pt-[0px]">
                            <span class="w-[37%] inline-block manrope-regular text-[16px]">Trackable Name:</span>
                            <span class="manrope-regular text-[16px] text-[#969696]">{{ $trackable->trackable_name }}</span>
                        </p>
                        <p class="pt-[10px]">
                            <span class="w-[37%] inline-block manrope-regular">Other name:</span>
                            <span class="manrope-regular text-[16px] text-[#969696]">{{ $trackable->other_name ?? 'N/A' }}</span>
                        </p>
                    </div>
                </div>
                <div class="lg:w-2/6 w-full pl-[5px] pr-[5px]">
                    <div class="profile-detail">
                        <p class="pt-[10px]">
                            <span class="w-[37%] inline-block manrope-regular">Linked Objects:</span>
                            <span class="manrope-regular text-[16px] text-[#969696]">
                                {{ $trackable->linkedObjects->pluck('name')->implode(', ') ?: 'None' }}
                            </span>
                        </p>
                        <p class="pt-[10px]">
                            <span class="w-[37%] inline-block manrope-regular text-[16px]">Status:</span>
                            <span class="manrope-regular text-[16px] {{ $trackable->is_active ? 'text-[#047413]' : 'text-[#ff0000]' }}">
                                {{ $trackable->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="profile-detail pt-[20px] pb-[1px] mt-[10px]">
    <div class="profile-project pt-[10px] pl-[3px] pr-[3px]">
        <h3 class="manrope-semibold text-[15px] text-[#437651] mb-[20px] flex justify-between">
            <span>Associated Projects</span>
            <div class="flex mt-[-15px]">
                <p class="flex items-center mr-[8px]">
                    <div class="relative flex items-center">
                        <input type="text" id="search-input" class="w-0 p-0 border border-[#EBEBEB] rounded-[11px] absolute right-[19px] z-[8] transition-all duration-300 overflow-hidden bg-white" placeholder="Search...">
                        <button id="search-toggle" class="p-[11px] rounded-[15px] border border-[#EBEBEB] ml-2 z-[8] bg-white">
                            <img src="{{ asset('admin-theme/assets/images/table-search.png') }}" class="w-[16px]" alt="Search">
                        </button>
                    </div>
                </p>
                <button id="view-toggle" class="p-[11px] rounded-[15px] border border-[#EBEBEB] ml-2 z-[9] bg-white">
                    <img id="view-icon" src="{{ asset('admin-theme/assets/images/grid-view.png') }}" class="w-[16px]" alt="Toggle View">
                </button>
            </div>
        </h3>
        <div class="mt-[20px]">
            <div class="relative overflow-x-auto h-full" id="project-table">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="border-b-[2px] border-solid border-b-[#E9EDF0]">
                        <tr>
                            <th class="px-6 py-3 manrope-regular text-[#344563] text-[16px]">Name of project</th>
                            <th class="px-6 py-3 text-center manrope-regular text-[#344563] text-[15px]">Date Created</th>
                            <th class="px-6 py-3 text-center manrope-regular text-[#344563] text-[15px]">Company Name</th>
                            <th class="px-6 py-3 text-center manrope-regular text-[#344563] text-[15px]">Status</th>
                            <th class="px-6 py-3 text-center manrope-regular text-[#344563] text-[15px]">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($trackable->projects as $project)
                        <tr class="bg-white transition duration-300 ease-in-out hover:bg-[#D8E3DB]">
                            <th scope="row" class="px-[20px] py-[20px] text-gray-900 whitespace-nowrap flex">
                                <div>
                                    <span class="text-center inline-block w-[47px] h-[47px] mr-[10px] text-[18px] bg-[#004040] text-[#fff] manrope-semibold rounded-[6px] py-[10px] px-[10px]">
                                        {{ strtoupper(substr($project->name, 0, 2)) }}
                                    </span>
                                </div>
                                <div class="text-[#344563] text-[15px] manrope-regular cursor-pointer mt-[10px]" onclick="document.location='{{ route('projects.show', $project->id) }}'">
                                    {{ $project->name }}
                                </div>
                            </th>
                            <td class="px-[20px] py-[20px] text-center manrope-medium text-[#344563] text-[15px]">
                                {{ $project->created_at->format('M d - Y') }}
                            </td>
                            <td class="px-[20px] py-[20px] text-center manrope-medium text-[#344563] text-[15px]">
                                {{ $project->companies->pluck('name')->implode(', ') ?: 'N/A' }}
                            </td>
                            <td class="px-[20px] py-[20px] text-center">
                                <button class="table-status w-[90px] bg-[#{{ $project->is_active ? '047413' : 'ff0000' }}] text-white rounded-[7px] py-1 px-4 text-sm font-medium">
                                    {{ $project->is_active ? 'Active' : 'Inactive' }}
                                </button>
                            </td>
                            <td class="flex justify-center relative">
                                <span>
                                    <a href="#">
                                        <img src="{{ asset('admin-theme/assets/images/edit-report.png') }}" class="w-[21px] mr-[20px]" alt="Edit">
                                    </a>
                                </span>
                                <span class="mt-[8px]">
                                    <a href="#" onclick="toggleDotDropdown(event)">
                                        <img src="{{ asset('admin-theme/assets/images/table-menu.png') }}" class="w-[23px] mr-[20px]" alt="Menu">
                                    </a>
                                </span>
                                <div class="dot-drop absolute bg-white tab-shadow rounded-md hidden top-[30px] right-[60px] w-[170px] p-[10px] z-[8]">
                                    <ul>
                                        <li class="py-[5px]">
                                            <a href="#" class="flex manrope-medium text-[#344563] text-[15px]" onclick toggleModale()">
                                                <img src="{{ asset('admin-theme/assets/images/equipment.png') }}" class="w-[16px] mr-[11px] object-contain" alt="Add Equipment">
                                                <p>Add Equipment</p>
                                            </a>
                                        </li>
                                        <li class="py-[5px]">
                                            <a href="#" class="flex manrope-medium text-[#344563] text-[15px]" onclick="toggleModalpeople()">
                                                <img src="{{ asset('admin-theme/assets/images/add-people.png') }}" class="w-[16px] mr-[11px] object-contain" alt="Add People">
                                                <p>Add People</p>
                                            </a>
                                        </li>
                                        <li class="py-[5px]">
                                            <a href="#" class="flex manrope-medium text-[#344563] text-[15px]">
                                                <img src="{{ asset('admin-theme/assets/images/add-people.png') }}" class="w-[16px] mr-[11px] object-contain" alt="Trackable">
                                                <p>Trackable</p>
                                            </a>
                                        </li>
                                        <li class="py-[5px]">
                                            <a href="#" class="flex manrope-medium text-[#344563] text-[15px]">
                                                <img src="{{ asset('admin-theme/assets/images/delete.png') }}" class="w-[16px] mr-[11px] object-contain" alt="Delete">
                                                <p>Delete</p>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="manrope-medium text-[#8791A3] text-[16px] py-[17px] px-[0px] text-center">
                                No projects associated with this trackable
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div id="project-grid" class="grid grid-cols-6 gap-4 hidden">
                @forelse($trackable->projects as $project)
                <div class="flex alert-shadow items-center p-[20px]">
                    <p class="bg-gradient-to-b from-[#844EBC] to-[#AA55AA] text-[18px] manrope-semibold text-white rounded-[8px] px-[10px] py-[8px]">
                        {{ strtoupper(substr($project->name, 0, 2)) }}
                    </p>
                    <p class="pl-[10px] manrope-medium text-[16px] text-[#344563]">{{ $project->name }}</p>
                </div>
                @empty
                <div class="flex alert-shadow items-center p-[20px] col-span-6">
                    <p class="manrope-medium text-[16px] text-[#344563] w-full text-center">No projects associated with this trackable</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
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

        const currentPage = window.location.pathname.split("/").pop();
        $(".sidebar li a").each(function() {
            if ($(this).attr("href") === currentPage) {
                const parentLi = $(this).parent();
                parentLi.addClass("bg-[#f1f1f1]");
                const img = parentLi.find("img");
                let imgSrc = img.attr("src");
                if (imgSrc && !imgSrc.includes("-green.png")) {
                    img.attr("src", imgSrc.replace(".png", "-green.png"));
                }
            }
        });

        // Toggle view between table and grid
        const viewToggleBtn = document.getElementById('view-toggle');
        const viewIcon = document.getElementById('view-icon');
        const tableView = document.getElementById('project-table');
        const gridView = document.getElementById('project-grid');

        viewToggleBtn.addEventListener('click', () => {
            const isTableVisible = !tableView.classList.contains('hidden');
            tableView.classList.toggle('hidden');
            gridView.classList.toggle('hidden');
            viewIcon.src = isTableVisible ? '{{ asset("admin-theme/assets/images/list-view.png")}}' : '{{ asset("admin-theme/assets/images/grid-view.png")}}';
        });

        // Search functionality
        $('#search-input').on('keyup', function() {
            const value = $(this).val().toLowerCase();
            $('#project-table tbody tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
            $('#project-grid > div').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
    });

    function toggleDotDropdown(event) {
        const dropdown = event.target.closest('td').querySelector('.dot-drop');
        document.querySelectorAll('.dot-drop').forEach(drop => drop.classList.add('hidden'));
        dropdown.classList.toggle('hidden');
    }
</script>
@endpush