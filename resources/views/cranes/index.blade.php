@extends('layouts.app')

@section('content')
<div class="flex flex-wrap">
    <div class="lg:w-1/6 md:w-1/6 w-full ">
        <div class="pl-[20px] py-[20px]">
            <select class="manrope-bold text-[22px] text-black w-[90%]">
                <option class="manrope-medium text-[13px] text-black">London Bridge</option>
                <option class="manrope-medium text-[13px] text-black">Triton Square</option>
                <option class="manrope-medium text-[13px] text-black">Powergate Phase 2</option>
            </select>
            <div class="crane-list py-[10px] pl-[5px] pr-[10px] h-[90%] overflow-y-scroll " x-data="{selected:1}">
                <button type="button" class="manrope-medium text-[17px] w-[95%] mb-[5px] py-[5px] pl-[15px] pr-[10px]" @click="selected !== 1 ? selected = 1 : selected = null">
                    <div class="flex items-center justify-between"> <span>All </span>
                        <svg :class="{'transform rotate-180' : selected == 1}" class="w-5 h-5 text-gray-500" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </button>
                <div class="relative overflow-hidden transition-all max-h-0 duration-700" x-ref="container1" x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                    <div class=" pb-[10px]">
                        <p class="manrope-medium text-[13px] w-[95%]  mb-[5px] px-[20px]" onclick="openTab(event, 'stream1')">camera 01</p>
                        <p class="manrope-medium text-[13px] w-[95%] mb-[5px]  px-[20px]" onclick="openTab(event, 'stream2')">camera 02</p>
                    </div>
                </div>
                <button type="button" class="manrope-medium text-[17px] w-[95%] mb-[5px] py-[5px] pl-[15px] pr-[10px]" @click="selected !== 2 ? selected = 2 : selected = null">
                    <div class="flex items-center justify-between"> <span>Crane 01 </span>
                        <svg :class="{'transform rotate-180' : selected == 1}" class="w-5 h-5 text-gray-500" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </button>
                <div class="relative overflow-hidden transition-all max-h-0 duration-700" x-ref="container2" x-bind:style="selected == 2 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                    <div class="pb-[10px]">
                        <p class="manrope-medium text-[13px] w-[95%]  mb-[5px]  px-[20px]" onclick="openTab(event, 'stream6')">camera 01</p>
                        <p class="manrope-medium text-[13px] w-[95%] mb-[5px]  px-[20px]" onclick="openTab(event, 'stream7')">camera 02</p>
                    </div>
                </div>
                <p class="manrope-medium text-[17px] w-[95%] mb-[5px] py-[5px] pl-[15px] pr-[10px]" onclick="openTab(event, 'stream3')">Lift 02</p>
                <p class="manrope-medium text-[17px] w-[95%] mb-[5px] py-[10px] pl-[15px] pr-[10px]" onclick="openTab(event, 'stream4')">Crane 03</p>
                <p class="manrope-medium text-[17px] w-[95%] mb-[5px] py-[10px] pl-[15px] pr-[10px]" onclick="openTab(event, 'stream5')">Hook Lift 04</p>
            </div>
        </div>
    </div>
    <div class="lg:w-5/6 md:w-5/6 mt-[10px]">
        <div class="mb-[20px]">
            <ul class="flex justify-between px-[15px]">
                <li>
                    <p class="inline-block manrope-medium text-[13px]  px-[0px] mt-[10px] mr-[15px] text-[#437651] underline">
                        < Back</p>
                </li>
                <li class="list-inline-item ">
                    <button
                        class="flex manrope-medium bg-[#3D3D3D] select-shadow btn rounded-[8px] py-[10px] px-[16px] text-[14px] border-[1px] border-solid border-[#3D3D3D] text-white"
                        onclick="toggleModale()">
                        <span class="mr-[10px]"><img src="assets/images/add.png" class="w-[15px] mt-[2px]"></span> Add Equipment
                    </button>
                </li>
            </ul>
        </div>
        <div class="tab-prop pl-[10px]" id="stream1">
            <div class="mb-[20px]">
                <ul class="flex">
                    <li class="tab-button ml-[10px] px-[10px] py-[5px] manrope-regular text-[20px] text-[#344563]" onclick="openTab(event, 'livestream1')">Live Stream</li>
                    <li class="tab-button ml-[10px] px-[10px] py-[5px] manrope-regular text-[20px] text-[#344563]" onclick="openTab(event, 'recordings1')">Recordings</li>
                    <li class="tab-button ml-[10px] px-[10px] py-[5px] manrope-regular text-[20px] text-[#344563]" onclick="openTab(event, 'screenshorts1')">Screenshots</li>
                </ul>
            </div>
            <div class="tab-prop1" id="livestream1">
                <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 gap-6 ">
                    <div class="relative alert-shadow rounded-[25px]">
                        <div class="crane-file">
                            <img src="assets/images/live-stream.png" class="rounded-t-[25px]" onclick="document.location='live-stream-video.html'">
                        </div>
                        <div class="absolute top-[10px] left-[10px]">
                            <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                        </div>
                        <p class="text-[#7A86A1] manrope-medium  text-[14px] mb-[5px] flex justify-between py-[20px] px-[20px]">
                            <span class=" inline-block manrope-medium text-[12px] text-black">Hook Lift</span>
                            <span class=" inline-block manrope-medium text-[12px] text-black"><img src="assets/images/record-menu.png" class="w-[22px] mt-[6px]  cursor-pointer record-menu"></span>
                        </p>
                        <div class="droplist hidden absolute bottom-[-80px] right-[10px] alert-shadow bg-[#fff] py-[3px] px-[14px]">
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px]">Live Stream</p>
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px]">Recordings</p>
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px]">Screenshorts</p>
                        </div>
                    </div>
                    <div class="relative alert-shadow rounded-[25px]">
                        <div class="crane-file">
                            <img src="assets/images/live-stream.png" class="rounded-t-[25px]" onclick="document.location='live-stream-video.html'">
                        </div>
                        <div class="absolute top-[10px] left-[10px]">
                            <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                        </div>
                        <p class="text-[#7A86A1] manrope-medium  text-[14px] mb-[5px] flex justify-between py-[20px] px-[20px]">
                            <span class=" inline-block manrope-medium text-[12px] text-black">Hook Lift</span>
                            <span class=" inline-block manrope-medium text-[12px] text-black"><img src="assets/images/record-menu.png" class="w-[22px] mt-[6px]  cursor-pointer record-menu"></span>
                        </p>
                        <div class="droplist hidden absolute bottom-[-80px] right-[10px] alert-shadow bg-[#fff] py-[3px] px-[14px]">
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px]">Live Stream</p>
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px]">Recordings</p>
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px]">Screenshorts</p>
                        </div>
                    </div>
                    <div class="relative alert-shadow rounded-[25px]">
                        <div class="crane-file">
                            <img src="assets/images/live-stream.png" class="rounded-t-[25px]" onclick="document.location='live-stream-video.html'">
                        </div>
                        <div class="absolute top-[10px] left-[10px]">
                            <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                        </div>
                        <p class="text-[#7A86A1] manrope-medium  text-[14px] mb-[5px] flex justify-between py-[20px] px-[20px]">
                            <span class=" inline-block manrope-medium text-[12px] text-black">Hook Lift</span>
                            <span class=" inline-block manrope-medium text-[12px] text-black"><img src="assets/images/record-menu.png" class="w-[22px] mt-[6px]  cursor-pointer record-menu"></span>
                        </p>
                        <div class="droplist hidden absolute bottom-[-80px] right-[10px] alert-shadow bg-[#fff] py-[3px] px-[14px]">
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px]">Live Stream</p>
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px]">Recordings</p>
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px]">Screenshorts</p>
                        </div>
                    </div>
                    <div class="relative alert-shadow rounded-[25px]">
                        <div class="crane-file">
                            <img src="assets/images/live-stream.png" class="rounded-t-[25px]" onclick="document.location='live-stream-video.html'">
                        </div>
                        <div class="absolute top-[10px] left-[10px]">
                            <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                        </div>
                        <p class="text-[#7A86A1] manrope-medium  text-[14px] mb-[5px] flex justify-between py-[20px] px-[20px]">
                            <span class=" inline-block manrope-medium text-[12px] text-black">Hook Lift</span>
                            <span class=" inline-block manrope-medium text-[12px] text-black"><img src="assets/images/record-menu.png" class="w-[22px] mt-[6px]  cursor-pointer record-menu"></span>
                        </p>
                        <div class="droplist hidden absolute bottom-[-80px] right-[10px] alert-shadow bg-[#fff] py-[3px] px-[14px]">
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px]">Live Stream</p>
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px]">Recordings</p>
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px]">Screenshorts</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-prop1 hidden" id="recordings1">
                <div class="grid lg:grid-cols-6 md:grid-cols-5 sm:grid-cols-2 gap-7 mt-[20px] ml-[20px]">
                    <div class="tab-shadow rounded-[15px] py-[20px] px-[16px] relative">
                        <div class="border-b-[#EBEBEB] border-b-solid border-b-[1px]" onclick="document.location='recording-list.html'">
                            <img src="assets/images/crane-file.png" class="w-[35px]  mx-auto pt-[20px] pb-[40px]">
                        </div>
                        <div class="pt-[20px]">
                            <h4 class="manrope-medium text-[16px] text-black mb-[5px]">Wolffkran</h4>
                            <p class="text-[#7A86A1] manrope-regular  text-[14px] mb-[5px] flex justify-between py-[0px] px-[0px]">
                                <span class=" inline-block ">02.02.2025</span>
                                <span class=" inline-block "><img src="assets/images/record-menu.png" class="w-[22px] mt-[6px]  cursor-pointer record-menu"></span>
                            </p>
                            <div class="droplist hidden absolute bottom-[-80px] right-[10px] alert-shadow bg-[#fff] py-[3px] px-[14px]">
                                <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/share.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Share</p>
                                <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/download.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Download</p>
                                <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/delete.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Delete</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-shadow rounded-[15px] py-[20px] px-[16px] relative">
                        <div class="border-b-[#EBEBEB] border-b-solid border-b-[1px]" onclick="document.location='recording-list.html'">
                            <img src="assets/images/crane-file.png" class="w-[35px]  mx-auto pt-[20px] pb-[40px]">
                        </div>
                        <div class="pt-[20px]">
                            <h4 class="manrope-medium text-[16px] text-black mb-[5px]">Wolffkran</h4>
                            <p class="text-[#7A86A1] manrope-regular  text-[14px] mb-[5px] flex justify-between py-[0px] px-[0px]">
                                <span class=" inline-block ">02.02.2025</span>
                                <span class=" inline-block "><img src="assets/images/record-menu.png" class="w-[22px] mt-[6px]  cursor-pointer record-menu"></span>
                            </p>
                            <div class="droplist hidden absolute bottom-[-80px] right-[10px] alert-shadow bg-[#fff] py-[3px] px-[14px]">
                                <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/share.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Share</p>
                                <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/download.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Download</p>
                                <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/delete.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Delete</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-shadow rounded-[15px] py-[20px] px-[16px] relative">
                        <div class="border-b-[#EBEBEB] border-b-solid border-b-[1px]" onclick="document.location='recording-list.html'">
                            <img src="assets/images/crane-file.png" class="w-[35px]  mx-auto pt-[20px] pb-[40px]">
                        </div>
                        <div class="pt-[20px]">
                            <h4 class="manrope-medium text-[16px] text-black mb-[5px]">Wolffkran</h4>
                            <p class="text-[#7A86A1] manrope-regular  text-[14px] mb-[5px] flex justify-between py-[0px] px-[0px]">
                                <span class=" inline-block ">02.02.2025</span>
                                <span class=" inline-block "><img src="assets/images/record-menu.png" class="w-[22px] mt-[6px]  cursor-pointer record-menu"></span>
                            </p>
                            <div class="droplist hidden absolute bottom-[-80px] right-[10px] alert-shadow bg-[#fff] py-[3px] px-[14px]">
                                <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/share.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Share</p>
                                <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/download.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Download</p>
                                <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/delete.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Delete</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-shadow rounded-[15px] py-[20px] px-[16px] relative">
                        <div class="border-b-[#EBEBEB] border-b-solid border-b-[1px]" onclick="document.location='recording-list.html'">
                            <img src="assets/images/crane-file.png" class="w-[35px]  mx-auto pt-[20px] pb-[40px]">
                        </div>
                        <div class="pt-[20px]">
                            <h4 class="manrope-medium text-[16px] text-black mb-[5px]">Wolffkran</h4>
                            <p class="text-[#7A86A1] manrope-regular  text-[14px] mb-[5px] flex justify-between py-[0px] px-[0px]">
                                <span class=" inline-block ">02.02.2025</span>
                                <span class=" inline-block "><img src="assets/images/record-menu.png" class="w-[22px] mt-[6px]  cursor-pointer record-menu"></span>
                            </p>
                            <div class="droplist hidden absolute bottom-[-80px] right-[10px] alert-shadow bg-[#fff] py-[3px] px-[14px]">
                                <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/share.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Share</p>
                                <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/download.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Download</p>
                                <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/delete.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Delete</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-shadow rounded-[15px] py-[20px] px-[16px] relative">
                        <div class="border-b-[#EBEBEB] border-b-solid border-b-[1px]" onclick="document.location='recording-list.html'">
                            <img src="assets/images/crane-file.png" class="w-[35px]  mx-auto pt-[20px] pb-[40px]">
                        </div>
                        <div class="pt-[20px]">
                            <h4 class="manrope-medium text-[16px] text-black mb-[5px]">Wolffkran</h4>
                            <p class="text-[#7A86A1] manrope-regular  text-[14px] mb-[5px] flex justify-between py-[0px] px-[0px]">
                                <span class=" inline-block ">02.02.2025</span>
                                <span class=" inline-block "><img src="assets/images/record-menu.png" class="w-[22px] mt-[6px]  cursor-pointer record-menu"></span>
                            </p>
                            <div class="droplist hidden absolute bottom-[-80px] right-[10px] alert-shadow bg-[#fff] py-[3px] px-[14px]">
                                <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/share.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Share</p>
                                <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/download.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Download</p>
                                <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/delete.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Delete</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-prop1 hidden" id="screenshorts1">
                <div class="grid lg:grid-cols-4 md:grid-cols-4 sm:grid-cols-2 gap-7 mt-[20px] ml-[20px]">
                    <div class="tab-shadow rounded-[15px] relative">
                        <div class="crane-file" onclick="document.location='live-stream-screenshorts.html'">
                            <img src="assets/images/screen-short-img.png" class="rounded-t-[25px]">
                        </div>
                        <p class="text-[#000000] manrope-regular  text-[14px] mb-[5px] flex justify-between py-[15px] px-[15px]">
                            <span class=" inline-block ">Screenshort 01</span>
                            <span class=" inline-block "><img src="assets/images/record-menu.png" class="w-[22px] mt-[6px]  cursor-pointer record-menu"></span>
                        </p>
                        <div class="droplist hidden absolute bottom-[-80px] right-[10px] alert-shadow bg-[#fff] py-[3px] px-[14px]">
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/share.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Share</p>
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/download.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Download</p>
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/delete.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Delete</p>
                        </div>
                    </div>
                    <div class="tab-shadow rounded-[15px] relative">
                        <div class="crane-file" onclick="document.location='live-stream-screenshorts.html'">
                            <img src="assets/images/screen-short-img.png" class="rounded-t-[25px]">
                        </div>
                        <p class="text-[#000000] manrope-regular  text-[14px] mb-[5px] flex justify-between py-[15px] px-[15px]">
                            <span class=" inline-block ">Screenshort 01</span>
                            <span class=" inline-block "><img src="assets/images/record-menu.png" class="w-[22px] mt-[6px]  cursor-pointer record-menu"></span>
                        </p>
                        <div class="droplist hidden absolute bottom-[-80px] right-[10px] alert-shadow bg-[#fff] py-[3px] px-[14px]">
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/share.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Share</p>
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/download.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Download</p>
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/delete.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Delete</p>
                        </div>
                    </div>
                    <div class="tab-shadow rounded-[15px] relative">
                        <div class="crane-file" onclick="document.location='live-stream-screenshorts.html'">
                            <img src="assets/images/screen-short-img.png" class="rounded-t-[25px]">
                        </div>
                        <p class="text-[#000000] manrope-regular  text-[14px] mb-[5px] flex justify-between py-[15px] px-[15px]">
                            <span class=" inline-block ">Screenshort 01</span>
                            <span class=" inline-block "><img src="assets/images/record-menu.png" class="w-[22px] mt-[6px]  cursor-pointer record-menu"></span>
                        </p>
                        <div class="droplist hidden absolute bottom-[-80px] right-[10px] alert-shadow bg-[#fff] py-[3px] px-[14px]">
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/share.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Share</p>
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/download.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Download</p>
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/delete.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Delete</p>
                        </div>
                    </div>
                    <div class="tab-shadow rounded-[15px] relative">
                        <div class="crane-file" onclick="document.location='live-stream-screenshorts.html'">
                            <img src="assets/images/screen-short-img.png" class="rounded-t-[25px]">
                        </div>
                        <p class="text-[#000000] manrope-regular  text-[14px] mb-[5px] flex justify-between py-[15px] px-[15px]">
                            <span class=" inline-block ">Screenshort 01</span>
                            <span class=" inline-block "><img src="assets/images/record-menu.png" class="w-[22px] mt-[6px]  cursor-pointer record-menu"></span>
                        </p>
                        <div class="droplist hidden absolute bottom-[-80px] right-[10px] alert-shadow bg-[#fff] py-[3px] px-[14px]">
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/share.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Share</p>
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/download.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Download</p>
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/delete.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Delete</p>
                        </div>
                    </div>
                    <div class="tab-shadow rounded-[15px] relative">
                        <div class="crane-file" onclick="document.location='live-stream-screenshorts.html'">
                            <img src="assets/images/screen-short-img.png" class="rounded-t-[25px]">
                        </div>
                        <p class="text-[#000000] manrope-regular  text-[14px] mb-[5px] flex justify-between py-[15px] px-[15px]">
                            <span class=" inline-block ">Screenshort 01</span>
                            <span class=" inline-block "><img src="assets/images/record-menu.png" class="w-[22px] mt-[6px]  cursor-pointer record-menu"></span>
                        </p>
                        <div class="droplist hidden absolute bottom-[-80px] right-[10px] alert-shadow bg-[#fff] py-[3px] px-[14px]">
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/share.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Share</p>
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/download.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Download</p>
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/delete.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Delete</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-prop pl-[10px] hidden" id="stream2">
            <div class="mb-[20px]">
                <ul class="flex">
                    <li class="tab-button ml-[10px] px-[10px] py-[5px] manrope-regular text-[20px] text-[#344563]" onclick="openTab(event, 'livestream2')">Live Stream</li>
                    <li class="tab-button ml-[10px] px-[10px] py-[5px] manrope-regular text-[20px] text-[#344563]" onclick="openTab(event, 'recordings2')">Recordings</li>
                    <li class="tab-button ml-[10px] px-[10px] py-[5px] manrope-regular text-[20px] text-[#344563]" onclick="openTab(event, 'screenshorts2')">Screenshots</li>
                </ul>
            </div>
            <div class="tab-prop1" id="livestream2">
                <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 gap-6 ">

                    <div class="relative alert-shadow rounded-[25px]">
                        <div class="crane-file">
                            <img src="assets/images/live-stream.png" class="rounded-t-[25px]" onclick="document.location='live-stream-video.html'">
                        </div>
                        <div class="absolute top-[10px] left-[10px]">
                            <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                        </div>
                        <p class="text-[#7A86A1] manrope-medium  text-[14px] mb-[5px] flex justify-between py-[20px] px-[20px]">
                            <span class=" inline-block manrope-medium text-[12px] text-black">Hook Lift</span>
                            <span class=" inline-block manrope-medium text-[12px] text-black"><img src="assets/images/record-menu.png" class="w-[22px] mt-[6px]  cursor-pointer record-menu"></span>
                        </p>
                        <div class="droplist hidden absolute bottom-[-80px] right-[10px] alert-shadow bg-[#fff] py-[3px] px-[14px]">
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px]">Live Stream</p>
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px]">Recordings</p>
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px]">Screenshorts</p>
                        </div>
                    </div>
                    <div class="relative alert-shadow rounded-[25px]">
                        <div class="crane-file">
                            <img src="assets/images/live-stream.png" class="rounded-t-[25px]" onclick="document.location='live-stream-video.html'">
                        </div>
                        <div class="absolute top-[10px] left-[10px]">
                            <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                        </div>
                        <p class="text-[#7A86A1] manrope-medium  text-[14px] mb-[5px] flex justify-between py-[20px] px-[20px]">
                            <span class=" inline-block manrope-medium text-[12px] text-black">Hook Lift</span>
                            <span class=" inline-block manrope-medium text-[12px] text-black"><img src="assets/images/record-menu.png" class="w-[22px] mt-[6px]  cursor-pointer record-menu"></span>
                        </p>
                        <div class="droplist hidden absolute bottom-[-80px] right-[10px] alert-shadow bg-[#fff] py-[3px] px-[14px]">
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px]">Live Stream</p>
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px]">Recordings</p>
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px]">Screenshorts</p>
                        </div>
                    </div>
                    <div class="relative alert-shadow rounded-[25px]">
                        <div class="crane-file">
                            <img src="assets/images/live-stream.png" class="rounded-t-[25px]" onclick="document.location='live-stream-video.html'">
                        </div>
                        <div class="absolute top-[10px] left-[10px]">
                            <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                        </div>
                        <p class="text-[#7A86A1] manrope-medium  text-[14px] mb-[5px] flex justify-between py-[20px] px-[20px]">
                            <span class=" inline-block manrope-medium text-[12px] text-black">Hook Lift</span>
                            <span class=" inline-block manrope-medium text-[12px] text-black"><img src="assets/images/record-menu.png" class="w-[22px] mt-[6px]  cursor-pointer record-menu"></span>
                        </p>
                        <div class="droplist hidden absolute bottom-[-80px] right-[10px] alert-shadow bg-[#fff] py-[3px] px-[14px]">
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px]">Live Stream</p>
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px]">Recordings</p>
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px]">Screenshorts</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-prop1 hidden" id="recordings2">
                <div class="grid lg:grid-cols-6 md:grid-cols-5 sm:grid-cols-2 gap-7 mt-[20px] ml-[20px]">
                    <div class="tab-shadow rounded-[15px] py-[20px] px-[16px] relative">
                        <div class="border-b-[#EBEBEB] border-b-solid border-b-[1px]" onclick="document.location='recording-list.html'">
                            <img src="assets/images/crane-file.png" class="w-[35px]  mx-auto pt-[20px] pb-[40px]">
                        </div>
                        <div class="pt-[20px]">
                            <h4 class="manrope-medium text-[16px] text-black mb-[5px]">Wolffkran</h4>
                            <p class="text-[#7A86A1] manrope-regular  text-[14px] mb-[5px] flex justify-between py-[0px] px-[0px]">
                                <span class=" inline-block ">02.02.2025</span>
                                <span class=" inline-block "><img src="assets/images/record-menu.png" class="w-[22px] mt-[6px]  cursor-pointer record-menu"></span>
                            </p>
                            <div class="droplist hidden absolute bottom-[-80px] right-[10px] alert-shadow bg-[#fff] py-[3px] px-[14px]">
                                <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/share.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Share</p>
                                <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/download.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Download</p>
                                <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/delete.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Delete</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-shadow rounded-[15px] py-[20px] px-[16px] relative">
                        <div class="border-b-[#EBEBEB] border-b-solid border-b-[1px]" onclick="document.location='recording-list.html'">
                            <img src="assets/images/crane-file.png" class="w-[35px]  mx-auto pt-[20px] pb-[40px]">
                        </div>
                        <div class="pt-[20px]">
                            <h4 class="manrope-medium text-[16px] text-black mb-[5px]">Wolffkran</h4>
                            <p class="text-[#7A86A1] manrope-regular  text-[14px] mb-[5px] flex justify-between py-[0px] px-[0px]">
                                <span class=" inline-block ">02.02.2025</span>
                                <span class=" inline-block "><img src="assets/images/record-menu.png" class="w-[22px] mt-[6px]  cursor-pointer record-menu"></span>
                            </p>
                            <div class="droplist hidden absolute bottom-[-80px] right-[10px] alert-shadow bg-[#fff] py-[3px] px-[14px]">
                                <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/share.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Share</p>
                                <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/download.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Download</p>
                                <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/delete.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Delete</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-shadow rounded-[15px] py-[20px] px-[16px] relative">
                        <div class="border-b-[#EBEBEB] border-b-solid border-b-[1px]" onclick="document.location='recording-list.html'">
                            <img src="assets/images/crane-file.png" class="w-[35px]  mx-auto pt-[20px] pb-[40px]">
                        </div>
                        <div class="pt-[20px]">
                            <h4 class="manrope-medium text-[16px] text-black mb-[5px]">Wolffkran</h4>
                            <p class="text-[#7A86A1] manrope-regular  text-[14px] mb-[5px] flex justify-between py-[0px] px-[0px]">
                                <span class=" inline-block ">02.02.2025</span>
                                <span class=" inline-block "><img src="assets/images/record-menu.png" class="w-[22px] mt-[6px]  cursor-pointer record-menu"></span>
                            </p>
                            <div class="droplist hidden absolute bottom-[-80px] right-[10px] alert-shadow bg-[#fff] py-[3px] px-[14px]">
                                <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/share.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Share</p>
                                <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/download.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Download</p>
                                <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/delete.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Delete</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-shadow rounded-[15px] py-[20px] px-[16px] relative">
                        <div class="border-b-[#EBEBEB] border-b-solid border-b-[1px]" onclick="document.location='recording-list.html'">
                            <img src="assets/images/crane-file.png" class="w-[35px]  mx-auto pt-[20px] pb-[40px]">
                        </div>
                        <div class="pt-[20px]">
                            <h4 class="manrope-medium text-[16px] text-black mb-[5px]">Wolffkran</h4>
                            <p class="text-[#7A86A1] manrope-regular  text-[14px] mb-[5px] flex justify-between py-[0px] px-[0px]">
                                <span class=" inline-block ">02.02.2025</span>
                                <span class=" inline-block "><img src="assets/images/record-menu.png" class="w-[22px] mt-[6px]  cursor-pointer record-menu"></span>
                            </p>
                            <div class="droplist hidden absolute bottom-[-80px] right-[10px] alert-shadow bg-[#fff] py-[3px] px-[14px]">
                                <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/share.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Share</p>
                                <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/download.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Download</p>
                                <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/delete.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Delete</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-shadow rounded-[15px] py-[20px] px-[16px] relative">
                        <div class="border-b-[#EBEBEB] border-b-solid border-b-[1px]" onclick="document.location='recording-list.html'">
                            <img src="assets/images/crane-file.png" class="w-[35px]  mx-auto pt-[20px] pb-[40px]">
                        </div>
                        <div class="pt-[20px]">
                            <h4 class="manrope-medium text-[16px] text-black mb-[5px]">Wolffkran</h4>
                            <p class="text-[#7A86A1] manrope-regular  text-[14px] mb-[5px] flex justify-between py-[0px] px-[0px]">
                                <span class=" inline-block ">02.02.2025</span>
                                <span class=" inline-block "><img src="assets/images/record-menu.png" class="w-[22px] mt-[6px]  cursor-pointer record-menu"></span>
                            </p>
                            <div class="droplist hidden absolute bottom-[-80px] right-[10px] alert-shadow bg-[#fff] py-[3px] px-[14px]">
                                <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/share.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Share</p>
                                <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/download.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Download</p>
                                <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/delete.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Delete</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-prop1 hidden" id="screenshorts2">
                <div class="grid lg:grid-cols-4 md:grid-cols-4 sm:grid-cols-2 gap-7 mt-[20px] ml-[20px]">
                    <div class="tab-shadow rounded-[15px] relative">
                        <div class="crane-file" onclick="document.location='live-stream-screenshorts.html'">
                            <img src="assets/images/screen-short-img.png" class="rounded-t-[25px]">
                        </div>
                        <p class="text-[#000000] manrope-regular  text-[14px] mb-[5px] flex justify-between py-[15px] px-[15px]">
                            <span class=" inline-block ">Screenshort 01</span>
                            <span class=" inline-block "><img src="assets/images/record-menu.png" class="w-[22px] mt-[6px]  cursor-pointer record-menu"></span>
                        </p>
                        <div class="droplist hidden absolute bottom-[-80px] right-[10px] alert-shadow bg-[#fff] py-[3px] px-[14px]">
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/share.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Share</p>
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/download.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Download</p>
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/delete.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Delete</p>
                        </div>
                    </div>
                    <div class="tab-shadow rounded-[15px] relative">
                        <div class="crane-file" onclick="document.location='live-stream-screenshorts.html'">
                            <img src="assets/images/screen-short-img.png" class="rounded-t-[25px]">
                        </div>
                        <p class="text-[#000000] manrope-regular  text-[14px] mb-[5px] flex justify-between py-[15px] px-[15px]">
                            <span class=" inline-block ">Screenshort 01</span>
                            <span class=" inline-block "><img src="assets/images/record-menu.png" class="w-[22px] mt-[6px]  cursor-pointer record-menu"></span>
                        </p>
                        <div class="droplist hidden absolute bottom-[-80px] right-[10px] alert-shadow bg-[#fff] py-[3px] px-[14px]">
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/share.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Share</p>
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/download.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Download</p>
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/delete.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Delete</p>
                        </div>
                    </div>
                    <div class="tab-shadow rounded-[15px] relative">
                        <div class="crane-file" onclick="document.location='live-stream-screenshorts.html'">
                            <img src="assets/images/screen-short-img.png" class="rounded-t-[25px]">
                        </div>
                        <p class="text-[#000000] manrope-regular  text-[14px] mb-[5px] flex justify-between py-[15px] px-[15px]">
                            <span class=" inline-block ">Screenshort 01</span>
                            <span class=" inline-block "><img src="assets/images/record-menu.png" class="w-[22px] mt-[6px]  cursor-pointer record-menu"></span>
                        </p>
                        <div class="droplist hidden absolute bottom-[-80px] right-[10px] alert-shadow bg-[#fff] py-[3px] px-[14px]">
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/share.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Share</p>
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/download.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Download</p>
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/delete.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Delete</p>
                        </div>
                    </div>
                    <div class="tab-shadow rounded-[15px] relative">
                        <div class="crane-file" onclick="document.location='live-stream-screenshorts.html'">
                            <img src="assets/images/screen-short-img.png" class="rounded-t-[25px]">
                        </div>
                        <p class="text-[#000000] manrope-regular  text-[14px] mb-[5px] flex justify-between py-[15px] px-[15px]">
                            <span class=" inline-block ">Screenshort 01</span>
                            <span class=" inline-block "><img src="assets/images/record-menu.png" class="w-[22px] mt-[6px]  cursor-pointer record-menu"></span>
                        </p>
                        <div class="droplist hidden absolute bottom-[-80px] right-[10px] alert-shadow bg-[#fff] py-[3px] px-[14px]">
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/share.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Share</p>
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/download.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Download</p>
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/delete.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Delete</p>
                        </div>
                    </div>
                    <div class="tab-shadow rounded-[15px] relative">
                        <div class="crane-file" onclick="document.location='live-stream-screenshorts.html'">
                            <img src="assets/images/screen-short-img.png" class="rounded-t-[25px]">
                        </div>
                        <p class="text-[#000000] manrope-regular  text-[14px] mb-[5px] flex justify-between py-[15px] px-[15px]">
                            <span class=" inline-block ">Screenshort 01</span>
                            <span class=" inline-block "><img src="assets/images/record-menu.png" class="w-[22px] mt-[6px]  cursor-pointer record-menu"></span>
                        </p>
                        <div class="droplist hidden absolute bottom-[-80px] right-[10px] alert-shadow bg-[#fff] py-[3px] px-[14px]">
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/share.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Share</p>
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/download.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Download</p>
                            <p class="manrope-regular text-[14px] text-[#000] p-[5px] flex"><img src="assets/images/delete.png" class="w-[15px] h-[15px] object-contain mr-[7px] mt-[3px]">Delete</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection