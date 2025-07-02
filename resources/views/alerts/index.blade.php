@extends('layouts.app')

@section('content')
<div class="w-full flex">
    <p class="inline-block manrope-medium text-[13px]  px-[0px] mt-[15px] mr-[15px] text-[#437651] underline">
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
            <h3 class="font-manrope font-semibold text-[22px] text-black pb-[10px]">Recent Alerts</h3>
            <div id="recent-alerts-container" class="alert-container">
                <!-- Alerts will be loaded here -->
            </div>
            <div id="recent-loading" class="text-center py-4 hidden">Loading...</div>
        </div>
        <div class="tab-prop hidden" id="allalert">
            <h3 class="font-manrope font-semibold text-[22px] text-black pb-[10px]">All Alerts</h3>
            <div id="all-alerts-container" class="alert-container">
                <!-- Alerts will be loaded here -->
            </div>
            <div id="all-loading" class="text-center py-4 hidden">Loading...</div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
let recentPage = 1;
let allPage = 1;
const perPage = 10;
let isRecentLoading = false;
let isAllLoading = false;
let recentHasMore = true;
let allHasMore = true;
let recentLoaded = false; // Track if Recent tab has been initially loaded
let allLoaded = false;    // Track if All Alerts tab has been initially loaded

function openTab(evt, tabName) {
    document.querySelectorAll('.tab-prop').forEach(tab => tab.classList.add('hidden'));
    document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
    document.getElementById(tabName).classList.remove('hidden');
    evt.currentTarget.classList.add('active');

    // Load initial alerts when switching tabs
    if (tabName === 'recentalert' && !recentLoaded) {
        resetTab('recent');
        loadAlerts('recent');
        recentLoaded = true;
    } else if (tabName === 'allalert' && !allLoaded) {
        resetTab('all');
        loadAlerts('all');
        allLoaded = true;
    }
}

async function loadAlerts(type) {
    const container = document.getElementById(`${type}-alerts-container`);
    const loading = document.getElementById(`${type}-loading`);
    const page = type === 'recent' ? recentPage : allPage;
    
    if ((type === 'recent' && isRecentLoading) || (type === 'all' && isAllLoading)) return;
    if ((type === 'recent' && !recentHasMore) || (type === 'all' && !allHasMore)) return;

    if (type === 'recent') isRecentLoading = true;
    else isAllLoading = true;
    loading.classList.remove('hidden');

    try {
        const response = await fetch("{{ route('alerts.load-more') }}?type=" + type + "&page=" + page + "&per_page=" + perPage);
        const data = await response.json();
        
        data.alerts.forEach(alert => {
            const alertHtml = `
                <div class="px-[0px] py-[25px] relative mb-[20px] border-b-solid border-b-[1px] border-b-[#0000001c]">
                    <p class="flex justify-between manrope-semibold text-[13px]">
                        <span class="flex">
                            <img src="{{ asset('admin-theme/assets/images/alert.png') }}" class="w-[35px] mr-[20px] object-contain mt-[-5px]">
                            ${alert.title}
                        </span>
                    </p>
                    <p class="flex justify-between px-[20px] manrope-medium text-[14px] mt-[5px] py-[10px] rounded-full pl-[55px]">
                        ${alert.description}
                        <span class="mr-[30px] text-[#7A86A1] manrope-regular text-[13px]">${alert.created_at}</span>
                    </p>
                    <div class="absolute manrope-medium text-[13px] bottom-[35px] right-[-8px] text-white w-[25px] h-[25px] text-center rounded-[14px] p-[2px] cursor-pointer">
                        <img src="{{ asset('admin-theme/assets/images/delete.png') }}">
                    </div>
                </div>`;
            container.insertAdjacentHTML('beforeend', alertHtml);
        });

        if (type === 'recent') {
            recentPage++;
            recentHasMore = data.alerts.length === perPage;
        } else {
            allPage++;
            allHasMore = data.alerts.length === perPage;
        }
    } catch (error) {
        console.error('Error loading alerts:', error);
    } finally {
        if (type === 'recent') isRecentLoading = false;
        else isAllLoading = false;
        loading.classList.add('hidden');
    }
}

function resetTab(type) {
    const container = document.getElementById(`${type}-alerts-container`);
    container.innerHTML = ''; // Clear existing alerts
    if (type === 'recent') {
        recentPage = 1;
        recentHasMore = true;
    } else {
        allPage = 1;
        allHasMore = true;
    }
}

function handleScroll() {
    const recentTab = document.getElementById('recentalert');
    const allTab = document.getElementById('allalert');
    
    if (!recentTab.classList.contains('hidden')) {
        const container = document.getElementById('recent-alerts-container');
        if (container.getBoundingClientRect().bottom <= window.innerHeight + 100) {
            loadAlerts('recent');
        }
    } else if (!allTab.classList.contains('hidden')) {
        const container = document.getElementById('all-alerts-container');
        if (container.getBoundingClientRect().bottom <= window.innerHeight + 100) {
            loadAlerts('all');
        }
    }
}

// Initial load for Recent tab (since it’s active by default)
resetTab('recent');
loadAlerts('recent');
recentLoaded = true;

window.addEventListener('scroll', handleScroll);
</script>
@endpush