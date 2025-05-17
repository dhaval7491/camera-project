@extends('layouts.app')

@section('content')
<div class="company-table">
    <div class="form-list">
        <div class="">
            <div class="flex flex-wrap">
                <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                    <h3 class="manrope-medium text-[#344563] text-[18px] mt-[17px]">All Projects</h3>
                </div>
                <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                    <div class="table-filter lg:float-right md:float-right sm:float-left xs:float-left">
                        <ul class="list-inline list-unstyled flex">
                            <li class="list-inline-item mr-[15px]">
                                <button
                                    class="flex manrope-medium bg-[#437651] select-shadow btn rounded-[8px] py-[10px] px-[25px] text-[14px] border-[1px] border-solid border-[#437651] text-white"
                                    onclick="toggleModal('createProjectModal')">
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
                    <div class="relative flex items-center">
                        <!-- Search Input -->
                        <input type="text" id="search-input"
                            class="w-0 p-0 border border-[#EBEBEB] rounded-[11px] absolute right-[19px] z-[8] transition-all duration-300 overflow-hidden bg-white"
                            placeholder="Search...">
                        <!-- Search Button -->
                        <button id="search-toggle"
                            class="p-[11px] rounded-[15px] border border-[#EBEBEB] ml-2 z-[9] bg-white">
                            <img src="{{ asset('admin-theme/assets/images/table-search.png') }}" class="w-[16px]">
                        </button>
                    </div>
                </p>
                <p class="flex items-center mr-[8px]">
                    <div x-data="{ open: false, search: '', selected: 'Digital Horizon Systems', options: ['Digital Horizon Systems', 'ByteCore Technologies', 'London Technova Solutions'], selectedOptions: [] }" class="relative">
                        <button @click="open = !open" class="p-2 bg-white focus:outline-none w-[200px] text-left manrope-medium font-medium text-[#6a6a75] text-[14px] border-[1px] border-solid border-[#bfbfbf] rounded-[10px] filter-buttons">
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
                <p class="flex items-center mr-[6px] ml-[8px]">
                    <input autocomplete="off" name="daterange" placeholder="Date" class="w-[240px] manrope-medium p-2 text-[#6a6a75] text-[14px] focus-visible:outline-none placeholder-[#6a6a75] border-[1px] border-solid border-[#bfbfbf] rounded-[10px] filter-buttons">
                </p>
                <p class="flex items-center mr-[8px]">
                    <div x-data="{ open: false, search: '', selected: 'Plant', options: ['London', 'Canada', 'India', 'USA'], selectedOptions: [] }" class="relative">
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
                    <div x-data="{ open: false, search: '', selected: 'Status', options: ['Active', 'Inactive', 'Blocked'], selectedOptions: [] }" class="relative">
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
                    {!! $dataTable->table(['class' => 'table table-bordered table-striped w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400'], true) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Project Modal -->
@include('projects.add')
<!-- Create Equipment Modal -->
@include('equipments.add')
<!-- Edit Project Modal -->
@include('projects.edit')
<!-- Add Trackable Modal -->
@include('trackables.add')
<!-- Add User Modal -->
@include('users.add')
@endsection

@push('scripts')
{!! $dataTable->scripts() !!}
<script>
    $(document).ready(function() {
        let table = $('#projects-table').DataTable();

        // Search input toggle
        $('#search-toggle').click(function() {
            const $input = $('#search-input');
            if ($input.width() === 0) {
                $input.css('width', '200px').css('padding', '8px 16px').focus();
            } else {
                $input.css('width', '0').css('padding', '0');
            }
        });

        // Reopen modal if there are validation errors
        @if($errors->any())
        toggleModal('createProjectModal');
        @endif

        // Toggle dot dropdown for actions
        window.toggleDotDropdown = function(event) {
            const dropdown = event.target.closest('td').querySelector('.dot-drop');
            dropdown.classList.toggle('hidden');
        };

        window.toggleProjectStatus = function(projectId) {
            $.ajax({
                url: '{{ url("projects") }}/' + projectId + '/toggle-active',
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

        // Fetch project data and populate edit modal
        window.showEditModal = function(projectId) {
            $.ajax({
                url: '{{ url("projects") }}/' + projectId + '/edit',
                method: 'GET',
                success: function(response) {
                    // Populate the edit modal fields
                    $('#edit_project_id').val(response.id);
                    $('#edit_project_name').val(response.name);
                    $('#edit_project_company_id').val(response.company_id);
                    $('#edit_location').val(response.location);
                    $('#edit_plant_name').val(response.plant_name);
                    $('#editProjectForm').attr('action', '{{ url("projects") }}/' + response.id);

                    // Open the edit modal
                    toggleModal('editProjectModal');
                },
                error: function(xhr) {
                    console.error('Error fetching project data:', xhr);
                    alert('Failed to load project data');
                }
            });
        };

        // Modified toggleModal to handle projectId for createTrackableModal
        window.toggleModal = function(modalId, projectId = null) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.toggle('hidden');
                // If opening createTrackableModal and projectId is provided, append hidden project_id input
                if (modalId === 'createTrackableModal' && projectId) {
                    const form = document.getElementById('createTrackableForm');
                    // Remove existing project_id input to avoid duplicates
                    const existingInput = form.querySelector('input[name="project_id"]');
                    if (existingInput) {
                        existingInput.remove();
                    }
                    // Append new hidden input for project_id
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'project_id';
                    hiddenInput.value = projectId;
                    form.appendChild(hiddenInput);
                }
            }
        };

        // Map provided modal function names to toggleModal
        window.toggleModalp = function() {
            toggleModal('createProjectModal');
        };

        window.toggleModale = function() {
            toggleModal('createEquipmentModal');
        };

        window.toggleModalpeople = function() {
            toggleModal('createUserModal');
        };

        // New function to handle Add User modal with pre-selected project
        window.openCreateUserModal = function(companyId, projectId) {
            // Open the create user modal
            toggleModal('createUserModal');
            // Set the company_id and project_id in your modal
            $('#u_company_id').val(companyId);
            $('#u_project_id').val(projectId);
        };
    });
</script>
@endpush