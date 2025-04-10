@extends('layouts.app')
@section('content')
<div class="pl-[30px]">
    <div class="form-list">
        <div class="">
            <div class="flex flex-wrap">
                <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                    <h3 class="manrope-medium text-[#344563] text-[18px] mt-[10px]">
                        <p class="inline-block manrope-medium text-[15px] px-[0px] mt-[10px] mr-[15px] text-[#437651] underline">
                            < Back</p>All Projects
                    </h3>
                </div>
                <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                    <div class="table-filter lg:float-right md:float-right sm:float-left xs:float-left">
                        <ul class="list-inline list-unstyled flex">
                            <li class="list-inline-item mr-[15px]">
                                <button
                                    class="flex manrope-medium bg-[#3D3D3D] select-shadow btn rounded-[8px] py-[10px] px-[25px] text-[14px] border-[1px] border-solid border-[#3D3D3D] text-white"
                                    onclick="toggleModal('createProjectModal')">
                                    <span class="mr-[10px]"><img src="{{ asset('admin-theme/assets/images/add.png') }}" class="w-[15px] mt-[2px]"></span> Add New
                                </button>
                            </li>
                            <li class="list-inline-item mr-[15px]">
                                <div class="relative flex items-center">
                                    <!-- Search Input -->
                                    <input type="text" id="search-input"
                                        class="w-0 p-0 border border-[#EBEBEB] rounded-[11px] absolute right-[19px] z-[8] transition-all duration-300 overflow-hidden bg-white"
                                        placeholder="Search...">

                                    <!-- Search Button -->
                                    <button id="search-toggle"
                                        class="p-[13px] rounded-[15px] border border-[#EBEBEB] ml-2 z-[9] bg-white">
                                        <img src="{{ asset('admin-theme/assets/images/table-search.png') }}" class="w-[16px]">
                                    </button>
                                </div>
                            </li>
                            <li class="list-inline-item mr-[15px]">
                                <input autocomplete="off" name="daterange" placeholder="This Month" class="calendar-bg manrope-medium select-shadow border-solder border-[1px] border-[#E9EDF0] w-[240px] py-[10px] pr-[5px] pl-[35px] rounded-[11px] text-[#344563] text-[14px] placeholder:text-[#344563]">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-filter-block mt-[20px]">
            <div class="flex">
                <p class="flex items-center w-[150px] manrope-medium font-medium text-[#6a6a75] text-[16px]"><img class="w-[20px] object-contain mr-[10px]" src="{{ asset('admin-theme/assets/images/filter-by.png') }}"> Filter By:</p>
                <p class="flex items-center ">
                    <img class="w-[40px] object-contain mr-[5px] border-[#EBEBEB] border-[1px] border-solid p-[7px] rounded-[16px]" src="{{ asset('admin-theme/assets/images/filter-user.png') }}">
                <div x-data="{ open: false, search: '', selected: 'Digital Horizon Systems', options: ['Digital Horizon Systems', 'ByteCore Technologies', 'London Technova Solutions'] , selectedOptions: []}" class="relative ">
                    <button @click="open = !open" class=" p-2 bg-white focus:outline-none w-[200px] text-left manrope-medium font-medium text-[#6a6a75] text-[14px]">
                        <span x-text="selected"></span>
                    </button>

                    <div x-show="open" @click.away="open = false" class="absolute mt-1 w-[300px] bg-white border border-gray-300 rounded-lg shadow-md manrope-medium font-medium text-[#6a6a75] text-[16px] z-[9]">
                        <input type="text" x-model="search" placeholder="Search..."
                            class="w-full p-2 border-b border-gray-300 focus:outline-none">
                        <ul class="max-h-40 overflow-y-auto">
                            <template x-for="option in options.filter(o => o.toLowerCase().includes(search.toLowerCase()))" :key="option">
                                <li class="p-2 flex items-center space-x-2 hover:bg-gray-100 cursor-pointer">
                                    <input type="checkbox"
                                        :value="option"
                                        x-model="selectedOptions"
                                        class="cursor-pointer">
                                    <span x-text="option"></span>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
                </p>
                <p class="flex items-center ">
                    <img class="w-[40px] object-contain mr-[5px] border-[#EBEBEB] border-[1px] border-solid p-[7px] rounded-[16px]" src="{{ asset('admin-theme/assets/images/filter-user.png') }}">
                <div x-data="{ open: false, search: '', selected: 'People', options: ['people 1', 'People 2', 'People 3', 'People 4'] , selectedOptions: []}" class="relative ">
                    <button @click="open = !open" class=" p-2 bg-white focus:outline-none w-[100px] text-left manrope-medium font-medium text-[#6a6a75] text-[14px]">
                        <span x-text="selected"></span>
                    </button>

                    <div x-show="open" @click.away="open = false" class="absolute mt-1 w-[150px] bg-white border border-gray-300 rounded-lg shadow-md manrope-medium font-medium text-[#6a6a75] text-[16px] z-[9]">
                        <input type="text" x-model="search" placeholder="Search..."
                            class="w-full p-2 border-b border-gray-300 focus:outline-none">
                        <ul class="max-h-40 overflow-y-auto">
                            <template x-for="option in options.filter(o => o.toLowerCase().includes(search.toLowerCase()))" :key="option">
                                <li class="p-2 flex items-center space-x-2 hover:bg-gray-100 cursor-pointer">
                                    <input type="checkbox"
                                        :value="option"
                                        x-model="selectedOptions"
                                        class="cursor-pointer">
                                    <span x-text="option"></span>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
                </p>
                <p class="flex items-center">
                    <img class="w-[40px] object-contain mr-[5px] border-[#EBEBEB] border-[1px] border-solid p-[7px] rounded-[16px]" src="{{ asset('admin-theme/assets/images/drop-cal.png') }}">
                    <input autocomplete="off" name="daterange" placeholder="Date" class="w-[240px] manrope-medium border-none p-2 text-[#6a6a75] text-[14px] focus-visible:outline-none placeholder-[#6a6a75]">
                </p>
                <p class="flex items-center">
                    <img class="w-[40px] object-contain mr-[5px] border-[#EBEBEB] border-[1px] border-solid p-[7px] rounded-[16px]" src="{{ asset('admin-theme/assets/images/location.png') }}">
                <div x-data="{ open: false, search: '', selected: 'Location', options: ['London', 'Canada', 'India', 'USA'] , selectedOptions: []}" class="relative ">
                    <button @click="open = !open" class=" p-2 bg-white focus:outline-none w-[100px] text-left manrope-medium font-medium text-[#6a6a75] text-[14px]">
                        <span x-text="selected"></span>
                    </button>

                    <div x-show="open" @click.away="open = false" class="absolute mt-1 w-[150px] bg-white border border-gray-300 rounded-lg shadow-md manrope-medium font-medium text-[#6a6a75] text-[16px] z-[9]">
                        <input type="text" x-model="search" placeholder="Search..."
                            class="w-full p-2 border-b border-gray-300 focus:outline-none">
                        <ul class="max-h-40 overflow-y-auto">
                            <template x-for="option in options.filter(o => o.toLowerCase().includes(search.toLowerCase()))" :key="option">
                                <li class="p-2 flex items-center space-x-2 hover:bg-gray-100 cursor-pointer">
                                    <input type="checkbox"
                                        :value="option"
                                        x-model="selectedOptions"
                                        class="cursor-pointer">
                                    <span x-text="option"></span>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
                </p>
                <p class="flex items-center">
                    <img class="w-[40px] object-contain mr-[5px] border-[#EBEBEB] border-[1px] border-solid p-[7px] rounded-[16px]" src="{{ asset('admin-theme/assets/images/status-filter.png') }}">
                <div x-data="{ open: false, search: '', selected: 'Status', options: ['Active', 'Inactive', 'Blocked'] , selectedOptions: []}" class="relative ">
                    <button @click="open = !open" class=" p-2 bg-white focus:outline-none w-[150px] text-left manrope-medium font-medium text-[#6a6a75] text-[14px]">
                        <span x-text="selected"></span>
                    </button>

                    <div x-show="open" @click.away="open = false" class="absolute mt-1 w-[150px] bg-white border border-gray-300 rounded-lg shadow-md manrope-medium font-medium text-[#6a6a75] text-[16px] z-[9]">
                        <input type="text" x-model="search" placeholder="Search..."
                            class="w-full p-2 border-b border-gray-300 focus:outline-none">
                        <ul class="max-h-40 overflow-y-auto">
                            <template x-for="option in options.filter(o => o.toLowerCase().includes(search.toLowerCase()))" :key="option">
                                <li class="p-2 flex items-center space-x-2 hover:bg-gray-100 cursor-pointer">
                                    <input type="checkbox"
                                        :value="option"
                                        x-model="selectedOptions"
                                        class="cursor-pointer">
                                    <span x-text="option"></span>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
                </p>
            </div>
        </div>
        <div class="form-list-table">
            <div class="mt-[20px]">
                <div class="relative overflow-x-scroll h-full">
                    <table id="projects-table" class="min-w-full leading-normal w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 whitespace-nowrap">
                        <thead class="bg-[#e6e6e6]">
                            <tr>
                                <th class="px-6 py-3 manrope-regular text-[#3D3D3D] text-[16px]">Name of project</th>
                                <th class="px-6 py-3 text-center manrope-regular text-[#3D3D3D] text-[15px]">Date Created</th>
                                <th class="px-6 py-3 text-center manrope-regular text-[#3D3D3D] text-[15px]">Company Name</th>
                                <th class="px-6 py-3 text-center manrope-regular text-[#3D3D3D] text-[15px]">Plant</th>
                                <th class="px-6 py-3 text-center manrope-regular text-[#3D3D3D] text-[15px]">Status</th>
                                <th class="px-6 py-3 text-center manrope-regular text-[#3D3D3D] text-[15px]">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be populated by DataTables -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<x-modal id="createProjectModal" title="Create a New Project" class="max-w-lg">
    <form method="POST" action="{{ route('projects.store') }}" enctype="multipart/form-data">
        @csrf
        <x-form-input
            label="Project Name"
            type="text"
            name="name"
            placeholder="Enter project name"
            class="text-[#7A86A1]" />

        <x-form-input
            label="Company Name"
            type="select"
            name="company_id"
            :options="$companies" />

        <x-form-input
            label="Location"
            type="text"
            name="location"
            placeholder="Enter location"
            class="text-[#7A86A1]" />

        <x-form-input
            label="Add Plant"
            type="text"
            name="plant_name"
            placeholder="Enter Plant Name"
            class="text-[#7A86A1]" />

        <div class="text-right mt-[100px]">
            <button type="button" class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-white w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-[#7A86A1] mr-[5px] text-[14px] cursor-pointer" onclick="toggleModalp()">
                Cancel
            </button>
            <button type="submit" class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-[#3D3D3D] w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-white mr-[5px] text-[14px] cursor-pointer">
                Create
            </button>
        </div>
    </form>
</x-modal>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        const table = $('#projects-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("projects.data") }}',
            columns: [{
                    data: null,
                    render: function(data, type, row) {
                        return `
                                <div class="flex">
                                    <span class="text-center inline-block w-[47px] h-[47px] mr-[10px] text-[18px] bg-gradient-to-b from-[#844EBC] to-[#AA55AA] text-[#fff] manrope-semibold rounded-[6px] py-[10px] px-[10px]">${row.initials}</span>
                                    <div class="text-[#344563] text-[15px] manrope-regular cursor-pointer mt-[10px]" onclick="document.location='project.html'">
                                        ${row.name}
                                    </div>
                                </div>`;
                    }
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    className: 'text-center text-[#344563] text-[16px] manrope-medium'
                },
                {
                    data: 'company_name',
                    name: 'location',
                    className: 'text-center text-[#344563] text-[16px] manrope-medium'
                },
                {
                    data: 'plant_name',
                    name: 'location',
                    className: 'text-center text-[#344563] text-[16px] manrope-medium'
                },
                {
                    data: 'status',
                    name: 'status',
                    className: 'text-center'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                }
            ],
            pageLength: 10, // Number of rows per page
            language: {
                search: "", // Remove the "Search" label
                searchPlaceholder: "Search...", // Add placeholder to the search input
            }
        });
        window.toggleProjectStatus = function(projectId) {
            $.ajax({
                url: '{{ url("projects") }}/' + projectId + '/toggle-active',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        table.ajax.reload(null, false); // Reload table data without resetting pagination
                    }
                },
                error: function(xhr) {
                    console.error('Error toggling status:', xhr);
                    alert('Failed to update status');
                }
            });
        };
    });
</script>
@endpush