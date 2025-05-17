@extends('layouts.app')

@section('content')
<div class="company-table">
    <div class="form-list">
        <div class="">
            <div class="flex flex-wrap">
                <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                    <h3 class="manrope-medium text-[#344563] text-[18px] mt-[17px]">All Companies</h3>
                </div>
                <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                    <div class="table-filter lg:float-right md:float-right sm:float-left xs:float-left">
                        <ul class="list-inline list-unstyled flex">
                            <li class="list-inline-item mr-[15px]">
                                <button
                                    class="flex manrope-medium bg-[#437651] select-shadow btn rounded-[8px] py-[10px] px-[25px] text-[14px] border-[1px] border-solid border-[#437651] text-white"
                                    onclick="toggleModal('createCompanyModal')">
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
                <div x-data="{ open: false, search: '', selected: 'Name of Companies', options: ['Digital Horizon Systems', 'ByteCore Technologies', 'London Technova Solutions'], selectedOptions: [] }" class="relative mr-[8px]">
                    <button @click="open = !open" class="p-2 focus:outline-none w-[200px] text-left manrope-medium font-medium text-[#6a6a75] text-[14px] border-[1px] border-solid border-[#bfbfbf] rounded-[10px] filter-buttons">
                        <span x-text="selected"></span>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute mt-1 w-[300px] bg-white border border-gray-300 rounded-lg shadow-md manrope-medium font-medium text-[#6a6a75] text-[16px] z-[9]">
                        <input type="text" x-model="search" placeholder="Search..." class="w-full p-2 border-b border-gray-300 focus:outline-none">
                        <ul class="max-h-40 overflow-y-auto">
                            <template x-for="option in options.filter(o => o.toLowerCase().includes(search.toLowerCase()))" :key="option">
                                <li class="p-2 flex items-center space-x-2 hover:bg-gray-100 cursor-pointer text-[#6a6a75]">
                                    <input type="checkbox" :value="option" x-model="selectedOptions" class="cursor-pointer">
                                    <span x-text="option"></span>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
                </p>
                <p class="flex items-center mr-[8px]">
                <div x-data="{ open: false, search: '', selected: 'People', options: ['People 1', 'People 2', 'People 3', 'People 4'], selectedOptions: [] }" class="relative mr-[8px]">
                    <button @click="open = !open" class="filter-buttons p-2 bg-white focus:outline-none w-[100px] text-left manrope-medium text-[#6a6a75] text-[14px] border-[1px] border-solid border-[#bfbfbf] rounded-[10px]">
                        <span x-text="selected"></span>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute mt-1 w-[150px] bg-white border border-gray-300 rounded-lg shadow-md manrope-medium font-medium text-[#6a6a75] text-[16px] z-[9]">
                        <input type="text" x-model="search" placeholder="Search..." class="w-full p-2 border-b border-gray-300 focus:outline-none">
                        <ul class="max-h-40 overflow-y-auto">
                            <template x-for="option in options.filter(o => o.toLowerCase().includes(search.toLowerCase()))" :key="option">
                                <li class="p-2 flex items-center space-x-2 hover:bg-gray-100 cursor-pointer text-[#6a6a75]">
                                    <input type="checkbox" :value="option" x-model="selectedOptions" class="cursor-pointer">
                                    <span x-text="option"></span>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
                </p>
                <p class="flex items-center mr-[8px]">
                    <input autocomplete="off" name="daterange" placeholder="Date" class="w-[240px] manrope-medium text-[#6a6a75] text-[14px] p-2 focus-visible:outline-none placeholder-[#6a6a75] border-[1px] border-solid border-[#bfbfbf] rounded-[10px] filter-buttons">
                </p>
                <p class="flex items-center mr-[8px]">
                <div x-data="{ open: false, search: '', selected: 'Location', options: ['London', 'Canada', 'India', 'USA'], selectedOptions: [] }" class="relative mr-[8px]">
                    <button @click="open = !open" class="filter-buttons p-2 bg-white focus:outline-none w-[100px] text-left manrope-medium text-[#6a6a75] text-[14px] border-[1px] border-solid border-[#bfbfbf] rounded-[10px]">
                        <span x-text="selected"></span>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute mt-1 w-[150px] bg-white border border-gray-300 rounded-lg shadow-md manrope-medium font-medium text-[#6a6a75] text-[16px] z-[9]">
                        <input type="text" x-model="search" placeholder="Search..." class="w-full p-2 border-b border-gray-300 focus:outline-none">
                        <ul class="max-h-40 overflow-y-auto">
                            <template x-for="option in options.filter(o => o.toLowerCase().includes(search.toLowerCase()))" :key="option">
                                <li class="p-2 flex items-center space-x-2 hover:bg-gray-100 cursor-pointer text-[#6a6a75]">
                                    <input type="checkbox" :value="option" x-model="selectedOptions" class="cursor-pointer">
                                    <span x-text="option"></span>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
                </p>
                <p class="flex items-center mr-[8px]">
                <div x-data="{ open: false, search: '', selected: 'Status', options: ['Active', 'Inactive'], selectedOptions: [] }" class="relative mr-[8px]">
                    <button @click="open = !open" class="filter-buttons p-2 bg-white focus:outline-none w-[150px] text-left manrope-medium text-[#6a6a75] text-[14px] border-[1px] border-solid border-[#bfbfbf] rounded-[10px]">
                        <span x-text="selected"></span>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute mt-1 w-[150px] bg-white border border-gray-300 rounded-lg shadow-md manrope-medium font-medium text-[#6a6a75] text-[16px] z-[9]">
                        <input type="text" x-model="search" placeholder="Search..." class="w-full p-2 border-b border-gray-300 focus:outline-none">
                        <ul class="max-h-40 overflow-y-auto">
                            <template x-for="option in options.filter(o => o.toLowerCase().includes(search.toLowerCase()))" :key="option">
                                <li class="p-2 flex items-center space-x-2 hover:bg-gray-100 cursor-pointer text-[#6a6a75]">
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
                    {!! $dataTable->table(['class' => 'table table-bordered table-striped min-w-full leading-normal w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 whitespace-nowrap'], true) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Company Modal -->
@include('companies.add')
<!-- Edit Company Modal -->
@include('companies.edit')
<!-- Create Project Modal -->
@include('projects.add')
<!-- Create User Modal -->
@include('users.add')
@endsection

@push('scripts')
{!! $dataTable->scripts() !!}
<script>
    $(document).ready(function() {
        let table = $('#companies-table').DataTable();

        // Reopen modal if there are validation errors
        @if($errors -> any())
        toggleModal('createCompanyModal');
        @endif

        // Toggle dot dropdown for actions
        window.toggleDotDropdown = function(event) {
            const dropdown = event.target.closest('td').querySelector('.dot-drop');
            dropdown.classList.toggle('hidden');
        };

        window.toggleCompanyStatus = function(companyId) {
            $.ajax({
                url: '{{ url("companies") }}/' + companyId + '/toggle-active',
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

        // Fetch company data and populate edit modal
        window.showEditModal = function(companyId) {
            $.ajax({
                url: '{{ url("companies") }}/' + companyId + '/edit',
                method: 'GET',
                success: function(response) {
                    // Populate the edit modal fields
                    $('#edit_company_id').val(response.id);
                    $('#edit_company_name').val(response.company_name);
                    $('#edit_company_location').val(response.location);
                    $('#editCompanyForm').attr('action', '{{ url("companies") }}/' + response.id);
                    // Remove any existing logo preview
                    $('#edit_company_logo').siblings('.logo-preview').remove();
                    if (response.logo) {
                        $('#edit_company_logo').after(`<div class="logo-preview"><img src="${response.logo}" alt="Current Logo" class="w-32 h-32 object-contain"></div>`);
                    }

                    // Open the edit modal
                    toggleModal('editCompanyModal');
                },
                error: function(xhr) {
                    console.error('Error fetching company data:', xhr);
                    alert('Failed to load company data');
                }
            });
        };

        // Handle Add Project modal with pre-selected company
        window.openCreateProjectModal = function(companyId) {
            toggleModal('createProjectModal');
            $('#company_id').val(companyId);
        };

        // Handle Add User modal with pre-selected company
        window.openCreateUserModal = function(companyId) {
            toggleModal('createUserModal');
            $('#u_company_id').val(companyId);
        };

        // Handle Delete company
        window.deleteCompany = function(companyId) {
            if (confirm('Are you sure you want to delete this company?')) {
                $.ajax({
                    url: '{{ url("companies") }}/' + companyId,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            table.ajax.reload(null, false);
                            alert('Company deleted successfully');
                        }
                    },
                    error: function(xhr) {
                        console.error('Error deleting company:', xhr);
                        alert('Failed to delete company');
                    }
                });
            }
        };
    });
</script>
@endpush