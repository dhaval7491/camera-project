@extends('layouts.app')

@section('content')
<div class="">
    <div class="form-list">
        <div class="flex flex-wrap justify-between items-center px-[10px]">
            <div class="pr-[5px] px-[0px] pl-[0px] mt-[0px] flex flex-nowrap overflow-x-auto">
                <button class="tab-button block text-[#323131] manrope-regular text-[13px] py-[5px] ml-[0px] mr-[25px] mb-[5px]" onclick="openTab(event, 'equipment')">
                    Equipment
                </button>
                <button class="tab-button block text-[#323131] manrope-regular text-[13px] py-[5px] ml-[25px] mr-[25px] mb-[5px]" onclick="openTab(event, 'mapping')">
                    Mapping
                </button>
                <button class="tab-button block text-[#323131] manrope-regular text-[13px] py-[5px] ml-[25px] mr-[25px] mb-[5px]" onclick="openTab(event, 'trackable')">
                    Trackable
                </button>
                <button class="tab-button block text-[#323131] manrope-regular text-[13px] py-[5px] ml-[25px] mr-[25px] mb-[5px]" onclick="openTab(event, 'ai-model')">
                    AI Model
                </button>
                <button class="tab-button block text-[#323131] manrope-regular text-[13px] py-[5px] ml-[25px] mr-[25px] mb-[5px]" onclick="openTab(event, 'event-type')">
                    Event Type
                </button>
            </div>
            <button id="add-equipment-btn"
                class="tab-action-btn flex manrope-medium bg-[#437651] select-shadow btn rounded-[8px] py-[8px] px-[15px] text-[11px] border-[1px] border-solid border-[#437651] text-white"
                onclick="openCreateEquipmentModal()" style="height:36px;">
                <span class="mr-[10px]"><img src="{{ asset('admin-theme/assets/images/add.png')}}" class="w-[15px] mt-[2px]"></span> Add Equipment
            </button>
            <button id="create-mapping-btn"
                class="tab-action-btn flex manrope-medium bg-[#437651] select-shadow btn rounded-[8px] py-[8px] px-[15px] text-[11px] border-[1px] border-solid border-[#437651] text-white hidden"
                onclick="toggleModal('createMappingModal')" style="height:36px;">
                <span class="mr-[10px]"><img src="{{ asset('admin-theme/assets/images/add.png')}}" class="w-[15px] mt-[2px]"></span> Add Mapping
            </button>
            <button id="add-trackable-btn"
                class="tab-action-btn flex manrope-medium bg-[#437651] select-shadow btn rounded-[8px] py-[8px] px-[15px] text-[11px] border-[1px] border-solid border-[#437651] text-white hidden"
                onclick="toggleModal('createTrackableModal')" style="height:36px;">
                <span class="mr-[10px]"><img src="{{ asset('admin-theme/assets/images/add.png')}}" class="w-[15px] mt-[2px]"></span> Add Trackable
            </button>
            <button id="add-ai-model-btn"
                class="tab-action-btn flex manrope-medium bg-[#437651] select-shadow btn rounded-[8px] py-[8px] px-[15px] text-[11px] border-[1px] border-solid border-[#437651] text-white hidden"
                onclick="toggleModaladdai()" style="height:36px;">
                <span class="mr-[10px]"><img src="{{ asset('admin-theme/assets/images/add.png')}}" class="w-[15px] mt-[2px]"></span> Add Ai Model
            </button>
            <button id="add-event-type-btn"
                class="tab-action-btn flex manrope-medium bg-[#437651] select-shadow btn rounded-[8px] py-[8px] px-[15px] text-[11px] border-[1px] border-solid border-[#437651] text-white hidden"
                onclick="toggleModalevent()" style="height:36px;">
                <span class="mr-[10px]"><img src="{{ asset('admin-theme/assets/images/add.png')}}" class="w-[15px] mt-[2px]"></span> Add Event
            </button>
        </div>
            <div class="pr-[5px] px-[10px] pl-[0px] mt-[20px] tab-content" id="v-pills-tabContent">
                <div class="tab-prop hidden" id="equipment">
                    <div class="company-table h-full">
                        <div class="form-list">
                            <div class="">
                                <div class="flex flex-wrap justify-end">
                                    <div class="table-filter-block mt-[0px]">
                                        <div class="flex justify-end ">
                                            <p class="flex items-center mr-[8px]">
                                                <div class="relative flex items-center mr-[8px]">
                                                    <input type="text" id="search-input"
                                                        class="w-0 p-0 border border-[#EBEBEB] rounded-[11px] absolute right-[19px] z-[8] transition-all duration-300 overflow-hidden bg-white"
                                                        placeholder="Search...">
                                                    <button id="search-toggle"
                                                        class="p-[11px] rounded-[14px] border border-[#EBEBEB] ml-2 z-[8] bg-white">
                                                        <img src="{{ asset('admin-theme/assets/images/table-search.png')}}" class="w-[16px]" style="width:13px;">
                                                    </button>
                                                </div>
                                            </p>
                                            <p class="flex items-center mr-[8px]">
                                                <div class="relative flex items-center mr-[8px] filter-resp">
                                                    <button id="search-toggle"
                                                        class="rounded-[14px] border border-[#EBEBEB] z-[8] bg-white" style="padding:12px;">
                                                        <img src="{{ asset('admin-theme/assets/images/filter-by.png')}}" class="" style="width:13px;">
                                                    </button>
                                                </div>
                                            </p>
                                            <p class="flex items-center mr-[8px] filter-drop">
                                                <select id="equipment-company-filter" multiple class="filter-select w-[150px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="Company Name">
                                                    @foreach($companies as $id => $name)
                                                    <option value="{{ $id }}">{{ $name }}</option>
                                                    @endforeach
                                                </select>
                                            </p>
                                            <p class="flex items-center mr-[8px] filter-drop">
                                                <select id="equipment-project-filter" multiple class="filter-select w-[100px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="Project">
                                                    @foreach($projects as $id => $name)
                                                    <option value="{{ $id }}">{{ $name }}</option>
                                                    @endforeach
                                                </select>
                                            </p>
                                            <p class="flex items-center mr-[8px] filter-drop">
                                                <select id="equipment-equipment-filter" multiple class="filter-select w-[120px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="Equipment">
                                                    @foreach($equipments as $id => $name)
                                                    <option value="{{ $id }}">{{ $name }}</option>
                                                    @endforeach
                                                </select>
                                            </p>
                                            <p class="flex items-center mr-[8px] filter-drop">
                                                <select id="equipment-status-filter" multiple class="filter-select w-[100px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="Status">
                                                    @foreach($statuses as $id => $name)
                                                    <option value="{{ $id }}">{{ $name }}</option>
                                                    @endforeach
                                                </select>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-list-table">
                                    <div class="mt-[20px]">
                                        <div class="relative">
                                            {!! $equipmentTable->table(['class' => 'all-table table table-bordered table-striped whitespace-nowrape'], true) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-prop hidden" id="mapping">
                    <div class="company-table h-full">
                        <div class="form-list">
                            <div class="">
                                <div class="flex flex-wrap justify-end">
                                    <div class="table-filter-block mt-[0px]">
                                        <div class="flex justify-end ">
                                            <p class="flex items-center mr-[8px]">
                                                <div class="relative flex items-center mr-[8px]">
                                                    <!-- Search Input -->
                                                    <input type="text" id="search-input"
                                                        class="w-0 p-0 border border-[#EBEBEB] rounded-[11px] absolute right-[19px] z-[8] transition-all duration-300 overflow-hidden bg-white"
                                                        placeholder="Search...">

                                                    <!-- Search Button -->
                                                    <button id="search-toggle"
                                                        class="p-[11px] rounded-[14px] border border-[#EBEBEB] ml-2 z-[8] bg-white">
                                                        <img src="{{ asset('admin-theme/assets/images/table-search.png')}}" class="w-[16px]" style="width:13px;">
                                                    </button>
                                                </div>
                                            </p>
                                            <p class="flex items-center mr-[8px] ">
                                                <div class="relative flex items-center mr-[8px] filter-resp">
                                                    <button id="search-toggle"
                                                        class="rounded-[14px] border border-[#EBEBEB] z-[8] bg-white" style="padding:12px;">
                                                        <img src="{{ asset('admin-theme/assets/images/filter-by.png')}}" class="" style="width:13px;">
                                                    </button>
                                                </div>
                                            </p>
                                            <p class="flex items-center mr-[8px] filter-drop">
                                                <select id="mapping-company-filter" multiple class="filter-select w-[150px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="Company Name">
                                                    @foreach($companies as $id => $name)
                                                    <option value="{{ $id }}">{{ $name }}</option>
                                                    @endforeach
                                                </select>
                                            </p>
                                            <p class="flex items-center mr-[8px] filter-drop">
                                                <select id="mapping-project-filter" multiple class="filter-select w-[100px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="Project">
                                                    @foreach($projects as $id => $name)
                                                    <option value="{{ $id }}">{{ $name }}</option>
                                                    @endforeach
                                                </select>
                                            </p>
                                            <p class="flex items-center mr-[8px] filter-drop">
                                                <select id="mapping-tablet-filter" multiple class="filter-select w-[100px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="Tablet">
                                                    @foreach($tablets as $id => $name)
                                                    <option value="{{ $id }}">{{ $name }}</option>
                                                    @endforeach
                                                </select>
                                            </p>
                                            <p class="flex items-center mr-[8px] filter-drop">
                                                <select id="mapping-status-filter" multiple class="filter-select w-[100px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="Status">
                                                    @foreach($statuses as $id => $name)
                                                    <option value="{{ $id }}">{{ $name }}</option>
                                                    @endforeach
                                                </select>
                                            </p>
                                        </div>
                                    </div>    
                                </div>
                            </div>
                           
                            <div class="form-list-table">
                                <div class="mt-[20px]">
                                    <div class="relative overflow-x-scroll h-full">
                                    {!! $mappingTable->table(['class' => 'all-table table table-bordered table-striped whitespace-nowrape'], true) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-prop hidden" id="trackable">
                    <div class="company-table h-full">
                        <div class="form-list">
                            <div class="">
                                <div class="flex flex-wrap justify-end">
                                    <div class="table-filter-block mt-[0px]">
                                        <div class="flex justify-end">
                                            <p class="flex items-center mr-[8px]">
                                                <div class="relative flex items-center mr-[8px]">
                                                    <input type="text" id="search-input"
                                                        class="w-0 p-0 border border-[#EBEBEB] rounded-[11px] absolute right-[19px] z-[8] transition-all duration-300 overflow-hidden bg-white"
                                                        placeholder="Search...">
                                                    <button id="search-toggle"
                                                        class="p-[11px] rounded-[14px] border border-[#EBEBEB] ml-2 z-[8] bg-white">
                                                        <img src="{{ asset('admin-theme/assets/images/table-search.png')}}" class="w-[16px]" style="width:13px;">
                                                    </button>
                                                </div>
                                            </p>
                                            <p class="flex items-center mr-[8px] ">
                                                <div class="relative flex items-center mr-[8px] filter-resp">
                                                    <button id="search-toggle"
                                                        class="rounded-[14px] border border-[#EBEBEB] z-[8] bg-white" style="padding:12px;">
                                                        <img src="{{ asset('admin-theme/assets/images/filter-by.png')}}" class="" style="width:13px;">
                                                    </button>
                                                </div>
                                            </p>
                                            <p class="flex items-center mr-[8px] filter-drop">
                                                <select id="trackable-name-filter" multiple class="filter-select w-[100px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="Name">
                                                    @foreach($trackables as $id => $name)
                                                    <option value="{{ $id }}">{{ $name }}</option>
                                                    @endforeach
                                                </select>
                                            </p>
                                            <p class="flex items-center mr-[8px] filter-drop">
                                                <select id="trackable-type-filter" multiple class="filter-select w-[120px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="Other name">
                                                    @foreach($types as $type)
                                                    <option value="{{ $type }}">{{ $type }}</option>
                                                    @endforeach
                                                </select>
                                            </p>
                                            <p class="flex items-center mr-[8px] filter-drop">
                                                <select id="trackable-status-filter" multiple class="filter-select w-[100px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="Status">
                                                    @foreach($statuses as $id => $name)
                                                    <option value="{{ $id }}">{{ $name }}</option>
                                                    @endforeach
                                                </select>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="form-list-table">
                                <div class="mt-[20px]">
                                    <div class="relative overflow-x-scroll h-full">
                                            {!! $trackableTable->table(['class' => 'all-table table table-bordered table-striped whitespace-nowrape'], true) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-prop hidden" id="ai-model">
                    <div class="company-table h-full">
                        <div class="form-list">
                            <div class="">
                                <div class="flex flex-wrap">
                                    <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                                        <!-- <h3 class="manrope-medium text-[#344563] text-[18px] mt-[17px]">Overall list</h3> -->
                                    </div>
                                    <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="table-filter-block mt-[30px]">
                                <div class="flex justify-end">
                                    <!-- Existing filter dropdowns remain unchanged -->
                                </div>
                            </div>
                            <div class="form-list-table">
                                <div class="mt-[20px]">
                                    <div class="relative overflow-x-scroll h-full">
                                        <table id="ai-models-table" class="all-table w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            <thead class="all-table border-b-[2px] border-solid border-b-[#E9EDF0]">
                                                <tr>
                                                    <th class="text-center pl-[10px] pb-[25px]">
                                                        <div class=""><input type="checkbox" id="select-people" class="border-gray-300 rounded h-4 w-4 accent-[#437651] focus:ring-0" /></div>
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] manrope-medium text-[#344563] font-medium text-[16px] text-center">AI Model Name</th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] manrope-medium text-[#344563] font-medium text-[16px] text-center">Event Type</th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-center manrope-medium text-[#344563] font-medium text-[16px]">Date Created</th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-center manrope-medium text-[#344563] font-medium text-[16px]">Trackable Name</th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-center manrope-medium text-[#344563] font-medium text-[16px]">Status</th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-center manrope-medium text-[#344563] font-medium text-[16px]">Object Type</th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-center manrope-medium text-[#344563] font-medium text-[16px]">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-prop hidden" id="event-type">
                    <div class="company-table h-full">
                        <div class="form-list">
                            <div class="">
                                <div class="flex flex-wrap">
                                    <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                                        <!-- <h3 class="manrope-medium text-[#344563] text-[18px] mt-[17px]">Overall list</h3> -->
                                    </div>
                                    <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="form-list-table">
                                <div class="mt-[20px]">
                                    <div class="relative overflow-x-scroll h-full">
                                        <table id="event-types-table" class=" all-table w-full text-sm text-left">
                                            <thead class="all-table border-b-[2px] border-solid border-b-[#E9EDF0] whitespace-nowrap">
                                                <tr>
                                                    <th class="text-center pl-[10px]">
                                                        <div class="pb-[15px]"><input type="checkbox" id="select-people" class="border-gray-300 rounded h-4 w-4 accent-[#437651] focus:ring-0" /></div>
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-center text-[#344563] text-[13px] manrope-regular ">Event Name</th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] manrope-medium text-[#344563] font-medium text-[16px] text-center">Condition</th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-center manrope-medium text-[#344563] font-medium text-[16px]">Wind Threshold</th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-center manrope-medium text-[#344563] font-medium text-[16px]">Height Threshold</th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-center manrope-medium text-[#344563] font-medium text-[16px]">Alert</th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-center manrope-medium text-[#344563] font-medium text-[16px]">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Create Equipment Modal -->
@include('equipments.add')

<!-- Edit Equipment Modal -->
@include('equipments.edit')
@include('mappings.add')
@include('mappings.edit')
<!-- Create Trackable Modal -->
@include('trackables.add')
<!-- Edit Trackable Modal -->
@include('trackables.edit')
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection--multiple {
        border: 1px solid #ebebeb;
        border-radius: 10px;
        padding: 2px;
        min-height: 34px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__rendered {
        padding: 0 4px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #f5f5f5;
        border: 1px solid #ebebeb;
        border-radius: 4px;
        padding: 2px 6px;
        margin: 2px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #444;
        margin-right: 4px;
    }

    .select2-container .select2-search--inline .select2-search__field {
        margin-top: 4px;
        font-family: 'Manrope', sans-serif;
        font-size: 14px;
        color: #444;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__placeholder {
        color: #444;
        font-family: 'Manrope', sans-serif;
        font-size: 14px;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
{!! $equipmentTable->scripts() !!}
{!! $mappingTable->scripts() !!}
{!! $trackableTable->scripts() !!}
<script>
    $(document).ready(function() {
        let mappingTable = $('#mappings-table').DataTable();
        let trackableTable= $('#trackables-table').DataTable();
        let equipmentTable = $('#equipments-table').DataTable()
        // Initialize Select2 for all filter selects
        $('.filter-select').select2({
            placeholder: function() {
                return $(this).data('placeholder');
            },
            allowClear: true,
            closeOnSelect: false,
            width: '100%'
        });

        // Apply filters function
        function applyFilters() {
            let companyIds = $('#equipment-company-filter').val() || [];
            let projectIds = $('#equipment-project-filter').val() || [];
            let equipmentIds = $('#equipment-equipment-filter').val() || [];
            let statuses = $('#equipment-status-filter').val() || [];

            // Map status values to Active/Inactive
            statuses = statuses.map(status => status == 1 ? 'Active' : status == 0 ? 'Inactive' : status);

            equipmentTable.ajax.url('{{ route("settings.equipments") }}?' + $.param({
                equipment_company_filter: companyIds,
                equipment_project_filter: projectIds,
                equipment_id_filter: equipmentIds,
                statuses: statuses
            })).load();
        }

        // Apply filters for Mapping table
        function applyMappingFilters() {
            let companyIds = $('#mapping-company-filter').val() || [];
            let projectIds = $('#mapping-project-filter').val() || [];
            let tabletIds = $('#mapping-tablet-filter').val() || [];
            let statuses = $('#mapping-status-filter').val() || [];

            // Map status values to Active/Inactive
            statuses = statuses.map(status => status == 1 ? 'Active' : status == 0 ? 'Inactive' : status);

            mappingTable.ajax.url('{{ route("settings.mappings") }}?' + $.param({
                mapping_company_filter: companyIds,
                mapping_project_filter: projectIds,
                mapping_tablet_filter: tabletIds,
                statuses: statuses
            })).load();
        }

        // Apply filters for Trackable table
        function applyTrackableFilters() {
            let trackableIds = $('#trackable-name-filter').val() || [];
            let typeValues = $('#trackable-type-filter').val() || [];
            let statuses = $('#trackable-status-filter').val() || [];

            // Map status values to Active/Inactive
            statuses = statuses.map(status => status == 1 ? 'Active' : status == 0 ? 'Inactive' : status);

            trackableTable.ajax.url('{{ route("settings.trackables") }}?' + $.param({
                trackable_name_filter: trackableIds,
                trackable_type_filter: typeValues,
                statuses: statuses
            })).load();
        }

        // Trigger filter on select2 change
        $('#equipment-company-filter, #equipment-project-filter, #equipment-equipment-filter, #equipment-plant-filter, #equipment-status-filter').on('change', function() {
            applyFilters();
        });

        // Trigger filter on select2 change for Mapping table
        $('#mapping-company-filter, #mapping-project-filter, #mapping-plant-filter, #mapping-tablet-filter, #mapping-status-filter').on('change', function() {
            applyMappingFilters();
        });

        // Trigger filter on select2 change for Trackable table
        $('#trackable-name-filter, #trackable-type-filter, #trackable-status-filter').on('change', function() {
            applyTrackableFilters();
        });

        // Search input handling
        // $('#search-toggle').on('click', function() {
        //     let searchInput = $('#search-input');
        //     if (searchInput.hasClass('w-0')) {
        //         searchInput.removeClass('w-0 p-0').addClass('w-[200px] p-2').focus();
        //     } else {
        //         searchInput.val('').removeClass('w-[200px] p-2').addClass('w-0 p-0');
        //         equipmentTable.search('').draw(); // Clear search
        //     }
        // });

        // $('#search-input').on('keyup', function() {
        //     equipmentTable.search($(this).val()).draw();
        // });

        // Track which DataTables have been initialized
        let initializedTables = {
            aiModel: false,
            eventType: false
        };

        // Initialize static DataTables for tabs that don't use Laravel DataTables
        function initializeStaticDataTables() {
            if (!initializedTables.aiModel) {
                $('#ai-models-table').DataTable({
                    responsive: true,
                    pageLength: 10,
                    order: [
                        [1, 'asc']
                    ],
                    columnDefs: [{
                            orderable: false,
                            targets: [0, 7]
                        },
                        {
                            responsivePriority: 1,
                            targets: [1, 5]
                        }
                    ]
                });
                initializedTables.aiModel = true;
            }

            if (!initializedTables.eventType) {
                $('#event-types-table').DataTable({
                    responsive: true,
                    pageLength: 10,
                    order: [
                        [1, 'asc']
                    ],
                    columnDefs: [{
                            orderable: false,
                            targets: [0, 6]
                        },
                        {
                            responsivePriority: 1,
                            targets: [1, 5]
                        }
                    ]
                });
                initializedTables.eventType = true;
            }
        }

        // Handle tab switching and DataTable initialization
        $('.tab-button').on('click', function(event) {
            const tabId = $(this).attr('onclick').match(/'([^']+)'/)[1];

            // Initialize DataTables based on the active tab
            setTimeout(function() {
               if (tabId === 'ai-model' || tabId === 'event-type') {
                    initializeStaticDataTables();
                    if (tabId === 'ai-model' && $.fn.DataTable.isDataTable('#ai-models-table')) {
                        $('#ai-models-table').DataTable().columns.adjust().responsive.recalc();
                    } else if (tabId === 'event-type' && $.fn.DataTable.isDataTable('#event-types-table')) {
                        $('#event-types-table').DataTable().columns.adjust().responsive.recalc();
                    }
                }
            }, 100);
        });

        // jQuery Validation for Create Equipment Form
        $('#createEquipmentForm').validate({
            rules: {
                type: {
                    required: true
                },
                equipment_name: {
                    required: true,
                    minlength: 2
                },
                password: {
                    required: true,
                    minlength: 8
                }
            },
            messages: {
                type: {
                    required: "Please select an equipment type"
                },
                equipment_name: {
                    required: "Please enter an equipment name",
                    minlength: "Equipment name must be at least 2 characters long"
                },
                password: {
                    required: "Please enter a password",
                    minlength: "Password must be at least 8 characters long"
                }
            },
            errorPlacement: function(error, element) {
                var errorDiv = '#' + (element.attr('name') === 'type' ? 'type_error' : element.attr('id') + '_error');
                $(errorDiv).text(error.text()).removeClass('hidden');
                element.addClass('input-error');
                if (element.attr('name') === 'type') {
                    $('#createEquipmentForm input[name="type"]').parent().addClass('input-error');
                }
            },
            success: function(label, element) {
                var errorDiv = '#' + ($(element).attr('name') === 'type' ? 'type_error' : $(element).attr('id') + '_error');
                $(errorDiv).addClass('hidden').text('');
                $(element).removeClass('input-error');
                if ($(element).attr('name') === 'type') {
                    $('#createEquipmentForm input[name="type"]').parent().removeClass('input-error');
                }
            },
            ignore: '#equipment_code' // Skip validation for equipment_code
        });

        // Function to fetch and set equipment code
        function fetchEquipmentCode(type) {
            $.ajax({
                url: '{{ route("equipments.generate-code") }}',
                method: 'POST',
                data: {
                    type: type,
                    _token: '{{ csrf_token() }}' // Include CSRF token for POST
                },
                success: function(response) {
                    $('#equipment_code').val(response.equipment_code);
                },
                error: function(xhr) {
                    console.error('Error fetching equipment code:', xhr);
                    toastr.error('Failed to generate equipment code');
                }
            });
        }

        // Open Create Equipment Modal and Fetch Equipment Code
        window.openCreateEquipmentModal = function() {
            $('#createEquipmentForm')[0].reset();
            $('#cameraFields').removeClass('hidden');
            $('.text-red-500').addClass('hidden');
            $('input').removeClass('input-error');
            $('#createEquipmentForm input[name="type"][value="camera"]').prop('checked', true);
            fetchEquipmentCode('camera');
            toggleModal('createEquipmentModal');
        };

        // Update equipment code when type changes
        $('#createEquipmentForm input[name="type"]').on('change', function() {
            fetchEquipmentCode($(this).val());
            if ($(this).val() === 'camera') {
                $('#cameraFields').removeClass('hidden');
            } else {
                $('#cameraFields').addClass('hidden');
                $('#stream_link').val('').removeClass('input-error');
                $('#stream_link_error').addClass('hidden').text('');
            }
        });

        // Handle Create Equipment Submission
        $('#createEquipmentSubmit').on('click', function(e) {
            e.preventDefault();
            if ($('#createEquipmentForm').valid()) {
                var formData = new FormData($('#createEquipmentForm')[0]);
                // formData.delete('equipment_code'); // Remove client-side code as server generates it
                $.ajax({
                    url: '{{ route("equipments.store") }}',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toggleModal('createEquipmentModal');
                        equipmentTable.ajax.reload(null, false);
                        toastr.success('Equipment created successfully');
                        $('#createEquipmentForm')[0].reset();
                        $('.text-red-500').addClass('hidden');
                        $('input').removeClass('input-error');
                        $('#createEquipmentForm input[name="type"][value="camera"]').prop('checked', true);
                        fetchEquipmentCode('camera'); // Reset with new code
                    },
                    error: function(xhr) {
                        console.error('Error creating equipment:', xhr);
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                var errorDiv = '#' + (key === 'type' ? 'type_error' : key + '_error');
                                $(errorDiv).text(value[0]).removeClass('hidden');
                                if (key === 'type') {
                                    $('#createEquipmentForm input[name="type"]').parent().addClass('input-error');
                                } else {
                                    $('#' + key).addClass('input-error');
                                }
                            });
                        } else {
                            toastr.error('Failed to create equipment. Please try again.');
                        }
                    }
                });
            }
        });

        // jQuery Validation for Edit Equipment Form
        $('#editEquipmentForm').validate({
            rules: {
                type: {
                    required: true
                },
                equipment_name: {
                    required: true,
                    minlength: 2
                },
                password: {
                    minlength: 8
                },
                stream_link: {
                    required: function() {
                        return $('#editEquipmentForm input[name="type"]:checked').val() === 'camera';
                    },
                    url: true
                }
            },
            messages: {
                type: {
                    required: "Please select an equipment type"
                },
                equipment_name: {
                    required: "Please enter an equipment name",
                    minlength: "Equipment name must be at least 2 characters long"
                },
                password: {
                    minlength: "Password must be at least 8 characters long"
                },
                stream_link: {
                    required: "Please enter a streaming link for camera equipment",
                    url: "Please enter a valid URL"
                }
            },
            errorPlacement: function(error, element) {
                var errorDiv = '#' + (element.attr('name') === 'type' ? 'type_error' : element.attr('id') + '_error');
                $(errorDiv).text(error.text()).removeClass('hidden');
                element.addClass('input-error');
                if (element.attr('name') === 'type') {
                    $('#editEquipmentForm input[name="type"]').parent().addClass('input-error');
                }
            },
            success: function(label, element) {
                var errorDiv = '#' + ($(element).attr('name') === 'type' ? 'type_error' : $(element).attr('id') + '_error');
                $(errorDiv).addClass('hidden').text('');
                $(element).removeClass('input-error');
                if ($(element).attr('name') === 'type') {
                    $('#editEquipmentForm input[name="type"]').parent().removeClass('input-error');
                }
            },
            ignore: '#edit_equipment_code' // Skip validation for equipment_code
        });

        // Handle Edit Equipment Submission
        $('#editEquipmentSubmit').on('click', function(e) {
            e.preventDefault();
            if ($('#editEquipmentForm').valid()) {
                var formData = new FormData($('#editEquipmentForm')[0]);
                var equipmentId = $('#edit_equipment_id').val();
                $.ajax({
                    url: '{{ route("equipments.update", ":id") }}'.replace(':id', equipmentId),
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toggleModal('editEquipmentModal');
                        equipmentTable.ajax.reload(null, false);
                        toastr.success('Equipment updated successfully');
                        $('#editEquipmentForm')[0].reset();
                        $('.text-red-500').addClass('hidden');
                        $('input').removeClass('input-error');
                    },
                    error: function(xhr) {
                        console.error('Error updating equipment:', xhr);
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, error) {
                                var errorDiv = '#' + key + '_error';
                                $(errorDiv).text(error[0]).removeClass('hidden');
                                if (key === 'type') {
                                    $('#editEquipmentForm input[name="type"]').parent().addClass('input-error');
                                } else {
                                    $('#' + key).addClass('input-error');
                                }
                            });
                        } else {
                            toastr.error('Failed to update equipment');
                        }
                    }
                });
            }
        });

        // jQuery Validation for Create Mapping Form
        $('#createMappingForm').validate({
            rules: {
                company_id: {
                    required: true
                },
                project_id: {
                    required: true
                },
                camera_id: {
                    required: true
                },
                tablet_id: {
                    required: true
                }
            },
            messages: {
                company_id: {
                    required: "Please select a company"
                },
                project_id: {
                    required: "Please select a project"
                },
                camera_id: {
                    required: "Please select a camera"
                },
                tablet_id: {
                    required: "Please select a tablet"
                }
            },
            errorPlacement: function(error, element) {
                var errorDiv = '#' + element.attr('id') + '_error';
                $(errorDiv).text(error.text()).removeClass('hidden');
                element.addClass('input-error');
            },
            success: function(label, element) {
                var errorDiv = '#' + $(element).attr('id') + '_error';
                $(errorDiv).addClass('hidden').text('');
                $(element).removeClass('input-error');
            }
        });

        // Handle Create Mapping Submission
        $('#createMappingSubmit').on('click', function(e) {
            e.preventDefault();
            if ($('#createMappingForm').valid()) {
                var formData = new FormData($('#createMappingForm')[0]);
                $.ajax({
                    url: '{{ route("mappings.store") }}',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toggleModal('createMappingModal');
                        mappingTable.ajax.reload(null, false);
                        toastr.success('Mapping created successfully');
                        $('#createMappingForm')[0].reset();
                        $('#createMappingForm select').val(null).trigger('change');
                        $('.text-red-500').addClass('hidden');
                        $('select').removeClass('input-error');
                    },
                    error: function(xhr) {
                        console.error('Error creating mapping:', xhr);
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, error) {
                                var errorDiv = '#' + key + '_error';
                                $(errorDiv).text(error[0]).removeClass('hidden');
                                $('#' + key).addClass('input-error');
                            });
                        } else {
                            toastr.error('Failed to create mapping');
                        }
                    }
                });
            }
        });

        // jQuery Validation for Edit Mapping Form
        $('#editMappingForm').validate({
            rules: {
                company_id: {
                    required: true
                },
                project_id: {
                    required: true
                },
                camera_id: {
                    required: true
                },
                tablet_id: {
                    required: true
                }
            },
            messages: {
                company_id: {
                    required: "Please select a company"
                },
                project_id: {
                    required: "Please select a project"
                },
                camera_id: {
                    required: "Please select a camera"
                },
                tablet_id: {
                    required: "Please select a tablet"
                }
            },
            errorPlacement: function(error, element) {
                var errorDiv = '#' + 'edit_' + element.attr('name') + '_error';
                $(errorDiv).text(error.text()).removeClass('hidden');
                element.addClass('error');
            },
            success: function(label, element) {
                var errorDiv = '#' + 'edit_' + $(element).attr('name') + '_error';
                $(errorDiv).addClass('hidden').text('');
                $(element).removeClass('input-error');
            }
        });

        // Handle Edit Mapping Submission
        $('#editMappingSubmit').on('click', function(e) {
            e.preventDefault();
            if ($('#editMappingForm').valid()) {
                var formData = new FormData($('#editMappingForm')[0]);
                var mappingId = $('#edit_mapping_id').val();
                $.ajax({
                    url: '{{ route("mappings.update", ":id") }}'.replace(':id', mappingId),
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toggleModal('editMappingModal');
                        mappingTable.ajax.reload(null, false);
                        toastr.success('Mapping updated successfully');
                        $('#editMappingForm')[0].reset();
                        $('#editMappingForm select').val(null).trigger('change');
                        $('.text-red-500').addClass('hidden');
                        $('select').removeClass('input-error');
                    },
                    error: function(xhr) {
                        console.error('Error updating mapping:', xhr);
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, error) {
                                var errorDiv = '#' + 'edit_' + key + '_error';
                                $(errorDiv).text(error[0]).removeClass('hidden');
                                $('#edit_' + key).addClass('input-error');
                            });
                        } else {
                            toastr.error('Failed to update mapping');
                        }
                    }
                });
            }
        });

        // jQuery Validation for Create Trackable Form
        $('#createTrackableForm').validate({
            rules: {
                trackable_name: {
                    required: true,
                    minlength: 2
                },
                other_name: {
                    minlength: 2
                }
            },
            messages: {
                trackable_name: {
                    required: "Please enter a trackable name",
                    minlength: "Trackable name must be at least 2 characters long"
                },
                other_name: {
                    minlength: "Other name must be at least 2 characters long"
                }
            },
            errorPlacement: function(error, element) {
                var errorDiv = '#' + element.attr('name').replace(/\[\]/g, '') + '_error';
                $(errorDiv).text(error.text()).removeClass('hidden');
                element.addClass('input-error');
            },
            success: function(label, element) {
                var errorDiv = '#' + $(element).attr('name').replace(/\[\]/g, '') + '_error';
                $(errorDiv).addClass('hidden').text('');
                $(element).removeClass('input-error');
            },
            ignore: [],
            submitHandler: function(form) {
                // Custom validation for linked objects
                if (!validateLinkedObjects()) {
                    return false;
                }
                
                // If validation passes, submit the form
                // Add your form submission logic here
                console.log('Form is valid and ready to submit');
                return false; // Remove this line when you add actual submission
            }
        });

        // Custom validation function for linked objects
        function validateLinkedObjects() {
            var linkedObjects = $('input[name="linked_objects[]"]');
            var hasValue = false;
            
            // Check if at least one linked object has a non-empty value
            linkedObjects.each(function() {
                if ($(this).val().trim().length > 0) {
                    hasValue = true;
                    return false; // Break out of loop
                }
            });
            
            if (!hasValue) {
                $('#linked_objects_error').text('Please add at least one linked object').removeClass('hidden');
                linkedObjects.addClass('input-error');
                return false;
            } else {
                $('#linked_objects_error').addClass('hidden').text('');
                linkedObjects.removeClass('input-error');
                return true;
            }
        }
        // Handle Create Trackable Submission
        $('#createTrackableSubmit').on('click', function(e) {
            e.preventDefault();
            // Manually validate linked_objects
            // var linkedObjects = $('input[name="linked_objects[]"]');
            // var validLinkedObjects = true;
            // linkedObjects.each(function() {
            //     if ($(this).val().trim().length === 0) {
            //         $(this).addClass('input-error');
            //         validLinkedObjects = false;
            //     } else {
            //         $(this).removeClass('input-error');
            //     }
            // });
            // if (!validLinkedObjects) {
            //     $('#linked_objects_error').text('Please fill in all linked objects or remove empty ones').removeClass('hidden');
            // } else {
            //     $('#linked_objects_error').addClass('hidden').text('');
            // }

            if ($('#createTrackableForm').valid() && validateLinkedObjects()) {
                var formData = new FormData($('#createTrackableForm')[0]);
                $.ajax({
                    url: '{{ route("trackables.store") }}',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toggleModal('createTrackableModal');
                        trackableTable.ajax.reload(null, false);
                        toastr.success('Trackable created successfully');
                        $('#createTrackableForm')[0].reset();
                        $('#linkedObjectsContainer').html(`
                            <div class="flex align-middle input-group">
                                <input type="text" name="linked_objects[]" class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[14px] border-[#EBEBEB] border-solid bg-white p-[7px] text-[#7A86A1] text-[14px] mr-[10px]" placeholder="Enter Linked Object">
                                <button type="button" class="border-[1px] rounded-[14px] border-[#EBEBEB] border-solid w-[50px] flex justify-center items-center" onclick="addNewLinkedObjectField('#linkedObjectsContainer', 'linked_objects[]')">
                                    <img src="{{ asset('admin-theme/assets/images/add-camera.png') }}" class="object-contain w-[50px] h-[41px] p-[11px]" alt="Add">
                                </button>
                            </div>
                        `);
                        $('.text-red-500').addClass('hidden');
                        $('input').removeClass('input-error');
                    },
                    error: function(xhr) {
                        console.error('Error creating trackable:', xhr);
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, error) {
                                var errorDiv = '#' + key.replace(/\.\d+/g, '') + '_error';
                                if (key.startsWith('linked_objects')) {
                                    $('#linked_objects_error').text(error[0]).removeClass('hidden');
                                    $('input[name="linked_objects[]"]').addClass('input-error');
                                } else {
                                    $(errorDiv).text(error[0]).removeClass('hidden');
                                    $('#' + key.replace(/\.\d+/g, '')).addClass('input-error');
                                }
                            });
                        } else {
                            toastr.error('Failed to create trackable');
                        }
                    }
                });
            }
        });

        // Cancel Create Equipment Modal
        window.cancelCreateEquipmentModal = function() {
            $('#createEquipmentForm')[0].reset();
            $('#cameraFields').removeClass('hidden');
            $('.text-red-500').addClass('hidden');
            $('input').removeClass('input-error');
            $('#createEquipmentForm input[name="type"][value="camera"]').prop('checked', true);
            toggleModal('createEquipmentModal');
        };

        // Cancel Edit Equipment Modal
        window.cancelEditEquipmentModal = function() {
            $('#editEquipmentForm')[0].reset();
            $('#editCameraFields').removeClass('hidden');
            $('.text-red-500').addClass('hidden');
            $('input').removeClass('input-error');
            toggleModal('editEquipmentModal');
        };

        // Cancel Create Mapping Modal
        window.cancelCreateMappingModal = function() {
            $('#createMappingForm')[0].reset();
            $('#createMappingForm select').val(null).trigger('change');
            $('.text-red-500').addClass('hidden');
            $('select').removeClass('input-error');
            toggleModal('createMappingModal');
        };

        // Cancel Edit Mapping Modal
        window.cancelEditMappingModal = function() {
            $('#editMappingForm')[0].reset();
            $('#editMappingForm select').val(null).trigger('change');
            $('.text-red-500').addClass('hidden');
            $('select').removeClass('input-error');
            toggleModal('editMappingModal');
        };

        // Cancel Create Trackable Modal
        window.cancelCreateTrackableModal = function() {
            $('#createTrackableForm')[0].reset();
            $('#linkedObjectsContainer').html(`
                <div class="flex align-middle input-group">
                    <input type="text" name="linked_objects[]" class="h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[14px] border-[#EBEBEB] border-solid bg-white p-[7px] text-[#7A86A1] text-[14px] mr-[10px]" placeholder="Enter Linked Object">
                    <button type="button" class="border-[1px] rounded-[14px] border-[#EBEBEB] border-solid w-[50px] flex justify-center items-center" onclick="addNewLinkedObjectField('#linkedObjectsContainer', 'linked_objects[]')">
                        <img src="{{ asset('admin-theme/assets/images/add-camera.png') }}" class="object-contain w-[50px] h-[41px] p-[11px]" alt="Add">
                    </button>
                </div>
            `);
            $('.text-red-500').addClass('hidden');
            $('input').removeClass('input-error');
            toggleModal('createTrackableModal');
        };

        window.toggleEquipmentStatus = function(equipmentId) {
            $.ajax({
                url: '{{ url("equipments") }}/' + equipmentId + '/toggle-active',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        equipmentTable.ajax.reload(null, false);
                    }
                },
                error: function(xhr) {
                    console.error('Error toggling status:', xhr);
                    alert('Failed to update status');
                }
            });
        };

        // Fetch equipment data and populate edit modal
        window.showEditModal = function(equipmentId) {
            $.ajax({
                url: '{{ url("equipments") }}/' + equipmentId + '/edit',
                method: 'GET',
                success: function(response) {
                    // Populate the edit modal fields
                    $('#edit_equipment_id').val(response.id);
                    $('#edit_equipment_name').val(response.equipment_name);
                    $('#edit_equipment_code').val(response.equipment_code);
                    $('#editEquipmentForm').attr('action', '{{ url("equipments") }}/' + response.id);

                    // Set the correct radio button and show appropriate fields
                    if (response.type === 'camera') {
                        $('#edit_type_camera').prop('checked', true);
                    } else if (response.type === 'tablet') {
                        $('#edit_type_tablet').prop('checked', true);
                    }

                    // Open the edit modal
                    toggleModal('editEquipmentModal');
                },
                error: function(xhr) {
                    console.error('Error fetching equipment data:', xhr);
                    alert('Failed to load equipment data');
                }
            });
        };

        window.toggleMappingStatus = function(mappingId) {
            $.ajax({
                url: '{{ url("mappings") }}/' + mappingId + '/toggle-active',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        mappingTable.ajax.reload(null, false);
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
                    $('#edit_camera_id').val(response.camera_id);
                    $('#edit_tablet_id').val(response.tablet_id);
                    $('#editMappingForm').attr('action', '{{ url("mappings") }}/' + response.id);
                    // Clear previous validation errors
                    $('#editMappingForm').validate().resetForm();
                    $('.text-red-500').addClass('hidden');
                    $('#editMappingForm select').removeClass('input-error');

                    // Open the edit modal
                    toggleModal('editMappingModal');
                },
                error: function(xhr) {
                    console.error('Error fetching mapping data:', xhr);
                    alert('Failed to load mapping data');
                }
            });
        };

        window.toggleTrackableStatus = function(trackableId) {
            $.ajax({
                url: '{{ url("trackables") }}/' + trackableId + '/toggle-active',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        trackableTable.ajax.reload(null, false);
                    }
                },
                error: function(xhr) {
                    console.error('Error toggling status:', xhr);
                    alert('Failed to update status');
                }
            });
        };

        // Fetch trackable data and populate edit modal
        window.showTrackableEditModal = function(trackableId) {
            $.ajax({
                url: '{{ url("trackables") }}/' + trackableId + '/edit',
                method: 'GET',
                success: function(response) {
                    // Populate the edit modal fields
                    $('#edit_trackable_id').val(response.id);
                    $('#edit_trackable_name').val(response.trackable_name);
                    $('#edit_other_name').val(response.other_name);
                    $('#edit_status').text(response.status).removeClass('bg-[#047413] bg-[#F96767]').addClass(response.status === 'Active' ? 'bg-[#047413]' : 'bg-[#F96767]');
                    $('#editTrackableForm').attr('action', '{{ url("trackables") }}/' + response.id);

                    // Populate linked objects container
                    let container = $('#editLinkedObjectsContainer');
                    container.empty();

                    // Add blank input with Add button at the top
                    let initialDiv = $('<div>').addClass('flex align-middle input-group');
                    let initialInput = $('<input>')
                        .attr('type', 'text')
                        .attr('name', 'linked_objects[]')
                        .addClass('h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[14px] border-[#EBEBEB] border-solid bg-white p-[7px] text-[#7A86A1] text-[14px] mr-[10px]')
                        .attr('placeholder', 'Enter Type')
                        .on('input', function() { checkInput(this); });
                    let addButton = $('<button>')
                        .attr('id', 'addLinkedObject')
                        .addClass('border-[1px] rounded-[14px] border-[#EBEBEB] border-solid w-[50px] flex justify-center items-center')
                        .html('<img src="{{ asset('admin-theme/assets/images/add-camera.png') }}" class="object-contain w-[50px] h-[41px] p-[11px]" alt="Add">')
                        .prop('disabled', true)
                        .on('click', function(event) {
                            event.preventDefault();
                            addNewField(this);
                        });
                    initialDiv.append(initialInput).append(addButton);
                    container.append(initialDiv);

                    // Add existing linked objects with Delete buttons
                    if (response.linked_objects && response.linked_objects.length > 0) {
                        response.linked_objects.forEach(function(object) {
                            let div = $('<div>').addClass('flex align-middle input-group');
                            let input = $('<input>')
                                .attr('type', 'text')
                                .attr('name', 'linked_objects[]')
                                .val(object)
                                .addClass('h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[14px] border-[#EBEBEB] border-solid bg-white p-[7px] text-[#7A86A1] text-[14px] mr-[10px]')
                                .attr('placeholder', 'Enter Linked Object');
                            let deleteButton = $('<button>')
                                .addClass('border-[1px] rounded-[14px] border-[#EBEBEB] border-solid w-[50px] flex justify-center items-center remove-linked-object')
                                .html('<img src="{{ asset('admin-theme/assets/images/delete.png') }}" class="w-[20px] h-[20px]" alt="Delete">')
                                .on('click', function() {
                                    div.remove();
                                });
                            div.append(input).append(deleteButton);
                            container.append(div);
                        });
                    }

                    // Open the edit modal
                    toggleModal('editTrackableModal');
                },
                error: function(xhr) {
                    console.error('Error fetching trackable data:', xhr);
                    alert('Failed to load trackable data');
                }
            });
        };

        // Handle edit form submission via AJAX
        $('#editTrackableForm').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST', // Laravel handles PUT via _method
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                      if (response.success) {
                        toggleModal('editTrackableModal');
                        trackableTable.ajax.reload(null, false);
                        toastr.success('Trackable updated successfully');
                        
                    }                 
                },
                error: function(xhr) {
                    console.error('Error updating trackable:', xhr);
                    let errors = xhr.responseJSON?.errors;
                    if (errors) {
                        let errorMsg = Object.values(errors).flat().join('\n');
                        alert('Validation errors:\n' + errorMsg);
                    } else {
                        alert('Failed to update trackable');
                    }
                }
            });
        });

         $('#company_id').on('change', function() {
            var companyId = $(this).val();
            var $projectSelect = $('#project_id');

            // Clear existing options and reinitialize Select2
            $projectSelect.empty().trigger('change');

            if (companyId) {
                // Fetch related projects via AJAX
                $.ajax({
                    url: '{{ route("mappings.get-projects") }}',
                    method: 'POST',
                    data: {
                        company_id: companyId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success && response.projects) {
                            // Populate project dropdown
                            $.each(response.projects, function(id, name) {
                                var option = new Option(name, id, false, false);
                                $projectSelect.append(option);
                            });
                            // Reinitialize Select2
                            $projectSelect.trigger('change');
                        } else {
                            toastr.error('No projects found for this company');
                        }
                    },
                    error: function(xhr) {
                        console.error('Error fetching projects:', xhr);
                        toastr.error('Failed to load projects');
                    }
                });
            }
        });
    });

    let previousTab = null;

    // Toggle action buttons based on active tab
    function toggleActionButtons(tabId) {
        $('.tab-action-btn').addClass('hidden');
        switch (tabId) {
            case 'equipment':
                $('#add-equipment-btn').removeClass('hidden');
                break;
            case 'mapping':
                $('#create-mapping-btn').removeClass('hidden');
                break;
            case 'trackable':
                $('#add-trackable-btn').removeClass('hidden');
                break;
            case 'ai-model':
                $('#add-ai-model-btn').removeClass('hidden');
                break;
            case 'event-type':
                $('#add-event-type-btn').removeClass('hidden');
                break;
        }
    }

    function openTab(event, tabId) {
        // Hide all tab contents
        document.querySelectorAll('.tab-prop').forEach(tab => tab.classList.add('hidden'));

        // Remove active styles from all buttons
        document.querySelectorAll('.tab-button').forEach(tab => {
            tab.classList.remove('border-b-[#437651]', 'border-b-solid', 'border-b-[2px]');
        });

        // Show selected tab content
        const selectedTab = document.getElementById(tabId);
        if (selectedTab) selectedTab.classList.remove('hidden');

        // Style clicked tab button
        event.currentTarget.classList.add('border-b-[#437651]', 'border-b-solid', 'border-b-[2px]');
        previousTab = event.currentTarget;

        // Toggle action buttons
        toggleActionButtons(tabId);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const firstTabButton = document.querySelector('.tab-button');
        const firstTabId = firstTabButton?.getAttribute('onclick')?.match(/'([^']+)'/)?.[1];
        const firstTabContent = firstTabId ? document.getElementById(firstTabId) : null;

        if (firstTabButton && firstTabContent) {
            firstTabContent.classList.remove('hidden');
            firstTabButton.classList.add('border-b-[#437651]', 'border-b-solid', 'border-b-[2px]');
            previousTab = firstTabButton;

            // Show only the equipment button initially
            toggleActionButtons('equipment');

            // Trigger DataTable refresh for the initial tab
            setTimeout(function() {
                if (firstTabId === 'equipment' && $.fn.DataTable.isDataTable('#equipments-table')) {
                    $('#equipments-table').DataTable().columns.adjust().responsive.recalc();
                }
            }, 100);
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('#equipment thead th').each(function() {
            const thText = $(this).text().trim();

            if (thText === 'Status') {
                $(this).addClass('status');
            } else if (thText === 'Action') {
                $(this).addClass('action');
            } else if (thText === 'Project Name') {
                $(this).addClass('name');
            } else if (thText === 'Company Name') {
                $(this).addClass('company');
            } else if (thText === 'Equipment Type') {
                $(this).addClass('equipmentType');
            } else if (thText === 'Equipment Code') {
                $(this).addClass('equipmentCode');
            } else if (thText === 'Equipment Name') {
                $(this).addClass('equipmentName');
            } else if (thText === 'Mapped To') {
                $(this).addClass('mappedto');
            }
            // Add more cases as needed
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#mappings-table thead th').each(function() {
            const thText = $(this).text().trim();

            if (thText === 'Status') {
                $(this).addClass('status');
            } else if (thText === 'Action') {
                $(this).addClass('action');
            } else if (thText === 'Project Name') {
                $(this).addClass('name');
            } else if (thText === 'Company Name') {
                $(this).addClass('company');
            } else if (thText === 'Equipment Type') {
                $(this).addClass('equipmentType');
            } else if (thText === 'Equipment Code') {
                $(this).addClass('equipmentCode');
            } else if (thText === 'Camera Name') {
                $(this).addClass('equipmentName');
            } else if (thText === 'Tablet Name') {
                $(this).addClass('mappedto');
            }
            // Add more cases as needed
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#trackables-table thead th').each(function() {
            const thText = $(this).text().trim();

            if (thText === 'Status') {
                $(this).addClass('status');
            } else if (thText === 'Action') {
                $(this).addClass('action');
            } else if (thText === 'Trackable Name') {
                $(this).addClass('name');
            } else if (thText === 'Other Name') {
                $(this).addClass('equipmentName');
            } else if (thText === 'Linked Objects') {
                $(this).addClass('linked');
            }
            // Add more cases as needed
        });
    });
</script>
@endpush