@extends('layouts.app')
@section('content')
<div class="flex flex-wrap">
    <div class="lg:w-1/6 md:w-1/6 w-full">
        <div class="crane-list py-[10px] pl-[5px] pr-[10px] h-[90%] overflow-y-scroll">
            @foreach($projects as $project)
            <button class="w-full tab-button tab-shadow py-[15px] px-[10px] rounded-[10px] mb-[10px] cursor-pointer" onclick="openTab(event, 'stream{{ $project['project_id'] }}')">
                <div class="flex">
                    <p class="w-[100%] text-left manrope-medium text-[13px] font-medium mb-[5px]">{{ $project['project_name'] }}</p>
                </div>
            </button>
            @endforeach
        </div>
    </div>
    <div class="lg:w-5/6 md:w-4/6 mt-[10px]">
        <p class="inline-block manrope-medium text-[15px] mt-[0px] mb-[10px] mr-[15px] text-[#437651] underline px-[15px]">
            <a href="{{ route('streams.index') }}">Back</a>
        </p>
        @foreach($projects as $index => $project)
        <div class="video-player px-[10px] relative w-[90%] {{ $index == 0 ? '' : 'hidden' }}" id="stream{{ $project['project_id'] }}" x-data="{ open: false }">
            <video class="w-full mt-[5px]" id="remoteVideo" autoplay playsinline></video>
            <p id="connectionStatus" class="manrope-medium text-[14px] text-[#344563]">Not connected</p>
            <div class="video-controls">
                <nav class="flex justify-between bg-[#00000054] mt-[-53px] z-[9px] relative pt-[18px] pb-[10px] pl-[40px]">
                    <div>
                        <ul class="navbar-nav mr-auto video-volume">
                            <li class="nav-item">
                                <div class="volume-control flex">
                                    <img src="{{ asset('assets/images/max-vol.png') }}" alt="Low Volume" class="volume-icon w-[15px] object-contain mr-[5px]">
                                    <input type="range" id="volume-slider" min="0" max="1" step="0.1" value="0.5">
                                    <img src="{{ asset('assets/images/min-vol.png') }}" alt="High Volume" class="volume-icon w-[15px] object-contain ml-[5px]">
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <ul class="flex">
                            <li class="nav-item">
                                <button id="play-pause"><img src="{{ asset('assets/images/play.png') }}" class="w-[20px] object-contain mr-[10px]"></button>
                            </li>
                            <li class="nav-item">
                                <button id="microphone"><img src="{{ asset('assets/images/microphone.png') }}" class="w-[20px] object-contain mr-[10px]"></button>
                            </li>
                            <li class="nav-item">
                                <button id="video-speed"><img src="{{ asset('assets/images/video-vid.png') }}" class="w-[20px] object-contain mr-[10px]"></button>
                            </li>
                            <li class="nav-item">
                                <button id="video-cut"><img src="{{ asset('assets/images/video-cut.png') }}" class="w-[20px] object-contain mr-[10px]"></button>
                            </li>
                            <li class="nav-item">
                                <button id="video-record"><img src="{{ asset('assets/images/video-record.png') }}" class="w-[20px] object-contain mr-[10px]"></button>
                            </li>
                            <li class="nav-item">
                                <button id="video-setting-menu"><img src="{{ asset('assets/images/video-settings.png') }}" class="w-[20px] object-contain mr-[10px]"></button>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <ul class="navbar-nav ml-auto flex">
                            <li class="nav-item">
                                <div class="size-control flex">
                                    <img src="{{ asset('assets/images/min-size.png') }}" alt="min size" class="size-icon w-[15px] object-contain mr-[5px]">
                                    <input type="range" id="size-slider" min="0" max="1" step="0.1" value="0.5">
                                    <img src="{{ asset('assets/images/max-size.png') }}" alt="max size" class="size-icon w-[15px] object-contain ml-[5px]">
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><img src="{{ asset('assets/images/max-screen.png') }}" class="w-[15px] object-contain ml-[15px]"></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div>
                <ul x-show="open"
                    @click.away="open = false"
                    x-transition:enter="transition transform ease-out duration-300"
                    x-transition:enter-start="-translate-y-10 opacity-0"
                    x-transition:enter-end="translate-y-0 opacity-100"
                    x-transition:leave="transition transform ease-in duration-200"
                    x-transition:leave-start="translate-y-0 opacity-100"
                    x-transition:leave-end="-translate-y-10 opacity-0"
                    class="absolute top-0 bg-[#0000007a] mr-[10px] shadow-lg rounded-md p-2 space-y-2 flex justify-center items-center space-x-4 z-[2]">
                    @foreach($project['camera'] as $camera)
                    <li class="flex flex-col items-center w-[15%]">
                        <a href="{{ route('streams.show', $camera['id']) }}">
                            <img src="{{ asset('assets/images/live-stream.png') }}" class="w-full">
                            <p class="manrope-medium bg-[white] text-[15px] inline-block w-full py-[1px] mb-0 text-center">{{ $camera['camera_name'] }}</p>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div x-show="open" class="absolute top-[20px] right-[30px] cursor-pointer z-[5]" @click="open = false">
                <p class="flex text-white items-center">
                    <span class="w-[20px] object-contain text-white manrope-medium">X</span>
                </p>
            </div>
            <div class="absolute top-[20px] left-[30px] bg-[#00000054] py-[5px] px-[19px] rounded-full">
                <p class="flex text-white text-[20px] cursor-pointer" @click="open = !open">
                    <img src="{{ asset('assets/images/thum-vid.png') }}" class="w-[25px] object-contain mr-[5px]">
                    {{ count($project['camera']) }}
                </p>
            </div>
            <div class="absolute top-[30%] right-[30px] bg-[#00000054] py-[45px] px-[10px] rounded-full">
                <div class="text-white text-[20px] cursor-pointer mb-[30px]" @click="open = !open">
                    <img src="{{ asset('assets/images/weather.png') }}" class="w-[40px] object-contain mx-auto mb-[8px]">
                    <p class="text-white manrope-bold text-[18px] text-center">5'</p>
                </div>
                <div class="text-white text-[20px] cursor-pointer" @click="open = !open">
                    <img src="{{ asset('assets/images/wind.png') }}" class="w-[25px] object-contain mx-auto mb-[8px]">
                    <p class="text-white manrope-bold text-[16px] text-center">15 mph</p>
                </div>
            </div>
            <div class="absolute top-[73%] right-[30px] w-[210px]">
                <img src="{{ asset('assets/images/compas.png') }}" class="bg-[#00000057] py-[9px] px-[48px] rounded-full">
            </div>
            <div x-show="!open" class="online absolute top-[20px] right-[30px] bg-[#00000054] py-[5px] px-[19px] rounded-full">
                <p class="flex text-white">
                    <img src="{{ asset('assets/images/online.png') }}" class="w-[20px] object-contain mr-[5px]">
                    <span id="onlineStatus">Online</span>
                </p>
            </div>
            <div id="popupvideo-menu" class="popup-video-speed hidden">
                <h3>Playback</h3>
                <ul class="list-unstyled">
                    <li>
                        <label for="custom-speed">Custom Speed:</label>
                        <input id="custom-speed" type="range" min="0.5" max="2" step="0.1" value="1">
                    </li>
                    <li>0.25x</li>
                    <li>0.5x</li>
                    <li>0.75x</li>
                    <li>Normal</li>
                    <li>1.25x</li>
                </ul>
            </div>
            <div id="popupsetting-video" class="popup-video-setting hidden">
                <ul class="list-unstyled">
                    <li>
                        <h4><img src="{{ asset('assets/images/sleep.png') }}">Sleep Timer</h4>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
