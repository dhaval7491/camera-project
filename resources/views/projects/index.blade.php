@extends('layouts.app')
@section('content')
<div class="pl-[30px]">
    <div class="form-list">
        <div class="">
            <div class="flex flex-wrap">
                <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                    <h3 class="manrope-medium text-[#344563] text-[18px] mt-[10px]">
                        <p class="inline-block manrope-medium text-[15px]  px-[0px] mt-[10px] mr-[15px] text-[#437651] underline">
                            < Back</p>All Projects
                    </h3>
                </div>
                <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                    <div class="table-filter lg:float-right md:float-right sm:float-left xs:float-left">
                        <ul class="list-inline list-unstyled flex">
                            <li class="list-inline-item mr-[15px]">
                                <button
                                    class="flex manrope-medium bg-[#3D3D3D] select-shadow btn rounded-[8px] py-[10px] px-[25px] text-[14px] border-[1px] border-solid border-[#3D3D3D] text-white"
                                    onclick="toggleModalp()">
                                    <span class="mr-[10px]"><img src="assets/images/add.png" class="w-[15px] mt-[2px]"></span> Add New
                                </button>
                            </li>
                            <li class="list-inline-item mr-[15px]">
                                <div class="relative flex items-center">
                                    <!-- Search Input -->
                                    <input type="text" id="search-input"
                                        class="w-0 p-0 border border-[#EBEBEB] rounded-[11px] absolute right-[19px] z-[8] transition-all duration-300 overflow-hidden bg-white"
                                        placeholder="Search...">

                                    <!-- Search Button -->
                                    <button id="search-toggle"
                                        class="p-[13px] rounded-[15px] border border-[#EBEBEB] ml-2 z-[9] bg-white">
                                        <img src="assets/images/table-search.png" class="w-[16px]">
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
        <div class="table-filter-block mt-[20px]">
            <div class="flex">
                <p class="flex items-center w-[150px] manrope-medium font-medium text-[#6a6a75] text-[16px]"><img class="w-[20px] object-contain mr-[10px]" src="assets/images/filter-by.png"> Filter By:</p>
                <p class="flex items-center ">
                    <img class="w-[40px] object-contain mr-[5px] border-[#EBEBEB] border-[1px] border-solid p-[7px] rounded-[16px]" src="assets/images/filter-user.png">
                <div x-data="{ open: false, search: '', selected: 'Digital Horizon Systems', options: ['Digital Horizon Systems', 'ByteCore Technologies', 'London Technova Solutions'] , selectedOptions: []}" class="relative ">
                    <button @click="open = !open" class=" p-2 bg-white focus:outline-none w-[200px] text-left manrope-medium font-medium text-[#6a6a75] text-[14px]">
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
                <p class="flex items-center ">
                    <img class="w-[40px] object-contain mr-[5px] border-[#EBEBEB] border-[1px] border-solid p-[7px] rounded-[16px]" src="assets/images/filter-user.png">
                <div x-data="{ open: false, search: '', selected: 'People', options: ['people 1', 'People 2', 'People 3', 'People 4'] , selectedOptions: []}" class="relative ">
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
                    <img class="w-[40px] object-contain mr-[5px] border-[#EBEBEB] border-[1px] border-solid p-[7px] rounded-[16px]" src="assets/images/drop-cal.png">
                    <input autocomplete="off" name="daterange" placeholder="Date" class="w-[240px] manrope-medium border-none p-2 text-[#6a6a75] text-[14px] focus-visible:outline-none placeholder-[#6a6a75]">
                </p>
                <p class="flex items-center">
                    <img class="w-[40px] object-contain mr-[5px] border-[#EBEBEB] border-[1px] border-solid p-[7px] rounded-[16px]" src="assets/images/location.png">
                <div x-data="{ open: false, search: '', selected: 'Location', options: ['London', 'Canada', 'India', 'USA'] , selectedOptions: []}" class="relative ">
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
                    <img class="w-[40px] object-contain mr-[5px] border-[#EBEBEB] border-[1px] border-solid p-[7px] rounded-[16px]" src="assets/images/status-filter.png">
                <div x-data="{ open: false, search: '', selected: 'Status', options: ['Active', 'Inactive', 'Blocked'] , selectedOptions: []}" class="relative ">
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
                <div class="relative overflow-x-auto h-full">
                    <table
                        class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-[#3D3D3D] bg-[#e6e6e6]">
                            <tr>
                                <th class="px-6 py-3 manrope-regular text-[#3D3D3D] text-[16px]">
                                    Name of project
                                </th>
                                <th class="px-6 py-3 text-center manrope-regular text-[#3D3D3D] text-[15px]">
                                    Date Created
                                </th>
                                <th class="px-6 py-3 text-center manrope-regular text-[#3D3D3D] text-[15px]">
                                    Company Name
                                </th>
                                <th class="px-6 py-3 text-center manrope-regular text-[#3D3D3D] text-[15px]">
                                    Trackable Name
                                </th>
                                <th class="px-6 py-3 text-center manrope-regular text-[#3D3D3D] text-[15px]">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-center manrope-regular text-[#3D3D3D] text-[15px]">
                                    Plant
                                </th>
                                <th class="px-6 py-3 text-center manrope-regular text-[#3D3D3D] text-[15px]">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6" class="manrope-medium manrope-medium text-[[#8791A3] text-[16px] py-[17px] px-[0px]">This Week</td>
                            </tr>
                            <tr
                                class="bg-white transition duration-300 ease-in-out hover:bg-[#ededed]">
                                <th scope="row"
                                    class="px-[20px] py-[20px] text-gray-900 whitespace-nowrap flex">
                                    <div class="">
                                        <span class="text-center inline-block w-[47px] h-[47px] mr-[10px] text-[18px] bg-gradient-to-b from-[#844EBC] to-[#AA55AA] text-[#fff] manrope-semibold rounded-[6px] py-[10px] px-[10px]">LB</span>
                                    </div>
                                    <div class="text-[#344563] text-[15px] manrope-regular cursor-pointer mt-[10px]" onclick="document.location='crane.html'">
                                        London Bridge
                                    </div>
                                </th>
                                <td
                                    class="px-[20px] py-[20px] text-center manrope-medium text-[#344563]  text-[15px]">
                                    Jan 08 - 2024
                                </td>
                                <td
                                    class="px-[20px] py-[20px] text-center manrope-medium text-[#344563]  text-[15px]">
                                    Digital Horizon Systems
                                </td>
                                <td
                                    class="px-[20px] py-[20px] text-center manrope-medium text-[#344563]  text-[15px]">
                                    Philip
                                </td>
                                <td class="px-[20px] py-[20px] text-center ">
                                    <button class="table-status w-[90px] bg-[#047413] text-white rounded-[7px] py-1 px-4 text-sm font-medium">
                                        Active
                                    </button>
                                </td>
                                <td
                                    class="px-[20px] py-[20px] text-center manrope-medium text-[#344563]  text-[15px]">
                                    Crane 01 , Lift 01 , Hook Lift 01 , Crane 02
                                </td>
                                <td class="flex justify-center relative">
                                    <span>
                                        <a href="#"><img src="assets/images/edit-report.png" class="w-[21px] mr-[20px]" onclick="toggleModal()"></a>
                                    </span>
                                    <span>
                                        <a href="crane.html"><img src="assets/images/live.png" class="w-[23px] mr-[20px]"></a>
                                    </span>
                                    <span class="mt-[8px]">
                                        <a href="#"><img src="assets/images/table-menu.png" class="w-[23px] mr-[20px]" onclick="toggleDotDropdown(event)"></a>
                                    </span>
                                    <div class="dot-drop absolute bg-white tab-shadow rounded-md hidden top-[30px] right-[60px] w-[170px] p-[10px] z-[8]">
                                        <ul>
                                            <li class="py-[5px]"><a href="#" class="flex manrope-medium text-[#344563]  text-[15px]">
                                                    <img src="assets/images/equipment.png" class="w-[16px] mr-[11px] object-contain">
                                                    <p onclick="toggleModale()">Add Equipment</p>
                                                </a></li>
                                            <li class="py-[5px]"><a href="#" class="flex manrope-medium text-[#344563]  text-[15px]">
                                                    <img src="assets/images/add-people.png" class="w-[16px] mr-[11px] object-contain">
                                                    <p onclick="toggleModalpeople()">Add People</p>
                                                </a></li>
                                            <li class="py-[5px]"><a href="#" class="flex manrope-medium text-[#344563]  text-[15px]">
                                                    <img src="assets/images/add-people.png" class="w-[16px] mr-[11px] object-contain">
                                                    <p onclick="toggleModalcont()">Add Trackable</p>
                                                </a></li>
                                            <li class="py-[5px]"><a href="#" class="flex manrope-medium text-[#344563]  text-[15px]">
                                                    <img src="assets/images/delete.png" class="w-[16px] mr-[11px] object-contain">
                                                    <p>Delete</p>
                                                </a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-[#f8f8f8] transition duration-300 ease-in-out hover:bg-[#ededed]">
                                <th scope="row"
                                    class="px-[20px] py-[20px] text-gray-900 whitespace-nowrap flex">
                                    <div class="">
                                        <span class="text-center inline-block w-[47px] h-[47px] mr-[10px] text-[18px] bg-gradient-to-b from-[#F99C43] to-[#F97C59] text-[#fff] manrope-semibold rounded-[6px] py-[10px] px-[10px]">TS</span>
                                    </div>
                                    <div class="text-[#344563] text-[15px] manrope-regular cursor-pointer mt-[10px]" onclick="document.location='crane.html'">
                                        Triton Square
                                    </div>
                                </th>
                                <td
                                    class="px-[20px] py-[20px] text-center manrope-medium text-[#344563]  text-[15px]">
                                    Jan 08 - 2024
                                </td>
                                <td
                                    class="px-[20px] py-[20px] text-center manrope-medium text-[#344563]  text-[15px]">
                                    Digital Horizon Systems
                                </td>
                                <td
                                    class="px-[20px] py-[20px] text-center manrope-medium text-[#344563]  text-[15px]">
                                    Steve
                                </td>
                                <td class="px-[20px] py-[20px] text-center ">
                                    <button class="table-status w-[90px] bg-[#047413] text-white rounded-[7px] py-1 px-4 text-sm font-medium">
                                        Active
                                    </button>
                                </td>
                                <td
                                    class="px-[20px] py-[20px] text-center manrope-medium text-[#344563]  text-[15px]">
                                    Crane 01 , Lift 01 , Hook Lift 01 , Crane 02
                                </td>
                                <td class="flex justify-center relative">
                                    <span>
                                        <a href="#"><img src="assets/images/edit-report.png" class="w-[21px] mr-[20px]" onclick="toggleModal()"></a>
                                    </span>
                                    <span>
                                        <a href="crane.html"><img src="assets/images/live.png" class="w-[23px] mr-[20px]"></a>
                                    </span>
                                    <span class="mt-[8px]">
                                        <a href="#"><img src="assets/images/table-menu.png" class="w-[23px] mr-[20px]" onclick="toggleDotDropdown(event)"></a>
                                    </span>
                                    <div class="dot-drop absolute bg-white tab-shadow rounded-md hidden top-[30px] right-[60px] w-[170px] p-[10px] z-[8]">
                                        <ul>
                                            <li class="py-[5px]"><a href="#" class="flex manrope-medium text-[#344563]  text-[15px]">
                                                    <img src="assets/images/equipment.png" class="w-[16px] mr-[11px] object-contain">
                                                    <p onclick="toggleModale()">Add Equipment</p>
                                                </a></li>
                                            <li class="py-[5px]"><a href="#" class="flex manrope-medium text-[#344563]  text-[15px]">
                                                    <img src="assets/images/add-people.png" class="w-[16px] mr-[11px] object-contain">
                                                    <p onclick="toggleModalpeople()">Add People</p>
                                                </a></li>
                                            <li class="py-[5px]"><a href="#" class="flex manrope-medium text-[#344563]  text-[15px]">
                                                    <img src="assets/images/add-people.png" class="w-[16px] mr-[11px] object-contain">
                                                    <p onclick="toggleModalcont()">Add Trackable</p>
                                                </a></li>
                                            <li class="py-[5px]"><a href="#" class="flex manrope-medium text-[#344563]  text-[15px]">
                                                    <img src="assets/images/delete.png" class="w-[16px] mr-[11px] object-contain">
                                                    <p>Delete</p>
                                                </a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr
                                class="bg-white transition duration-300 ease-in-out hover:bg-[#ededed]">
                                <th scope="row"
                                    class="px-[20px] py-[20px] text-gray-900 whitespace-nowrap flex">
                                    <div class="">
                                        <span class="text-center inline-block w-[47px] h-[47px] mr-[10px] text-[18px] bg-gradient-to-b from-[#FFB6DE] to-[#f880c2] text-[#fff] manrope-semibold rounded-[6px] py-[10px] px-[10px]">PP</span>
                                    </div>
                                    <div class="text-[#344563] text-[15px] manrope-regular cursor-pointer mt-[10px]" onclick="document.location='crane.html'">
                                        Powergate Phase 2
                                    </div>
                                </th>
                                <td
                                    class="px-[20px] py-[20px] text-center manrope-medium text-[#344563]  text-[15px]">
                                    Jan 08 - 2024
                                </td>
                                <td
                                    class="px-[20px] py-[20px] text-center manrope-medium text-[#344563]  text-[15px]">
                                    Digital Horizon Systems
                                </td>
                                <td
                                    class="px-[20px] py-[20px] text-center manrope-medium text-[#344563]  text-[15px]">
                                    John
                                </td>
                                <td class="px-[20px] py-[20px] text-center ">
                                    <button class="table-status w-[90px] bg-[#047413] text-white rounded-[7px] py-1 px-4 text-sm font-medium">
                                        Active
                                    </button>
                                </td>
                                <td
                                    class="px-[20px] py-[20px] text-center manrope-medium text-[#344563]  text-[15px]">
                                    Crane 01 , Lift 01 , Hook Lift 01 , Crane 02
                                </td>
                                <td class="flex justify-center relative">
                                    <span>
                                        <a href="#"><img src="assets/images/edit-report.png" class="w-[21px] mr-[20px]" onclick="toggleModal()"></a>
                                    </span>
                                    <span>
                                        <a href="crane.html"><img src="assets/images/live.png" class="w-[23px] mr-[20px]"></a>
                                    </span>
                                    <span class="mt-[8px]">
                                        <a href="#"><img src="assets/images/table-menu.png" class="w-[23px] mr-[20px]" onclick="toggleDotDropdown(event)"></a>
                                    </span>
                                    <div class="dot-drop absolute bg-white tab-shadow rounded-md hidden top-[30px] right-[60px] w-[170px] p-[10px] z-[8]">
                                        <ul>
                                            <li class="py-[5px]"><a href="#" class="flex manrope-medium text-[#344563]  text-[15px]">
                                                    <img src="assets/images/equipment.png" class="w-[16px] mr-[11px] object-contain">
                                                    <p onclick="toggleModale()">Add Equipment</p>
                                                </a></li>
                                            <li class="py-[5px]"><a href="#" class="flex manrope-medium text-[#344563]  text-[15px]">
                                                    <img src="assets/images/add-people.png" class="w-[16px] mr-[11px] object-contain">
                                                    <p onclick="toggleModalpeople()">Add People</p>
                                                </a></li>
                                            <li class="py-[5px]"><a href="#" class="flex manrope-medium text-[#344563]  text-[15px]">
                                                    <img src="assets/images/add-people.png" class="w-[16px] mr-[11px] object-contain">
                                                    <p onclick="toggleModalcont()">Add Trackable</p>
                                                </a></li>
                                            <li class="py-[5px]"><a href="#" class="flex manrope-medium text-[#344563]  text-[15px]">
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
@endsection