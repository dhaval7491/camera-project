@extends('layouts.app')
@section('content')
<div class="company-table">
    <div class="form-list">
        <div class="">
            <div class="flex flex-wrap">
                <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                    <h3 class="manrope-medium text-[#344563] text-[18px] mt-[10px]">
                        <p class="inline-block manrope-medium text-[15px]  px-[0px] mt-[10px] mr-[15px] text-[#437651] underline">
                            < Back</p> User - 10
                    </h3>
                </div>
                <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                    <div class="table-filter lg:float-right md:float-right sm:float-left xs:float-left">
                        <ul class="list-inline list-unstyled flex">
                            <li class="list-inline-item mr-[15px]">
                                <button
                                    class="flex manrope-medium bg-[#3D3D3D] select-shadow btn rounded-[8px] py-[10px] px-[25px] text-[14px] border-[1px] border-solid border-[#3D3D3D] text-white"
                                    onclick="toggleModalu()">
                                    <span class="mr-[10px]"><img src="{{ asset('admin-theme/assets/images/add.png') }}" class="w-[15px] mt-[2px]"></span> Add New
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-filter-block mt-[20px]">
            <div class="flex">
                <p class="flex items-center w-[150px] manrope-medium font-medium text-[#6a6a75] text-[16px]"><img class="w-[20px] object-contain mr-[10px]" src="{{ asset('admin-theme/assets/images/filter-by.png') }}"> Filter By:</p>
                <p class="flex items-center ">
                    <img class="w-[40px] object-contain mr-[5px] border-[#EBEBEB] border-[1px] border-solid p-[7px] rounded-[16px]" src="{{ asset('admin-theme/assets/images/filter-user.png') }}">
                <div x-data="{ open: false, search: '', selected: 'User', options: ['User 1', 'User 2', 'User 3', 'User 4'] , selectedOptions: []}" class="relative ">
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
                <p class="flex items-center ">
                    <img class="w-[40px] h-[40px] object-contain mr-[5px] border-[#EBEBEB] border-[1px] border-solid p-[10px] rounded-[16px]" src="{{ asset('admin-theme/assets/images/fil-company.png') }}">
                <div x-data="{ open: false, search: '', selected: 'Company', options: ['Digital Horizon Systems', 'ByteCore Technologies', 'London Technova Solutions'] , selectedOptions: [] }" class="relative ">
                    <button @click="open = !open" class=" p-2 bg-white focus:outline-none w-[120px] text-left manrope-medium font-medium text-[#6a6a75] text-[14px]">
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
                    <img class="w-[40px] object-contain mr-[5px] border-[#EBEBEB] border-[1px] border-solid p-[7px] rounded-[16px]" src="{{ asset('admin-theme/assets/images/project-filter.png') }}">
                <div x-data="{ open: false, search: '', selected: 'Project', options: ['Project 1', 'Project 2', 'Project 3', 'Project 4'] , selectedOptions: []}" class="relative ">
                    <button @click="open = !open" class=" p-2 bg-white focus:outline-none w-[120px] text-left manrope-medium font-medium text-[#6a6a75] text-[14px]">
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
                    <img class="w-[40px] object-contain mr-[5px] border-[#EBEBEB] border-[1px] border-solid p-[7px] rounded-[16px]" src="{{ asset('admin-theme/assets/images/member-filter.png') }}">
                <div x-data="{ open: false, search: '', selected: 'User Id', options: ['#48964778', '#48964778', '#48964778', '#48964778'] , selectedOptions: []}" class="relative ">
                    <button @click="open = !open" class=" p-2 bg-white focus:outline-none w-[120px] text-left manrope-medium font-medium text-[#6a6a75] text-[14px]">
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
                <p class="flex items-center">
                    <img class="w-[40px] object-contain mr-[5px] border-[#EBEBEB] border-[1px] border-solid p-[7px] rounded-[16px]" src="{{ asset('admin-theme/assets/images/status-filter.png') }}">
                <div x-data="{ open: false, search: '', selected: 'Status', options: ['Active', 'Inactive', 'Block'] , selectedOptions: [] }" class="relative ">
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
                        class="w-full text-sm text-left rtl:text-right">
                        <thead class=" bg-[#e6e6e6]">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 manrope-regular text-[#3D3D3D] text-[15px]">
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left manrope-regular text-[#3D3D3D] text-[15px]">
                                    User Name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center manrope-regular text-[#3D3D3D] text-[15px]">
                                    Company Name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center manrope-regular text-[#3D3D3D] text-[15px]">
                                    User ID
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center manrope-regular text-[#3D3D3D] text-[15px]">
                                    Access Level
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center manrope-regular text-[#3D3D3D] text-[15px]">
                                    Status
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center manrope-regular text-[#3D3D3D] text-[15px]">
                                    Member Since
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center manrope-regular text-[#3D3D3D] text-[15px]">
                                    More
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white transition duration-300 ease-in-out hover:bg-[#ededed]">
                                <th class="text-center">
                                    <div class="">
                                        <input id="default-checkbox" type="checkbox" value="" class="text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    </div>
                                </th>
                                <td class="px-6 py-4 text-center manrope-regular text-[#344563] font-normal text-[16px] ">
                                    <div class="flex">
                                        <div class="mr-[15px]">
                                            <img class="w-[40px] object-contain" src="{{ asset('admin-theme/assets/images/user-img.png') }}">
                                        </div>
                                        <div class="text-left">
                                            <h5 class="manrope-regular text-black text-[16px]">Mas Indro</h5>
                                            <p class="manrope-regular text-[#7A86A1] text-[14px]">Manindro@gmail.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center manrope-regular text-black font-normal text-[16px]">
                                    <div>
                                        <p class="manrope-regular font-normal text-[16px]">Digital Horizon solutions</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center manrope-regular text-black font-normal text-[16px]">
                                    <div>
                                        <p class="manrope-regular font-normal text-[16px]">Project</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center ">
                                    <p class="manrope-regular text-black text-[16px]">#48964778</p>
                                </td>
                                <td class="px-[20px] py-[20px] text-center ">
                                    <button class="table-status w-[90px] bg-[#047413] text-white rounded-[7px] py-1 px-4 text-sm font-medium cursor-pointer">
                                        Active
                                    </button>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <p class="manrope-regular text-black font-normal text-[16px]">January 15 , 2023</p>
                                </td>
                                <td class="px-6 py-4 text-center relative">
                                    <ul class="flex justify-center">
                                        <li class="py-[5px]"><a href="user-view.html" class="flex manrope-regular text-[#344563] font-normal text-[15px]">
                                                <img src="{{ asset('admin-theme/assets/images/view.png') }}" class="mt-[4px] w-[20px] mr-[11px] object-contain"></a>
                                        </li>
                                        <li class="py-[5px]"><a href="#" class="flex manrope-regular text-[#344563] font-normal text-[15px]" onclick="toggleModalp()">
                                                <img src="{{ asset('admin-theme/assets/images/project.png') }}" class="w-[15px] mr-[11px] object-contain"></a>
                                        </li>
                                        <li class="py-[5px]"><a href="#" class="flex manrope-regular text-[#344563] font-normal text-[15px]">
                                                <img src="{{ asset('admin-theme/assets/images/edit-opt.png') }}" class="mt-[4px] w-[20px] mr-[11px] object-contain" onclick="toggleModal()"></a>
                                        </li>
                                        <li class="py-[5px]"><a href="#" class="flex manrope-regular text-[#344563] font-normal text-[15px]">
                                                <img src="{{ asset('admin-theme/assets/images/delete.png') }}" class="w-[20px] mr-[11px] object-contain"></a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            <tr class="bg-[#f8f8f8] transition duration-300 ease-in-out hover:bg-[#ededed]">
                                <th class="text-center">
                                    <div class="">
                                        <input id="default-checkbox" type="checkbox" value="" class="text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    </div>
                                </th>
                                <td class="px-6 py-4 text-center manrope-regular text-[#344563] font-normal text-[16px] ">
                                    <div class="flex">
                                        <div class="mr-[15px]">
                                            <img class="w-[40px] object-contain" src="{{ asset('admin-theme/assets/images/user-img.png') }}">
                                        </div>
                                        <div class="text-left">
                                            <h5 class="manrope-regular text-black text-[16px]">Mas Indro</h5>
                                            <p class="manrope-regular text-[#7A86A1] text-[14px]">Manindro@gmail.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center manrope-regular text-black font-normal text-[16px]">
                                    <div>
                                        <p class="manrope-regular font-normal text-[16px]">Digital Horizon solutions</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center manrope-regular text-black font-normal text-[16px]">
                                    <div>
                                        <p class="manrope-regular font-normal text-[16px]">Project</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center ">
                                    <p class="manrope-regular text-black text-[16px]">#48964778</p>
                                </td>
                                <td class="px-[20px] py-[20px] text-center ">
                                    <button class="table-status w-[90px] bg-[#047413] text-white rounded-[7px] py-1 px-4 text-sm font-medium cursor-pointer">
                                        Active
                                    </button>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <p class="manrope-regular text-black font-normal text-[16px]">January 15 , 2023</p>
                                </td>
                                <td class="px-6 py-4 text-center relative">
                                    <ul class="flex justify-center">
                                        <li class="py-[5px]"><a href="user-view.html" class="flex manrope-regular text-[#344563] font-normal text-[15px]">
                                                <img src="{{ asset('admin-theme/assets/images/view.png') }}" class="mt-[4px] w-[20px] mr-[11px] object-contain"></a>
                                        </li>
                                        <li class="py-[5px]"><a href="#" class="flex manrope-regular text-[#344563] font-normal text-[15px]" onclick="toggleModalp()">
                                                <img src="{{ asset('admin-theme/assets/images/project.png') }}" class="w-[15px] mr-[11px] object-contain"></a>
                                        </li>
                                        <li class="py-[5px]"><a href="#" class="flex manrope-regular text-[#344563] font-normal text-[15px]">
                                                <img src="{{ asset('admin-theme/assets/images/edit-opt.png') }}" class="mt-[4px] w-[20px] mr-[11px] object-contain" onclick="toggleModal()"></a>
                                        </li>
                                        <li class="py-[5px]"><a href="#" class="flex manrope-regular text-[#344563] font-normal text-[15px]">
                                                <img src="{{ asset('admin-theme/assets/images/delete.png') }}" class="w-[20px] mr-[11px] object-contain"></a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            <tr class="bg-white transition duration-300 ease-in-out hover:bg-[#ededed]">
                                <th class="text-center">
                                    <div class="">
                                        <input id="default-checkbox" type="checkbox" value="" class="text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    </div>
                                </th>
                                <td class="px-6 py-4 text-center manrope-regular text-[#344563] font-normal text-[16px] ">
                                    <div class="flex">
                                        <div class="mr-[15px]">
                                            <img class="w-[40px] object-contain" src="{{ asset('admin-theme/assets/images/user-img.png') }}">
                                        </div>
                                        <div class="text-left">
                                            <h5 class="manrope-regular text-black text-[16px]">Mas Indro</h5>
                                            <p class="manrope-regular text-[#7A86A1] text-[14px]">Manindro@gmail.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center manrope-regular text-black font-normal text-[16px]">
                                    <div>
                                        <p class="manrope-regular font-normal text-[16px]">Digital Horizon solutions</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center manrope-regular text-black font-normal text-[16px]">
                                    <div>
                                        <p class="manrope-regular font-normal text-[16px]">Project</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center ">
                                    <p class="manrope-regular text-black text-[16px]">#48964778</p>
                                </td>
                                <td class="px-[20px] py-[20px] text-center ">
                                    <button class="table-status w-[90px] bg-[#047413] text-white rounded-[7px] py-1 px-4 text-sm font-medium cursor-pointer">
                                        Active
                                    </button>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <p class="manrope-regular text-black font-normal text-[16px]">January 15 , 2023</p>
                                </td>
                                <td class="px-6 py-4 text-center relative">
                                    <ul class="flex justify-center">
                                        <li class="py-[5px]"><a href="user-view.html" class="flex manrope-regular text-[#344563] font-normal text-[15px]">
                                                <img src="{{ asset('admin-theme/assets/images/view.png') }}" class="mt-[4px] w-[20px] mr-[11px] object-contain"></a>
                                        </li>
                                        <li class="py-[5px]"><a href="#" class="flex manrope-regular text-[#344563] font-normal text-[15px]" onclick="toggleModalp()">
                                                <img src="{{ asset('admin-theme/assets/images/project.png') }}" class="w-[15px] mr-[11px] object-contain"></a>
                                        </li>
                                        <li class="py-[5px]"><a href="#" class="flex manrope-regular text-[#344563] font-normal text-[15px]">
                                                <img src="{{ asset('admin-theme/assets/images/edit-opt.png') }}" class="mt-[4px] w-[20px] mr-[11px] object-contain" onclick="toggleModal()"></a>
                                        </li>
                                        <li class="py-[5px]"><a href="#" class="flex manrope-regular text-[#344563] font-normal text-[15px]">
                                                <img src="{{ asset('admin-theme/assets/images/delete.png') }}" class="w-[20px] mr-[11px] object-contain"></a>
                                        </li>
                                    </ul>
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