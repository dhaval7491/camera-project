@extends('layouts.app')

@section('content')
<div class="pl-[30px]">
    <div class="form-list">
        <div class="">
            <div class="flex flex-wrap">
                <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                    <h3 class="manrope-medium text-[#344563] text-[18px] mt-[10px]">
                        <p class="inline-block manrope-medium text-[15px] px-[0px] mt-[10px] mr-[15px] text-[#437651] underline">
                            < Back</p> All Companies
                    </h3>
                </div>
                <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                    <div class="table-filter lg:float-right md:float-right sm:float-left xs:float-left">
                        <ul class="list-inline list-unstyled flex">
                            <li class="list-inline-item mr-[15px]">
                                <button
                                    class="flex manrope-medium bg-[#3D3D3D] select-shadow btn rounded-[8px] py-[10px] px-[25px] text-[14px] border-[1px] border-solid border-[#3D3D3D] text-white"
                                    onclick="toggleModal('createCompanyModal')">
                                    <span class="mr-[10px]"><img src="{{ asset('admin-theme/assets/images/add.png')}}" class="w-[15px] mt-[2px]"></span> Add New
                                </button>
                            </li>
                            <li class="list-inline-item mr-[15px]">
                                <div class="relative flex items-center">
                                    <input type="text" id="search-input"
                                        class="w-0 p-0 border border-[#EBEBEB] rounded-[11px] absolute right-[19px] z-[8] transition-all duration-300 overflow-hidden bg-white"
                                        placeholder="Search...">
                                    <button id="search-toggle"
                                        class="p-[13px] rounded-[7px] border border-[#EBEBEB] ml-2 z-[9] w-[16px]">
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

        <!-- Filter Section -->
        <div class="table-filter-block mt-[20px]">
            <div class="flex">
                <p class="flex items-center w-[150px] manrope-medium text-[#000] text-[16px]">
                    <img class="w-[20px] object-contain mr-[10px]" src="{{ asset('admin-theme/assets/images/filter-by.png')}}"> Filter By:
                </p>
                <p class="flex items-center">
                    <img class="w-[40px] h-[40px] object-contain mr-[5px] border-[#EBEBEB] border-[1px] border-solid p-[10px] rounded-[16px]" src="{{ asset('admin-theme/assets/images/fil-company.png')}}">
                <div x-data="{ open: false, search: '', selected: 'Digital Horizon Systems', options: ['Digital Horizon Systems', 'ByteCore Technologies', 'London Technova Solutions'], selectedOptions: [] }" class="relative">
                    <button @click="open = !open" class="p-2 bg-white focus:outline-none w-[200px] text-left manrope-medium font-medium text-[#6a6a75] text-[14px]">
                        <span x-text="selected"></span>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute mt-1 w-[300px] bg-white border border-gray-300 rounded-lg shadow-md manrope-medium font-medium text-[#6a6a75] text-[16px] z-[9]">
                        <input type="text" x-model="search" placeholder="Search..." class="w-full p-2 border-b border-gray-300 focus:outline-none">
                        <ul class="max-h-40 overflow-y-auto">
                            <template x-for="option in options.filter(o => o.toLowerCase().includes(search.toLowerCase()))" :key="option">
                                <li class="p-2 flex items-center space-x-2 hover:bg-gray-100 cursor-pointer">
                                    <input type="checkbox" :value="option" x-model="selectedOptions" class="cursor-pointer">
                                    <span x-text="option"></span>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
                </p>
                <!-- Other filter dropdowns (People, Date, Location, Status) -->
                <p class="flex items-center">
                    <img class="w-[40px] h-[40px] object-contain mr-[5px] border-[#EBEBEB] border-[1px] border-solid p-[7px] rounded-[16px]" src="{{ asset('admin-theme/assets/images/filter-user.png')}}">
                <div x-data="{ open: false, search: '', selected: 'People', options: ['People 1', 'People 2', 'People 3', 'People 4'], selectedOptions: [] }" class="relative">
                    <button @click="open = !open" class="p-2 bg-white focus:outline-none w-[100px] text-left manrope-medium text-[#6a6a75] text-[15px]">
                        <span x-text="selected"></span>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute mt-1 w-[150px] bg-white border border-gray-300 rounded-lg shadow-md manrope-medium font-medium text-[#6a6a75] text-[16px] z-[9]">
                        <input type="text" x-model="search" placeholder="Search..." class="w-full p-2 border-b border-gray-300 focus:outline-none">
                        <ul class="max-h-40 overflow-y-auto">
                            <template x-for="option in options.filter(o => o.toLowerCase().includes(search.toLowerCase()))" :key="option">
                                <li class="p-2 flex items-center space-x-2 hover:bg-gray-100 cursor-pointer">
                                    <input type="checkbox" :value="option" x-model="selectedOptions" class="cursor-pointer">
                                    <span x-text="option"></span>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
                </p>
                <p class="flex items-center">
                    <img class="w-[40px] h-[40px] object-contain mr-[5px] border-[#EBEBEB] border-[1px] border-solid p-[7px] rounded-[16px]" src="{{ asset('admin-theme/assets/images/drop-cal.png')}}">
                    <input autocomplete="off" name="daterange" placeholder="Date" class="w-[240px] manrope-medium text-[#6a6a75] text-[15px] border-none p-2 focus-visible:outline-none placeholder-[#6a6a75]">
                </p>
                <p class="flex items-center">
                    <img class="w-[40px] object-contain mr-[5px] border-[#EBEBEB] border-[1px] border-solid p-[10px] rounded-[16px]" src="{{ asset('admin-theme/assets/images/location.png')}}">
                <div x-data="{ open: false, search: '', selected: 'Location', options: ['London', 'Canada', 'India', 'USA'], selectedOptions: [] }" class="relative">
                    <button @click="open = !open" class="p-2 bg-white focus:outline-none w-[100px] text-left manrope-medium text-[#6a6a75] text-[15px]">
                        <span x-text="selected"></span>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute mt-1 w-[150px] bg-white border border-gray-300 rounded-lg shadow-md manrope-medium font-medium text-[#6a6a75] text-[16px] z-[9]">
                        <input type="text" x-model="search" placeholder="Search..." class="w-full p-2 border-b border-gray-300 focus:outline-none">
                        <ul class="max-h-40 overflow-y-auto">
                            <template x-for="option in options.filter(o => o.toLowerCase().includes(search.toLowerCase()))" :key="option">
                                <li class="p-2 flex items-center space-x-2 hover:bg-gray-100 cursor-pointer">
                                    <input type="checkbox" :value="option" x-model="selectedOptions" class="cursor-pointer">
                                    <span x-text="option"></span>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
                </p>
                <p class="flex items-center">
                    <img class="w-[40px] h-[40px] object-contain mr-[5px] border-[#EBEBEB] border-[1px] border-solid p-[10px] rounded-[16px]" src="{{ asset('admin-theme/assets/images/status-filter.png')}}">
                <div x-data="{ open: false, search: '', selected: 'Status', options: ['Active', 'Inactive', 'Blocked'], selectedOptions: [] }" class="relative">
                    <button @click="open = !open" class="p-2 bg-white focus:outline-none w-[150px] text-left manrope-medium text-[#6a6a75] text-[15px]">
                        <span x-text="selected"></span>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute mt-1 w-[150px] bg-white border border-gray-300 rounded-lg shadow-md manrope-medium font-medium text-[#6a6a75] text-[16px] z-[9]">
                        <input type="text" x-model="search" placeholder="Search..." class="w-full p-2 border-b border-gray-300 focus:outline-none">
                        <ul class="max-h-40 overflow-y-auto">
                            <template x-for="option in options.filter(o => o.toLowerCase().includes(search.toLowerCase()))" :key="option">
                                <li class="p-2 flex items-center space-x-2 hover:bg-gray-100 cursor-pointer">
                                    <input type="checkbox" :value="option" x-model="selectedOptions" class="cursor-pointer">
                                    <span x-text="option"></span>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
                </p>
            </div>
        </div>

        <!-- Table Section -->
        <div class="form-list-table">
            <div class="mt-[20px]">
                <div class="relative overflow-x-scroll h-full">
                    <table id="companies-table" class="min-w-full leading-normal w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 whitespace-nowrap">
                        <thead class="bg-[#e6e6e6]">
                            <tr>
                                <th class="px-6 py-3 manrope-regular text-[#3D3D3D] text-[16px]">Name of Companies</th>
                                <th class="px-6 py-3 text-center manrope-regular text-[#3D3D3D] text-[15px]">Date Created</th>
                                <th class="px-6 py-3 text-center manrope-regular text-[#3D3D3D] text-[15px]">Location</th>
                                <th class="px-6 py-3 text-center manrope-regular text-[#3D3D3D] text-[15px]">Status</th>
                                <th class="px-6 py-3 text-center manrope-regular text-[#3D3D3D] text-[15px] min-w-[20%]">People</th>
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
        <!-- <div class="form-list-table">
            <div class="mt-[20px]">
                <div class="relative overflow-x-scroll h-full">
                    <table class="min-w-full leading-normal w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 whitespace-nowrap">
                        <thead class="bg-[#e6e6e6]">
                            <tr>
                                <th class="px-6 py-3 manrope-regular text-[#3D3D3D] text-[16px]">Name of Companies</th>
                                <th class="px-6 py-3 text-center manrope-regular text-[#3D3D3D] text-[15px]">Date Created</th>
                                <th class="px-6 py-3 text-center manrope-regular text-[#3D3D3D] text-[15px]">Location</th>
                                <th class="px-6 py-3 text-center manrope-regular text-[#3D3D3D] text-[15px]">Status</th>
                                <th class="px-6 py-3 text-center manrope-regular text-[#3D3D3D] text-[15px] min-w-[20%]">People</th>
                                <th class="px-6 py-3 text-center manrope-regular text-[#3D3D3D] text-[15px]">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6" class="manrope-medium text-[#8791A3] text-[16px] py-[17px] px-[0px]">This Week</td>
                            </tr>
                            <tr class="bg-white transition duration-300 ease-in-out hover:bg-[#ededed]">
                                <th scope="row" class="px-[20px] py-[20px] text-gray-900 whitespace-nowrap flex">
                                    <div class="">
                                        <span class="text-center inline-block w-[47px] h-[47px] mr-[10px] text-[18px] bg-gradient-to-b from-[#844EBC] to-[#AA55AA] text-[#fff] manrope-semibold rounded-[6px] py-[10px] px-[10px]">DH</span>
                                    </div>
                                    <div class="text-[#344563] text-[15px] manrope-regular cursor-pointer mt-[10px]" onclick="document.location='project.html'">
                                        Digital Horizon Systems
                                    </div>
                                </th>
                                <td class="px-[20px] py-[20px] text-center text-[#344563] text-[16px] manrope-medium">Jan 08 - 2024</td>
                                <td class="px-[20px] py-[20px] text-center text-[#344563] text-[16px] manrope-medium">London</td>
                                <td class="px-[20px] py-[20px] text-center">
                                    <button class="table-status w-[90px] bg-[#047413] text-white rounded-[7px] py-1 px-4 text-sm font-medium cursor-pointer">
                                        Active
                                    </button>
                                </td>
                                <td>
                                    <div class="people-profile flex justify-center">
                                        <img src="{{ asset('admin-theme/assets/images/people-1.png')}}" class="w-[30px] h-[30px] object-contain">
                                        <img src="{{ asset('admin-theme/assets/images/people-2.png')}}" class="ml-[-10px]">
                                        <img src="{{ asset('admin-theme/assets/images/people-3.png')}}" class="ml-[-10px]">
                                        <img src="{{ asset('admin-theme/assets/images/people-4.png')}}" class="ml-[-10px]">
                                        <span class="bg-[#437651] text-white w-[30px] h-[30px] rounded-[20px] p-[5px] manrope-medium">2+</span>
                                    </div>
                                </td>
                                <td class="flex justify-center relative">
                                    <span>
                                        <a href="#"><img src="{{ asset('admin-theme/assets/images/edit-report.png')}}" class="w-[21px] mr-[20px]" onclick="toggleModal('createCompanyModal')"></a>
                                    </span>
                                    <span>
                                        <a href="crane.html"><img src="{{ asset('admin-theme/assets/images/live.png')}}" class="w-[23px] mr-[20px]"></a>
                                    </span>
                                    <span class="mt-[8px]">
                                        <a href="#"><img src="{{ asset('admin-theme/assets/images/table-menu.png')}}" class="w-[23px] mr-[20px]" onclick="toggleDotDropdown(event)"></a>
                                    </span>
                                    <div class="dot-drop absolute bg-white tab-shadow rounded-md hidden top-[30px] right-[60px] w-[170px] p-[10px] z-[8]">
                                        <ul>
                                            <li class="py-[5px]">
                                                <a href="#" class="flex text-[#344563] text-[16px] manrope-medium">
                                                    <img src="{{ asset('admin-theme/assets/images/project.png')}}" class="w-[16px] mr-[11px] object-contain">
                                                    <p onclick="toggleModalp()">Add Project</p>
                                                </a>
                                            </li>
                                            <li class="py-[5px]">
                                                <a href="#" class="flex text-[#344563] text-[16px] manrope-medium">
                                                    <img src="{{ asset('admin-theme/assets/images/add-people.png')}}" class="w-[16px] mr-[11px] object-contain">
                                                    <p>Add People</p>
                                                </a>
                                            </li>
                                            <li class="py-[5px]">
                                                <a href="#" class="flex text-[#344563] text-[16px] manrope-medium">
                                                    <img src="{{ asset('admin-theme/assets/images/delete.png')}}" class="w-[16px] mr-[11px] object-contain">
                                                    <p>Delete</p>
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
        </div> -->
    </div>
</div>

<!-- Create Company Modal -->
<x-modal id="createCompanyModal" title="Create a New Company" class="max-w-lg">
    <form method="POST" action="{{ route('companies.store') }}" enctype="multipart/form-data">
        @csrf
        <x-form-input
            label="Company Name"
            type="text"
            name="company_name"
            id="company_name"
            placeholder="Enter Company Name"
            class="text-[#7A86A1]" />
        @error('company_name')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <x-form-input
            label="Upload Logo"
            type="file"
            id="logo"
            name="logo" />
        @error('logo')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <x-form-input
            label="Location"
            type="text"
            name="location"
            id="location"
            placeholder="Enter Company Name"
            class="text-[#7A86A1]" />
        @error('location')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <p class="block text-[15px] manrope-medium text-[#000000] mb-[35px]">Admin Details</p>

        <x-form-input
            label="Admin Name"
            type="text"
            name="admin_name"
            id="admin_name"
            placeholder="Enter admin name"
            class="text-[#7A86A1]" />
        @error('admin_name')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <x-form-input
            label="Admin Mail ID"
            type="email"
            name="admin_email"
            id="admin_email"
            placeholder="Enter Admin Mail ID"
            class="text-[#7A86A1]" />
        @error('admin_email')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <x-form-input
            label="Admin Password"
            type="password"
            name="admin_password"
            id="admin_password"
            placeholder="Enter password"
            class="text-[#7A86A1]" />
        @error('admin_password')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <div class="text-right mt-[10px]">
            <button type="button" class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-white w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-[#7A86A1] mr-[5px] text-[14px] cursor-pointer" onclick="toggleModal('addcompany')">
                Cancel
            </button>
            <button type="submit" class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-[#3D3D3D] w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-white mr-[5px] text-[14px] cursor-pointer">
                Create
            </button>
        </div>
    </form>
</x-modal>
<!-- Edit Company Modal -->
<x-modal id="editCompanyModal" title="Edit Company" class="max-w-lg">
    <form method="POST" action="" id="editCompanyForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" id="edit_company_id">
        <x-form-input label="Company Name" type="text" name="company_name" id="edit_company_name" placeholder="Enter Company Name" class="text-[#7A86A1]" />
        <x-form-input label="Upload Logo" type="file" name="logo" id="edit_company_logo" />
        <x-form-input label="Location" type="text" name="location" id="edit_company_location" placeholder="Enter Company Location" class="text-[#7A86A1]" />
        <div class="text-right mt-[10px]">
            <button type="button" class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-white w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-[#7A86A1] mr-[5px] text-[14px] cursor-pointer" onclick="toggleModal('editCompanyModal')">
                Cancel
            </button>
            <button type="submit" class="rounded-[14px] border-[1px] border-[#EBEBEB] border-solid bg-[#3D3D3D] w-[120px] py-[6px] px-[5px] manrope-medium font-medium text-white mr-[5px] text-[14px] cursor-pointer">
                Update
            </button>
        </div>
    </form>
</x-modal>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        const table = $('#companies-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("companies.data") }}',
            columns: [{
                    data: null,
                    render: function(data, type, row) {
                        return `
                                <div class="flex">
                                    <span class="text-center inline-block w-[47px] h-[47px] mr-[10px] text-[18px] bg-gradient-to-b from-[#844EBC] to-[#AA55AA] text-[#fff] manrope-semibold rounded-[6px] py-[10px] px-[10px]">${row.initials}</span>
                                    <div class="text-[#344563] text-[15px] manrope-regular cursor-pointer mt-[10px]" onclick="document.location='project.html'">
                                        ${row.company_name}
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
                    data: 'location',
                    name: 'location',
                    className: 'text-center text-[#344563] text-[16px] manrope-medium'
                },
                {
                    data: 'status',
                    name: 'status',
                    className: 'text-center'
                },
                {
                    data: 'people',
                    name: 'people',
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
        // Reopen modal if there are validation errors
        @if($errors -> any())
        toggleModal('createCompanyModal');
        @endif
        window.toggleCompanyStatus = function(companyId) {
            $.ajax({
                url: '{{ url("companies") }}/' + companyId + '/toggle-active',
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

    function showEditModal(companyId) {
        const companies = @json($companies);
        const company = companies.find(c => c.id === companyId);

        if (company) {
            document.getElementById('edit_company_id').value = company.id;
            document.getElementById('edit_company_name').value = company.company_name;
            document.getElementById('edit_company_location').value = company.location;
            document.getElementById('editCompanyForm').action = '{{ url("companies") }}/' + company.id;
            toggleModal('editCompanyModal');
        }
    }
</script>
@endpush