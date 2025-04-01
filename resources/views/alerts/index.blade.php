@extends('layouts.app')

@section('content')
<div class="w-full flex">
    <p class="inline-block manrope-medium text-[15px]  px-[0px] mt-[15px] mr-[15px] text-[#437651] underline">
        < Back</p>
</div>
<div class="w-[85%]  mt-[20px] mx-auto  p-[10px] h-[80%]">
    <ul class="flex mb-[30px]">
        <li class="pr-[20px] py-[5px]" role="presentation">
            <button class="manrope-medium text-[16px]  tab-button px-[15px]" onclick="openTab(event, 'recentalert')">Recent</button>
        </li>
        <li class="py-[5px] tab-button" role="presentation">
            <button class="manrope-medium text-[16px] tab-button px-[15px]" onclick="openTab(event, 'allalert')">All Alerts</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-prop" id="recentalert">
            <div class="">
                <h3 class="font-manrope font-semibold text-[22px] text-black pb-[10px]">Recent Alerts</h3>
                @foreach($recentAlerts as $alert)
                <div class="px-[0px] py-[25px] relative mb-[20px] border-b-solid border-b-[1px] border-b-[#0000001c]">
                    <p class="flex justify-between manrope-semibold text-[15px]">
                        <span class="flex">
                            <img src="{{ asset('admin-theme/assets/images/alert.png') }}" class="w-[35px] mr-[20px] object-contain mt-[-5px]">
                            {{ $alert->title }}
                        </span>
                    </p>
                    <p class="flex justify-between px-[20px] manrope-medium text-[14px] mt-[5px] py-[10px] rounded-full pl-[55px]">
                        {{ $alert->description }}
                        <span class="mr-[30px] text-[#7A86A1] manrope-regular text-[13px]">{{ $alert->created_at->format('h:i A') }}</span>
                    </p>
                    <div class="absolute manrope-medium text-[15px] bottom-[35px] right-[-8px] text-white w-[25px] h-[25px] text-center rounded-[14px] p-[2px] cursor-pointer">
                        <img src="{{ asset('admin-theme/assets/images/delete.png') }}">
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="tab-prop hidden" id="allalert">
            <div class="">
                <h3 class="font-manrope font-semibold text-[22px] text-black pb-[10px]">All Alerts</h3>
                @foreach($allAlerts as $alert)
                <div class="px-[0px] py-[25px] relative mb-[20px] border-b-solid border-b-[1px] border-b-[#0000001c]">
                    <p class="flex justify-between manrope-semibold text-[15px]">
                        <span class="flex">
                            <img src="{{ asset('admin-theme/assets/images/alert.png') }}" class="w-[35px] mr-[20px] object-contain mt-[-5px]">
                            {{ $alert->title }}
                        </span>
                    </p>
                    <p class="flex justify-between px-[20px] manrope-medium text-[14px] mt-[5px] py-[10px] rounded-full pl-[55px]">
                        {{ $alert->description }}
                        <span class="mr-[30px] text-[#7A86A1] manrope-regular text-[13px]">{{ $alert->created_at->format('h:i A') }}</span>
                    </p>
                    <div class="absolute manrope-medium text-[15px] bottom-[35px] right-[-8px] text-white w-[25px] h-[25px] text-center rounded-[14px] p-[2px] cursor-pointer">
                        <img src="{{ asset('admin-theme/assets/images/delete.png') }}">
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection