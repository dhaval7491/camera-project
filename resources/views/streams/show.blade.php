@extends('layouts.app')
@section('content')
<style>
    .video-box {
        width: 140px;
        /* Match video width */
        height: 80px;
        /* Match video height */
        max-width: 100%;
        /* Ensure responsiveness */
        position: relative;
        /* For positioning video-info */
        margin: 10px;
        /* Optional: spacing */
        overflow: hidden;
        /* Prevent overflow */
    }

    .video-box video {
        width: 100% !important;
        /* Fill video-box width */
        height: 100% !important;
        /* Fill video-box height */
        display: block;
        /* Remove extra space below video */
        object-fit: cover;
        /* Ensure video fills container without distortion */
    }

    .video-info {
        position: absolute;
        bottom: 5px;
        right: 5px;
        display: flex;
        align-items: center;
    }

    .video-status {
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }

    .status-connecting {
        background-color: orange;
        /* Example styling for connecting status */
    }

    /* Main video container styling */
    .main-video-container {
        width: 100%;
        height: 100%;
        position: relative;
        overflow: hidden;
        background-color: #000;
        border-radius: 8px;
    }

    .main-video-container video {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        display: block !important;
    }
</style>
<div class="flex flex-wrap">
    <div class="lg:w-1/6 md:w-1/6 w-full">
        <div class="crane-list py-[10px] pl-[5px] pr-[10px] h-[90%] overflow-y-scroll">
            @foreach($projects as $project)
            <button class="w-full tab-button tab-shadow py-[15px] px-[10px] rounded-[10px] mb-[10px] cursor-pointer" onclick="openPTab(event, 'stream{{ $project['project_id'] }}')">
                <div class="flex">
                    <p class="w-[100%] text-left manrope-medium text-[13px] font-medium mb-[5px]">{{ $project['project_name'] }}</p>
                </div>
            </button>
            @endforeach
        </div>
    </div>
    <div class="lg:w-5/6 md:w-4/6 mt-[10px]">
        @foreach($projects as $index => $project)
        <div class="video-player px-[10px] relative w-full {{ $index == 0 ? '' : 'hidden' }}" id="stream{{ $project['project_id'] }}" x-data="{ open: false }">
            <div class="video-container relative w-full" style="aspect-ratio: 16/9;">
                <div
                    class="main-video-container w-full h-full"
                    id="mainVideo{{ $project['project_id'] }}"
                    style="background-color: #000;">
                </div>
            </div>
            <p id="statusText{{ $project['project_id'] }}" class="manrope-medium text-[14px] text-[#344563]">Not connected</p>
            <div class="video-controls">
                <nav class="flex justify-between bg-[#00000054] mt-[-53px] z-[9px] relative pt-[18px] pb-[10px] pl-[40px]">
                    <div>
                        <ul class="navbar-nav mr-auto video-volume">
                            <li class="nav-item">
                                <div class="volume-control flex">
                                    <img src="{{ asset('admin-theme/assets/images/max-vol.png') }}" alt="Low Volume" class="volume-icon w-[15px] object-contain mr-[5px]">
                                    <input type="range" id="volume-slider{{ $project['project_id'] }}" min="0" max="1" step="0.1" value="0.5">
                                    <img src="{{ asset('admin-theme/assets/images/min-vol.png') }}" alt="High Volume" class="volume-icon w-[15px] object-contain ml-[5px]">
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <ul class="flex">
                            <li class="nav-item">
                                <button id="play-pause{{ $project['project_id'] }}"><img src="{{ asset('admin-theme/assets/images/play.png') }}" class="w-[20px] object-contain mr-[10px]"></button>
                            </li>
                            <li class="nav-item">
                                <button id="microphone{{ $project['project_id'] }}"><img src="{{ asset('admin-theme/assets/images microphone.png') }}" class="w-[20px] object-contain mr-[10px]"></button>
                            </li>
                            <li class="nav-item">
                                <button id="video-speed{{ $project['project_id'] }}"><img src="{{ asset('admin-theme/assets/images/video-vid.png') }}" class="w-[20px] object-contain mr-[10px]"></button>
                            </li>
                            <li class="nav-item">
                                <button id="video-cut{{ $project['project_id'] }}"><img src="{{ asset('admin-theme/assets/images/video-cut.png') }}" class="w-[20px] object-contain mr-[10px]"></button>
                            </li>
                            <li class="nav-item">
                                <button id="video-record{{ $project['project_id'] }}"><img src="{{ asset('admin-theme/assets/images/video-record.png') }}" class="w-[20px] object-contain mr-[10px]"></button>
                            </li>
                            <li class="nav-item">
                                <button id="video-setting-menu{{ $project['project_id'] }}"><img src="{{ asset('admin-theme/assets/images/video-settings.png') }}" class="w-[20px] object-contain mr-[10px]"></button>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <ul class="navbar-nav ml-auto flex">
                            <li class="nav-item">
                                <div class="size-control flex">
                                    <img src="{{ asset('admin-theme/assets/images/min-size.png') }}" alt="min size" class="size-icon w-[15px] object-contain mr-[5px]">
                                    <input type="range" id="size-slider{{ $project['project_id'] }}" min="0" max="1" step="0.1" value="0.5">
                                    <img src="{{ asset('admin-theme/assets/images/max-size.png') }}" alt="max size" class="size-icon w-[15px] object-contain ml-[5px]">
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><img src="{{ asset('admin-theme/assets/images/max-screen.png') }}" class="w-[15px] object-contain ml-[15px]"></a>
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
                    class="absolute top-0 bg-[#0000007a] mr-[10px] shadow-lg rounded-md p-2 space-y-2 flex justify-center items-center space-x-4 z-[2] w-full">
                    @foreach($project['camera'] as $camera)
                    <li class="flex flex-col items-center">
                        <div class="cursor-pointer" onclick="switchCamera('{{ $camera['id'] }}', '{{ $project['project_id'] }}')">
                            <div class="video-box w-full" id="video-box-{{ $camera['id']}}">
                                <div width="140" height="80" id="video-{{ $camera['id']}}"></div>
                                <div class="video-info">
                                    <div class="video-status status-connecting"></div>
                                </div>
                            </div>
                            <p class="manrope-medium bg-[white] text-[13px] inline-block w-full py-[1px] mb-0 text-center">{{ $camera['camera_name'] }}</p>
                        </div>
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
                    <img src="{{ asset('admin-theme/assets/images/thum-vid.png') }}" class="w-[25px] object-contain mr-[5px]">
                    {{ count($project['camera']) }}
                </p>
            </div>
            <div class="absolute top-[30%] right-[30px] bg-[#00000054] py-[45px] px-[10px] rounded-full">
                <div class="text-white text-[20px] cursor-pointer mb-[30px]" @click="open = !open">
                    <img src="{{ asset('admin-theme/assets/images/weather.png') }}" class="w-[40px] object-contain mx-auto mb-[8px]">
                    <p class="text-white manrope-bold text-[18px] text-center">5'</p>
                </div>
                <div class="text-white text-[20px] cursor-pointer" @click="open = !open">
                    <img src="{{ asset('admin-theme/assets/images/wind.png') }}" class="w-[25px] object-contain mx-auto mb-[8px]">
                    <p class="text-white manrope-bold text-[16px] text-center">15 mph</p>
                </div>
            </div>
            <!-- <div class="absolute top-[73%] right-[30px] w-[210px]">
                <img src="{{ asset('admin-theme/assets/images/compas.png') }}" class="bg-[#00000057] py-[9px] px-[48px] rounded-full">
            </div> -->
            <div x-show="!open" class="online absolute top-[20px] right-[30px] bg-[#00000054] py-[5px] px-[19px] rounded-full">
                <p class="flex text-white">
                    <img src="{{ asset('admin-theme/assets/images/online.png') }}" class="w-[20px] object-contain mr-[5px]">
                    <span id="onlineStatus{{ $project['project_id'] }}">Online</span>
                </p>
            </div>
            <div id="popupvideo-menu{{ $project['project_id'] }}" class="popup-video-speed hidden">
                <h3>Playback</h3>
                <ul class="list-unstyled">
                    <li>
                        <label for="custom-speed{{ $project['project_id'] }}">Custom Speed:</label>
                        <input id="custom-speed{{ $project['project_id'] }}" type="range" min="0.5" max="2" step="0.1" value="1">
                    </li>
                    <li>0.25x</li>
                    <li>0.5x</li>
                    <li>0.75x</li>
                    <li>Normal</li>
                    <li>1.25x</li>
                </ul>
            </div>
            <div id="popupsetting-video{{ $project['project_id'] }}" class="popup-video-setting hidden">
                <ul class="list-unstyled">
                    <li>
                        <h4><img src="{{ asset('admin-theme/assets/images/sleep.png') }}">Sleep Timer</h4>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked{{ $project['project_id'] }}" checked>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Hidden data for JavaScript -->
