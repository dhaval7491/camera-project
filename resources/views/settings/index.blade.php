@extends('layouts.app')

@section('content')
<div class="">
    <div class="form-list">
        <div class="">
            <div class="py-[10px] px-[25px] mt-[0px] flex">
                <button class="tab-button block text-[#323131] manrope-regular text-[16px] py-[5px] ml-[25px] mr-[25px] mb-[5px]" onclick="openTab(event, 'equipment')">
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
            <div class="py-[10px] px-[25px] tab-content" id="v-pills-tabContent">
                <div class="tab-prop hidden" id="equipment">
                    <div class="company-table h-full">
                        <div class="form-list">
                            <div class="">
                                <div class="flex flex-wrap">
                                    <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full flex">
                                        <h3 class="manrope-medium text-[#344563] text-[18px] mt-[17px]">Equipment List</h3>
                                    </div>
                                    <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                                        <div class="table-filter lg:float-right md:float-right sm:float-left xs:float-left">
                                            <ul class="list-inline list-unstyled flex">
                                                <li class="list-inline-item mr-[15px]">
                                                    <button
                                                        class="flex manrope-medium bg-[#437651] select-shadow btn rounded-[8px] py-[10px] px-[25px] text-[14px] border-[1px] border-solid border-[#437651] text-white"
                                                        onclick="toggleModale()">
                                                        <span class="mr-[10px]"><img src="assets/images/add.png" class="w-[15px] mt-[2px]"></span> Add Equipment
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
                                    <div x-data="{ open: false, search: '', selected: 'Company Name', options: ['Digital Horizon Systems', 'ByteCore Technologies', 'London Technova Solutions'],selectedOptions: [] }" class="relative ">
                                        <button @click="open = !open" class=" p-2 bg-white focus:outline-none w-[150px] text-left manrope-medium font-medium text-[#444] text-[14px] border-[1px] border-solid border-[#ebebeb] rounded-[10px] filter-buttons">
                                            <span x-text="selected"></span>
                                        </button>

                                        <div x-show="open" @click.away="open = false" class="absolute mt-1 w-[280px] bg-white border border-gray-300 rounded-lg shadow-md manrope-medium font-medium text-[#6a6a75] text-[16px] z-[9]">
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
                                    <div x-data="{ open: false, search: '', selected: 'Project', options: ['Project 1', 'Project 2', 'Project 3', 'Project 4'],selectedOptions: [] }" class="relative ">
                                        <button @click="open = !open" class=" p-2 bg-white focus:outline-none w-[100px] text-left manrope-medium font-medium text-[#444] text-[14px] border-[1px] border-solid border-[#ebebeb] rounded-[10px] filter-buttons">
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
                                    <div x-data="{ open: false, search: '', selected: 'Equipment', options: ['Crane 01', 'Lift 01', 'Hook lift', 'Crane 02' , 'Lift 03'] ,selectedOptions: []}" class="relative ">
                                        <button @click="open = !open" class=" p-2 bg-white focus:outline-none w-[120px] text-left manrope-medium font-medium text-[#444] text-[14px] border-[1px] border-solid border-[#ebebeb] rounded-[10px] filter-buttons">
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
                                    <div x-data="{ open: false, search: '', selected: 'Plant Name', options: ['TC01' , 'TC01' , 'TC01'] ,selectedOptions: [] }" class="relative ">
                                        <button @click="open = !open" class=" p-2 bg-white focus:outline-none w-[120px] text-left manrope-medium font-medium text-[#444] text-[14px] border-[1px] border-solid border-[#ebebeb] rounded-[10px] filter-buttons">
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
                                    <p class="flex items-center mr-[8px]">
                                    <div x-data="{ open: false, search: '', selected: 'Status', options: ['Inactive', 'Active', 'Blocked'] ,selectedOptions: [] }" class="relative ">
                                        <button @click="open = !open" class=" p-2 bg-white focus:outline-none w-[100px] text-left manrope-medium font-medium text-[#444] text-[14px] border-[1px] border-solid border-[#ebebeb] rounded-[10px] filter-buttons">
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
                                        <table
                                            class="w-full text-sm text-left">
                                            <thead class=" border-b-[2px] border-solid border-b-[#E9EDF0]">
                                                <tr>
                                                    <th class="text-center">
                                                        <div class="p-[10px] pb-[25px]">
                                                            <input type="checkbox" id="select-people" class="border-gray-300 rounded h-4 w-4 accent-[#437651] focus:ring-0" />
                                                        </div>
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] manrope-medium text-[#344563] font-medium text-[16px] whitespace-nowrap">Equipment ID</th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-left manrope-medium text-[#344563] font-medium text-[15px] whitespace-nowrap">Equipment Name</th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-left manrope-medium text-[#344563] font-medium text-[15px] whitespace-nowrap">Company Name</th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-left manrope-medium text-[#344563] font-medium text-[15px]  whitespace-nowrap">Project Name</th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-center  manrope-medium text-[#344563] font-medium text-[15px] whitespace-nowrap">Plant Name </th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-center  manrope-medium text-[#344563] font-medium text-[15px] whitespace-nowrap">Equipment Type</th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-left manrope-medium text-[#344563] font-medium text-[15px]  whitespace-nowrap">Mapped To</th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-left manrope-medium text-[#344563] font-medium text-[15px]  whitespace-nowrap">Streaming Links</th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-center  manrope-medium text-[#344563] font-medium text-[15px] whitespace-nowrap">Status </th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-center  manrope-medium text-[#344563] font-medium text-[15px] whitespace-nowrap">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="bg-white transition duration-300 ease-in-out hover:bg-[#D8E3DB]">
                                                    <th class="text-center">
                                                        <div class="">
                                                            <input type="checkbox" id="select-people" class="border-gray-300 rounded h-4 w-4 accent-[#437651] focus:ring-0" />
                                                        </div>
                                                    </th>
                                                    <td class="px-6 py-4 text-left ">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">#01</p>
                                                    </td>
                                                    <td class="px-6 py-4 text-left ">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">Hook Lift 01</p>
                                                    </td>
                                                    <td class="px-6 py-4 ">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">Digital Horizon Systems</p>
                                                    </td>
                                                    <td class="px-6 py-4 ">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">London Bridge</p>
                                                    </td>
                                                    <td class="px-6 py-4 ">
                                                        <p class="manrope-regular text-black font-normal text-[16px] text-center">TC01</p>
                                                    </td>
                                                    <td class="px-6 py-4 text-center">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">Camera</p>
                                                    </td>
                                                    <td class="px-6 py-4 text-center">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">I PAD 01</p>
                                                    </td>
                                                    <td class="px-6 py-4 text-left manrope-regular text-black font-normal text-[16px] relative">
                                                        <div class=" w-[150px]">
                                                            <span class="truncate block w-full p-2 rounded">
                                                                https://www.example.com/api/v1/resources/data/fetch?user_id=1234567890abcdef1234567890abcdef&
                                                            </span>
                                                            <img src="assets/images/copy.png" class="copy-icon absolute right-0 top-[20px] w-[23px] cursor-pointer">
                                                        </div>
                                                    </td>
                                                    <td class="px-[20px] py-[20px] text-center ">
                                                        <button class="table-status w-[90px] bg-[#047413] text-white rounded-[7px] py-1 px-4 text-sm font-medium cursor-pointer">
                                                            Active
                                                        </button>
                                                    </td>
                                                    <td class="px-6 py-4 text-center relative">
                                                        <span><a href="#"><img src="assets/images/more.png" class="w-[25px] my-0 mx-auto" onclick="toggleDotDropdown(event)"></a></span>
                                                        <div class="dot-drop absolute bg-white tab-shadow rounded-md hidden top-[50px] right-[60px] w-[170px] p-[10px] z-[8]">
                                                            <ul>
                                                                <li class="py-[5px]"><a href="#" class="flex manrope-regular text-[#344563] font-normal text-[15px]">
                                                                        <img src="assets/images/edit-opt.png" class="w-[16px] mr-[11px] object-contain" onclick="toggleModale()">
                                                                        <p>Edit</p>
                                                                    </a></li>
                                                                <li class="py-[5px]"><a href="#" class="flex manrope-regular text-[#344563] font-normal text-[15px]">
                                                                        <img src="assets/images/delete.png" class="w-[16px] mr-[11px] object-contain">
                                                                        <p>Delete</p>
                                                                    </a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="bg-[#f6f9f7] transition duration-300 ease-in-out hover:bg-[#ededed]">
                                                    <th class="text-center">
                                                        <div class="">
                                                            <input type="checkbox" id="select-people" class="border-gray-300 rounded h-4 w-4 accent-[#437651] focus:ring-0" />
                                                        </div>
                                                    </th>
                                                    <td class="px-6 py-4 text-left ">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">#02</p>
                                                    </td>
                                                    <td class="px-6 py-4 text-left ">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">Hook Lift 02</p>
                                                    </td>
                                                    <td class="px-6 py-4 ">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">Digital Horizon Systems</p>
                                                    </td>
                                                    <td class="px-6 py-4 ">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">London Bridge</p>
                                                    </td>
                                                    <td class="px-6 py-4 ">
                                                        <p class="manrope-regular text-black font-normal text-[16px] text-center">TC01</p>
                                                    </td>
                                                    <td class="px-6 py-4 text-center">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">Camera</p>
                                                    </td>
                                                    <td class="px-6 py-4 text-center">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">I PAD 01</p>
                                                    </td>
                                                    <td class="px-6 py-4 text-left manrope-regular text-black font-normal text-[16px] relative">
                                                        <div class=" w-[150px]">
                                                            <span class="truncate block w-full p-2 rounded">
                                                                https://www.abc.com
                                                            </span>
                                                            <img src="assets/images/copy.png" class="copy-icon absolute right-0 top-[20px] w-[23px] cursor-pointer">
                                                        </div>
                                                    </td>
                                                    <td class="px-[20px] py-[20px] text-center ">
                                                        <button class="table-status w-[90px] bg-[#047413] text-white rounded-[7px] py-1 px-4 text-sm font-medium cursor-pointer">
                                                            Active
                                                        </button>
                                                    </td>
                                                    <td class="px-6 py-4 text-center relative">
                                                        <span><a href="#"><img src="assets/images/more.png" class="w-[25px] my-0 mx-auto" onclick="toggleDotDropdown(event)"></a></span>
                                                        <div class="dot-drop absolute bg-white tab-shadow rounded-md hidden top-[50px] right-[60px] w-[170px] p-[10px] z-[8]">
                                                            <ul>
                                                                <li class="py-[5px]"><a href="#" class="flex manrope-regular text-[#344563] font-normal text-[15px]">
                                                                        <img src="assets/images/edit-opt.png" class="w-[16px] mr-[11px] object-contain" onclick="toggleModale()">
                                                                        <p>Edit</p>
                                                                    </a></li>
                                                                <li class="py-[5px]"><a href="#" class="flex manrope-regular text-[#344563] font-normal text-[15px]">
                                                                        <img src="assets/images/delete.png" class="w-[16px] mr-[11px] object-contain">
                                                                        <p>Delete</p>
                                                                    </a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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
                                                        onclick="toggleModalm()">
                                                        <span class="mr-[10px]"><img src="assets/images/add.png" class="w-[15px] mt-[2px]"></span> Create Mapping
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
                                    <div x-data="{ open: false, search: '', selected: 'Company Name', options: ['Digital Horizon Systems', 'ByteCore Technologies', 'London Technova Solutions'] , selectedOptions: [] }" class="relative ">
                                        <button @click="open = !open" class=" p-2 bg-white focus:outline-none w-[150px] text-left manrope-medium font-medium text-[#444] text-[14px] border-[1px] border-solid border-[#ebebeb] rounded-[10px] filter-buttons">
                                            <span x-text="selected"></span>
                                        </button>

                                        <div x-show="open" @click.away="open = false" class="absolute mt-1 w-[300px] bg-white border border-gray-300 rounded-lg shadow-md manrope-medium font-medium text-[#444] text-[16px] z-[9]">
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
                                    <div x-data="{ open: false, search: '', selected: 'Project', options: ['Project 1', 'Project 2', 'Project 3', 'Project 4'] , selectedOptions: [] }" class="relative ">
                                        <button @click="open = !open" class=" p-2 bg-white focus:outline-none w-[100px] text-left manrope-medium font-medium text-[#444] text-[14px] border-[1px] border-solid border-[#ebebeb] rounded-[10px] filter-buttons">
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
                                    <div x-data="{ open: false, search: '', selected: 'Plant Name', options: ['Crane 01', 'Lift 01', 'Hook lift', 'Crane 02' , 'Lift 03'] , selectedOptions: [] }" class="relative ">
                                        <button @click="open = !open" class=" p-2 bg-white focus:outline-none w-[120px] text-left manrope-medium font-medium text-[#444] text-[14px] border-[1px] border-solid border-[#ebebeb] rounded-[10px] filter-buttons">
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
                                    <p class="flex items-center mr-[8px] ">
                                    <div x-data="{ open: false, search: '', selected: 'Tablet', options: ['IPad'] , selectedOptions: [] }" class="relative ">
                                        <button @click="open = !open" class=" p-2 bg-white focus:outline-none w-[100px] text-left manrope-medium font-medium text-[#444] text-[14px] border-[1px] border-solid border-[#ebebeb] rounded-[10px] filter-buttons">
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
                                    <p class="flex items-center mr-[8px]">
                                    <div x-data="{ open: false, search: '', selected: 'Status', options: ['Status 1', 'Status 2', 'Status 3', 'Status 4'] , selectedOptions: [] }" class="relative ">
                                        <button @click="open = !open" class=" p-2 bg-white focus:outline-none w-[100px] text-left manrope-medium font-medium text-[#444] text-[14px] border-[1px] border-solid border-[#ebebeb] rounded-[10px] filter-buttons">
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
                                        <table
                                            class="w-full text-sm text-left">
                                            <thead class=" border-b-[2px] border-solid border-b-[#E9EDF0]">
                                                <tr>
                                                    <th class="text-center">
                                                        <div class="p-[10px] pb-[25px]">
                                                            <input type="checkbox" id="select-people" class="border-gray-300 rounded h-4 w-4 accent-[#437651] focus:ring-0" />
                                                        </div>
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-left manrope-medium text-[#344563] font-medium text-[15px]">Company Name</th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-left manrope-medium text-[#344563] font-medium text-[15px]">Project Name</th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-left manrope-medium text-[#344563] font-medium text-[15px]">Plant Name</th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-center manrope-medium text-[#344563] font-medium text-[15px]">Camera Name </th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-center manrope-medium text-[#344563] font-medium text-[15px]">Tablet Name</th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-left manrope-medium text-[#344563] font-medium text-[15px]">Streaming Links</th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-center manrope-medium text-[#344563] font-medium text-[15px]">Status </th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-center manrope-medium text-[#344563] font-medium text-[15px]">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="bg-white transition duration-300 ease-in-out hover:bg-[#D8E3DB]">
                                                    <th class="text-center">
                                                        <div class="">
                                                            <input type="checkbox" id="select-people" class="border-gray-300 rounded h-4 w-4 accent-[#437651] focus:ring-0" />
                                                        </div>
                                                    </th>
                                                    <td class="px-6 py-4 text-left ">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">Digital Horizon Systems</p>
                                                    </td>
                                                    <td class="px-6 py-4 ">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">London Bridge</p>
                                                    </td>
                                                    <td class="px-6 py-4 ">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">Crane 01</p>
                                                    </td>
                                                    <td class="px-6 py-4 ">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">Camera 01</p>
                                                    </td>
                                                    <td class="px-6 py-4 text-center">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">I Pad</p>
                                                    </td>
                                                    <td class="px-6 py-4 text-left manrope-regular text-black font-normal text-[16px] relative">
                                                        <div class=" w-72">
                                                            <span class="truncate block w-full p-2 rounded">
                                                                https://www.example.com/api/v1/resources/data/fetch?user_id=1234567890abcdef1234567890abcdef&
                                                            </span>
                                                            <img src="assets/images/copy.png" class="copy-icon absolute right-0 top-[20px] w-[23px] cursor-pointer">
                                                        </div>
                                                    </td>
                                                    <td class="px-[20px] py-[20px] text-center ">
                                                        <button class="table-status w-[90px] bg-[#047413] text-white rounded-[7px] py-1 px-4 text-sm font-medium">
                                                            Active
                                                        </button>
                                                    </td>
                                                    <td class="px-6 py-4 text-center relative">
                                                        <span><a href="#"><img src="assets/images/more.png" class="w-[25px] my-0 mx-auto" onclick="toggleDotDropdown(event)"></a></span>
                                                        <div class="dot-drop absolute bg-white tab-shadow rounded-md hidden top-[50px] right-[60px] w-[170px] p-[10px] z-[8]">
                                                            <ul>
                                                                <li class="py-[5px]"><a href="#" class="flex manrope-regular text-[#344563] font-normal text-[15px]">
                                                                        <img src="assets/images/edit-opt.png" class="w-[16px] mr-[11px] object-contain" onclick="toggleModal()">
                                                                        <p>Edit</p>
                                                                    </a></li>
                                                                <li class="py-[5px]"><a href="#" class="flex manrope-regular text-[#344563] font-normal text-[15px]">
                                                                        <img src="assets/images/delete.png" class="w-[16px] mr-[11px] object-contain">
                                                                        <p>Delete</p>
                                                                    </a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="bg-[#f6f9f7] transition duration-300 ease-in-out hover:bg-[#D8E3DB]">
                                                    <th class="text-center">
                                                        <div class="">
                                                            <input type="checkbox" id="select-people" class="border-gray-300 rounded h-4 w-4 accent-[#437651] focus:ring-0" />
                                                        </div>
                                                    </th>
                                                    <td class="px-6 py-4 text-left manrope-medium text-[#344563] font-normal text-[16px] ">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">Digital Horizon Systems</p>
                                                    </td>
                                                    <td class="px-6 py-4 ">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">London Bridge</p>
                                                    </td>
                                                    <td class="px-6 py-4 ">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">Crane 01</p>
                                                    </td>
                                                    <td class="px-6 py-4 ">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">Camera 01</p>
                                                    </td>
                                                    <td class="px-6 py-4 text-center">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">I Pad</p>
                                                    </td>
                                                    <td class="px-6 py-4 text-left manrope-regular text-black font-normal text-[16px] relative">
                                                        <div class=" w-72">
                                                            <span class="truncate block w-full p-2 rounded">
                                                                https://www.example.com/api/v1/resources/data/fetch?user_id=1234567890abcdef1234567890abcdef&
                                                            </span>
                                                            <img src="assets/images/copy.png" class="copy-icon absolute right-0 top-[20px] w-[23px] cursor-pointer">
                                                        </div>
                                                    </td>
                                                    <td class="px-[20px] py-[20px] text-center ">
                                                        <button class="table-status w-[90px] bg-[#047413] text-white rounded-[7px] py-1 px-4 text-sm font-medium">
                                                            Active
                                                        </button>
                                                    </td>
                                                    <td class="px-6 py-4 text-center relative">
                                                        <span><a href="#"><img src="assets/images/more.png" class="w-[25px] my-0 mx-auto" onclick="toggleDotDropdown(event)"></a></span>
                                                        <div class="dot-drop absolute bg-white tab-shadow rounded-md hidden top-[50px] right-[60px] w-[170px] p-[10px] z-[8]">
                                                            <ul>
                                                                <li class="py-[5px]"><a href="#" class="flex manrope-regular text-[#344563] font-normal text-[15px]">
                                                                        <img src="assets/images/edit-opt.png" class="w-[16px] mr-[11px] object-contain" onclick="toggleModal()">
                                                                        <p>Edit</p>
                                                                    </a></li>
                                                                <li class="py-[5px]"><a href="#" class="flex manrope-regular text-[#344563] font-normal text-[15px]">
                                                                        <img src="assets/images/delete.png" class="w-[16px] mr-[11px] object-contain">
                                                                        <p>Delete</p>
                                                                    </a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="bg-white transition duration-300 ease-in-out hover:bg-[#D8E3DB]">
                                                    <th class="text-center">
                                                        <div class="">
                                                            <input type="checkbox" id="select-people" class="border-gray-300 rounded h-4 w-4 accent-[#437651] focus:ring-0" />
                                                        </div>
                                                    </th>
                                                    <td class="px-6 py-4 text-left ">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">Digital Horizon Systems</p>
                                                    </td>
                                                    <td class="px-6 py-4 ">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">London Bridge</p>
                                                    </td>
                                                    <td class="px-6 py-4 ">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">Crane 01</p>
                                                    </td>
                                                    <td class="px-6 py-4 ">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">Camera 01</p>
                                                    </td>
                                                    <td class="px-6 py-4 text-center">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">I Pad</p>
                                                    </td>
                                                    <td class="px-6 py-4 text-left manrope-regular text-black font-normal text-[16px] relative">
                                                        <div class=" w-72">
                                                            <span class="truncate block w-full p-2 rounded">
                                                                https://www.example.com/api/v1/resources/data/fetch?user_id=1234567890abcdef1234567890abcdef&
                                                            </span>
                                                            <img src="assets/images/copy.png" class="copy-icon absolute right-0 top-[20px] w-[23px] cursor-pointer">
                                                        </div>
                                                    </td>
                                                    <td class="px-[20px] py-[20px] text-center ">
                                                        <button class="table-status w-[90px] bg-[#047413] text-white rounded-[7px] py-1 px-4 text-sm font-medium">
                                                            Active
                                                        </button>
                                                    </td>
                                                    <td class="px-6 py-4 text-center relative">
                                                        <span><a href="#"><img src="assets/images/more.png" class="w-[25px] my-0 mx-auto" onclick="toggleDotDropdown(event)"></a></span>
                                                        <div class="dot-drop absolute bg-white tab-shadow rounded-md hidden top-[50px] right-[60px] w-[170px] p-[10px] z-[8]">
                                                            <ul>
                                                                <li class="py-[5px]"><a href="#" class="flex manrope-regular text-[#344563] font-normal text-[15px]">
                                                                        <img src="assets/images/edit-opt.png" class="w-[16px] mr-[11px] object-contain" onclick="toggleModal()">
                                                                        <p>Edit</p>
                                                                    </a></li>
                                                                <li class="py-[5px]"><a href="#" class="flex manrope-regular text-[#344563] font-normal text-[15px]">
                                                                        <img src="assets/images/delete.png" class="w-[16px] mr-[11px] object-contain">
                                                                        <p>Delete</p>
                                                                    </a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="bg-[#f6f9f7] transition duration-300 ease-in-out hover:bg-[#D8E3DB]">
                                                    <th class="text-center">
                                                        <div class="">
                                                            <input type="checkbox" id="select-people" class="border-gray-300 rounded h-4 w-4 accent-[#437651] focus:ring-0" />
                                                        </div>
                                                    </th>
                                                    <td class="px-6 py-4 text-left manrope-medium text-[#344563] font-normal text-[16px] ">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">Digital Horizon Systems</p>
                                                    </td>
                                                    <td class="px-6 py-4 ">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">London Bridge</p>
                                                    </td>
                                                    <td class="px-6 py-4 ">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">Crane 01</p>
                                                    </td>
                                                    <td class="px-6 py-4 ">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">Camera 01</p>
                                                    </td>
                                                    <td class="px-6 py-4 text-center">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">I Pad</p>
                                                    </td>
                                                    <td class="px-6 py-4 text-left manrope-regular text-black font-normal text-[16px] relative">
                                                        <div class=" w-72">
                                                            <span class="truncate block w-full p-2 rounded">
                                                                https://www.example.com/api/v1/resources/data/fetch?user_id=1234567890abcdef1234567890abcdef&
                                                            </span>
                                                            <img src="assets/images/copy.png" class="copy-icon absolute right-0 top-[20px] w-[23px] cursor-pointer">
                                                        </div>
                                                    </td>
                                                    <td class="px-[20px] py-[20px] text-center ">
                                                        <button class="table-status w-[90px] bg-[#047413] text-white rounded-[7px] py-1 px-4 text-sm font-medium">
                                                            Active
                                                        </button>
                                                    </td>
                                                    <td class="px-6 py-4 text-center relative">
                                                        <span><a href="#"><img src="assets/images/more.png" class="w-[25px] my-0 mx-auto" onclick="toggleDotDropdown(event)"></a></span>
                                                        <div class="dot-drop absolute bg-white tab-shadow rounded-md hidden top-[50px] right-[60px] w-[170px] p-[10px] z-[8]">
                                                            <ul>
                                                                <li class="py-[5px]"><a href="#" class="flex manrope-regular text-[#344563] font-normal text-[15px]">
                                                                        <img src="assets/images/edit-opt.png" class="w-[16px] mr-[11px] object-contain" onclick="toggleModal()">
                                                                        <p>Edit</p>
                                                                    </a></li>
                                                                <li class="py-[5px]"><a href="#" class="flex manrope-regular text-[#344563] font-normal text-[15px]">
                                                                        <img src="assets/images/delete.png" class="w-[16px] mr-[11px] object-contain">
                                                                        <p>Delete</p>
                                                                    </a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
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
                                                        onclick="toggleModalcont()">
                                                        <span class="mr-[10px]"><img src="assets/images/add.png" class="w-[15px] mt-[2px]"></span> Add new
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
                                    <div x-data="{ open: false, search: '', selected: 'Name', options: ['Jon Snow'] , selectedOptions: [] }" class="relative ">
                                        <button @click="open = !open" class=" p-2 bg-white focus:outline-none w-[100px] text-left manrope-medium font-medium text-[#6a6a75] text-[14px]  border-[1px] border-solid border-[#ebebeb] rounded-[10px] filter-buttons">
                                            <span x-text="selected"></span>
                                        </button>

                                        <div x-show="open" @click.away="open = false" class="absolute mt-1 w-[200px] bg-white border border-gray-300 rounded-lg shadow-md manrope-medium font-medium text-[#6a6a75] text-[16px] z-[9]">
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
                                    <p class="flex items-center  mr-[8px]">
                                    <div x-data="{ open: false, search: '', selected: 'Other name', options: ['Type'] , selectedOptions: [] }" class="relative ">
                                        <button @click="open = !open" class=" p-2 bg-white focus:outline-none w-[120px] text-left manrope-medium font-medium text-[#444] text-[14px] border-[1px] border-solid border-[#ebebeb] rounded-[10px] filter-buttons">
                                            <span x-text="selected"></span>
                                        </button>

                                        <div x-show="open" @click.away="open = false" class="absolute mt-1 w-[200px] bg-white border border-gray-300 rounded-lg shadow-md manrope-medium font-medium text-[#6a6a75] text-[16px] z-[9]">
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
                                    <div x-data="{ open: false, search: '', selected: 'Status', options: ['Status 1', 'Status 2', 'Status 3', 'Status 4'] , selectedOptions: [] }" class="relative ">
                                        <button @click="open = !open" class=" p-2 bg-white focus:outline-none w-[100px] text-left manrope-medium font-medium text-[#444] text-[14px] border-[1px] border-solid border-[#ebebeb] rounded-[10px] filter-buttons">
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
                                        <table
                                            class="w-full text-sm text-left">
                                            <thead class=" border-b-[2px] border-solid border-b-[#E9EDF0]">
                                                <tr>
                                                    <th class="text-center pl-[10px] pb-[25px]">
                                                        <div class="">
                                                            <input type="checkbox" id="select-people" class="border-gray-300 rounded h-4 w-4 accent-[#437651] focus:ring-0" />
                                                        </div>
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-center manrope-medium text-[#344563] font-medium text-[15px]">Trackable Name</th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-center manrope-medium text-[#344563] font-medium text-[15px]">Other name</th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-center manrope-medium text-[#344563] font-medium text-[15px]">Linked Objects</th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-center manrope-medium text-[#344563] font-medium text-[15px]">Status</th>
                                                    <th scope="col" class="px-6 py-3 pb-[25px] text-center manrope-medium text-[#344563] font-medium text-[15px]">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="bg-white transition duration-300 ease-in-out hover:bg-[#D8E3DB]">
                                                    <th class="text-center  pl-[10px]">
                                                        <div class="">
                                                            <input type="checkbox" id="select-people" class="border-gray-300 rounded h-4 w-4 accent-[#437651] focus:ring-0" />
                                                        </div>
                                                    </th>
                                                    <td class="px-6 py-4 text-center ">
                                                        <p class="manrope-regular text-black font-normal text-[16px]"><a href="trackable-projects.html" class="cursor-pointer">Mas Indro</a></p>
                                                    </td>
                                                    <td class="px-6 py-4 text-center">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">Abc</p>
                                                    </td>
                                                    <td class="px-6 py-4 text-center">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">Linked object 1 , Linked Object 2</p>
                                                    </td>
                                                    <td class="px-[20px] py-[20px] text-center ">
                                                        <button class="table-status w-[90px] bg-[#047413] text-white rounded-[7px] py-1 px-4 text-sm font-medium">
                                                            Active
                                                        </button>
                                                    </td>
                                                    <td class="px-6 py-4 text-center relative">
                                                        <span><a href="#"><img src="assets/images/more.png" class="w-[25px] my-0 mx-auto" onclick="toggleDotDropdown(event)"></a></span>
                                                        <div class="dot-drop absolute bg-white tab-shadow rounded-md hidden top-[50px] right-[60px] w-[170px] p-[10px] z-[8]">
                                                            <ul>
                                                                <li class="py-[5px]"><a href="trackable-projects.html" class="flex manrope-regular text-[#344563] font-normal text-[15px]">
                                                                        <img src="assets/images/view.png" class="w-[16px] mr-[11px] object-contain">
                                                                        <p>View</p>
                                                                    </a></li>
                                                                <li class="py-[5px]"><a href="#" class="flex manrope-regular text-[#344563] font-normal text-[15px]">
                                                                        <img src="assets/images/edit-opt.png" class="w-[16px] mr-[11px] object-contain" onclick="toggleModal()">
                                                                        <p>Edit</p>
                                                                    </a></li>
                                                                <li class="py-[5px]"><a href="#" class="flex manrope-regular text-[#344563] font-normal text-[15px]">
                                                                        <img src="assets/images/delete.png" class="w-[16px] mr-[11px] object-contain">
                                                                        <p>Delete</p>
                                                                    </a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="bg-[#f6f9f7] transition duration-300 ease-in-out hover:bg-[#D8E3DB]">
                                                    <th class="text-center  pl-[10px]">
                                                        <div class="">
                                                            <input type="checkbox" id="select-people" class="border-gray-300 rounded h-4 w-4 accent-[#437651] focus:ring-0" />
                                                        </div>
                                                    </th>
                                                    <td class="px-6 py-4 text-center ">
                                                        <p class="manrope-regular text-black font-normal text-[16px]"><a href="trackable-projects.html" class="cursor-pointer">Mas Indro</a></p>
                                                    </td>
                                                    <td class="px-6 py-4 text-center">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">Abc</p>
                                                    </td>
                                                    <td class="px-6 py-4 text-center">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">Linked object 1 , Linked Object 2</p>
                                                    </td>
                                                    <td class="px-[20px] py-[20px] text-center ">
                                                        <button class="table-status w-[90px] bg-[#047413] text-white rounded-[7px] py-1 px-4 text-sm font-medium">
                                                            Active
                                                        </button>
                                                    </td>
                                                    <td class="px-6 py-4 text-center relative">
                                                        <span><a href="#"><img src="assets/images/more.png" class="w-[25px] my-0 mx-auto" onclick="toggleDotDropdown(event)"></a></span>
                                                        <div class="dot-drop absolute bg-white tab-shadow rounded-md hidden top-[50px] right-[60px] w-[170px] p-[10px] z-[8]">
                                                            <ul>
                                                                <li class="py-[5px]"><a href="trackable-projects.html" class="flex manrope-regular text-[#344563] font-normal text-[15px]">
                                                                        <img src="assets/images/view.png" class="w-[16px] mr-[11px] object-contain">
                                                                        <p>View</p>
                                                                    </a></li>
                                                                <li class="py-[5px]"><a href="#" class="flex manrope-regular text-[#344563] font-normal text-[15px]">
                                                                        <img src="assets/images/edit-opt.png" class="w-[16px] mr-[11px] object-contain" onclick="toggleModal()">
                                                                        <p>Edit</p>
                                                                    </a></li>
                                                                <li class="py-[5px]"><a href="#" class="flex manrope-regular text-[#344563] font-normal text-[15px]">
                                                                        <img src="assets/images/delete.png" class="w-[16px] mr-[11px] object-contain">
                                                                        <p>Delete</p>
                                                                    </a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="bg-white transition duration-300 ease-in-out hover:bg-[#D8E3DB]">
                                                    <th class="text-center  pl-[10px]">
                                                        <div class="">
                                                            <input type="checkbox" id="select-people" class="border-gray-300 rounded h-4 w-4 accent-[#437651] focus:ring-0" />
                                                        </div>
                                                    </th>
                                                    <td class="px-6 py-4 text-center ">
                                                        <p class="manrope-regular text-black font-normal text-[16px]"><a href="trackable-projects.html" class="cursor-pointer">Mas Indro</a></p>
                                                    </td>
                                                    <td class="px-6 py-4 text-center">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">Abc</p>
                                                    </td>
                                                    <td class="px-6 py-4 text-center">
                                                        <p class="manrope-regular text-black font-normal text-[16px]">Linked object 1 , Linked Object 2</p>
                                                    </td>
                                                    <td class="px-[20px] py-[20px] text-center ">
                                                        <button class="table-status w-[90px] bg-[#047413] text-white rounded-[7px] py-1 px-4 text-sm font-medium">
                                                            Active
                                                        </button>
                                                    </td>
                                                    <td class="px-6 py-4 text-center relative">
                                                        <span><a href="#"><img src="assets/images/more.png" class="w-[25px] my-0 mx-auto" onclick="toggleDotDropdown(event)"></a></span>
                                                        <div class="dot-drop absolute bg-white tab-shadow rounded-md hidden top-[50px] right-[60px] w-[170px] p-[10px] z-[8]">
                                                            <ul>
                                                                <li class="py-[5px]"><a href="trackable-projects.html" class="flex manrope-regular text-[#344563] font-normal text-[15px]">
                                                                        <img src="assets/images/view.png" class="w-[16px] mr-[11px] object-contain">
                                                                        <p>View</p>
                                                                    </a></li>
                                                                <li class="py-[5px]"><a href="#" class="flex manrope-regular text-[#344563] font-normal text-[15px]">
                                                                        <img src="assets/images/edit-opt.png" class="w-[16px] mr-[11px] object-contain" onclick="toggleModal()">
                                                                        <p>Edit</p>
                                                                    </a></li>
                                                                <li class="py-[5px]"><a href="#" class="flex manrope-regular text-[#344563] font-normal text-[15px]">
                                                                        <img src="assets/images/delete.png" class="w-[16px] mr-[11px] object-contain">
                                                                        <p>Delete</p>
                                                                    </a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
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
                                                        <span class="mr-[10px]"><img src="assets/images/add.png" class="w-[15px] mt-[2px]"></span> Add New
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
                                    <div x-data="{ open: false, search: '', selected: 'Model Name', options: ['Box Lifting'] , selectedOptions: [] }" class="relative ">
                                        <button @click="open = !open" class=" p-2 bg-white focus:outline-none w-[130px] text-left manrope-medium font-medium text-[#6a6a75] text-[14px]  border-[1px] border-solid border-[#ebebeb] rounded-[10px] filter-buttons">
                                            <span x-text="selected"></span>
                                        </button>

                                        <div x-show="open" @click.away="open = false" class="absolute mt-1 w-[200px] bg-white border border-gray-300 rounded-lg shadow-md manrope-medium font-medium text-[#6a6a75] text-[16px] z-[9]">
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
                                    <div x-data="{ open: false, search: '', selected: 'Event Type', options: ['Lifting'] , selectedOptions: [] }" class="relative ">
                                        <button @click="open = !open" class=" p-2 bg-white focus:outline-none w-[120px] text-left manrope-medium font-medium text-[#444] text-[14px] border-[1px] border-solid border-[#ebebeb] rounded-[10px] filter-buttons">
                                            <span x-text="selected"></span>
                                        </button>

                                        <div x-show="open" @click.away="open = false" class="absolute mt-1 w-[200px] bg-white border border-gray-300 rounded-lg shadow-md manrope-medium font-medium text-[#6a6a75] text-[16px] z-[9]">
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
                                    <div x-data="{ open: false, search: '', selected: 'Trackable Name', options: ['Mas Indro'] , selectedOptions: [] }" class="relative ">
                                        <button @click="open = !open" class=" p-2 bg-white focus:outline-none w-[150px] text-left manrope-medium font-medium text-[#444] text-[14px] border-[1px] border-solid border-[#ebebeb] rounded-[10px] filter-buttons">
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
                                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            <thead class=" border-b-[2px] border-solid border-b-[#E9EDF0]">
                                                <tr>
                                                    <th class="text-center pl-[10px] pb-[25px]">
                                                        <div class="">
                                                            <input type="checkbox" id="select-people" class="border-gray-300 rounded h-4 w-4 accent-[#437651] focus:ring-0" />
                                                        </div>
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 pb-[25px] manrope-medium text-[#344563] font-medium text-[16px] text-center">
                                                        AI Model Name
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 pb-[25px] manrope-medium text-[#344563] font-medium text-[16px] text-center">
                                                        Event Type
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 pb-[25px] text-center manrope-medium text-[#344563] font-medium text-[16px]">
                                                        Date Created
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 pb-[25px] text-center manrope-medium text-[#344563] font-medium text-[16px]">
                                                        Trackable Name
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 pb-[25px] text-center manrope-medium text-[#344563] font-medium text-[16px]">
                                                        Status
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 pb-[25px] text-center manrope-medium text-[#344563] font-medium text-[16px]">
                                                        Object Type
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 pb-[25px] text-center manrope-medium text-[#344563] font-medium text-[16px]">
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="bg-white transition duration-300 ease-in-out hover:bg-[#D8E3DB]">
                                                    <th class="text-center pl-[10px]">
                                                        <div class="">
                                                            <input type="checkbox" id="select-people" class="border-gray-300 rounded h-4 w-4 accent-[#437651] focus:ring-0" />
                                                        </div>
                                                    </th>
                                                    <td
                                                        class="px-6 py-4 text-center manrope-medium text-[#344563] font-normal text-[16px]">
                                                        Box Lifting
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 text-center manrope-medium text-[#344563] font-normal text-[16px]">
                                                        Lifting
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 text-center manrope-medium text-[#344563] font-normal text-[16px]">
                                                        Jan 08 - 2024
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 text-center manrope-medium text-[#344563] font-normal text-[16px]">
                                                        Mas Indro
                                                    </td>
                                                    <td class="px-[20px] py-[20px] text-center ">
                                                        <button class="table-status w-[90px] bg-[#047413] text-white rounded-[7px] py-1 px-4 text-sm font-medium cursor-pointer">
                                                            Active
                                                        </button>
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 text-center manrope-medium text-[#344563] font-normal text-[16px]">
                                                        Box

                                                    </td>
                                                    <td class="flex justify-center relative">
                                                        <span class="mt-[20px]"><a href="#"><img src="assets/images/edit-report.png" class="w-[21px] mr-[20px]"></a></span>
                                                        <span class="mt-[20px]"><a href="#"><img src="assets/images/live.png" class="w-[23px] mr-[20px]"></a></span>
                                                        <span class="mt-[30px]"><a href="#"><img src="assets/images/table-menu.png" class="w-[21px] mr-[20px]" onclick="toggleDotDropdown(event)"></a></span>
                                                        <div class="dot-drop absolute bg-white tab-shadow rounded-md hidden top-[0px] right-[60px] w-[170px] p-[10px] z-[8]">
                                                            <ul>
                                                                <li class="py-[5px]"><a href="#" class="flex text-[#344563] text-[16px] manrope-medium">
                                                                        <img src="assets/images/edit-opt.png" class="w-[16px] mr-[11px] object-contain">
                                                                        <p>Edit</p>
                                                                    </a></li>
                                                                <li class="py-[5px]"><a href="#" class="flex text-[#344563] text-[16px] manrope-medium">
                                                                        <img src="assets/images/delete.png" class="w-[16px] mr-[11px] object-contain">
                                                                        <p>Delete</p>
                                                                    </a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="bg-[#f6f9f7] transition duration-300 ease-in-out hover:bg-[#D8E3DB]">
                                                    <th class="text-center pl-[10px]">
                                                        <div class="">
                                                            <input type="checkbox" id="select-people" class="border-gray-300 rounded h-4 w-4 accent-[#437651] focus:ring-0" />
                                                        </div>
                                                    </th>
                                                    <td
                                                        class="px-6 py-4 text-center manrope-medium text-[#344563] font-normal text-[16px]">
                                                        Box Lifting
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 text-center manrope-medium text-[#344563] font-normal text-[16px]">
                                                        Lifting
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 text-center manrope-medium text-[#344563] font-normal text-[16px]">
                                                        Jan 08 - 2024
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 text-center manrope-medium text-[#344563] font-normal text-[16px]">
                                                        Mas Indro
                                                    </td>
                                                    <td class="px-[20px] py-[20px] text-center ">
                                                        <button class="table-status w-[90px] bg-[#047413] text-white rounded-[7px] py-1 px-4 text-sm font-medium cursor-pointer">
                                                            Active
                                                        </button>
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 text-center manrope-medium text-[#344563] font-normal text-[16px]">
                                                        Box

                                                    </td>
                                                    <td class="flex justify-center relative">
                                                        <span class="mt-[20px]"><a href="#"><img src="assets/images/edit-report.png" class="w-[23px] mr-[20px]"></a></span>
                                                        <span class="mt-[20px]"><a href="#"><img src="assets/images/live.png" class="w-[23px] mr-[20px]"></a></span>
                                                        <span class="mt-[30px]"><a href="#"><img src="assets/images/table-menu.png" class="w-[23px] mr-[20px]" onclick="toggleDotDropdown(event)"></a></span>
                                                        <div class="dot-drop absolute bg-white tab-shadow rounded-md hidden top-[0px] right-[60px] w-[170px] p-[10px] z-[8]">
                                                            <ul>
                                                                <li class="py-[5px]"><a href="#" class="flex text-[#344563] text-[16px] manrope-medium">
                                                                        <img src="assets/images/edit-opt.png" class="w-[16px] mr-[11px] object-contain">
                                                                        <p>Edit</p>
                                                                    </a></li>
                                                                <li class="py-[5px]"><a href="#" class="flex text-[#344563] text-[16px] manrope-medium">
                                                                        <img src="assets/images/delete.png" class="w-[16px] mr-[11px] object-contain">
                                                                        <p>Delete</p>
                                                                    </a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
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
                                                        <span class="mr-[10px]"><img src="assets/images/add.png" class="w-[15px] mt-[2px]"></span> Add New
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
                                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            <thead class=" border-b-[2px] border-solid border-b-[#E9EDF0]">
                                                <tr>
                                                    <th class="text-center pl-[10px] ">
                                                        <div class="pb-[15px]">
                                                            <input type="checkbox" id="select-people" class="border-gray-300 rounded h-4 w-4 accent-[#437651] focus:ring-0" />
                                                        </div>
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 pb-[25px] manrope-medium text-[#344563] font-medium text-[16px] text-center">
                                                        Event Name
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 pb-[25px] manrope-medium text-[#344563] font-medium text-[16px] text-center">
                                                        Condition
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 pb-[25px] text-center manrope-medium text-[#344563] font-medium text-[16px]">
                                                        Wind Threshold
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 pb-[25px] text-center manrope-medium text-[#344563] font-medium text-[16px]">
                                                        Height Threshold
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 pb-[25px] text-center manrope-medium text-[#344563] font-medium text-[16px]">
                                                        Alert
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 pb-[25px] text-center manrope-medium text-[#344563] font-medium text-[16px]">
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="bg-white transition duration-300 ease-in-out hover:bg-[#D8E3DB]">
                                                    <th class="text-center pl-[10px]">
                                                        <div class="">
                                                            <input type="checkbox" id="select-people" class="border-gray-300 rounded h-4 w-4 accent-[#437651] focus:ring-0" />
                                                        </div>
                                                    </th>
                                                    <td
                                                        class="px-6 py-4 text-center manrope-medium text-[#344563] font-normal text-[16px]">
                                                        Lifting
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 text-center manrope-medium text-[#344563] font-normal text-[16px]">
                                                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 text-center manrope-medium text-[#344563] font-normal text-[16px]">
                                                        38 Km/hr
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 text-center manrope-medium text-[#344563] font-normal text-[16px]">
                                                        38 Km/hr
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 text-center manrope-medium text-[#344563] font-normal text-[16px]">
                                                        Alert Text

                                                    </td>
                                                    <td class="flex justify-center relative">
                                                        <span class="mt-[30px]"><a href="#"><img src="assets/images/table-menu.png" class="w-[21px] mr-[20px]" onclick="toggleDotDropdown(event)"></a></span>
                                                        <div class="dot-drop absolute bg-white tab-shadow rounded-md hidden top-[0px] right-[60px] w-[170px] p-[10px] z-[8]">
                                                            <ul>
                                                                <li class="py-[5px]"><a href="#" class="flex text-[#344563] text-[16px] manrope-medium">
                                                                        <img src="assets/images/edit-opt.png" class="w-[16px] mr-[11px] object-contain">
                                                                        <p>Edit</p>
                                                                    </a></li>
                                                                <li class="py-[5px]"><a href="#" class="flex text-[#344563] text-[16px] manrope-medium">
                                                                        <img src="assets/images/delete.png" class="w-[16px] mr-[11px] object-contain">
                                                                        <p>Delete</p>
                                                                    </a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="bg-white transition duration-300 ease-in-out hover:bg-[#D8E3DB]">
                                                    <th class="text-center pl-[10px]">
                                                        <div class="">
                                                            <input type="checkbox" id="select-people" class="border-gray-300 rounded h-4 w-4 accent-[#437651] focus:ring-0" />
                                                        </div>
                                                    </th>
                                                    <td
                                                        class="px-6 py-4 text-center manrope-medium text-[#344563] font-normal text-[16px]">
                                                        Waiting
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 text-center manrope-medium text-[#344563] font-normal text-[16px]">
                                                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 text-center manrope-medium text-[#344563] font-normal text-[16px]">
                                                        38 Km/hr
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 text-center manrope-medium text-[#344563] font-normal text-[16px]">
                                                        38 Km/hr
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 text-center manrope-medium text-[#344563] font-normal text-[16px]">
                                                        Alert Text

                                                    </td>
                                                    <td class="flex justify-center relative">
                                                        <span class="mt-[30px]"><a href="#"><img src="assets/images/table-menu.png" class="w-[21px] mr-[20px]" onclick="toggleDotDropdown(event)"></a></span>
                                                        <div class="dot-drop absolute bg-white tab-shadow rounded-md hidden top-[0px] right-[60px] w-[170px] p-[10px] z-[8]">
                                                            <ul>
                                                                <li class="py-[5px]"><a href="#" class="flex text-[#344563] text-[16px] manrope-medium">
                                                                        <img src="assets/images/edit-opt.png" class="w-[16px] mr-[11px] object-contain">
                                                                        <p>Edit</p>
                                                                    </a></li>
                                                                <li class="py-[5px]"><a href="#" class="flex text-[#344563] text-[16px] manrope-medium">
                                                                        <img src="assets/images/delete.png" class="w-[16px] mr-[11px] object-contain">
                                                                        <p>Delete</p>
                                                                    </a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
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
@endsection
@push('scripts')
<script>
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
        }
    });
</script>
@endpush