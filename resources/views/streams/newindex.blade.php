@extends('layouts.app')
@section('content')
<div class="flex flex-wrap">
    <div class="lg:w-1/6 md:w-1/6 w-full h-full">
        <div class="crane-list py-[10px] pl-[5px] pr-[10px] h-[90%] overflow-y-scroll ">
            <!-- <button class="w-full  tab-button tab-shadow py-[15px] px-[10px] rounded-[10px] mb-[10px] cursor-pointer" onclick="openTab(event, 'stream1')">
                                    <p class="w-[100%] text-left manrope-medium text-[13px] font-medium mb-[5px]">Time Square</p>
                                </button> -->
            <button class="w-full tab-button tab-shadow py-[15px] px-[10px] rounded-[10px] mb-[10px] cursor-pointer group text-left overflow-hidden transition-all duration-300">
                <p class="w-full manrope-medium text-[13px] font-medium mb-[5px]">Time Square</p>
                <div class="drop-part max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                    <p class="flex justify-between border-t-[#9696963f] border-t-[1px] border-solid mt-[15px] pt-[5px]">
                        <span class="manrope-medium text-[13px] text-[#444]">Hook Lift</span>
                        <span class="manrope-medium text-[11px] text-[#969696]">09-05-2025</span>
                    </p>
                    <p class="flex justify-between mt-[5px] pt-[5px]">
                        <span class="manrope-medium text-[13px] text-[#444]">Lift 1</span>
                        <span class="manrope-medium text-[11px] text-[#969696]">11-05-2025</span>
                    </p>
                </div>
            </button>
            <button class="w-full  tab-button tab-shadow py-[15px] px-[10px] rounded-[10px] mb-[10px] cursor-pointer group text-left overflow-hidden transition-all duration-300" onclick="openTab(event, 'stream2')">
                <p class="w-[100%] text-left manrope-medium text-[13px] font-medium">Horizon Point</p>
                <div class="drop-part max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                    <p class="flex justify-between border-t-[#9696963f] border-t-[1px] border-solid mt-[15px] pt-[5px]">
                        <span class="manrope-medium text-[13px] text-[#444]">Camera 1</span>
                        <span class="manrope-medium text-[11px] text-[#969696]">02-05-2025</span>
                    </p>
                    <p class="flex justify-between mt-[5px] pt-[5px]">
                        <span class="manrope-medium text-[13px] text-[#444]">Camera 23</span>
                        <span class="manrope-medium text-[11px] text-[#969696]">04-05-2025</span>
                    </p>
                    <p class="flex justify-between mt-[5px] pt-[5px]">
                        <span class="manrope-medium text-[13px] text-[#444]">Camera 44</span>
                        <span class="manrope-medium text-[11px] text-[#969696]">02-05-2025</span>
                    </p>
                    <p class="flex justify-between mt-[5px] pt-[5px]">
                        <span class="manrope-medium text-[13px] text-[#444]">Camera 2</span>
                        <span class="manrope-medium text-[11px] text-[#969696]">02-05-2025</span>
                    </p>
                    <p class="flex justify-between mt-[5px] pt-[5px]">
                        <span class="manrope-medium text-[13px] text-[#444]">Camera 4</span>
                        <span class="manrope-medium text-[11px] text-[#969696]">03-05-2025</span>
                    </p>
                </div>
            </button>
            <button class="w-full  tab-button tab-shadow py-[15px] px-[10px] rounded-[10px] mb-[10px] cursor-pointer group text-left overflow-hidden transition-all duration-300" onclick="openTab(event, 'stream3')">
                <p class="w-[100%] text-left manrope-medium text-[13px] font-medium">Park Towers</p>
                <div class="drop-part max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                    <p class="flex justify-between border-t-[#9696963f] border-t-[1px] border-solid mt-[15px] pt-[5px]">
                        <span class="manrope-medium text-[13px] text-[#444]">Hook Lft 23</span>
                        <span class="manrope-medium text-[11px] text-[#969696]">05-05-2025</span>
                    </p>
                    <p class="flex justify-between mt-[5px] pt-[5px]">
                        <span class="manrope-medium text-[13px] text-[#444]">crane 12</span>
                        <span class="manrope-medium text-[11px] text-[#969696]">05-05-2025</span>
                    </p>
                    <p class="flex justify-between mt-[5px] pt-[5px]">
                        <span class="manrope-medium text-[13px] text-[#444]">Hook Lift</span>
                        <span class="manrope-medium text-[11px] text-[#969696]">06-05-2025</span>
                    </p>
                    <p class="flex justify-between mt-[5px] pt-[5px]">
                        <span class="manrope-medium text-[13px] text-[#444]">Hook Lift</span>
                        <span class="manrope-medium text-[11px] text-[#969696]">06-05-2025</span>
                    </p>
                    <p class="flex justify-between mt-[5px] pt-[5px]">
                        <span class="manrope-medium text-[13px] text-[#444]">Hook Lift</span>
                        <span class="manrope-medium text-[11px] text-[#969696]">06-05-2025</span>
                    </p>
                </div>
            </button>
            <button class="w-full  tab-button tab-shadow py-[15px] px-[10px] rounded-[10px] mb-[10px] cursor-pointer group text-left overflow-hidden transition-all duration-300" onclick="openTab(event, 'stream4')">
                <p class="w-[100%] text-left manrope-medium text-[13px] font-medium">Evergreen Terraces</p>
                <div class="drop-part max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                    <p class="flex justify-between border-t-[#9696963f] border-t-[1px] border-solid mt-[15px] pt-[5px]">
                        <span class="manrope-medium text-[13px] text-[#444]">Hook abcd</span>
                        <span class="manrope-medium text-[11px] text-[#969696]">12-05-2025</span>
                    </p>
                    <p class="flex justify-between mt-[5px] pt-[5px]">
                        <span class="manrope-medium text-[13px] text-[#444]">Hook efgh</span>
                        <span class="manrope-medium text-[11px] text-[#969696]">12-05-2025</span>
                    </p>
                </div>
            </button>
        </div>
    </div>
    <div class="lg:w-5/6 md:w-5/6 mt-[10px] h-full">
        <div class="tab-prop pl-[10px]" id="stream1">
            <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 gap-6">
                <div class="relative"
                    onclick="document.location='live-stream-video1.html'">
                    <div class="crane-file relative group">
                        <img src="assets/images/live-stream.png">
                        <div class="absolute inset-0 border-10 border-[#437651] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="absolute top-[10px] left-[10px]">
                        <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                    </div>
                    <div class="hover-effect"></div>
                </div>
                <div class="relative"
                    onclick="document.location='live-stream-video1.html'">
                    <div class="crane-file relative group">
                        <img src="assets/images/live-stream.png">
                        <div class="absolute inset-0 border-10 border-[#437651] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="absolute top-[10px] left-[10px]">
                        <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                    </div>
                    <div class="hover-effect"></div>
                </div>
                <div class="relative"
                    onclick="document.location='live-stream-video1.html'">
                    <div class="crane-file relative group">
                        <img src="assets/images/live-stream.png">
                        <div class="absolute inset-0 border-10 border-[#437651] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="absolute top-[10px] left-[10px]">
                        <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                    </div>
                    <div class="hover-effect"></div>
                </div>
                <div class="relative"
                    onclick="document.location='live-stream-video1.html'">
                    <div class="crane-file relative group">
                        <img src="assets/images/live-stream.png">
                        <div class="absolute inset-0 border-10 border-[#437651] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="absolute top-[10px] left-[10px]">
                        <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                    </div>
                    <div class="hover-effect"></div>
                </div>
            </div>
        </div>
        <div class="tab-prop pl-[10px]  hidden" id="stream2">
            <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 gap-6">
                <div class="relative"
                    onclick="document.location='live-stream-video1.html'">
                    <div class="crane-file">
                        <img src="assets/images/live-stream.png">
                    </div>
                    <div class="absolute top-[10px] left-[10px]">
                        <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                    </div>
                    <div class="hover-effect"></div>
                </div>
                <div class="relative"
                    onclick="document.location='live-stream-video1.html'">
                    <div class="crane-file">
                        <img src="assets/images/live-stream.png">
                    </div>
                    <div class="absolute top-[10px] left-[10px]">
                        <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                    </div>
                    <div class="hover-effect"></div>
                </div>
                <div class="relative"
                    onclick="document.location='live-stream-video1.html'">
                    <div class="crane-file">
                        <img src="assets/images/live-stream.png">
                    </div>
                    <div class="absolute top-[10px] left-[10px]">
                        <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                    </div>
                    <div class="hover-effect"></div>
                </div>
                <div class="relative"
                    onclick="document.location='live-stream-video1.html'">
                    <div class="crane-file">
                        <img src="assets/images/live-stream.png">
                    </div>
                    <div class="absolute top-[10px] left-[10px]">
                        <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                    </div>
                    <div class="hover-effect"></div>
                </div>
                <div class="relative"
                    onclick="document.location='live-stream-video1.html'">
                    <div class="crane-file">
                        <img src="assets/images/live-stream.png">
                    </div>
                    <div class="absolute top-[10px] left-[10px]">
                        <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                    </div>
                    <div class="hover-effect"></div>
                </div>
            </div>
        </div>
        <div class="tab-prop pl-[10px] hidden" id="stream3">
            <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 gap-6">
                <div class="relative"
                    onclick="document.location='live-stream-video1.html'">
                    <div class="crane-file">
                        <img src="assets/images/live-stream.png">
                    </div>
                    <div class="absolute top-[10px] left-[10px]">
                        <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                    </div>
                    <div class="hover-effect"></div>
                </div>
                <div class="relative"
                    onclick="document.location='live-stream-video1.html'">
                    <div class="crane-file">
                        <img src="assets/images/live-stream.png">
                    </div>
                    <div class="absolute top-[10px] left-[10px]">
                        <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                    </div>
                    <div class="hover-effect"></div>
                </div>
                <div class="relative"
                    onclick="document.location='live-stream-video1.html'">
                    <div class="crane-file">
                        <img src="assets/images/live-stream.png">
                    </div>
                    <div class="absolute top-[10px] left-[10px]">
                        <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                    </div>
                    <div class="hover-effect"></div>
                </div>
                <div class="relative"
                    onclick="document.location='live-stream-video1.html'">
                    <div class="crane-file">
                        <img src="assets/images/live-stream.png">
                    </div>
                    <div class="absolute top-[10px] left-[10px]">
                        <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                    </div>
                    <div class="hover-effect"></div>
                </div>
                <div class="relative"
                    onclick="document.location='live-stream-video1.html'">
                    <div class="crane-file">
                        <img src="assets/images/live-stream.png">
                    </div>
                    <div class="absolute top-[10px] left-[10px]">
                        <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                    </div>
                    <div class="hover-effect"></div>
                </div>
            </div>
        </div>
        <div class="tab-prop pl-[10px] hidden" id="stream4">
            <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 gap-6">
                <div class="relative"
                    onclick="document.location='live-stream-video1.html'">
                    <div class="crane-file">
                        <img src="assets/images/live-stream.png">
                    </div>
                    <div class="absolute top-[10px] left-[10px]">
                        <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                    </div>
                    <div class="hover-effect"></div>
                </div>
                <div class="relative"
                    onclick="document.location='live-stream-video1.html'">
                    <div class="crane-file">
                        <img src="assets/images/live-stream.png">
                    </div>
                    <div class="absolute top-[10px] left-[10px]">
                        <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                    </div>
                    <div class="hover-effect"></div>
                </div>
                <div class="relative"
                    onclick="document.location='live-stream-video1.html'">
                    <div class="crane-file">
                        <img src="assets/images/live-stream.png">
                    </div>
                    <div class="absolute top-[10px] left-[10px]">
                        <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                    </div>
                    <div class="hover-effect"></div>
                </div>
            </div>
        </div>
        <div class="tab-prop pl-[10px] hidden" id="stream5">
            <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 gap-6">
                <div class="relative"
                    onclick="document.location='live-stream-video1.html'">
                    <div class="crane-file">
                        <img src="assets/images/live-stream.png">
                    </div>
                    <div class="absolute top-[10px] left-[10px]">
                        <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                    </div>
                    <div class="hover-effect"></div>
                </div>
                <div class="relative"
                    onclick="document.location='live-stream-video1.html'">
                    <div class="crane-file">
                        <img src="assets/images/live-stream.png">
                    </div>
                    <div class="absolute top-[10px] left-[10px]">
                        <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                    </div>
                    <div class="hover-effect"></div>
                </div>
                <div class="relative"
                    onclick="document.location='live-stream-video1.html'">
                    <div class="crane-file">
                        <img src="assets/images/live-stream.png">
                    </div>
                    <div class="absolute top-[10px] left-[10px]">
                        <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                    </div>
                    <div class="hover-effect"></div>
                </div>
                <div class="relative"
                    onclick="document.location='live-stream-video1.html'">
                    <div class="crane-file">
                        <img src="assets/images/live-stream.png">
                    </div>
                    <div class="absolute top-[10px] left-[10px]">
                        <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                    </div>
                    <div class="hover-effect"></div>
                </div>
                <div class="relative"
                    onclick="document.location='live-stream-video1.html'">
                    <div class="crane-file">
                        <img src="assets/images/live-stream.png">
                    </div>
                    <div class="absolute top-[10px] left-[10px]">
                        <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                    </div>
                    <div class="hover-effect"></div>
                </div>
            </div>
        </div>
        <div class="tab-prop pl-[10px] hidden" id="stream6">
            <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 gap-6">
                <div class="relative"
                    onclick="document.location='live-stream-video1.html'">
                    <div class="crane-file">
                        <img src="assets/images/live-stream.png">
                    </div>
                    <div class="absolute top-[10px] left-[10px]">
                        <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                    </div>
                    <div class="hover-effect"></div>
                </div>
                <div class="relative"
                    onclick="document.location='live-stream-video1.html'">
                    <div class="crane-file">
                        <img src="assets/images/live-stream.png">
                    </div>
                    <div class="absolute top-[10px] left-[10px]">
                        <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                    </div>
                    <div class="hover-effect"></div>
                </div>
                <div class="relative"
                    onclick="document.location='live-stream-video1.html'">
                    <div class="crane-file">
                        <img src="assets/images/live-stream.png">
                    </div>
                    <div class="absolute top-[10px] left-[10px]">
                        <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                    </div>
                    <div class="hover-effect"></div>
                </div>
                <div class="relative"
                    onclick="document.location='live-stream-video1.html'">
                    <div class="crane-file">
                        <img src="assets/images/live-stream.png">
                    </div>
                    <div class="absolute top-[10px] left-[10px]">
                        <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                    </div>
                    <div class="hover-effect"></div>
                </div>
                <div class="relative"
                    onclick="document.location='live-stream-video1.html'">
                    <div class="crane-file">
                        <img src="assets/images/live-stream.png">
                    </div>
                    <div class="absolute top-[10px] left-[10px]">
                        <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                    </div>
                    <div class="hover-effect"></div>
                </div>
                <div class="relative"
                    onclick="document.location='live-stream-video1.html'">
                    <div class="crane-file">
                        <img src="assets/images/live-stream.png">
                    </div>
                    <div class="absolute top-[10px] left-[10px]">
                        <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                    </div>
                    <div class="hover-effect"></div>
                </div>
                <div class="relative"
                    onclick="document.location='live-stream-video1.html'">
                    <div class="crane-file">
                        <img src="assets/images/live-stream.png">
                    </div>
                    <div class="absolute top-[10px] left-[10px]">
                        <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                    </div>
                    <div class="hover-effect"></div>
                </div>
            </div>
        </div>
        <div class="tab-prop pl-[10px] hidden" id="stream7">
            <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 gap-6">
                <div class="relative"
                    onclick="document.location='live-stream-video1.html'">
                    <div class="crane-file">
                        <img src="assets/images/live-stream.png">
                    </div>
                    <div class="absolute top-[10px] left-[10px]">
                        <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                    </div>
                    <div class="hover-effect"></div>
                </div>
                <div class="relative"
                    onclick="document.location='live-stream-video1.html'">
                    <div class="crane-file">
                        <img src="assets/images/live-stream.png">
                    </div>
                    <div class="absolute top-[10px] left-[10px]">
                        <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                    </div>
                    <div class="hover-effect"></div>
                </div>
                <div class="relative"
                    onclick="document.location='live-stream-video1.html'">
                    <div class="crane-file">
                        <img src="assets/images/live-stream.png">
                    </div>
                    <div class="absolute top-[10px] left-[10px]">
                        <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                    </div>
                    <div class="hover-effect"></div>
                </div>
                <div class="relative"
                    onclick="document.location='live-stream-video1.html'">
                    <div class="crane-file">
                        <img src="assets/images/live-stream.png">
                    </div>
                    <div class="absolute top-[10px] left-[10px]">
                        <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                    </div>
                    <div class="hover-effect"></div>
                </div>
                <div class="relative"
                    onclick="document.location='live-stream-video1.html'">
                    <div class="crane-file">
                        <img src="assets/images/live-stream.png">
                    </div>
                    <div class="absolute top-[10px] left-[10px]">
                        <p class="flex  manrope-medium font-semibold text-red-500"><img src="assets/images/live-reco.png" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                    </div>
                    <div class="hover-effect"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
        //---------------------------------tab bg-color ----------------------------------
        let previousTab = null; // Variable to track the previously active tab

function openTab(event, tabId) {
    // Hide all tabs
    document.querySelectorAll('.tab-prop').forEach(tab => tab.classList.add('hidden'));

    // Remove the active background color class from all buttons
    document.querySelectorAll('.tab-button').forEach(tab => tab.classList.remove('bg-[#ededed]'));

    // Show the selected tab
    document.getElementById(tabId).classList.remove('hidden');

    // Add the active background color to the clicked tab
    event.currentTarget.classList.add('bg-[#ededed]');

    // If there was a previously active tab, reset its background color
    if (previousTab && previousTab !== event.currentTarget) {
        previousTab.classList.remove('bg-[#ededed]');
    }

    // Update the previousTab to the newly clicked tab
    previousTab = event.currentTarget;
}

// Function to activate the first tab on page load
window.onload = function () {
    let firstTabButton = document.querySelector('.tab-button'); // Select the first tab button
    let firstTabContent = document.querySelector('.tab-prop'); // Select the first tab content

    if (firstTabButton && firstTabContent) {
        firstTabContent.classList.remove('hidden'); // Show the first tab content
        firstTabButton.classList.add('bg-[#ededed]'); // Set the background color for the first tab
        previousTab = firstTabButton; // Set the first tab as previously active
    }
};
</script>
<script>
     $(document).ready(function() {
        $(".sidebar li").each(function() {
            const img = $(this).find("img");
            const originalSrc = img.attr("src"); 
            const hoverSrc = originalSrc.replace(".png", "-green.png");
    
            $(this).on("mouseenter", function() {
                img.attr("src", hoverSrc);
            });
    
            $(this).on("mouseleave", function() {
                if (!$(this).hasClass("active")) {
    
                    img.attr("src", originalSrc);
                }
            });
        });
    
        // Add active class dynamically
        const currentPage = window.location.pathname.split("/").pop();

        $(".sidebar li a").each(function() {
            if ($(this).attr("href") === currentPage) {
                const parentLi = $(this).parent();
                
                // Add active styles
                parentLi.addClass("bg-[#f1f1f1] border-l-[2px] border-l-solid border-l-[#437651]");
        
                // Change the image source to "-green.png"
                const img = parentLi.find("img");
                let imgSrc = img.attr("src");
        
                if (imgSrc && !imgSrc.includes("-green.png")) {
                    img.attr("src", imgSrc.replace(".png", "-green.png"));
                }
            }
        });
    });
</script>
<script>
document.querySelectorAll('.tab-button').forEach(button => {
    const dropPart = button.querySelector('.drop-part');

    button.addEventListener('mouseenter', () => {
        dropPart.style.maxHeight = dropPart.scrollHeight + 'px';
    });

    button.addEventListener('mouseleave', () => {
        dropPart.style.maxHeight = '0';
    });
});
</script>
@endpush