<script type="application/json" id="projectsData">
    @json($projects)
</script>

@endsection
@push('styles')
<style>
    .tab-prop {
        min-height: 400px;
    }

    .tab-button.bg-[#ededed] {
        background-color: #ededed !important;
    }

    video {
        width: 100%;
        height: auto;
        border-radius: 8px;
        background-color: #000;
    }

    #activeRoomsList li {
        padding: 5px 10px;
        background: #f0f0f0;
        margin-bottom: 5px;
        border-radius: 4px;
    }

    /* Video box styling */
    .video-box {
        position: relative;
        border: 2px solid #ccc;
        border-radius: 8px;
        overflow: hidden;
        margin: 5px 0;
        width: 140px;
        height: 80px;
    }

    .video-box video {
        display: block;
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
    }

    .video-info {
        position: absolute;
        top: 5px;
        right: 5px;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 2px 6px;
        border-radius: 4px;
        font-size: 12px;
    }

    .video-status {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
    }

    .status-connecting {
        background-color: orange;
    }

    .status-connected {
        background-color: green;
    }

    .status-disconnected {
        background-color: red;
    }

    /* Main video container specific styling */
    .main-video-container {
        width: 100%;
        height: 100%;
        position: relative;
        overflow: hidden;
        background-color: #000;
        border-radius: 8px;
    }

    .main-video-container video {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        display: block !important;
        border-radius: 8px;
    }
