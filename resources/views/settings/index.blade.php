@extends('layouts.app')

@section('content')
<div class="">
    <div class="form-list">
        <div class="flex justify-between pr-[20px] mr-[5px]">
            <div class="py-[10px] px-[25px] mt-[0px] flex">
                <button class="tab-button block text-[#323131] manrope-regular text-[16px] py-[5px] ml-[0px] mr-[25px] mb-[5px]" onclick="openTab(event, 'equipment')">
                    Equipment
                </button>
                <button class="tab-button block text-[#323131] manrope-regular text-[16px] py-[5px] ml-[25px] mr-[25px] mb-[5px]" onclick="openTab(event, 'mapping')">
                    Mapping
                </button>
                <button class="tab-button block text-[#323131] manrope-regular text-[16px] py-[5px] ml-[25px] mr-[25px] mb-[5px]" onclick="openTab(event, 'trackable')">
                    Trackable
                </button>
                <button class="tab-button block text-[#323131] manrope-regular text-[16px] py-[5px] ml-[25px] mr-[25px] mb-[5px]" onclick="openTab(event, 'ai-model')">
                    AI Model
                </button>
                <button class="tab-button block text-[#323131] manrope-regular text-[16px] py-[5px] ml-[25px] mr-[25px] mb-[5px]" onclick="openTab(event, 'event-type')">
                    Event Type
                </button>
            </div>
            <button
                class="flex manrope-medium bg-[#437651] select-shadow btn rounded-[8px] py-[10px] px-[25px] text-[14px] border-[1px] border-solid border-[#437651] text-white"
                onclick="toggleModal('createEquipmentModal')" style="height:43px;">
                <span class="mr-[10px]"><img src="{{ asset('admin-theme/assets/images/add.png')}}" class="w-[15px] mt-[2px]"></span> Add Equipment
            </button>
        </div>
            <div class="py-[10px] px-[25px] tab-content" id="v-pills-tabContent">
                <div class="tab-prop hidden" id="equipment">
                    <div class="company-table h-full">
                        <div class="form-list">
                            <div class="">
                                <div class="flex flex-wrap">
                                    <div class="sm:w-6/6 md:w-2/6 lg:w-2/6 w-full flex">
                                        <h3 class="manrope-medium text-[#344563] text-[18px] mt-[17px]">Equipment List</h3>
                                    </div>
                                    <div class="sm:w-6/6 md:w-4/6 lg:w-4/6 w-full">
                                        <div class="table-filter-block mt-[0px]">
                                            <div class="flex justify-end">
                                                <p class="flex items-center mr-[8px]">
                                                    <div class="relative flex items-center mr-[8px]">
                                                        <!-- Search Input -->
                                                        <input type="text" id="search-input"
                                                            class="w-0 p-0 border border-[#EBEBEB] rounded-[11px] absolute right-[19px] z-[8] transition-all duration-300 overflow-hidden bg-white"
                                                            placeholder="Search...">

                                                        <!-- Search Button -->
                                                        <button id="search-toggle"
                                                            class="p-[11px] rounded-[15px] border border-[#EBEBEB] ml-2 z-[8] bg-white">
                                                            <img src="{{ asset('admin-theme/assets/images/table-search.png')}}" class="w-[16px]">
                                                        </button>
                                                    </div>
                                                </p>
                                                <p class="flex items-center mr-[8px]">
                                                    <select id="equipment-company-filter" multiple class="filter-select w-[150px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="Company Name">
                                                        @foreach($companies as $id => $name)
                                                        <option value="{{ $id }}">{{ $name }}</option>
                                                        @endforeach
                                                    </select>
                                                </p>
                                                <p class="flex items-center mr-[8px]">
                                                    <select id="equipment-project-filter" multiple class="filter-select w-[100px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="Project">
                                                        @foreach($projects as $id => $name)
                                                        <option value="{{ $id }}">{{ $name }}</option>
                                                        @endforeach
                                                    </select>
                                                </p>
                                                <p class="flex items-center mr-[8px]">
                                                    <select id="equipment-equipment-filter" multiple class="filter-select w-[120px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="Equipment">
                                                        @foreach($equipments as $id => $name)
                                                        <option value="{{ $id }}">{{ $name }}</option>
                                                        @endforeach
                                                    </select>
                                                </p>
                                                <p class="flex items-center mr-[8px]">
                                                    <select id="equipment-plant-filter" multiple class="filter-select w-[120px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="Plant Name">
                                                        @foreach($plants as $plant)
                                                        <option value="{{ $plant }}">{{ $plant }}</option>
                                                        @endforeach
                                                    </select>
                                                </p>
                                                <p class="flex items-center mr-[8px]">
                                                    <select id="equipment-status-filter" multiple class="filter-select w-[100px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="Status">
                                                        @foreach($statuses as $id => $name)
                                                        <option value="{{ $id }}">{{ $name }}</option>
                                                        @endforeach
                                                    </select>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-list-table">
                                <div class="mt-[20px]">
                                    <div class="relative">
                                        {!! $equipmentDataTable->table(['class' => 'all-table table table-bordered table-striped whitespace-nowrape', 'id' => 'equipments-table'], true) !!}
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
                                <div class="flex flex-wrap">
                                    <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                                        <h3 class="manrope-medium text-[#344563] text-[18px] mt-[17px]">Device Mapped - 40</h3>
                                    </div>
                                    <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                                        <div class="table-filter lg:float-right md:float-right sm:float-left xs:float-left">
                                            <ul class="list-inline list-unstyled flex">
                                                <li class="list-inline-item mr-[15px]">
                                                    <button
                                                        class="flex manrope-medium bg-[#437651] select-shadow btn rounded-[8px] py-[10px] px-[25px] text-[14px] border-[1px] border-solid border-[#437651] text-white"
                                                        onclick="toggleModal('createMappingModal')">
                                                        <span class="mr-[10px]"><img src="{{ asset('admin-theme/assets/images/add.png')}}" class="w-[15px] mt-[2px]"></span> Create Mapping
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-filter-block mt-[30px]">
                                <div class="flex justify-end">
                                    <p class="flex items-center mr-[8px]">
                                        <div class="relative flex items-center mr-[8px]">
                                            <!-- Search Input -->
                                            <input type="text" id="search-input"
                                                class="w-0 p-0 border border-[#EBEBEB] rounded-[11px] absolute right-[19px] z-[8] transition-all duration-300 overflow-hidden bg-white"
                                                placeholder="Search...">

                                            <!-- Search Button -->
                                            <button id="search-toggle"
                                                class="p-[11px] rounded-[15px] border border-[#EBEBEB] ml-2 z-[9] bg-white">
                                                <img src="{{ asset('admin-theme/assets/images/table-search.png')}}" class="w-[16px]">
                                            </button>
                                        </div>
                                    </p>
                                    <p class="flex items-center mr-[8px]">
                                        <select id="mapping-company-filter" multiple class="filter-select w-[150px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="Company Name">
                                            @foreach($companies as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </p>
                                    <p class="flex items-center mr-[8px]">
                                        <select id="mapping-project-filter" multiple class="filter-select w-[100px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="Project">
                                            @foreach($projects as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </p>
                                    <p class="flex items-center mr-[8px]">
                                        <select id="mapping-plant-filter" multiple class="filter-select w-[120px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="Plant Name">
                                            @foreach($plants as $plant)
                                            <option value="{{ $plant }}">{{ $plant }}</option>
                                            @endforeach
                                        </select>
                                    </p>
                                    <p class="flex items-center mr-[8px]">
                                        <select id="mapping-tablet-filter" multiple class="filter-select w-[100px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="Tablet">
                                            <option value="IPad">IPad</option>
                                        </select>
                                    </p>
                                    <p class="flex items-center mr-[8px]">
                                        <select id="mapping-status-filter" multiple class="filter-select w-[100px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="Status">
                                            @foreach($statuses as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </p>
                                </div>
                            </div>
                            <div class="form-list-table">
                                <div class="mt-[20px]">
                                    <div class="relative overflow-x-scroll h-full">
                                        <table id="mappings-table" class="w-full text-sm text-left">
                                            <thead class="all-table border-b-[2px] border-solid border-b-[#E9EDF0]">
                                                <tr>
                                                    <th class="text-center"><div class="p-[10px] pb-[25px]"><input type="checkbox" id="select-people" class="border-gray-300 rounded h-4 w-4 accent-[#437651] mt-[15px] ml-[20px]" /></div></th>
                                                    <th scope="col" class="px-6 py-3 pb-[15px] text-left manrope-medium text-[#344563] font-medium text-[15px]">Company Name</th>
                                                    <th scope="col" class="px-6 py-3 pb-[15px] text-left manrope-medium text-[#344563] font-medium text-[15px]">Project Name</th>
                                                    <th scope="col" class="px-6 py-3 pb-[15px] text-left manrope-medium text-[#344563] font-medium text-[15px]">Plant Name</th>
                                                    <th scope="col" class="px-6 py-3 pb-[15px] text-center manrope-medium text-[#344563] font-medium text-[15px]">Camera Name</th>
                                                    <th scope="col" class="px-6 py-3 pb-[15px] text-center manrope-medium text-[#344563] font-medium text-[15px]">Tablet Name</th>
                                                    <th scope="col" class="px-6 py-3 pb-[15px] text-center manrope-medium text-[#344563] font-medium text-[15px]">Streaming Links</th>
                                                    <th scope="col" class="px-6 py-3 pb-[15px] text-center manrope-medium text-[#344563] font-medium text-[15px]">Status</th>
                                                    <th scope="col" class="px-6 py-3 pb-[15px] text-center manrope-medium text-[#344563] font-medium text-[15px]">Action</th>
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
                <div class="tab-prop hidden" id="trackable">
                    <div class="company-table h-full">
                        <div class="form-list">
                            <div class="">
                                <div class="flex flex-wrap">
                                    <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                                        <h3 class="manrope-medium text-[#344563] text-[18px] mt-[17px]">Trackable - 10</h3>
                                    </div>
                                    <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                                        <div class="table-filter lg:float-right md:float-right sm:float-left xs:float-left">
                                            <ul class="list-inline list-unstyled flex">
                                                <li class="list-inline-item mr-[15px]">
                                                    <button
                                                        class="flex manrope-medium bg-[#437651] select-shadow btn rounded-[8px] py-[10px] px-[25px] text-[14px] border-[1px] border-solid border-[#437651] text-white"
                                                        onclick="toggleModal('createTrackableModal')">
                                                        <span class="mr-[10px]"><img src="{{ asset('admin-theme/assets/images/add.png')}}" class="w-[15px] mt-[2px]"></span> Add new
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-filter-block mt-[30px]">
                                <div class="flex justify-end">
                                    <p class="flex items-center mr-[8px]">
                                        <div class="relative flex items-center mr-[8px]">
                                            <!-- Search Input -->
                                            <input type="text" id="search-input"
                                                class="w-0 p-0 border border-[#EBEBEB] rounded-[11px] absolute right-[19px] z-[8] transition-all duration-300 overflow-hidden bg-white"
                                                placeholder="Search...">

                                            <!-- Search Button -->
                                            <button id="search-toggle"
                                                class="p-[11px] rounded-[15px] border border-[#EBEBEB] ml-2 z-[9] bg-white">
                                                <img src="{{ asset('admin-theme/assets/images/table-search.png')}}" class="w-[16px]">
                                            </button>
                                        </div>
                                    </p>
                                    <p class="flex items-center mr-[8px]">
                                        <select id="trackable-name-filter" multiple class="filter-select w-[100px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="Name">
                                            @foreach($trackables as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </p>
                                    <p class="flex items-center mr-[8px]">
                                        <select id="trackable-type-filter" multiple class="filter-select w-[120px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="Other name">
                                            <option value="Type">Type</option>
                                        </select>
                                    </p>
                                    <p class="flex items-center mr-[8px]">
                                        <select id="trackable-status-filter" multiple class="filter-select w-[100px] p-2 border border-[#ebebeb] rounded-[10px] manrope-medium text-[#444] text-[14px]" data-placeholder="Status">
                                            @foreach($statuses as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </p>
                                </div>
                            </div>
                            <div class="form-list-table">
                                <div class="mt-[20px]">
                                    <div class="relative overflow-x-scroll h-full">
                                        <table id="trackables-table" class="w-full text-sm text-left">
                                            <thead class="all-table border-b-[2px] border-solid border-b-[#E9EDF0]">
                                                <tr>
                                                    <th class="text-center pl-[10px] pb-[25px]">
                                                        <div class=""><input type="checkbox" id="select-people" class="border-gray-300 rounded h-4 w-4 accent-[#437651] focus:ring-0" /></div>
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-center manrope-medium text-[#344563] font-medium text-[15px]">Trackable Name</th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-center manrope-medium text-[#344563] font-medium text-[15px]">Other name</th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-center manrope-medium text-[#344563] font-medium text-[15px]">Linked Objects</th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-center manrope-medium text-[#344563] font-medium text-[15px]">Status</th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-center manrope-medium text-[#344563] font-medium text-[15px]">Action</th>
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
                <div class="tab-prop hidden" id="ai-model">
                    <div class="company-table h-full">
                        <div class="form-list">
                            <div class="">
                                <div class="flex flex-wrap">
                                    <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                                        <h3 class="manrope-medium text-[#344563] text-[18px] mt-[17px]">Overall list</h3>
                                    </div>
                                    <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                                        <div class="table-filter lg:float-right md:float-right sm:float-left xs:float-left">
                                            <ul class="list-inline list-unstyled flex">
                                                <li class="list-inline-item mr-[15px]">
                                                    <button
                                                        class="flex manrope-medium bg-[#437651] select-shadow btn rounded-[8px] py-[10px] px-[25px] text-[14px] border-[1px] border-solid border-[#437651] text-white"
                                                        onclick="toggleModaladdai()">
                                                        <span class="mr-[10px]"><img src="{{ asset('admin-theme/assets/images/add.png')}}" class="w-[15px] mt-[2px]"></span> Add New
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
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
                                        <table id="ai-models-table" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
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
                                        <h3 class="manrope-medium text-[#344563] text-[18px] mt-[17px]">Overall list</h3>
                                    </div>
                                    <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                                        <div class="table-filter lg:float-right md:float-right sm:float-left xs:float-left">
                                            <ul class="list-inline list-unstyled flex">
                                                <li class="list-inline-item mr-[15px]">
                                                    <button
                                                        class="flex manrope-medium bg-[#437651] select-shadow btn rounded-[8px] py-[10px] px-[25px] text-[14px] border-[1px] border-solid border-[#437651] text-white"
                                                        onclick="toggleModalevent()">
                                                        <span class="mr-[10px]"><img src="{{ asset('admin-theme/assets/images/add.png')}}" class="w-[15px] mt-[2px]"></span> Add New
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
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
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-center color-[#3D3D3D] text-[15px] manrope-regular ">Event Name</th>
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
{!! $equipmentDataTable->scripts() !!}
<script>
    $(document).ready(function() {
        let mappingTable;
        let trackableTable;
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

        // Track which DataTables have been initialized
        let initializedTables = {
            equipment: true, // Equipment is initialized by default
            mapping: false,
            trackable: false,
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

        // Initialize mapping DataTable
        function initializeMappingDataTable() {
            if (!initializedTables.mapping && $('#mappings-table').length) {
                // Load the mapping DataTable via AJAX
                $.get('{{ route("mappings.index") }}', function(data) {
                    mappingTable = $('#mappings-table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: '{{ route("mappings.index") }}',
                        columns: [{
                                data: 'checkbox',
                                name: 'checkbox',
                                orderable: false,
                                searchable: false
                            },
                            {
                                data: 'company_name',
                                name: 'company_name'
                            },
                            {
                                data: 'project_name',
                                name: 'project_name'
                            },
                            {
                                data: 'plant_name',
                                name: 'plant_name'
                            },
                            {
                                data: 'camera_name',
                                name: 'camera_name'
                            },
                            {
                                data: 'tablet_name',
                                name: 'tablet_name'
                            },
                            {
                                data: 'streaming_links',
                                name: 'streaming_links'
                            },
                            {
                                data: 'status',
                                name: 'status'
                            },
                            {
                                data: 'action',
                                name: 'action',
                                orderable: false,
                                searchable: false
                            }
                        ],
                        responsive: true,
                        pageLength: 10,
                        order: [
                            [1, 'asc']
                        ],
                        columnDefs: [{
                                orderable: false,
                                targets: [0, 8]
                            },
                            {
                                responsivePriority: 1,
                                targets: [1, 7]
                            }
                        ]
                    });
                    initializedTables.mapping = true;
                }).fail(function() {
                    console.error('Failed to load mapping data');
                });
            }
        }

        // Initialize trackable DataTable
        function initializeTrackableDataTable() {
            if (!initializedTables.trackable && $('#trackables-table').length) {
                // Load the trackable DataTable via AJAX
                $.get('{{ route("trackables.index") }}', function(data) {
                    trackableTable = $('#trackables-table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: '{{ route("trackables.index") }}',
                        columns: [{
                                data: 'checkbox',
                                name: 'checkbox',
                                orderable: false,
                                searchable: false
                            },
                            {
                                data: 'trackable_name',
                                name: 'trackable_name'
                            },
                            {
                                data: 'other_name',
                                name: 'other_name'
                            },
                            {
                                data: 'linked_objects',
                                name: 'linked_objects'
                            },
                            {
                                data: 'status',
                                name: 'status'
                            },
                            {
                                data: 'action',
                                name: 'action',
                                orderable: false,
                                searchable: false
                            }
                        ],
                        responsive: true,
                        pageLength: 10,
                        order: [
                            [1, 'asc']
                        ],
                        columnDefs: [{
                                orderable: false,
                                targets: [0, 5]
                            },
                            {
                                responsivePriority: 1,
                                targets: [1, 4]
                            }
                        ]
                    });
                    initializedTables.trackable = true;
                }).fail(function() {
                    console.error('Failed to load trackable data');
                });
            }
        }

        // Handle tab switching and DataTable initialization
        $('.tab-button').on('click', function(event) {
            const tabId = $(this).attr('onclick').match(/'([^']+)'/)[1];

            // Initialize DataTables based on the active tab
            setTimeout(function() {
                if (tabId === 'equipment' && $.fn.DataTable.isDataTable('#equipments-table')) {
                    $('#equipments-table').DataTable().columns.adjust().responsive.recalc();
                } else if (tabId === 'mapping') {
                    initializeMappingDataTable();
                    if ($.fn.DataTable.isDataTable('#mappings-table')) {
                        $('#mappings-table').DataTable().columns.adjust().responsive.recalc();
                    }
                } else if (tabId === 'trackable') {
                    initializeTrackableDataTable();
                    if ($.fn.DataTable.isDataTable('#trackables-table')) {
                        $('#trackables-table').DataTable().columns.adjust().responsive.recalc();
                    }
                } else if (tabId === 'ai-model' || tabId === 'event-type') {
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
                equipment_code: {
                    required: true,
                    minlength: 6
                },
                password: {
                    required: true,
                    minlength: 8
                },
                stream_link: {
                    required: function(element) {
                        return $('#createEquipmentForm input[name="type"]:checked').val() === 'camera';
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
                equipment_code: {
                    required: "Please enter an equipment code",
                    minlength: "Equipment code must be at least 6 characters long"
                },
                password: {
                    required: "Please enter a password",
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
            }
        });

        // Handle Create Equipment Submission
        $('#createEquipmentSubmit').on('click', function(e) {
            e.preventDefault();
            if ($('#createEquipmentForm').valid()) {
                var formData = new FormData($('#createEquipmentForm')[0]);
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
                        $('#cameraFields').removeClass('hidden');
                        $('.text-red-500').addClass('hidden');
                        $('input').removeClass('input-error');
                        $('#createEquipmentForm input[name="type"][value="camera"]').prop('checked', true);
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
                equipment_code: {
                    required: true,
                    minlength: 6
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
                equipment_code: {
                    required: "Please enter an equipment code",
                    minlength: "Equipment code must be at least 6 characters long"
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
            }
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

        // Toggle camera fields for Create Equipment modal
        $('#createEquipmentForm input[name="type"]').on('change', function() {
            if ($(this).val() === 'camera') {
                $('#cameraFields').removeClass('hidden');
            } else {
                $('#cameraFields').addClass('hidden');
                $('#stream_link').val('').removeClass('input-error');
                $('#stream_link_error').addClass('hidden').text('');
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

        // Copy streaming link to clipboard
        $(document).on('click', '.copy-streaming-link', function() {
            let url = $(this).data('link');
            navigator.clipboard.writeText(url).then(() => {
                alert('Link copied to clipboard!');
            }).catch(err => {
                console.error('Failed to copy: ', err);
                alert('Failed to copy link');
            });
        });

        // Fetch equipment data and populate edit modal
        window.showEditModal = function(equipmentId) {
            $.ajax({
                url: '{{ url("equipments") }}/' + equipmentId + '/edit',
                method: 'GET',
                success: function(response) {
                    // Populate the edit modal fields
                    $('#edit_equipment_id').val(response.id);
                    $('#edit_equipment_name').val(response.equipment_name);
                    $('#edit_stream_link').val(response.stream_link);
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

                    // Populate linked objects
                    let container = $('#editLinkedObjectsContainer');
                    container.empty();
                    if (response.linked_objects && response.linked_objects.length > 0) {
                        response.linked_objects.forEach(function(object, index) {
                            let div = $('<div>').addClass('flex align-middle input-group');
                            let input = $('<input>')
                                .attr('type', 'text')
                                .attr('name', 'linked_objects[]')
                                .val(object)
                                .addClass('h-[44px] focus-visible:outline-none w-full border-[1px] rounded-[14px] border-[#EBEBEB] border-solid bg-white p-[7px] text-[#7A86A1] text-[14px] mr-[10px]')
                                .attr('placeholder', 'Enter Linked Object');
                            let button = $('<button>')
                                .addClass('border-[1px] rounded-[14px] border-[#EBEBEB] border-solid w-[50px] flex justify-center items-center')
                                .html('<img src="{{ asset('admin-theme/assets/images/delete.png ') }}" class="w-[20px] h-[20px]" alt="Delete">')
                                .on('click', function() {
                                    div.remove();
                                });
                            div.append(input).append(button);
                            container.append(div);
                        });
                    }
                    // Add one empty input field
                    addNewLinkedObjectField('#editLinkedObjectsContainer', 'linked_objects[]');

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
                        table.ajax.reload(null, false); // Refresh DataTable
                        toggleModal('editTrackableModal'); // Close modal
                        alert('Trackable updated successfully');
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
    });

    let previousTab = null;

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
    }

    document.addEventListener('DOMContentLoaded', function() {
        const firstTabButton = document.querySelector('.tab-button');
        const firstTabId = firstTabButton?.getAttribute('onclick')?.match(/'([^']+)'/)?.[1];
        const firstTabContent = firstTabId ? document.getElementById(firstTabId) : null;

        if (firstTabButton && firstTabContent) {
            firstTabContent.classList.remove('hidden');
            firstTabButton.classList.add('border-b-[#437651]', 'border-b-solid', 'border-b-[2px]');
            previousTab = firstTabButton;

            // Trigger DataTable refresh for the initial tab
            setTimeout(function() {
                if (firstTabId === 'equipment' && $.fn.DataTable.isDataTable('#equipments-table')) {
                    $('#equipments-table').DataTable().columns.adjust().responsive.recalc();
                }
            }, 100);
        }
    });
</script>
@endpush