@extends('layouts.app')

@section('content')
<div class="company-table h-full">
    <div class="form-list">
        <div class="p-6 lg:p-8">
            <div class="flex flex-wrap">
                <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                    <h3 class="manrope-medium text-[#344563] text-[13px] mt-[10px]">
                        <p class="inline-block manrope-medium text-[13px] px-[0px] mt-[10px] mr-[15px] text-[#437651] underline">
                            < Back</p>Device Mapped - 40
                    </h3>
                </div>
                <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                    <div class="table-filter lg:float-right md:float-right sm:float-left xs:float-left">
                        <ul class="list-inline list-unstyled flex">
                            <li class="list-inline-item mr-[15px]">
                                <button
                                    class="flex manrope-medium bg-[#3D3D3D] select-shadow btn rounded-[8px] py-[10px] px-[25px] text-[14px] border-[1px] border-solid border-[#3D3D3D] text-black"
                                    onclick="toggleModal('createMappingModal')">
                                    <span class="mr-[10px]"><img src="{{ asset('admin-theme/assets/images/add.png') }}" class="w-[15px] mt-[2px]"></span> Create Mapping
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-filter-block mt-[30px]">
            <div class="flex">
                <p class="flex items-center w-[150px] manrope-medium font-medium text-[#6a6a75] text-[16px]"><img class="w-[20px] object-contain mr-[10px]" src="{{ asset('admin-theme/assets/images/filter-by.png') }}"> Filter By:</p>
                <p class="flex items-center ">
                    <img class="w-[40px] h-[40px] object-contain mr-[5px] border-[#EBEBEB] border-[1px] border-solid p-[7px] rounded-[16px]" src="{{ asset('admin-theme/assets/images/fil-company.png') }}">
                <div x-data="{ open: false, search: '', selected: 'Company Name', options: ['Digital Horizon Systems', 'ByteCore Technologies', 'London Technova Solutions'] , selectedOptions: [] }" class="relative ">
                    <button @click="open = !open" class=" p-2 bg-white focus:outline-none w-[150px] text-left manrope-medium font-medium text-[#6a6a75] text-[14px]">
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
                <p class="flex items-center">
                    <img class="w-[40px] h-[40px] object-contain mr-[5px] border-[#EBEBEB] border-[1px] border-solid p-[7px] rounded-[16px]" src="{{ asset('admin-theme/assets/images/fil-project.png') }}">
                <div x-data="{ open: false, search: '', selected: 'Project', options: ['Project 1', 'Project 2', 'Project 3', 'Project 4'] , selectedOptions: [] }" class="relative ">
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
                    <img class="w-[40px] h-[40px] object-contain mr-[5px] border-[#EBEBEB] border-[1px] border-solid p-[7px] rounded-[16px]" src="{{ asset('admin-theme/assets/images/camera.png') }}">
                <div x-data="{ open: false, search: '', selected: 'Equipment', options: ['Crane 01', 'Lift 01', 'Hook lift', 'Crane 02' , 'Lift 03'] , selectedOptions: [] }" class="relative ">
                    <button @click="open = !open" class=" p-2 bg-white focus:outline-none w-[120px] text-left manrope-medium font-medium text-[#6a6a75] text-[14px]">
                        <span x-text="selected"></span>
                    </button>

                    <div x-show="open" @click.away="open = false" class="absolute mt-1 w-[120px] bg-white border border-gray-300 rounded-lg shadow-md manrope-medium font-medium text-[#6a6a75] text-[16px] z-[9]">
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
                    <img class="w-[40px] h-[40px] object-contain mr-[5px] border-[#EBEBEB] border-[1px] border-solid p-[7px] rounded-[16px]" src="{{ asset('admin-theme/assets/images/tablet.png') }}">
                <div x-data="{ open: false, search: '', selected: 'Tablet', options: ['IPad'] , selectedOptions: [] }" class="relative ">
                    <button @click="open = !open" class=" p-2 bg-white focus:outline-none w-[100px] text-left manrope-medium font-medium text-[#6a6a75] text-[14px]">
                        <span x-text="selected"></span>
                    </button>

                    <div x-show="open" @click.away="open = false" class="absolute mt-1 w-[100px] bg-white border border-gray-300 rounded-lg shadow-md manrope-medium font-medium text-[#6a6a75] text-[16px] z-[9]">
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
                    <img class="w-[40px] h-[40px] object-contain mr-[5px] border-[#EBEBEB] border-[1px] border-solid p-[7px] rounded-[16px]" src="{{ asset('admin-theme/assets/images/status-filter.png') }}">
                <div x-data="{ open: false, search: '', selected: 'Status', options: ['Status 1', 'Status 2', 'Status 3', 'Status 4'] , selectedOptions: [] }" class="relative ">
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
                    {!! $dataTable->table(['class' => 'all-table w-full text-sm text-left'], true) !!}
                </div>
            </div>
        </div>
    </div>
</div>
@include('mappings.add')
@include('mappings.edit')
@endsection
@push('scripts')
{!! $dataTable->scripts() !!}
<script>
    $(document).ready(function() {
        let table = $('#mappings-table').DataTable();

        // Reopen modal if there are validation errors
        @if($errors->any())
        toggleModal('createMappingModal');
        @endif

        window.toggleMappingStatus = function(mappingId) {
            $.ajax({
                url: '{{ url("mappings") }}/' + mappingId + '/toggle-active',
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

        window.showEditMappingModal = function(mappingId) {
            $.ajax({
                url: '{{ url("mappings") }}/' + mappingId + '/edit',
                method: 'GET',
                success: function(response) {
                    $('#edit_mapping_id').val(response.id);
                    $('#edit_company_id').val(response.company_id);
                    $('#edit_project_id').val(response.project_id);
                    $('#edit_equipment_id').val(response.equipment_id);
                    $('#editMappingForm').attr('action', '{{ url("mappings") }}/' + response.id);
                    toggleModal('editMappingModal');
                },
                error: function(xhr) {
                    console.error('Error fetching mapping data:', xhr);
                    alert('Failed to load mapping data');
                }
            });
        };
    });
</script>
@endpush