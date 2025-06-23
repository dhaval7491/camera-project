@extends('layouts.app')
@section('content')
<div class="flex flex-wrap">
    <div class="lg:w-1/6 md:w-1/6 w-full h-full">
        <div class="crane-list py-[10px] pl-[5px] pr-[10px] h-[90%] overflow-y-scroll">
            @foreach($projects as $index => $project)
            <button class="w-full tab-button tab-shadow py-[15px] px-[10px] rounded-[10px] mb-[10px] cursor-pointer" onclick="openTab(event, 'stream{{ $project['project_id'] }}')">
                <div class="flex">
                    <p class="w-[100%] text-left manrope-medium text-[13px] font-medium mb-[5px]">{{ $project['project_name'] }}</p>
                </div>
            </button>
            @endforeach
        </div>
    </div>
    <div class="lg:w-5/6 md:w-5/6 mt-[10px] h-full">
        @foreach($projects as $index => $project)
        <div class="tab-prop pl-[10px] {{ $index == 0 ? '' : 'hidden' }}" id="stream{{ $project['project_id'] }}">
            <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 gap-6">
                @foreach($project['camera'] as $camera)
                <div class="relative" onclick="document.location='{{ route('streams.show', $camera['id']) }}'">
                    <div class="crane-file relative group">
                        <img src="{{ asset('admin-theme/assets/images/live-stream.png') }}" alt="{{ $camera['camera_name'] }}">
                        <div class="absolute inset-0 border-10 border-[#437651] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="absolute top-[10px] left-[10px]">
                        <p class="flex manrope-medium font-semibold text-red-500">
                            <img src="{{ asset('admin-theme/assets/images/live-reco.png') }}" class="w-[20px] object-contain mr-[5px] mt-[-2px]"> Live
                        </p>
                    </div>
                    <div class="hover-effect"></div>
                </div>
                @endforeach
                @if(empty($project['camera']))
                <div class="col-span-full text-center">
                    <p class="manrope-medium text-[16px] text-[#344563]">No cameras available for this project.</p>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
@push('styles')
<style>
.tab-prop {
    min-height: 400px; /* Ensure tabs have a minimum height */
}
.tab-button.bg-[#ededed] {
    background-color: #ededed !important; /* Ensure active tab background is applied */
}
.crane-file img {
    width: 100%;
    height: auto;
    object-fit: cover;
    border-radius: 8px;
}
</style>
@endpush
@push('scripts')
<script>
function openTab(event, tabId) {
    // Hide all tabs
    document.querySelectorAll('.tab-prop').forEach(tab => tab.classList.add('hidden'));

    // Remove the active background color class from all buttons
    document.querySelectorAll('.tab-button').forEach(tab => tab.classList.remove('bg-[#ededed]'));

    // Show the selected tab
    const selectedTab = document.getElementById(tabId);
    if (selectedTab) {
        selectedTab.classList.remove('hidden');
    }

    // Add the active background color to the clicked tab
    event.currentTarget.classList.add('bg-[#ededed]');

    // Update the previousTab to the newly clicked tab
    previousTab = event.currentTarget;
}

// Activate the first tab on page load
document.addEventListener('DOMContentLoaded', function() {
    const firstTabButton = document.querySelector('.tab-button');
    const firstTabId = firstTabButton?.getAttribute('onclick')?.match(/'([^']+)'/)?.[1];
    const firstTabContent = firstTabId ? document.getElementById(firstTabId) : null;

    if (firstTabButton && firstTabContent) {
        firstTabContent.classList.remove('hidden');
        firstTabButton.classList.add('bg-[#ededed]');
        previousTab = firstTabButton;
    }
});
</script>
@endpush