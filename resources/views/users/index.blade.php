@extends('layouts.app')

@section('content')
<div class="p-6 lg:p-8">
    <div class="form-list">
        <div class="">
            <div class="flex flex-wrap">
                <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                    <h3 class="manrope-medium text-[#344563] text-[18px] mt-[17px]">
                        User - {{ $userCount ?? '10' }}
                    </h3>
                </div>
                <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                    <div class="table-filter lg:float-right md:float-right sm:float-left xs:float-left">
                        <ul class="list-inline list-unstyled flex">
                            <li class="list-inline-item mr-[15px]">
                                <button
                                    class="flex manrope-medium bg-[#437651] select-shadow btn rounded-[8px] py-[10px] px-[25px] text-[14px] border-[1px] border-solid border-[#437651] text-white"
                                    onclick="toggleModal('createUserModal')">
                                    <span class="mr-[10px]">
                                        <img src="{{ asset('admin-theme/assets/images/add.png') }}" class="w-[15px] mt-[2px]">
                                    </span> Add New
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="table-filter-block mt-[20px]">
            <div class="flex justify-end">
                <p class="flex items-center mr-[8px]">
                    <div x-data="{ open: false, search: '', selected: 'User', options: ['User 1', 'User 2', 'User 3', 'User 4'], selectedOptions: [] }" class="relative">
                        <button @click="open = !open" class="p-2 bg-white focus:outline-none w-[100px] text-left manrope-medium font-medium text-[#6a6a75] text-[14px] border-[1px] border-solid border-[#bfbfbf] rounded-[10px] filter-buttons">
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
                <p class="flex items-center mr-[8px]">
                    <div x-data="{ open: false, search: '', selected: 'Company', options: ['Digital Horizon Systems', 'ByteCore Technologies', 'London Technova Solutions'], selectedOptions: [] }" class="relative">
                        <button @click="open = !open" class="p-2 bg-white focus:outline-none w-[120px] text-left manrope-medium font-medium text-[#6a6a75] text-[14px] border-[1px] border-solid border-[#bfbfbf] rounded-[10px] filter-buttons">
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
                <p class="flex items-center mr-[8px] ml-[8px]">
                    <input autocomplete="off" name="daterange" placeholder="Date" class="w-[240px] manrope-medium text-[#6a6a75] text-[15px] p-2 focus-visible:outline-none placeholder-[#6a6a75] border-[1px] border-solid border-[#bfbfbf] rounded-[10px] filter-buttons">
                </p>
                <p class="flex items-center mr-[8px]">
                    <div x-data="{ open: false, search: '', selected: 'Project', options: ['Project 1', 'Project 2', 'Project 3', 'Project 4'], selectedOptions: [] }" class="relative">
                        <button @click="open = !open" class="p-2 bg-white focus:outline-none w-[120px] text-left manrope-medium font-medium text-[#6a6a75] text-[14px] border-[1px] border-solid border-[#bfbfbf] rounded-[10px] filter-buttons">
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
                <p class="flex items-center mr-[8px]">
                    <div x-data="{ open: false, search: '', selected: 'User Id', options: ['#48964778', '#48964778', '#48964778', '#48964778'], selectedOptions: [] }" class="relative">
                        <button @click="open = !open" class="p-2 bg-white focus:outline-none w-[120px] text-left manrope-medium font-medium text-[#6a6a75] text-[14px] border-[1px] border-solid border-[#bfbfbf] rounded-[10px] filter-buttons">
                            <span x-text="selected"></span>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute mt-1 w-[250px] bg-white border border-gray-300 rounded-lg shadow-md manrope-medium font-medium text-[#6a6a75] text-[16px] z-[9]">
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
                <p class="flex items-center mr-[8px]">
                    <div x-data="{ open: false, search: '', selected: 'Status', options: ['Active', 'Inactive', 'Block'], selectedOptions: [] }" class="relative">
                        <button @click="open = !open" class="p-2 bg-white focus:outline-none w-[150px] text-left manrope-medium font-medium text-[#6a6a75] text-[14px] border-[1px] border-solid border-[#bfbfbf] rounded-[10px] filter-buttons">
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

        <!-- Table Section -->
        <div class="form-list-table">
            <div class="mt-[20px]">
                <div class="relative overflow-x-auto h-full">
                    {!! $dataTable->table(['class' => 'w-full text-sm text-left rtl:text-right'], true) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create User Modal -->
@include('users.add')
<!-- Edit User Modal -->
@include('users.edit')
<!-- Create Project Modal -->
@include('projects.add')
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

        // Modified toggleModal to handle userId for createProjectModal
        window.toggleModal = function(modalId, userId = null) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.toggle('hidden');
                // If opening createProjectModal and userId is provided, append hidden user_id input
                if (modalId === 'createProjectModal' && userId) {
                    const form = document.getElementById('createProjectForm');
                    // Remove existing user_id input to avoid duplicates
                    const existingInput = form.querySelector('input[name="user_id"]');
                    if (existingInput) {
                        existingInput.remove();
                    }
                    // Append new hidden input for user_id
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'user_id';
                    hiddenInput.value = userId;
                    form.appendChild(hiddenInput);
                }
            }
        };

        // Map provided modal function names to toggleModal
        window.toggleModalu = function() {
            toggleModal('createUserModal');
        };

        window.toggleModalp = function(userId = null) {
            toggleModal('createProjectModal', userId);
        };
    });
</script>
@endpush