@push('styles')
<style>
.tab-prop {
    min-height: 400px;
}
.tab-button.bg-[#ededed] {
    background-color: #ededed !important;
}
#remoteVideo {
    width: 100%;
    height: auto;
    border-radius: 8px;
    background-color: #000;
}
</style>
@endpush
@push('scripts')
<script src="https://unpkg.com/peerjs@1.5.2/dist/peerjs.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const roomId = $cameraId ; // Use streaming_link or cameraId as roomId
    const remoteVideo = document.getElementById('remoteVideo');
    const connectionStatus = document.getElementById('connectionStatus');
    const onlineStatus = document.getElementById('onlineStatus');

    let peer = null;
    let conn = null;

    function initializePeer() {
        peer = new Peer({
            host: '/', // Adjust to your PeerJS server host
            port: 3001, // Adjust to your PeerJS server port
            path: '/peerjs',
            secure: false, // Set to true if using HTTPS
        });

        peer.on('open', (id) => {
            console.log('PeerJS ID:', id);
            connectionStatus.textContent = 'Connected to PeerJS server';
            joinRoom(roomId);
        });

        peer.on('error', (err) => {
            console.error('PeerJS Error:', err);
            connectionStatus.textContent = 'PeerJS Error: ' + err.type;
            onlineStatus.textContent = 'Offline';
        });

        peer.on('disconnected', () => {
            console.log('PeerJS Disconnected');
            connectionStatus.textContent = 'Disconnected from PeerJS server';
            onlineStatus.textContent = 'Offline';
        });
    }

    function joinRoom(roomId) {
        if (!peer) {
            console.error('Peer not initialized');
            return;
        }

        conn = peer.connect(roomId);
        conn.on('open', () => {
            console.log('Connected to room:', roomId);
            connectionStatus.textContent = 'Connected to room';
            onlineStatus.textContent = 'Online';
        });

        conn.on('error', (err) => {
            console.error('Connection Error:', err);
            connectionStatus.textContent = 'Connection Error';
            onlineStatus.textContent = 'Offline';
        });

        peer.on('call', (call) => {
            call.answer();
            call.on('stream', (remoteStream) => {
                remoteVideo.srcObject = remoteStream;
                remoteVideo.play().catch((err) => {
                    console.error('Video play error:', err);
                });
                connectionStatus.textContent = 'Streaming';
                onlineStatus.textContent = 'Online';
            });

            call.on('close', () => {
                console.log('Call closed');
                remoteVideo.srcObject = null;
                connectionStatus.textContent = 'Call closed';
                onlineStatus.textContent = 'Offline';
            });

            call.on('error', (err) => {
                console.error('Call error:', err);
                connectionStatus.textContent = 'Call error';
                onlineStatus.textContent = 'Offline';
            });
        });
    }

    function hangUp() {
        if (conn) {
            conn.close();
            conn = null;
        }
        if (peer) {
            peer.destroy();
            peer = null;
        }
        remoteVideo.srcObject = null;
        connectionStatus.textContent = 'Not connected';
        onlineStatus.textContent = 'Offline';
    }

    function reconnect() {
        hangUp();
        initializePeer();
    }

    // Initialize PeerJS and join room on page load
    initializePeer();

    // Tab switching logic
    let previousTab = null;

    function openTab(event, tabId) {
        document.querySelectorAll('.tab-prop').forEach(tab => tab.classList.add('hidden'));
        document.querySelectorAll('.tab-button').forEach(tab => tab.classList.remove('bg-[#ededed]'));
        const selectedTab = document.getElementById(tabId);
        if (selectedTab) selectedTab.classList.remove('hidden');
        event.currentTarget.classList.add('bg-[#ededed]');
        previousTab = event.currentTarget;
    }

    // Activate first tab on page load
    const firstTabButton = document.querySelector('.tab-button');
    const firstTabId = firstTabButton?.getAttribute('onclick')?.match(/'([^']+)'/)?.[1];
    const firstTabContent = firstTabId ? document.getElementById(firstTabId) : null;

    if (firstTabButton && firstTabContent) {
        firstTabContent.classList.remove('hidden');
        firstTabButton.classList.add('bg-[#ededed]');
        previousTab = firstTabButton;
    }

    // Video controls (basic implementation)
    const playPauseButton = document.getElementById('play-pause');
    playPauseButton.addEventListener('click', () => {
        if (remoteVideo.paused) {
            remoteVideo.play();
            playPauseButton.innerHTML = `<img src="{{ asset('assets/images/pause.png') }}" class="w-[20px] object-contain mr-[10px]">`;
        } else {
            remoteVideo.pause();
            playPauseButton.innerHTML = `<img src="{{ asset('assets/images/play.png') }}" class="w-[20px] object-contain mr-[10px]">`;
        }
    });

    const volumeSlider = document.getElementById('volume-slider');
    volumeSlider.addEventListener('input', () => {
        remoteVideo.volume = volumeSlider.value;
    });

    // Cleanup on page unload
    window.addEventListener('beforeunload', hangUp);
});
</script>
@endpush