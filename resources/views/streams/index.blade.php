@extends('layouts.app')
@section('content')
<div class="flex flex-wrap">
    <div class="lg:w-1/6 md:w-1/6 w-full h-full">
        <div class="crane-list py-[10px] pl-[5px] pr-[10px] h-[90%] overflow-y-scroll ">
            @foreach($projects as $project)
            <button class="w-full  tab-button tab-shadow py-[15px] px-[10px] rounded-[10px] mb-[10px] cursor-pointer" onclick="openTab(event, 'stream1')">
                <div class="flex">
                    <p class="w-[100%] text-left manrope-medium text-[13px] font-medium mb-[5px]">{{ $project->name }}</p>
                </div>
            </button>
            @endforeach
        </div>
    </div>
    <div class="lg:w-5/6 md:w-5/6 mt-[10px] h-full">
        <p class="inline-block manrope-medium text-[15px] mt-[0px] mb-[15px] mr-[15px] text-[#437651] underline px-[15px]">
            < Back</p>
                <div class="tab-prop pl-[10px]" id="stream1">
                    <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 gap-6">
                        <div class="relative"
                            onclick="document.location='live-stream-video1.html'">
                            <div class="crane-file relative group">
                                <img src="{{ asset('admin-theme/assets/images/live-stream.png') }}">
                                <div class="absolute inset-0 border-10 border-[#437651] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                            <div class="absolute top-[10px] left-[10px]">
                                <p class="flex  manrope-medium font-semibold text-red-500"><img src="{{ asset('admin-theme/assets/images/live-reco.png') }}" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                            </div>
                            <div class="hover-effect"></div>
                        </div>
                        <div class="relative"
                            onclick="document.location='live-stream-video1.html'">
                            <div class="crane-file relative group">
                                <img src="{{ asset('admin-theme/assets/images/live-stream.png') }}">
                                <div class="absolute inset-0 border-10 border-[#437651] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                            <div class="absolute top-[10px] left-[10px]">
                                <p class="flex  manrope-medium font-semibold text-red-500"><img src="{{ asset('admin-theme/assets/images/live-reco.png') }}" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                            </div>
                            <div class="hover-effect"></div>
                        </div>
                        <div class="relative"
                            onclick="document.location='live-stream-video1.html'">
                            <div class="crane-file relative group">
                                <img src="{{ asset('admin-theme/assets/images/live-stream.png') }}">
                                <div class="absolute inset-0 border-10 border-[#437651] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                            <div class="absolute top-[10px] left-[10px]">
                                <p class="flex  manrope-medium font-semibold text-red-500"><img src="{{ asset('admin-theme/assets/images/live-reco.png') }}" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                            </div>
                            <div class="hover-effect"></div>
                        </div>
                        <div class="relative"
                            onclick="document.location='live-stream-video1.html'">
                            <div class="crane-file relative group">
                                <img src="{{ asset('admin-theme/assets/images/live-stream.png') }}">
                                <div class="absolute inset-0 border-10 border-[#437651] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                            <div class="absolute top-[10px] left-[10px]">
                                <p class="flex  manrope-medium font-semibold text-red-500"><img src="{{ asset('admin-theme/assets/images/live-reco.png') }}" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
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
                                <img src="{{ asset('admin-theme/assets/images/live-stream.png') }}">
                            </div>
                            <div class="absolute top-[10px] left-[10px]">
                                <p class="flex  manrope-medium font-semibold text-red-500"><img src="{{ asset('admin-theme/assets/images/live-reco.png') }}" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                            </div>
                            <div class="hover-effect"></div>
                        </div>
                        <div class="relative"
                            onclick="document.location='live-stream-video1.html'">
                            <div class="crane-file">
                                <img src="{{ asset('admin-theme/assets/images/live-stream.png') }}">
                            </div>
                            <div class="absolute top-[10px] left-[10px]">
                                <p class="flex  manrope-medium font-semibold text-red-500"><img src="{{ asset('admin-theme/assets/images/live-reco.png') }}" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                            </div>
                            <div class="hover-effect"></div>
                        </div>
                        <div class="relative"
                            onclick="document.location='live-stream-video1.html'">
                            <div class="crane-file">
                                <img src="{{ asset('admin-theme/assets/images/live-stream.png') }}">
                            </div>
                            <div class="absolute top-[10px] left-[10px]">
                                <p class="flex  manrope-medium font-semibold text-red-500"><img src="{{ asset('admin-theme/assets/images/live-reco.png') }}" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                            </div>
                            <div class="hover-effect"></div>
                        </div>
                        <div class="relative"
                            onclick "document.location='live-stream-video1.html'">
                            <div class="crane-file">
                                <img src="{{ asset('admin-theme/assets/images/live-stream.png') }}">
                            </div>
                            <div class="absolute top-[10px] left-[10px]">
                                <p class="flex  manrope-medium font-semibold text-red-500"><img src="{{ asset('admin-theme/assets/images/live-reco.png') }}" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                            </div>
                            <div class="hover-effect"></div>
                        </div>
                        <div class="relative"
                            onclick="document.location='live-stream-video1.html'">
                            <div class="crane-file">
                                <img src="{{ asset('admin-theme/assets/images/live-stream.png') }}">
                            </div>
                            <div class="absolute top-[10px] left-[10px]">
                                <p class="flex  manrope-medium font-semibold text-red-500"><img src="{{ asset('admin-theme/assets/images/live-reco.png') }}" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
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
                                <img src="{{ asset('admin-theme/assets/images/live-stream.png') }}">
                            </div>
                            <div class="absolute top-[10px] left-[10px]">
                                <p class="flex  manrope-medium font-semibold text-red-500"><img src="{{ asset('admin-theme/assets/images/live-reco.png') }}" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                            </div>
                            <div class="hover-effect"></div>
                        </div>
                        <div class="relative"
                            onclick="document.location='live-stream-video1.html'">
                            <div class="crane-file">
                                <img src="{{ asset('admin-theme/assets/images/live-stream.png') }}">
                            </div>
                            <div class="absolute top-[10px] left-[10px]">
                                <p class="flex  manrope-medium font-semibold text-red-500"><img src="{{ asset('admin-theme/assets/images/live-reco.png') }}" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                            </div>
                            <div class="hover-effect"></div>
                        </div>
                        <div class="relative"
                            onclick="document.location='live-stream-video1.html'">
                            <div class="crane-file">
                                <img src="{{ asset('admin-theme/assets/images/live-stream.png') }}">
                            </div>
                            <div class="absolute top-[10px] left-[10px]">
                                <p class="flex  manrope-medium font-semibold text-red-500"><img src="{{ asset('admin-theme/assets/images/live-reco.png') }}" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                            </div>
                            <div class="hover-effect"></div>
                        </div>
                        <div class="relative"
                            onclick="document.location='live-stream-video1.html'">
                            <div class="crane-file">
                                <img src="{{ asset('admin-theme/assets/images/live-stream.png') }}">
                            </div>
                            <div class="absolute top-[10px] left-[10px]">
                                <p class="flex  manrope-medium font-semibold text-red-500"><img src="{{ asset('admin-theme/assets/images/live-reco.png') }}" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                            </div>
                            <div class="hover-effect"></div>
                        </div>
                        <div class="relative"
                            onclick="document.location='live-stream-video1.html'">
                            <div class="crane-file">
                                <img src="{{ asset('admin-theme/assets/images/live-stream.png') }}">
                            </div>
                            <div class="absolute top-[10px] left-[10px]">
                                <p class="flex  manrope-medium font-semibold text-red-500"><img src="{{ asset('admin-theme/assets/images/live-reco.png') }}" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
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
                                <img src="{{ asset('admin-theme/assets/images/live-stream.png') }}">
                            </div>
                            <div class="absolute top-[10px] left-[10px]">
                                <p class="flex  manrope-medium font-semibold text-red-500"><img src="{{ asset('admin-theme/assets/images/live-reco.png') }}" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                            </div>
                            <div class="hover-effect"></div>
                        </div>
                        <div class="relative"
                            onclick="document.location='live-stream-video1.html'">
                            <div class="crane-file">
                                <img src="{{ asset('admin-theme/assets/images/live-stream.png') }}">
                            </div>
                            <div class="absolute top-[10px] left-[10px]">
                                <p class="flex  manrope-medium font-semibold text-red-500"><img src="{{ asset('admin-theme/assets/images/live-reco.png') }}" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                            </div>
                            <div class="hover-effect"></div>
                        </div>
                        <div class="relative"
                            onclick="document.location='live-stream-video1.html'">
                            <div class="crane-file">
                                <img src="{{ asset('admin-theme/assets/images/live-stream.png') }}">
                            </div>
                            <div class="absolute top-[10px] left-[10px]">
                                <p class="flex  manrope-medium font-semibold text-red-500"><img src="{{ asset('admin-theme/assets/images/live-reco.png') }}" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
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
                                <img src="{{ asset('admin-theme/assets/images/live-stream.png') }}">
                            </div>
                            <div class="absolute top-[10px] left-[10px]">
                                <p class="flex  manrope-medium font-semibold text-red-500"><img src="{{ asset('admin-theme/assets/images/live-reco.png') }}" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                            </div>
                            <div class="hover-effect"></div>
                        </div>
                        <div class="relative"
                            onclick="document.location='live-stream-video1.html'">
                            <div class="crane-file">
                                <img src="{{ asset('admin-theme/assets/images/live-stream.png') }}">
                            </div>
                            <div class="absolute top-[10px] left-[10px]">
                                <p class="flex  manrope-medium font-semibold text-red-500"><img src="{{ asset('admin-theme/assets/images/live-reco.png') }}" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                            </div>
                            <div class="hover-effect"></div>
                        </div>
                        <div class="relative"
                            onclick="document.location='live-stream-video1.html'">
                            <div class="crane-file">
                                <img src="{{ asset('admin-theme/assets/images/live-stream.png') }}">
                            </div>
                            <div class="absolute top-[10px] left-[10px]">
                                <p class="flex  manrope-medium font-semibold text-red-500"><img src="{{ asset('admin-theme/assets/images/live-reco.png') }}" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                            </div>
                            <div class="hover-effect"></div>
                        </div>
                        <div class="relative"
                            onclick="document.location='live-stream-video1.html'">
                            <div class="crane-file">
                                <img src="{{ asset('admin-theme/assets/images/live-stream.png') }}">
                            </div>
                            <div class="absolute top-[10px] left-[10px]">
                                <p class="flex  manrope-medium font-semibold text-red-500"><img src="{{ asset('admin-theme/assets/images/live-reco.png') }}" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                            </div>
                            <div class="hover-effect"></div>
                        </div>
                        <div class="relative"
                            onclick="document.location='live-stream-video1.html'">
                            <div class="crane-file">
                                <img src="{{ asset('admin-theme/assets/images/live-stream.png') }}">
                            </div>
                            <div class="absolute top-[10px] left-[10px]">
                                <p class="flex  manrope-medium font-semibold text-red-500"><img src="{{ asset('admin-theme/assets/images/live-reco.png') }}" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
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
                                <img src="{{ asset('admin-theme/assets/images/live-stream.png') }}">
                            </div>
                            <div class="absolute top-[10px] left-[10px]">
                                <p class="flex  manrope-medium font-semibold text-red-500"><img src="{{ asset('admin-theme/assets/images/live-reco.png') }}" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                            </div>
                            <div class="hover-effect"></div>
                        </div>
                        <div class="relative"
                            onclick="document.location='live-stream-video1.html'">
                            <div class="crane-file">
                                <img src="{{ asset('admin-theme/assets/images/live-stream.png') }}">
                            </div>
                            <div class="absolute top-[10px] left-[10px]">
                                <p class="flex  manrope-medium font-semibold text-red-500"><img src="{{ asset('admin-theme/assets/images/live-reco.png') }}" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                            </div>
                            <div class="hover-effect"></div>
                        </div>
                        <div class="relative"
                            onclick="document.location='live-stream-video1.html'">
                            <div class="crane-file">
                                <img src="{{ asset('admin-theme/assets/images/live-stream.png') }}">
                            </div>
                            <div class="absolute top-[10px] left-[10px]">
                                <p class="flex  manrope-medium font-semibold text-red-500"><img src="{{ asset('admin-theme/assets/images/live-reco.png') }}" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                            </div>
                            <div class="hover-effect"></div>
                        </div>
                        <div class="relative"
                            onclick="document.location='live-stream-video1.html'">
                            <div class="crane-file">
                                <img src="{{ asset('admin-theme/assets/images/live-stream.png') }}">
                            </div>
                            <div class="absolute top-[10px] left-[10px]">
                                <p class="flex  manrope-medium font-semibold text-red-500"><img src="{{ asset('admin-theme/assets/images/live-reco.png') }}" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                            </div>
                            <div class="hover-effect"></div>
                        </div>
                        <div class="relative"
                            onclick="document.location='live-stream-video1.html'">
                            <div class="crane-file">
                                <img src="{{ asset('admin-theme/assets/images/live-stream.png') }}">
                            </div>
                            <div class="absolute top-[10px] left-[10px]">
                                <p class="flex  manrope-medium font-semibold text-red-500"><img src="{{ asset('admin-theme/assets/images/live-reco.png') }}" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                            </div>
                            <div class="hover-effect"></div>
                        </div>
                        <div class="relative"
                            onclick="document.location='live-stream-video1.html'">
                            <div class="crane-file">
                                <img src="{{ asset('admin-theme/assets/images/live-stream.png') }}">
                            </div>
                            <div class="absolute top-[10px] left-[10px]">
                                <p class="flex  manrope-medium font-semibold text-red-500"><img src="{{ asset('admin-theme/assets/images/live-reco.png') }}" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                            </div>
                            <div class="hover-effect"></div>
                        </div>
                        <div class="relative"
                            onclick="document.location='live-stream-video1.html'">
                            <div class="crane-file">
                                <img src="{{ asset('admin-theme/assets/images/live-stream.png') }}">
                            </div>
                            <div class="absolute top-[10px] left-[10px]">
                                <p class="flex  manrope-medium font-semibold text-red-500"><img src="{{ asset('admin-theme/assets/images/live-reco.png') }}" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
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
                                <img src="{{ asset('admin-theme/assets/images/live-stream.png') }}">
                            </div>
                            <div class="absolute top-[10px] leftmeal-[10px]">
                                <p class="flex  manrope-medium font-semibold text-red-500"><img src="{{ asset('admin-theme/assets/images/live-reco.png') }}" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                            </div>
                            <div class="hover-effect"></div>
                        </div>
                        <div class="relative"
                            onclick="document.location='live-stream-video1.html'">
                            <div class="crane-file">
                                <img src="{{ asset('admin-theme/assets/images/live-stream.png') }}">
                            </div>
                            <div class="absolute top-[10px] left-[10px]">
                                <p class="flex  manrope-medium font-semibold text-red-500"><img src="{{ asset('admin-theme/assets/images/live-reco.png') }}" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                            </div>
                            <div class="hover-effect"></div>
                        </div>
                        <div class="relative"
                            onclick="document.location='live-stream-video1.html'">
                            <div class="crane-file">
                                <img src="{{ asset('admin-theme/assets/images/live-stream.png') }}">
                            </div>
                            <div class="absolute top-[10px] left-[10px]">
                                <p class="flex  manrope-medium font-semibold text-red-500"><img src="{{ asset('admin-theme/assets/images/live-reco.png') }}" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                            </div>
                            <div class="hover-effect"></div>
                        </div>
                        <div class="relative"
                            onclick="document.location='live-stream-video1.html'">
                            <div class="crane-file">
                                <img src="{{ asset('admin-theme/assets/images/live-stream.png') }}">
                            </div>
                            <div class="absolute top-[10px] left-[10px]">
                                <p class="flex  manrope-medium font-semibold text-red-500"><img src="{{ asset('admin-theme/assets/images/live-reco.png') }}" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                            </div>
                            <div class="hover-effect"></div>
                        </div>
                        <div class="relative"
                            onclick="document.location='live-stream-video1.html'">
                            <div class="crane-file">
                                <img src="{{ asset('admin-theme/assets/images/live-stream.png') }}">
                            </div>
                            <div class="absolute top-[10px] left-[10px]">
                                <p class="flex  manrope-medium font-semibold text-red-500"><img src="{{ asset('admin-theme/assets/images/live-reco.png') }}" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live</p>
                            </div>
                            <div class="hover-effect"></div>
                        </div>
                    </div>
                </div>
    </div>
</div>
@endsection