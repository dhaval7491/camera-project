@extends('layouts.app')

@section('content')
<div class="company-table h-full">
    <div class="form-list">
        <div class="">
            <div class="flex flex-wrap">
                <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                    <h3 class="manrope-medium text-[#344563] text-[18px] mt-[10px]">
                        <p class="inline-block manrope-medium text-[15px]  px-[0px] mt-[10px] mr-[15px] text-[#437651] underline">
                            < Back</p>Project
                    </h3>
                </div>
                <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                    <div class="table-filter lg:float-right md:float-right sm:float-left xs:float-left">
                        <ul class="list-inline list-unstyled flex">
                            <li class="list-inline-item mr-[15px]">
                                <button
                                    class="flex manrope-medium bg-[#3D3D3D] select-shadow btn rounded-[8px] py-[10px] px-[25px] text-[14px] border-[1px] border-solid border-[#3D3D3D] text-white"
                                    onclick="toggleModalcont()">
                                    <span class="mr-[10px]"><img src="assets/images/add.png" class="w-[15px] mt-[2px]"></span> Create Trackable
                                </button>
                            </li>
                            <li class="list-inline-item">
                                <button
                                    class="flex manrope-medium bg-[#3D3D3D] select-shadow btn rounded-[8px] py-[10px] px-[25px] text-[14px] border-[1px] border-solid border-[#3D3D3D] text-white"
                                    onclick="toggleModalassigntrackable()">Assign Trackable
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile-detail alert-shadow pt-[20px] pr-[25px] pb-[1px] pl-[20px] mt-[10px]">
            <div class="flex justify-between pl-[5px] pr-[5px]">
                <h4 class="manrope-medium text-[18px] mb-[20px]">Project Detail</h4>
            </div>
            <div class="flex flex-wrap mb-[30px]">
                <div class="lg:w-1/9 w-full pl-[5px] pr-[15px] border-r-[#e4e4e4] border-r-[1px] border-r-solid flex items-center justify-center">
                    <div class="text-center inline-block w-[140px] h-[140px] mr-[10px] text-[50px] bg-gradient-to-b from-[#844EBC] to-[#AA55AA] text-[#fff] manrope-semibold rounded-[6px] py-[10px] px-[10px] items-center justify-center pt-[30px]">
                        LB
                    </div>
                </div>
                <div class="lg:w-8/9 w-full pl-[15px] pr-[10px]">
                    <h3 class="manrope-regular text-[16px] ml-[5px] font-semibold">London Bridge</h3>
                    <div class="flex flex-wrap mb-[30px]">
                        <div class="lg:w-2/6 w-full pl-[5px] pr-[5px] pt-[10px]">
                            <div class="profile-detail">
                                <p class="pt-[0px]"><span class="w-[37%] inline-block manrope-regular text-[16px] text-[#3D3D3D]">Name of project:</span><span class="manrope-regular text-[16px] text-[#969696]">
                                        London Bridge</span></p>
                                <p class="pt-[10px]"><span class="w-[37%] inline-block manrope-regular">Date Created: </span><span class="manrope-regular text-[16px] text-[#969696] ">Jan 08 - 2024</span></p>

                            </div>
                        </div>
                        <div class="lg:w-2/6 w-full pl-[5px] pr-[5px]">
                            <div class="profile-detail">
                                <p class="pt-[10px]"><span class="w-[37%] inline-block manrope-regular">Company Name: </span><span class="manrope-regular text-[16px] text-[#969696]">Digital Horizon Systems</span></p>
                                <p class="pt-[10px]"><span class="w-[37%] inline-block manrope-regular text-[16px]">Status:</span><span class="manrope-regular text-[16px] text-[#047413]">Active</span></p>
                            </div>
                        </div>
                        <div class="lg:w-2/6 w-full pl-[5px] pr-[5px]">
                            <div class="profile-detail">
                                <p class="pt-[10px]"><span class="w-[37%] inline-block manrope-regular">Plant: </span>
                                    <span class="manrope-regular text-[16px] text-[#969696]">Crane 01 , Lift 01 , Hook Lift 01 , Crane 02</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-between pl-[5px] pr-[5px]">
            <h4 class="manrope-medium text-[18px] mb-[10px] mt-[10px]">Trackable List</h4>
        </div>
        <div class="form-list-table">
            <div class="">
                <div class="relative overflow-x-scroll h-full">
                    <table
                        class="w-full text-sm text-left">
                        <thead class=" bg-[#e6e6e6]">
                            <tr>
                                <th scope="col" class="px-6 py-3 manrope-medium text-[#3D3D3D] font-medium text-[16px]"></th>
                                <th scope="col" class="px-6 py-3 text-center manrope-medium text-[#3D3D3D] font-medium text-[15px]">Trackable Name</th>
                                <th scope="col" class="px-6 py-3 text-center manrope-medium text-[#3D3D3D] font-medium text-[15px]">Other name</th>
                                <th scope="col" class="px-6 py-3 text-center manrope-medium text-[#3D3D3D] font-medium text-[15px]">Linked Objects</th>
                                <th scope="col" class="px-6 py-3 text-center manrope-medium text-[#3D3D3D] font-medium text-[15px]">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white transition duration-300 ease-in-out hover:bg-[#ededed]">
                                <th class="text-center">
                                    <div class="">
                                        <input id="default-checkbox" type="checkbox" value="" class="text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
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
                            </tr>
                            <tr class="bg-[#f8f8f8] transition duration-300 ease-in-out hover:bg-[#ededed]">
                                <th class="text-center">
                                    <div class="">
                                        <input id="default-checkbox" type="checkbox" value="" class="text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    </div>
                                </th>
                                <td class="px-6 py-4 text-center ">
                                    <p class="manrope-regular text-black font-normal text-[16px]">Mas Indro</p>
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
                            </tr>
                            <tr class="bg-white transition duration-300 ease-in-out hover:bg-[#ededed]">
                                <th class="text-center">
                                    <div class="">
                                        <input id="default-checkbox" type="checkbox" value="" class="text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    </div>
                                </th>
                                <td class="px-6 py-4 text-center ">
                                    <p class="manrope-regular text-black font-normal text-[16px]">Mas Indro</p>
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
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection