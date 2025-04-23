@extends('layouts.app')

@section('content')
<div class="p-6 lg:p-8">
    <div class="form-list">
        <div class="">
            <div class="flex flex-wrap">
                <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                    <h3 class="manrope-medium text-[#344563] text-[18px] mt-[10px]">
                        <a href="#" class="inline-block manrope-medium text-[15px] px-[0px] mt-[10px] mr-[15px] text-[#437651] underline">← Back</a> All Users
                    </h3>
                </div>
                <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                    <div class="table-filter lg:float-right md:float-right sm:float-left xs:float-left">
                        <ul class="list-inline list-unstyled flex">
                            <li class="list-inline-item mr-[15px]">
                                <button
                                    class="flex manrope-medium bg-[#3D3D3D] select-shadow btn rounded-[8px] py-[10px] px-[25px] text-[14px] border-[1px] border-solid border-[#3D3D3D] text-white"
                                    onclick="toggleModal('createUserModal')">
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
                    <div x-data="{ open: false, search: '', selected: 'Company', options: ['Digital Horizon Systems', 'ByteCore Technologies', 'London Technova Solutions'], selectedOptions: [] }" class="relative">
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
                <p class="flex items-center">
                    <img class="w-[40px] h-[40px] object-contain mr-[5px] border-[#EBEBEB] border-[1px] border-solid p-[7px] rounded-[16px]" src="{{ asset('admin-theme/assets/images/project-filter.png')}}">
                    <div x-data="{ open: false, search: '', selected: 'Project', options: ['Project 1', 'Project 2', 'Project 3', 'Project 4'], selectedOptions: [] }" class="relative">
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
                <p class="flex items-center">
                    <img class="w-[40px] h-[40px] object-contain mr-[5px] border-[#EBEBEB] border-[1px] border-solid p-[7px] rounded-[16px]" src="{{ asset('admin-theme/assets/images/status-filter.png')}}">
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
                    {!! $dataTable->table(['class' => 'table table-bordered table-striped'], true) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create User Modal -->
@include('users.add')
<!-- Edit User Modal -->
@include('users.edit')

@endsection

@push('scripts')
{!! $dataTable->scripts() !!}
<script>
    $(document).ready(function() {
        let table = $('#user-table').DataTable();

        // Reopen modal if there are validation errors
        @if($errors->any())
        toggleModal('createUserModal');
        @endif

        window.toggleUserStatus = function(userId) {
            $.ajax({
                url: '{{ url("users") }}/' + userId + '/toggle-active',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        table.ajax.reload(null, false);
                    }
                },
                error: function(xhr) {
                    console.error('Error toggling status:', xhr);
                    alert('Failed to update status');
                }
            });
        };

        // Fetch user data and populate edit modal
        window.showEditModal = function(userId) {
            $.ajax({
                url: '{{ url("users") }}/' + userId + '/edit',
                method: 'GET',
                success: function(response) {
                    // Populate the edit modal fields
                    $('#edit_user_id').val(response.id);
                    $('#edit_user_name').val(response.user_name);
                    $('#edit_email').val(response.email);
                    $('#edit_company_id').val(response.company_id);
                    $('#edit_project_id').val(response.project_id);
                    $('#edit_location').val(response.location);
                    $('#edit_access_level').val(response.access_level);
                    $('#editUserForm').attr('action', '{{ url("users") }}/' + response.id);
                    if (response.image) {
                        $('#edit_user_image').after(`<div><img src="${response.image}" alt="Current Image" class="w-32 h-32 object-contain"></div>`);
                    }

                    // Open the edit modal
                    toggleModal('editUserModal');
                },
                error: function(xhr) {
                    console.error('Error fetching user data:', xhr);
                    alert('Failed to load user data');
                }
            });
        };
    });
</script>
@endpush