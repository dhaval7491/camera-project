@extends('layouts.app')
@section('content')
<div class="">
    <div class="form-list">
        <div class="">
            <div class="flex flex-wrap h-full">
                <div class="sm:w-6/6 md:w-1/6 lg:w-1/6 w-[80%]">
                    <div class="h-full sidebar-shadow py-[10px] px-[25px] mt-[0px]">
                        <button class="tab-button block text-[#969696] manrope-regular text-[16px] py-[5px] pl-[10px] mb-[5px]" onclick="openTab(event, 'account')">
                            Account
                        </button>
                        <button class="tab-button block text-[#969696] manrope-regular text-[16px] py-[5px] pl-[10px] mb-[5px]" onclick="openTab(event, 'login')">
                            Login and security
                        </button>
                        <button class="tab-button block text-[#969696] manrope-regular text-[16px] py-[5px] pl-[10px] mb-[5px]" onclick="openTab(event, 'platform')">
                            Platform
                        </button>
                        <button class="tab-button block text-[#969696] manrope-regular text-[16px] py-[5px] pl-[10px] mb-[5px]" onclick="openTab(event, 'event')">
                            Event Type
                        </button>
                    </div>
                </div>
                <div class="sm:w-6/6 md:w-5/6 lg:w-5/6 w-full">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-prop hidden" id="account">
                            <div class="account-detail pl-[40px] pt-[20px]">
                                <h4 class="manrope-semibold font-[16px] text-[#3D3D3D]">Account Details</h4>
                                <div class="account-form mt-[40px]">
                                    <p class="manrope-medium text-[15px] text-[#000000] mb-[10px]">Upload Profile Picture</p>
                                    <form class="items-start gap-6">
                                        <div class="relative w-[12%] mb-[40px]">
                                            <img src="{{ asset('admin-theme/assets/images/profile-edit.png') }}" class="w-full">
                                            <label for="file-input"
                                                class="absolute bottom-[20px] right-[10px] bg-white p-1 rounded-full shadow-md cursor-pointer flex items-center justify-center">
                                                <img src="{{ asset('admin-theme/assets/images/camera.png') }}" class="w-[30px] h-[30px] object-contain p-[2px]">
                                            </label>
                                            <input type="file" id="file-input" accept="image/*" class="hidden">
                                        </div>
                                        <div class="w-[60%]">
                                            <label class="text-[15px] text-black font-medium manrope-medium">Full name</label>
                                            <div class="mt-[20px] mb-[30px]">
                                                <div class="sm:flex">
                                                    <input type="text" class="block w-full border-[1px] border-solid border-[#EBEBEB] relative rounded-l-full py-[10px] px-[25px]">
                                                    <input type="text" class="block w-full border-[1px] border-solid border-[#EBEBEB] relative rounded-r-full  py-[10px] px-[25px]">
                                                </div>
                                            </div>
                                            <label class="text-[15px] text-black font-medium manrope-medium">Email</label>
                                            <input type="text" class="mt-[20px] block w-full border-[1px] border-solid border-[#EBEBEB] relative rounded-full py-[10px] px-[25px]">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-prop hidden" id="organisation">
                            <div class="account-detail pl-[40px] pt-[20px]">
                                <h4 class="manrope-semibold font-[16px] text-[#3D3D3D]">Organisation</h4>
                                <div class="account-form w-[60%]">
                                    <form class="mt-[40px]">
                                        <div class="mb-[20px]">
                                            <label class="text-[15px] text-black font-medium manrope-medium">Company Name</label>
                                            <input type="text" class="mt-[20px] block w-full border-[1px] border-solid border-[#EBEBEB] relative rounded-full py-[10px] px-[25px]">
                                        </div>
                                        <div class="">
                                            <label class="text-[15px] text-black font-medium manrope-medium">Timezone</label>
                                            <select class="mt-[20px] block w-full border-[1px] border-solid border-[#EBEBEB] relative rounded-full py-[10px] px-[25px]">
                                                <option></option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-prop hidden" id="login">
                            <div class="account-detail pl-[40px] pt-[20px]">
                                <h4 class="manrope-semibold font-[16px] text-[#3D3D3D]">Login and Security</h4>
                                <h5 class="manrope-medium text-[16px] mt-[10px]">Two Factor Authentication options</h5>
                                <div class="w-[60%]">
                                    <!-- Text Message Security -->
                                    <div class="border-l-[6px] border-[#437651] border-solid tab-shadow py-[20px] px-[30px] mb-[30px] mt-[40px]">
                                        <div class="flex justify-between items-center">
                                            <h5 class="text-lg font-semibold">Text Message</h5>
                                            <label class="flex items-center cursor-pointer">
                                                <input type="checkbox" class="sr-only peer">
                                                <div class="w-10 h-5 bg-gray-300 rounded-full peer-checked:bg-orange-400 relative transition">
                                                    <div class="absolute left-1 top-1 w-3 h-3 bg-white rounded-full peer-checked:left-6 transition"></div>
                                                </div>
                                            </label>
                                        </div>
                                        <p class="text-gray-500 manrope-regular text-[15px] mt-[10px]">Use your mobile phone to receive verification code</p>
                                        <div class="flex justify-between items-center mt-[20px]">
                                            <span class="text-[#7A86A1] manrope-medium text-[14px]"><input id="checked-checkbox" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 rounded-sm checked:bg-black focus:ring-[#000] mr-[10px]">Verified, January 03</span>
                                            <span class="text-[#7A86A1] manrope-medium text-[14px]">+91 8425621XXX <a href="#" class="text-[#81C3F0] manrope-medium text-[14px] ml-[20px]"><span onclick="toggleModalphone()">Edit</span></a></span>
                                        </div>
                                    </div>

                                    <!-- Google Authenticator -->
                                    <div class="tab-shadow py-[20px] px-[30px] mb-[30px] mt-[40px]">
                                        <div class="flex justify-between items-center">
                                            <h5 class="text-lg font-semibold">Google Authenticator</h5>
                                            <label class="flex items-center cursor-pointer">
                                                <input type="checkbox" class="sr-only peer">
                                                <div class="w-10 h-5 bg-gray-300 rounded-full peer-checked:bg-orange-400 relative transition">
                                                    <div class="absolute left-1 top-1 w-3 h-3 bg-white rounded-full peer-checked:left-6 transition"></div>
                                                </div>
                                            </label>
                                        </div>
                                        <p class="text-gray-500 manrope-regular text-[15px] mt-[10px]">Use the google authenticator app to generate one time security code</p>
                                        <div class="flex justify-between items-center mt-[20px]">
                                            <span class="text-[#7A86A1] manrope-medium text-[14px]"><input id="checked-checkbox" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 rounded-sm checked:bg-black focus:ring-[#000] mr-[10px]">Verified, January 03</span>
                                            <span class="text-[#7A86A1] manrope-medium text-[14px]">Google App <a href="#" class="text-[#81C3F0] manrope-medium text-[14px] ml-[20px]"><span onclick="toggleModalwebsite()">Edit</span></a></span>
                                        </div>
                                    </div>

                                    <!-- Create Password -->
                                    <div class="tab-shadow py-[20px] px-[30px] mb-[30px] mt-[40px]">
                                        <h5 class="text-lg font-semibold">Create Password</h5>
                                        <div class="relative mt-2">
                                            <input type="password" class="w-[70%] border-[1px] border-[#EBEBEB] border-solid rounded-full  p-3 pr-10 focus:ring focus:ring-gray-200" placeholder="******************">
                                        </div>
                                    </div>

                                    <!-- Enter Password -->
                                    <div class="border-l-[6px] border-[#437651] border-solid tab-shadow py-[20px] px-[30px] mb-[30px] mt-[40px]">
                                        <h5 class="text-lg font-semibold">Enter Password</h5>
                                        <div class="relative mt-2">
                                            <input type="password" class="w-[70%] border-[1px] border-[#EBEBEB] border-solid rounded-full  p-3 pr-10 focus:ring focus:ring-gray-200" placeholder="******************">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-prop hidden" id="device">
                            <div class="relative overflow-x-scroll h-full pl-[40px] pt-[40px]">
                                <table class="w-full text-sm text-left">
                                    <tr class="bg-[ededed]">
                                        <td class="py-[20px] px-[15px] manrope-medium text-[16px] text-black">Crane 01</td>
                                        <td class="py-[20px] px-[15px] manrope-medium text-[16px] text-black">#637282929</td>
                                        <td class="py-[20px] px-[15px] manrope-medium text-[16px] text-black">Device Name</td>
                                        <td class="py-[20px] px-[15px] manrope-medium text-[16px] text-black">https://www.example.com/api/v1/resources/data/fetch?user</td>
                                        <td><button class="bg-[#3D3D3D] text-white rounded-full py-[7px] px-[25px] manrope-medium text-[16px]">Remove</button></td>
                                        <td class="py-[20px] px-[15px]"><i class="fas fa-edit"></i></td>
                                    </tr>
                                </table>
                                <div class="mt-[30px]">
                                    <h4 class="manrope-semibold text-[16px] text-[#3D3D3D]">Add Device</h4>
                                    <form class="w-[60%]">
                                        <div>
                                            <label class="manrope-medium text-[15px] text-black block mt-[40px]">Crane Name</label>
                                            <input class="border-[#EBEBEB] border-[1px] border-solid rounded-full w-full p-[7px] mt-[7px]">
                                        </div>
                                        <div class="mb-4">
                                            <label class="manrope-medium text-[15px] text-black block mt-[40px]">Crane ID</label>
                                            <input class="border-[#EBEBEB] border-[1px] border-solid rounded-full w-full p-[7px] mt-[7px]">
                                        </div>
                                        <div class="mb-4">
                                            <label class="manrope-medium text-[15px] text-black block mt-[40px]">Device Name</label>
                                            <input class="border-[#EBEBEB] border-[1px] border-solid rounded-full w-full p-[7px] mt-[7px]">
                                        </div>
                                        <div class="mb-4">
                                            <label class="manrope-medium text-[15px] text-black block mt-[40px]">Device Link</label>
                                            <input class="border-[#EBEBEB] border-[1px] border-solid rounded-full w-full p-[7px] mt-[7px]">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-prop hidden" id="platform">
                            <div class="pl-[40px] pt-[40px]">
                                <h5 class="manrope-semibold font-[16px] text-[#3D3D3D]">Project Details</h5>
                                <div class="p-[30px] w-[80%] mt-[20px] alert-shadow ">
                                    <p class="manrope-semibold text-[16px] text-[#3D3D3D]">London Bridge</p>
                                    <table class="w-full text-sm text-left">
                                        <tr class="">
                                            <td class="py-[10px] px-[15px] manrope-medium text-[16px] text-black">Crane 01</td>
                                            <td class="py-[10px] px-[15px] manrope-medium text-[16px] text-black">#637282929</td>
                                            <td class="py-[10px] px-[15px] manrope-medium text-[16px] text-black">Device Name</td>
                                            <td class="py-[10px] px-[15px] manrope-medium text-[16px] text-black">https://www.example.com/api/v1/resources/data/fetch?user</td>
                                        </tr>
                                        <tr class="">
                                            <td class="py-[10px] px-[15px] manrope-medium text-[16px] text-black">Crane 01</td>
                                            <td class="py-[10px] px-[15px] manrope-medium text-[16px] text-black">#637282929</td>
                                            <td class="py-[10px] px-[15px] manrope-medium text-[16px] text-black">Device Name</td>
                                            <td class="py-[10px] px-[15px] manrope-medium text-[16px] text-black">https://www.example.com/api/v1/resources/data/fetch?user</td>
                                        </tr>
                                    </table>
                                    <div class="text-right mt-[20px]">
                                        <button class="bg-[#3D3D3D] text-white rounded-full py-[7px] px-[25px] manrope-medium text-[16px] mr-[20px] cursor-pointer">Remove</button><a href="#"><i class="fas fa-edit"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-prop hidden" id="event">
                            <div class="account-detail pl-[40px] pt-[20px]">
                                <div class="flex flex-wrap">
                                    <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                                        <h3 class="manrope-medium text-[#344563] text-[18px] mt-[10px]">
                                            <p class="inline-block manrope-medium text-[15px] px-[0px] mt-[10px] mr-[15px] text-[#437651] underline">
                                                < Back</p>Event Type
                                        </h3>
                                    </div>
                                    <div class="sm:w-6/6 md:w-3/6 lg:w-3/6 w-full">
                                        <div class="table-filter lg:float-right md:float-right sm:float-left xs:float-left">
                                            <ul class="list-inline list-unstyled flex">
                                                <li class="list-inline-item mr-[15px]">
                                                    <button
                                                        class="flex manrope-medium bg-[#3D3D3D] select-shadow btn rounded-[8px] py-[10px] px-[25px] text-[14px] border-[1px] border-solid border-[#3D3D3D] text-white"
                                                        onclick="toggleModalevent()">
                                                        <span class="mr-[10px]"><img src="{{ asset('admin-theme/assets/images/add.png') }}" class="w-[15px] mt-[2px]"></span> Add new
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="account-form w-[100%]">
                                    <div class="form-list-table">
                                        <div class="mt-[20px]">
                                            <div class="relative overflow-x-scroll h-full">
                                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                    <thead class=" bg-[#e6e6e6]">
                                                        <tr>
                                                            <th scope="col" class="px-6 py-3 manrope-medium text-[#3D3D3D] font-medium text-[16px]"></th>
                                                            <th scope="col"
                                                                class="px-6 py-3 manrope-medium text-[#3D3D3D] font-medium text-[16px] text-center">
                                                                Event Name
                                                            </th>
                                                            <th scope="col"
                                                                class="px-6 py-3 manrope-medium text-[#3D3D3D] font-medium text-[16px] text-center">
                                                                Condition
                                                            </th>
                                                            <th scope="col"
                                                                class="px-6 py-3 text-center manrope-medium text-[#3D3D3D] font-medium text-[16px]">
                                                                Wind Threshold
                                                            </th>
                                                            <th scope="col"
                                                                class="px-6 py-3 text-center manrope-medium text-[#3D3D3D] font-medium text-[16px]">
                                                                Height Threshold
                                                            </th>
                                                            <th scope="col"
                                                                class="px-6 py-3 text-center manrope-medium text-[#3D3D3D] font-medium text-[16px]">
                                                                Alert
                                                            </th>
                                                            <th scope="col"
                                                                class="px-6 py-3 text-center manrope-medium text-[#3D3D3D] font-medium text-[16px]">
                                                                Action
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
                                                                <span class="mt-[30px]"><a href="#"><img src="{{ asset('admin-theme/assets/images/table-menu.png') }}" class="w-[21px] mr-[20px]" onclick="toggleDotDropdown(event)"></a></span>
                                                                <div class="dot-drop absolute bg-white tab-shadow rounded-md hidden top-[40px] right-[60px] w-[170px] p-[10px] z-[8]">
                                                                    <ul>
                                                                        <li class="py-[5px]"><a href="#" class="flex text-[#344563] text-[16px] manrope-medium">
                                                                                <img src="{{ asset('admin-theme/assets/images/edit-opt.png') }}" class="w-[16px] mr-[11px] object-contain">
                                                                                <p>Edit</p>
                                                                            </a></li>
                                                                        <li class="py-[5px]"><a href="#" class="flex text-[#344563] text-[16px] manrope-medium">
                                                                                <img src="{{ asset('admin-theme/assets/images/delete.png') }}" class="w-[16px] mr-[11px] object-contain">
                                                                                <p>Delete</p>
                                                                            </a></li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="bg-[#f8f8f8] transition duration-300 ease-in-out hover:bg-[#ededed]">
                                                            <th class="text-center">
                                                                <div class="">
                                                                    <input id="default-checkbox" type="checkbox" value="" class="text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
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
                                                                <span class="mt-[30px]"><a href="#"><img src="{{ asset('admin-theme/assets/images/table-menu.png') }}" class="w-[21px] mr-[20px]" onclick="toggleDotDropdown(event)"></a></span>
                                                                <div class="dot-drop absolute bg-white tab-shadow rounded-md hidden top-[40px] right-[60px] w-[170px] p-[10px] z-[8]">
                                                                    <ul>
                                                                        <li class="py-[5px]"><a href="#" class="flex text-[#344563] text-[16px] manrope-medium">
                                                                                <img src="{{ asset('admin-theme/assets/images/edit-opt.png') }}" class="w-[16px] mr-[11px] object-contain">
                                                                                <p>Edit</p>
                                                                            </a></li>
                                                                        <li class="py-[5px]"><a href="#" class="flex text-[#344563] text-[16px] manrope-medium">
                                                                                <img src="{{ asset('admin-theme/assets/images/delete.png') }}" class="w-[16px] mr-[11px] object-contain">
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
    </div>
</div>
@endsection