</style>
@endpush
@push('scripts')
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/livekit-client/dist/livekit-client.umd.min.js"></script>

<script>
    // Set up CSRF token for all jQuery AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Global room instance to manage connections
    let currentRoom = null;

    function getLiveKitToken(roomName, participantName = '{{ auth()->user()->name ?? "viewer" }}') {
        return new Promise((resolve, reject) => {
            console.log('Fetching token from:', '{{ route("livekit.token") }}');
            $.ajax({
                url: '{{ route("livekit.token") }}',
                type: 'POST',
                data: {
                    room_name: roomName,
                    participant_name: participantName,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    if (data.success) {
                        resolve(data.data.token);
                    } else {
                        reject(new Error(data.message || 'Failed to fetch token'));
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Non-JSON response:', xhr.responseText);
                    reject(new Error(`HTTP error! Status: ${xhr.status}, Error: ${error}`));
                }
            });
        });
    }

    async function joinRoom(cameraId, projectId) {
        const wsUrl = "wss://cameraapp-77f2s2l7.livekit.cloud";
        let token;
        try {
            token = await getLiveKitToken(cameraId);
        } catch (err) {
            console.error('Error fetching token:', err);
            document.getElementById(`statusText${projectId}`).textContent = 'Failed to get token';
            return;
        }

        if (!token) {
            document.getElementById(`statusText${projectId}`).textContent = 'Failed to get token';
            return;
        }

        // Disconnect previous room if exists
        if (currentRoom) {
            await currentRoom.disconnect();
        }

        const room = new LivekitClient.Room();
        currentRoom = room;
        currentCameraId = cameraId;

        room.on(LivekitClient.RoomEvent.TrackSubscribed, (track, publication, participant) => {
            console.log('TrackSubscribed:', track, publication, participant);
            if (track.kind === LivekitClient.Track.Kind.Video) {
                const videoElement = track.attach();
                videoElement.autoplay = true;
                videoElement.playsInline = true;

                // Apply styling to ensure video fits container
                videoElement.style.width = '100%';
                videoElement.style.height = '100%';
                videoElement.style.objectFit = 'cover';
                videoElement.style.display = 'block';
                videoElement.style.borderRadius = '8px';

                const mainVideo = document.getElementById(`mainVideo${projectId}`);
                // Clear previous content
                mainVideo.innerHTML = '';
                // Add new video element
                mainVideo.appendChild(videoElement);

                // Create thumbnail video element (clone the video stream)
                const thumbnailVideoElement = track.attach();
                thumbnailVideoElement.autoplay = true;
                thumbnailVideoElement.playsInline = true;

                // Apply styling to thumbnail video
                thumbnailVideoElement.style.width = '100%';
                thumbnailVideoElement.style.height = '100%';
                thumbnailVideoElement.style.objectFit = 'cover';
                thumbnailVideoElement.style.display = 'block';

                // Render thumbnail video for the matching camera
                const thumbnailContainer = document.getElementById(`video-${cameraId}`);
                if (thumbnailContainer) {
                    thumbnailContainer.innerHTML = '';
                    thumbnailContainer.appendChild(thumbnailVideoElement);
                }

                document.getElementById(`statusText${projectId}`).textContent = 'Connected';
                document.getElementById(`onlineStatus${projectId}`).textContent = 'Online';

                const videoBox = document.getElementById(`video-box-${cameraId}`);
                if (videoBox) {
                    const statusElement = videoBox.querySelector('.video-status');
                    if (statusElement) {
                        statusElement.classList.remove('status-connecting');
                        statusElement.classList.add('status-connected');
                    }
                }
            }
        });

        room.on(LivekitClient.RoomEvent.Disconnected, () => {
            document.getElementById(`statusText${projectId}`).textContent = 'Not connected';
            document.getElementById(`onlineStatus${projectId}`).textContent = 'Offline';

            const videoBox = document.getElementById(`video-box-${cameraId}`);
            if (videoBox) {
                const statusElement = videoBox.querySelector('.video-status');
                if (statusElement) {
                    statusElement.classList.remove('status-connected');
                    statusElement.classList.add('status-disconnected');
                }
            }
        });

        try {
            await room.connect(wsUrl, token);
            console.log('Connected to room:', cameraId);
            document.getElementById(`statusText${projectId}`).textContent = 'Connecting...';
        } catch (err) {
            console.error('Failed to connect:', err);
            document.getElementById(`statusText${projectId}`).textContent = 'Connection failed';
            document.getElementById(`onlineStatus${projectId}`).textContent = 'Offline';

            const videoBox = document.getElementById(`video-box-${cameraId}`);
            if (videoBox) {
                const statusElement = videoBox.querySelector('.video-status');
                if (statusElement) {
                    statusElement.classList.remove('status-connecting');
                    statusElement.classList.add('status-disconnected');
                }
            }
        }
    }

    async function switchCamera(cameraId, projectId) {
        await joinRoom(cameraId, projectId);
    }

    function openPTab(event, streamId) 
    {
        // Get all video-player elements
        const videoPlayers = document.querySelectorAll('.video-player');
        
        // Add 'hidden' class to all video-player elements
        videoPlayers.forEach(player => {
            player.classList.add('hidden');
        });
        
        // Remove 'hidden' class from the selected stream
        const selectedStream = document.getElementById(streamId);
        if (selectedStream) {
            selectedStream.classList.remove('hidden');
        }
        
        // Optional: Update active tab styling (e.g., highlight the clicked button)
        const tabButtons = document.querySelectorAll('.tab-button');
        tabButtons.forEach(button => {
            button.classList.remove('bg-[#ededed]');
        });
        event.currentTarget.classList.add('bg-[#ededed]');
    }

    // Initialize with first camera of first project
    document.addEventListener('DOMContentLoaded', async () => {
        const projectsDataElement = document.getElementById('projectsData');
        if (!projectsDataElement) {
            console.error('projectsData element not found');
            return;
        }
        try {
            const projects = JSON.parse(projectsDataElement.textContent);
            if (projects.length > 0 && projects[0].camera.length > 0) {
                const firstCameraId = projects[0].camera[0].id;
                const firstProjectId = projects[0].project_id;
                await joinRoom(firstCameraId, firstProjectId);
            } else {
                console.error('No projects or cameras available');
            }
        } catch (err) {
            console.error('Error parsing projectsData:', err);
        }
    });
</script>
@endpush