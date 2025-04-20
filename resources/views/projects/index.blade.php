@extends('layouts.app')

@section('content')
<div class="p-6 lg:p-8">
    <div class="form-list">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
            <div class="flex items-center">
                <a href="#" class="text-sm text-green-600 underline mr-4 hover:text-green-800 transition-colors">← Back</a>
                <h3 class="text-2xl font-semibold text-gray-800">All Projects</h3>
            </div>
            <div class="flex items-center space-x-3">
                <!-- Search -->
                <div class="relative">
                    <input type="text" id="search-input" placeholder="Search..."
                        class="w-full md:w-64 pl-10 pr-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-green-500 transition-all">
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
                <!-- Date Range -->
                <input autocomplete="off" name="daterange" placeholder="This Month"
                    class="w-48 py-2 pl-10 pr-4 rounded-lg border border-gray-200 text-gray-600 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 bg-[url('{{ asset('admin-theme/assets/images/calendar.png') }}')] bg-no-repeat bg-[10px_center] bg-[length:16px]">
                <!-- Add New Button -->
                <button onclick="toggleModal('createProjectModal')"
                    class="flex items-center bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i> Add New
                </button>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
            <div class="flex flex-wrap items-center gap-4">
                <div class="flex items-center text-gray-700 font-medium">
                    <img src="{{ asset('admin-theme/assets/images/filter-by.png')}}" class="w-5 mr-2">
                    Filter By:
                </div>
                <!-- Company Filter -->
                <div x-data="{ open: false, search: '', selected: 'Digital Horizon Systems', options: ['Digital Horizon Systems', 'ByteCore Technologies', 'London Technova Solutions'], selectedOptions: [] }"
                    class="relative">
                    <button @click="open = !open" class="flex items-center px-3 py-2 bg-gray-100 rounded-lg text-gray-600 hover:bg-gray-200 transition-colors">
                        <img src="{{ asset('admin-theme/assets/images/fil-company.png')}}" class="w-6 mr-2">
                        <span x-text="selected"></span>
                        <i class="fas fa-chevron-down ml-2"></i>
                    </button>
                    <div x-show="open" @click.away="open = false"
                        class="absolute mt-2 w-64 bg-white border border-gray-200 rounded-lg shadow-lg z-10">
                        <input type="text" x-model="search" placeholder="Search..."
                            class="w-full p-2 border-b border-gray-200 focus:outline-none">
                        <ul class="max-h-48 overflow-y-auto">
                            <template x-for="option in options.filter(o => o.toLowerCase().includes(search.toLowerCase()))" :key="option">
                                <li class="p-2 flex items-center space-x-2 hover:bg-gray-100 cursor-pointer">
                                    <input type="checkbox" :value="option" x-model="selectedOptions" class="cursor-pointer">
                                    <span x-text="option"></span>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
                <!-- People Filter -->
                <div x-data="{ open: false, search: '', selected: 'People', options: ['People 1', 'People 2', 'People 3', 'People 4'], selectedOptions: [] }"
                    class="relative">
                    <button @click="open = !open" class="flex items-center px-3 py-2 bg-gray-100 rounded-lg text-gray-600 hover:bg-gray-200 transition-colors">
                        <img src="{{ asset('admin-theme/assets/images/filter-user.png')}}" class="w-6 mr-2">
                        <span x-text="selected"></span>
                        <i class="fas fa-chevron-down ml-2"></i>
                    </button>
                    <div x-show="open" @click.away="open = false"
                        class="absolute mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-10">
                        <input type="text" x-model="search" placeholder="Search..."
                            class="w-full p-2 border-b border-gray-200 focus:outline-none">
                        <ul class="max-h-48 overflow-y-auto">
                            <template x-for="option in options.filter(o => o.toLowerCase().includes(search.toLowerCase()))" :key="option">
                                <li class="p-2 flex items-center space-x-2 hover:bg-gray-100 cursor-pointer">
                                    <input type="checkbox" :value="option" x-model="selectedOptions" class="cursor-pointer">
                                    <span x-text="option"></span>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
                <!-- Date Filter -->
                <div class="relative">
                    <input autocomplete="off" name="daterange" placeholder="Date"
                        class="w-48 py-2 pl-10 pr-4 rounded-lg border border-gray-200 text-gray-600 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 bg-[url('{{ asset('admin-theme/assets/images/drop-cal.png') }}')] bg-no-repeat bg-[10px_center] bg-[length:16px]">
                </div>
                <!-- Location Filter -->
                <div x-data="{ open: false, search: '', selected: 'Location', options: ['London', 'Canada', 'India', 'USA'], selectedOptions: [] }"
                    class="relative">
                    <button @click="open = !open" class="flex items-center px-3 py-2 bg-gray-100 rounded-lg text-gray-600 hover:bg-gray-200 transition-colors">
                        <img src="{{ asset('admin-theme/assets/images/location.png')}}" class="w-6 mr-2">
                        <span x-text="selected"></span>
                        <i class="fas fa-chevron-down ml-2"></i>
                    </button>
                    <div x-show="open" @click.away="open = false"
                        class="absolute mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-10">
                        <input type="text" x-model="search" placeholder="Search..."
                            class="w-full p-2 border-b border-gray-200 focus:outline-none">
                        <ul class="max-h-48 overflow-y-auto">
                            <template x-for="option in options.filter(o => o.toLowerCase().includes(search.toLowerCase()))" :key="option">
                                <li class="p-2 flex items-center space-x-2 hover:bg-gray-100 cursor-pointer">
                                    <input type="checkbox" :value="option" x-model="selectedOptions" class="cursor-pointer">
                                    <span x-text="option"></span>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
                <!-- Status Filter -->
                <div x-data="{ open: false, search: '', selected: 'Status', options: ['Active', 'Inactive', 'Blocked'], selectedOptions: [] }"
                    class="relative">
                    <button @click="open = !open" class="flex items-center px-3 py-2 bg-gray-100 rounded-lg text-gray-600 hover:bg-gray-200 transition-colors">
                        <img src="{{ asset('admin-theme/assets/images/status-filter.png')}}" class="w-6 mr-2">
                        <span x-text="selected"></span>
                        <i class="fas fa-chevron-down ml-2"></i>
                    </button>
                    <div x-show="open" @click.away="open = false"
                        class="absolute mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-10">
                        <input type="text" x-model="search" placeholder="Search..."
                            class="w-full p-2 border-b border-gray-200 focus:outline-none">
                        <ul class="max-h-48 overflow-y-auto">
                            <template x-for="option in options.filter(o => o.toLowerCase().includes(search.toLowerCase()))" :key="option">
                                <li class="p-2 flex items-center space-x-2 hover:bg-gray-100 cursor-pointer">
                                    <input type="checkbox" :value="option" x-model="selectedOptions" class="cursor-pointer">
                                    <span x-text="option"></span>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-lg shadow-sm p-4">
            <div class="">
                {!! $dataTable->table(['class' => 'table table-bordered table-striped'], true) !!}
            </div>
        </div>
    </div>
</div>

<!-- Create Company Modal -->
@include('projects.add')
<!-- Create Equipment Modal -->
@include('equipments.add')
<!-- Edit Company Modal -->
@include('projects.edit')
@endsection

@push('scripts')
{!! $dataTable->scripts() !!}
<script>
    $(document).ready(function() {
        let table = $('#projects-table').DataTable()

        // Reopen modal if there are validation errors
        @if($errors->any())
        toggleModal('createProjectModal');
        @endif

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
    });

    // Fetch project data and populate edit modal
    window.showEditModal = function(projectId) {
        $.ajax({
            url: '{{ url("projects") }}/' + projectId + '/edit',
            method: 'GET',
            success: function(response) {
                // Populate the edit modal fields
                $('#edit_project_id').val(response.id);
                $('#edit_project_name').val(response.name);
                $('#edit_company_id').val(response.company_id);
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
</script>
@endpush