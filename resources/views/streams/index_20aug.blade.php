@extends('layouts.app')
@section('content')
<style>
    .video-box {
        height: 60px;
        width: 100%;
        max-width: 100%;
        position: relative;
        margin: 10px;
        overflow: hidden;
    }

    .video-box video {
        width: 100% !important;
        height: 100% !important;
        display: block;
        object-fit: cover;
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
    }

    .status-connected {
        background-color: green;
    }

    .status-disconnected {
        background-color: red;
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

    /* Control buttons styling */
    .control-btn {
        background: none;
        border: none;
        cursor: pointer;
        opacity: 0.8;
        transition: opacity 0.3s;
    }

    .control-btn:hover {
        opacity: 1;
    }

    .control-btn img {
        filter: brightness(0) invert(1);
    }

    /* Volume and size controls */
    .volume-control input[type="range"],
    .size-control input[type="range"] {
        width: 60px;
    }

    /* Active tab styling */
    .tab-button {
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .tab-button.active {
        background-color: #3b82f6 !important;
        border-color: #2563eb !important;
        color: white !important;
        box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3);
    }

    .tab-button.active p {
        color: white !important;
    }

    .tab-button:hover {
        background-color: #e5e7eb;
    }

    .tab-button.active:hover {
        background-color: #2563eb !important;
    }

    /* Loading spinner */
    .loading-spinner {
        border: 4px solid #f3f3f3;
        border-top: 4px solid #3498db;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 2s linear infinite;
        margin: 20px auto;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* All Cam View Grid Styles */
    .all-cam-grid {
        min-height: 400px;
    }

    .camera-grid-item {
        position: relative;
        background-color: #000;
        border-radius: 8px;
        overflow: hidden;
        aspect-ratio: 16/9;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .camera-grid-item:hover {
        transform: scale(1.02);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }

    .camera-grid-item video {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .camera-offline {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        color: #666;
        background-color: #1a1a1a;
    }

    .camera-live-indicator {
        position: absolute;
        top: 10px;
        left: 10px;
        background-color: rgba(0, 0, 0, 0.7);
        padding: 4px 8px;
        border-radius: 4px;
    }

    .camera-name-label {
        position: absolute;
        bottom: 10px;
        left: 10px;
        background-color: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
    }

    .camera-status-indicator {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
    }
</style>

<div class="flex flex-wrap" style="height: calc(100vh - 120px); width:100%;">
    <!-- Sidebar with projects -->
    <div class="lg:w-1/6 md:w-1/6 sm:w-6/6 w-full">
        <div class="crane-list py-[10px] pl-[5px] pr-[10px] overflow-y-scroll w-full">
            <!-- All Cam View Switch -->
            <div class="mb-[15px] px-[10px]">
                <div class="flex items-center justify-between">
                    <span class="manrope-medium text-[13px] font-medium text-black">All Cam View</span>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" id="allCamViewSwitch" onchange="toggleAllCamView()" checked>
                        <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500"></div>
                    </label>
                </div>
            </div>
            @foreach($projects as $index => $project)
            <button class="w-full tab-button tab-shadow py-[10px] px-[10px] rounded-[10px] mb-[10px] cursor-pointer hover:bg-green-500 hover:text-white 
                {{ $index == 0 ? 'bg-green-500 text-white active' : 'bg-white text-black' }}"
                style="height:42px;"
                onclick="selectProject({{ $project->project_id }}, this, '{{ $project->project_name }}')">
                <div class="flex">
                    <p class="w-[100%] text-left manrope-medium text-[13px] font-medium mb-[5px]">
                        {{ $project->project_name }}
                    </p>
                </div>
            </button>
            @endforeach
        </div>
    </div>

    <!-- Main content area -->
    <div class="lg:w-5/6 md:w-5/6 sm:w-6/6 mt-[10px] xs:6/6 w-full">
        <!-- Loading indicator -->
        <div id="loadingIndicator" class="text-center" style="display: none;">
            <div class="loading-spinner"></div>
            <p class="text-gray-600">Loading cameras...</p>
        </div>

        <!-- Error message -->
        <div id="errorMessage" class="text-center text-red-600" style="display: none;">
            <p>Error loading project cameras. Please try again.</p>
        </div>

        <!-- All Cameras Grid View (Shown by default) -->
        <div class="all-cam-grid pl-[10px] pr-[10px]" id="allCamGridContainer" style="display: block;">
            <div class="grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-6" id="allCamGrid">
                <!-- Camera grid items will be populated dynamically -->
            </div>
        </div>

        <!-- Single video player container -->
        <div class="video-player px-[10px] relative w-full" id="videoPlayerContainer" x-data="{ open: false }" style="display: none;">
            <div class="video-container relative w-full h-full" style="aspect-ratio: 16/9;">
                <div class="main-video-container w-full h-full" id="mainVideoContainer" style="background-color: #000;">
                    <!-- Main video stream will be inserted here -->
                    <div class="flex items-center justify-center h-full text-white">
                        <p>Select a camera to start streaming</p>
                    </div>
                </div>
            </div>

            <p id="statusText" class="manrope-medium text-[14px] text-[#344563]">Not connected</p>

            <!-- Video controls -->
            <div class="video-controls">
                <nav class="flex justify-between bg-[#00000054] mt-[-53px] z-[9px] relative pt-[0px] pb-[0px] pl-[20px] pr-[20px]">
                    <div>
                        <ul class="navbar-nav mr-auto video-volume">
                            <li class="nav-item">
                                <div class="volume-control flex">
                                    <img src="{{ asset('admin-theme/assets/images/max-vol.png') }}" alt="Low Volume" class="volume-icon w-[15px] object-contain mr-[5px]">
                                    <input type="range" id="volume-slider" min="0" max="1" step="0.1" value="0.5">
                                    <img src="{{ asset('admin-theme/assets/images/min-vol.png') }}" alt="High Volume" class="volume-icon w-[15px] object-contain ml-[5px]">
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <ul class="flex">
                            <li class="nav-item">
                                <button id="play-pause" class="control-btn" onclick="togglePlayPause()">
                                    <img src="{{ asset('admin-theme/assets/images/play.png') }}" class="w-[20px] object-contain mr-[10px]" id="play-pause-icon">
                                </button>
                            </li>
                            <li class="nav-item">
                                <button id="microphone" class="control-btn" onclick="toggleMute()">
                                    <img src="{{ asset('admin-theme/assets/images/speaker.png') }}" class="w-[20px] object-contain mr-[10px]" id="mute-icon">
                                </button>
                            </li>
                            <li class="nav-item">
                                <button id="video-speed" class="control-btn">
                                    <img src="{{ asset('admin-theme/assets/images/video-vid.png') }}" class="w-[20px] object-contain mr-[10px]">
                                </button>
                            </li>
                            <li class="nav-item">
                                <button id="video-cut" class="control-btn">
                                    <img src="{{ asset('admin-theme/assets/images/video-cut.png') }}" class="w-[20px] object-contain mr-[10px]">
                                </button>
                            </li>
                            <li class="nav-item">
                                <button id="video-record" class="control-btn">
                                    <img src="{{ asset('admin-theme/assets/images/video-record.png') }}" class="w-[20px] object-contain mr-[10px]">
                                </button>
                            </li>
                            <li class="nav-item">
                                <button id="video-setting-menu" class="control-btn">
                                    <img src="{{ asset('admin-theme/assets/images/video-settings.png') }}" class="w-[20px] object-contain mr-[10px]">
                                </button>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <ul class="navbar-nav ml-auto flex">
                            <li class="nav-item">
                                <div class="size-control flex">
                                    <img src="{{ asset('admin-theme/assets/images/min-size.png') }}" alt="min size" class="size-icon w-[15px] object-contain mr-[5px]">
                                    <input type="range" id="size-slider" min="0" max="1" step="0.1" value="0.5">
                                    <img src="{{ asset('admin-theme/assets/images/max-size.png') }}" alt="max size" class="size-icon w-[15px] object-contain ml-[5px]">
                                </div>
                            </li>
                            <li class="nav-item">
                                <button class="control-btn" onclick="toggleFullscreen()">
                                    <img src="{{ asset('admin-theme/assets/images/max-screen.png') }}" class="w-[15px] object-contain ml-[15px]">
                                </button>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

            <!-- Camera thumbnails overlay -->
            <div>
                <ul x-show="open"
                    @click.away="open = false"
                    x-transition:enter="transition transform ease-out duration-300"
                    x-transition:enter-start="-translate-y-10 opacity-0"
                    x-transition:enter-end="translate-y-0 opacity-100"
                    x-transition:leave="transition transform ease-in duration-200"
                    x-transition:leave-start="translate-y-0 opacity-100"
                    x-transition:leave-end="-translate-y-10 opacity-0"
                    class="absolute top-0 bg-[#0000007a] shadow-lg rounded-md p-2 space-y-2 flex justify-center items-center space-x-4 z-[2]"
                    style="width:96.6%;"
                    id="cameraThumbnailsList">
                    <!-- Camera thumbnails will be populated dynamically -->
                </ul>
            </div>

            <!-- Close button for thumbnails -->
            <div x-show="open" class="absolute top-[20px] right-[30px] cursor-pointer z-[5]" @click="open = false">
                <p class="flex text-white items-center">
                    <span class="w-[20px] object-contain text-white manrope-medium">X</span>
                </p>
            </div>

            <!-- Camera count button -->
            <div class="absolute top-[20px] left-[30px] bg-[#00000054] py-[5px] px-[19px] rounded-full">
                <p class="flex text-white text-[20px] cursor-pointer" @click="open = !open">
                    <img src="{{ asset('admin-theme/assets/images/thum-vid.png') }}" class="w-[25px] object-contain mr-[5px]">
                    <span id="cameraCount">0</span>
                </p>
            </div>

            <!-- Weather info -->
            <div class="absolute top-[30%] right-[30px] bg-[#00000054] lg:py-[45px] md:py-[45px] px-[10px] rounded-full sm:py-[25px]">
                <div class="text-white text-[20px] cursor-pointer mb-[30px]">
                    <img src="{{ asset('admin-theme/assets/images/weather.png') }}" class="w-[30px] w-[30px] object-contain mx-auto mb-[8px]">
                    <p class="text-white manrope-bold text-[15px] text-center">5'</p>
                </div>
                <div class="text-white text-[20px] cursor-pointer">
                    <img src="{{ asset('admin-theme/assets/images/wind.png') }}" class="w-[20px] object-contain mx-auto mb-[8px]">
                    <p class="text-white manrope-bold text-[12px] text-center">15 mph</p>
                </div>
            </div>

            <!-- Online status -->
            <div x-show="!open" class="online absolute top-[20px] right-[30px] bg-[#00000054] py-[5px] px-[19px] rounded-full">
                <p class="flex text-white">
                    <img id="camStatImg" src="{{ asset('admin-theme/assets/images/offline.png') }}" class="w-[20px] object-contain mr-[5px]">
                    <span id="onlineStatus">Offline</span>
                </p>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .tab-prop {
        min-height: 400px;
    }

    video {
        width: 100%;
        height: auto;
        border-radius: 8px;
        background-color: #000;
    }
</style>
@endpush

@push('scripts')
<script>
    // Janus Gateway REST API integration
    const JANUS_URL = "https://unnifyy.com:8089/janus";

    // Global state management
    let currentProject = null;
    let projectConnection = null;
    let currentCameras = [];
    let activeTab = null;
    let isAllCamViewEnabled = true; // Changed to true to enable by default
    let gridConnections = {};

    // Utility functions
    function randStr() {
        return Math.random().toString(36).substring(2, 12);
    }

    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    async function janusPost(endpoint, body) {
        try {
            const res = await fetch(`${JANUS_URL}${endpoint}`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(body),
            });
            return await res.json();
        } catch (error) {
            console.error("Janus POST error:", error);
            throw error;
        }
    }

    // Toggle All Cam View
    function toggleAllCamView() {
        const allCamSwitch = document.getElementById('allCamViewSwitch');
        const allCamGridContainer = document.getElementById('allCamGridContainer');
        const videoPlayerContainer = document.getElementById('videoPlayerContainer');

        isAllCamViewEnabled = allCamSwitch.checked;

        if (isAllCamViewEnabled) {
            // Show all cam grid, hide single player
            allCamGridContainer.style.display = 'block';
            videoPlayerContainer.style.display = 'none';
            
            // If we have current cameras, populate the grid
            if (currentCameras && currentCameras.length > 0) {
                populateAllCamGrid(currentCameras);
            }
        } else {
            // Show single player, hide all cam grid
            allCamGridContainer.style.display = 'none';
            videoPlayerContainer.style.display = 'block';
            
            // Disconnect all grid connections
            disconnectAllGridCameras();
        }
    }

    // Populate All Cam Grid
    function populateAllCamGrid(cameras) {
        const allCamGrid = document.getElementById('allCamGrid');
        if (!allCamGrid) return;

        allCamGrid.innerHTML = '';

        if (!cameras || cameras.length === 0) {
            allCamGrid.innerHTML = `
                <div class="col-span-full text-center">
                    <p class="manrope-medium text-[16px] text-[#344563]">No cameras available for this project.</p>
                </div>
            `;
            return;
        }

        cameras.forEach((camera, index) => {
            const gridItem = document.createElement('div');
            gridItem.className = 'camera-grid-item';
            gridItem.id = `grid-camera-${camera.id}`;
            
            gridItem.innerHTML = `
                <div class="camera-offline" id="offline-${camera.id}">
                    <p class="text-white">No stream available</p>
                </div>
                <div class="camera-live-indicator" style="display: none;" id="live-indicator-${camera.id}">
                    <p class="flex manrope-medium font-semibold text-red-500">
                        <img src="{{ asset('admin-theme/assets/images/live-reco.png') }}" class="w-[15px] object-contain mr-[3px] mt-[-1px]"> Live
                    </p>
                </div>
                <div class="camera-name-label">
                    <span class="manrope-medium text-white">${camera.camera_name}</span>
                </div>
                <div class="camera-status-indicator status-disconnected" id="grid-status-${camera.id}"></div>
            `;

            // Add click handler to switch to single view
            gridItem.addEventListener('click', () => {
                switchToSingleView(camera.id);
            });

            allCamGrid.appendChild(gridItem);

            // Connect camera with delay to avoid overload
            setTimeout(() => {
                connectGridCamera(camera, index * 2000); // Stagger connections by 2 seconds
            }, 100);
        });
    }

    // Connect individual grid camera
    async function connectGridCamera(camera, delay = 0) {
        await sleep(delay);
        
        console.log(`[GRID] Connecting camera ${camera.id}...`);
        
        try {
            const gridCamera = new CameraConnection(camera.id, camera.camera_name, false);
            gridCamera.isGridMode = true;
            gridConnections[camera.id] = gridCamera;

            const sessionCreated = await gridCamera.createSession();
            if (sessionCreated) {
                const pluginAttached = await gridCamera.attachPlugin();
                if (pluginAttached) {
                    await gridCamera.listParticipants();
                }
            }
        } catch (error) {
            console.error(`[GRID] Failed to connect camera ${camera.id}:`, error);
        }
    }

    // Disconnect all grid cameras
    async function disconnectAllGridCameras() {
        console.log('[GRID] Disconnecting all grid cameras...');
        
        const disconnectPromises = Object.values(gridConnections).map(camera => camera.disconnect());
        await Promise.all(disconnectPromises);
        
        gridConnections = {};
    }

    // Switch from all cam view to single view
    function switchToSingleView(cameraId) {
        const allCamSwitch = document.getElementById('allCamViewSwitch');
        allCamSwitch.checked = false;
        isAllCamViewEnabled = false;
        
        // Hide grid, show single player
        document.getElementById('allCamGridContainer').style.display = 'none';
        document.getElementById('videoPlayerContainer').style.display = 'block';
        
        // Switch to the selected camera
        if (projectConnection) {
            projectConnection.switchMainCamera(cameraId);
        }
        
        // Disconnect grid cameras
        disconnectAllGridCameras();
    }

    // Camera connection class (modified for grid support)
    class CameraConnection {
        constructor(cameraId, cameraName, isMainCamera = false) {
            this.cameraId = cameraId;
            this.cameraName = cameraName;
            this.roomId = cameraId;
            this.isMainCamera = isMainCamera;
            this.isGridMode = false;
            this.sessionId = null;
            this.handleId = null;
            this.feedId = null;
            this.pc = null;
            this.videoElement = null;
            this.isPolling = false;
            this.isConnected = false;
        }

        async createSession() {
            try {
                const res = await janusPost("", {
                    janus: "create",
                    transaction: randStr()
                });
                this.sessionId = res.data.id;
                console.log(`[CAMERA ${this.cameraId}] Created session:`, this.sessionId);
                this.pollEvents();
                return true;
            } catch (error) {
                console.error(`[CAMERA ${this.cameraId}] Session creation failed:`, error);
                return false;
            }
        }

        async attachPlugin() {
            try {
                const res = await janusPost(`/${this.sessionId}`, {
                    janus: "attach",
                    plugin: "janus.plugin.videoroom",
                    transaction: randStr()
                });
                this.handleId = res.data.id;
                console.log(`[CAMERA ${this.cameraId}] Attached to plugin:`, this.handleId);
                return true;
            } catch (error) {
                console.error(`[CAMERA ${this.cameraId}] Plugin attachment failed:`, error);
                return false;
            }
        }

        async joinAsSubscriber(feedId) {
            this.feedId = feedId;
            console.log(`[CAMERA ${this.cameraId}] Joining as subscriber to feed:`, feedId, 'in room:', this.roomId);

            try {
                await janusPost(`/${this.sessionId}/${this.handleId}`, {
                    janus: "message",
                    body: {
                        request: "join",
                        ptype: "subscriber",
                        room: this.roomId,
                        feed: feedId
                    },
                    transaction: randStr()
                });

                this.updateStatus("Connecting...");
                return true;
            } catch (error) {
                console.error(`[CAMERA ${this.cameraId}] Join failed:`, error);
                this.updateStatus("Connection failed");
                return false;
            }
        }

        async startSubscriber(jsep) {
            try {
                this.pc = new RTCPeerConnection({
                    iceServers: [{
                        urls: "stun:stun.l.google.com:19302"
                    }]
                });

                this.pc.ontrack = (e) => {
                    console.log(`[CAMERA ${this.cameraId}] Received remote track`);
                    this.handleRemoteStream(e.streams[0]);
                };

                this.pc.onicecandidate = async (event) => {
                    if (event.candidate) {
                        await janusPost(`/${this.sessionId}/${this.handleId}`, {
                            janus: "trickle",
                            candidate: event.candidate,
                            transaction: randStr()
                        });
                    } else {
                        await janusPost(`/${this.sessionId}/${this.handleId}`, {
                            janus: "trickle",
                            candidate: {
                                completed: true
                            },
                            transaction: randStr()
                        });
                    }
                };

                await this.pc.setRemoteDescription(jsep);
                const answer = await this.pc.createAnswer();
                await this.pc.setLocalDescription(answer);

                await janusPost(`/${this.sessionId}/${this.handleId}`, {
                    janus: "message",
                    body: {
                        request: "start",
                        room: this.roomId
                    },
                    jsep: answer,
                    transaction: randStr()
                });

                console.log(`[CAMERA ${this.cameraId}] Sent SDP answer for room:`, this.roomId);
            } catch (error) {
                console.error(`[CAMERA ${this.cameraId}] StartSubscriber error:`, error);
                this.updateStatus("Connection failed");
            }
        }

        handleRemoteStream(stream) {
            // Create video element
            const videoElement = document.createElement("video");
            videoElement.autoplay = true;
            videoElement.playsInline = true;
            videoElement.controls = false;
            videoElement.muted = true;
            videoElement.style.width = '100%';
            videoElement.style.height = '100%';
            videoElement.style.objectFit = 'cover';
            videoElement.style.display = 'block';
            videoElement.style.borderRadius = '8px';
            videoElement.id = `video-${this.cameraId}-element`;

            // Attach stream to video element
            videoElement.srcObject = stream;
            this.videoElement = videoElement;

            if (this.isGridMode) {
                this.placeInGridContainer();
            } else {
                // Always place in thumbnail container first
                this.placeInThumbnailContainer();

                // If this is the main camera, also place in main container
                if (this.isMainCamera) {
                    this.placeInMainContainer();
                }
            }

            this.isConnected = true;
            this.updateStatus("Connected");
        }

        placeInGridContainer() {
            const gridContainer = document.getElementById(`grid-camera-${this.cameraId}`);
            const offlineDiv = document.getElementById(`offline-${this.cameraId}`);
            const liveIndicator = document.getElementById(`live-indicator-${this.cameraId}`);

            if (gridContainer && this.videoElement) {
                // Hide offline message
                if (offlineDiv) {
                    offlineDiv.style.display = 'none';
                }

                // Show live indicator
                if (liveIndicator) {
                    liveIndicator.style.display = 'block';
                }

                // Add video element
                const gridVideo = this.videoElement.cloneNode();
                gridVideo.srcObject = this.videoElement.srcObject;
                gridVideo.muted = true;
                gridContainer.insertBefore(gridVideo, gridContainer.firstChild);
            }
        }

        placeInMainContainer() {
            const mainVideo = document.getElementById('mainVideoContainer');
            if (mainVideo && this.videoElement) {
                mainVideo.innerHTML = '';
                const mainVideoElement = this.videoElement.cloneNode();
                mainVideoElement.srcObject = this.videoElement.srcObject;
                mainVideoElement.muted = false;
                mainVideo.appendChild(mainVideoElement);
                this.setupVolumeControl();
                this.updateOnlineStatus("Online");
            }
        }

        placeInThumbnailContainer() {
            const thumbnailContainer = document.getElementById(`video-${this.cameraId}`);
            if (thumbnailContainer && this.videoElement) {
                thumbnailContainer.innerHTML = '';
                const thumbnailVideo = this.videoElement.cloneNode();
                thumbnailVideo.muted = true;
                thumbnailVideo.srcObject = this.videoElement.srcObject;
                thumbnailContainer.appendChild(thumbnailVideo);
            }
        }

        moveToMainContainer() {
            if (this.videoElement && this.isConnected) {
                this.isMainCamera = true;
                this.placeInMainContainer();

                // Update other cameras to not be main
                if (projectConnection) {
                    Object.values(projectConnection.cameras).forEach(camera => {
                        if (camera.cameraId !== this.cameraId) {
                            camera.isMainCamera = false;
                        }
                    });
                }
            }
        }

        setupVolumeControl() {
            const mainVideo = document.querySelector('#mainVideoContainer video');
            if (mainVideo) {
                const volumeSlider = document.getElementById('volume-slider');
                if (volumeSlider) {
                    mainVideo.volume = volumeSlider.value;
                    volumeSlider.addEventListener('input', () => {
                        mainVideo.volume = volumeSlider.value;
                    });
                }
            }
        }

        async pollEvents() {
            if (this.isPolling) return;
            this.isPolling = true;

            while (this.sessionId && this.isPolling) {
                try {
                    const res = await fetch(`${JANUS_URL}/${this.sessionId}?rid=${Date.now()}&maxev=1`);
                    const data = await res.json();

                    if (data.janus === "event") {
                        const pluginData = data.plugindata?.data;

                        if (pluginData?.videoroom === "event" && pluginData.publishers?.length > 0) {
                            const feedId = pluginData.publishers[0].id;
                            console.log(`[CAMERA ${this.cameraId}] Found publisher feed ID:`, feedId);
                            await this.joinAsSubscriber(feedId);
                        }

                        if (data.jsep) {
                            console.log(`[CAMERA ${this.cameraId}] Got JSEP offer`);
                            await this.startSubscriber(data.jsep);
                        }
                    }
                } catch (err) {
                    console.error(`[CAMERA ${this.cameraId}] Polling error:`, err);
                }

                await sleep(500);
            }
        }

        async listParticipants() {
            try {
                const res = await janusPost(`/${this.sessionId}/${this.handleId}`, {
                    janus: "message",
                    body: {
                        request: "listparticipants",
                        room: this.roomId
                    },
                    transaction: randStr()
                });

                const data = res.plugindata?.data;
                if (data?.videoroom === "participants") {
                    const publishers = data.participants.filter(p => p.publisher);
                    if (publishers.length > 0) {
                        const feedId = publishers[0].id;
                        console.log(`[CAMERA ${this.cameraId}] Found publisher via list:`, feedId, 'in room:', this.roomId);
                        await this.joinAsSubscriber(feedId);
                    }
                }
            } catch (error) {
                console.error(`[CAMERA ${this.cameraId}] List participants error:`, error);
            }
        }

        updateStatus(status) {
            const statusElement = document.getElementById(`status-${this.cameraId}`);
            if (statusElement) {
                statusElement.className = `video-status ${
                    status === 'Connected' ? 'status-connected' :
                    status === 'Connecting...' ? 'status-connecting' :
                    'status-disconnected'
                }`;
            }

            // Update grid status if in grid mode
            if (this.isGridMode) {
                const gridStatusElement = document.getElementById(`grid-status-${this.cameraId}`);
                if (gridStatusElement) {
                    gridStatusElement.className = `camera-status-indicator ${
                        status === 'Connected' ? 'status-connected' :
                        status === 'Connecting...' ? 'status-connecting' :
                        'status-disconnected'
                    }`;
                }
            }

            // Update main status if this is main camera
            if (this.isMainCamera) {
                const mainStatusElement = document.getElementById('statusText');
                if (mainStatusElement) {
                    mainStatusElement.textContent = status;
                }
            }
        }

        updateOnlineStatus(status) {
            if (this.isMainCamera) {
                const onlineElement = document.getElementById('onlineStatus');
                if (onlineElement) {
                    onlineElement.textContent = status;
                }
                if(status == "Online")
                {
                    camStatImg.src = "{{ asset('admin-theme/assets/images/online.png') }}";
                }
                else{
                    camStatImg.src = "{{ asset('admin-theme/assets/images/offline.png') }}";
                }
            }
        }

        async disconnect() {
            this.isPolling = false;
            this.isConnected = false;

            if (this.pc) {
                this.pc.close();
                this.pc = null;
            }

            if (this.videoElement) {
                this.videoElement.srcObject = null;
                this.videoElement = null;
            }

            if (this.sessionId) {
                try {
                    await janusPost(`/${this.sessionId}`, {
                        janus: "destroy",
                        transaction: randStr()
                    });
                } catch (error) {
                    console.error(`[CAMERA ${this.cameraId}] Session destroy error:`, error);
                }
                this.sessionId = null;
            }

            this.updateStatus("Disconnected");
            if (this.isMainCamera) {
                this.updateOnlineStatus("Offline");
            }

            // Clean up grid view if needed
            if (this.isGridMode) {
                const gridContainer = document.getElementById(`grid-camera-${this.cameraId}`);
                const offlineDiv = document.getElementById(`offline-${this.cameraId}`);
                const liveIndicator = document.getElementById(`live-indicator-${this.cameraId}`);
                
                if (gridContainer) {
                    // Remove video element
                    const video = gridContainer.querySelector('video');
                    if (video) {
                        video.remove();
                    }
                    
                    // Show offline message
                    if (offlineDiv) {
                        offlineDiv.style.display = 'flex';
                    }
                    
                    // Hide live indicator
                    if (liveIndicator) {
                        liveIndicator.style.display = 'none';
                    }
                }
            }
        }
    }

    // Project connection manager
    class ProjectConnection {
        constructor(projectData) {
            this.projectId = projectData.project_id;
            this.projectName = projectData.project_name;
            this.cameras = {};
            this.isInitialized = false;

            // Initialize camera connections
            projectData.cameras.forEach((camera, index) => {
                const isMainCamera = index === 0; // First camera is main by default
                this.cameras[camera.id] = new CameraConnection(camera.id, camera.camera_name, isMainCamera);
            });
        }

        async initializeAllCameras() {
            if (this.isInitialized) return;

            console.log(`[PROJECT ${this.projectId}] Initializing all cameras...`);

            // Initialize all cameras
            const initPromises = Object.values(this.cameras).map(async (camera) => {
                const sessionCreated = await camera.createSession();
                if (sessionCreated) {
                    const pluginAttached = await camera.attachPlugin();
                    if (pluginAttached) {
                        await camera.listParticipants();
                    }
                }
            });

            await Promise.all(initPromises);
            this.isInitialized = true;

            console.log(`[PROJECT ${this.projectId}] All cameras initialized`);
        }

        switchMainCamera(cameraId) {
            const targetCamera = this.cameras[cameraId];
            if (targetCamera && targetCamera.isConnected) {
                // Set all cameras to not main
                Object.values(this.cameras).forEach(camera => {
                    camera.isMainCamera = false;
                });

                // Move target camera to main container
                targetCamera.moveToMainContainer();

                console.log(`[PROJECT ${this.projectId}] Switched main camera to:`, cameraId);
            }
        }

        async disconnect() {
            console.log(`[PROJECT ${this.projectId}] Disconnecting all cameras...`);

            const disconnectPromises = Object.values(this.cameras).map(camera => camera.disconnect());
            await Promise.all(disconnectPromises);

            this.isInitialized = false;
        }

        getMainCameraVideoElement() {
            const mainCamera = Object.values(this.cameras).find(camera => camera.isMainCamera);
            return mainCamera ? mainCamera.videoElement : null;
        }
    }

    // AJAX function to get project cameras
    function fetchProjectCameras(projectId) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: "{{ route('streams.project.cameras', ':projectId') }}".replace(':projectId', projectId),
                method: 'GET',
                dataType: 'json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (data.success) {
                        resolve(data.project);
                    } else {
                        reject(new Error(data.message || 'Failed to fetch cameras'));
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                    reject(new Error('Error fetching project cameras: ' + error));
                }
            });
        });
    }

    // Function to create camera thumbnails
    function createCameraThumbnails(cameras) {
        const thumbnailsList = document.getElementById('cameraThumbnailsList');
        if (!thumbnailsList) return;

        thumbnailsList.innerHTML = '';

        cameras.forEach(camera => {
            const listItem = document.createElement('li');
            listItem.className = 'mb-[2px] w-[10%]';

            listItem.innerHTML = `
                <div class="cursor-pointer" onclick="switchCamera('${camera.id}')">
                    <div class="video-box w-full" id="video-box-${camera.id}">
                        <div id="video-${camera.id}"></div>
                        <div class="video-info">
                            <div class="video-status status-connecting" id="status-${camera.id}"></div>
                        </div>
                    </div>
                    <p class="manrope-medium bg-[white] text-[13px] inline-block w-full py-[1px] mb-0 text-center pl-[5px] pr-[5px]">
                        ${camera.camera_name}
                    </p>
                </div>
            `;

            thumbnailsList.appendChild(listItem);
        });

        // Update camera count
        const cameraCountElement = document.getElementById('cameraCount');
        if (cameraCountElement) {
            cameraCountElement.textContent = cameras.length;
        }
    }

    // Main function to select and load a project
    async function selectProject(projectId, buttonElement, projectName) {
        try {
            // Update active tab
            if (activeTab) {
                activeTab.classList.remove('active', 'bg-green-500', 'text-white');
                activeTab.classList.add('bg-white', 'text-black');
            }

            buttonElement.classList.add('active', 'bg-green-500', 'text-white');
            buttonElement.classList.remove('bg-white', 'text-black');
            activeTab = buttonElement;

            // Show loading
            document.getElementById('loadingIndicator').style.display = 'block';
            document.getElementById('errorMessage').style.display = 'none';
            document.getElementById('videoPlayerContainer').style.display = 'none';
            document.getElementById('allCamGridContainer').style.display = 'none';

            // Disconnect previous project if exists
            if (projectConnection) {
                await projectConnection.disconnect();
                projectConnection = null;
            }

            // Disconnect grid cameras if any
            await disconnectAllGridCameras();

            // Fetch project cameras via AJAX
            const projectData = await fetchProjectCameras(projectId);

            if (!projectData.cameras || projectData.cameras.length === 0) {
                throw new Error('No cameras found for this project');
            }

            // Store current project data
            currentProject = projectData;
            currentCameras = projectData.cameras;

            // Show appropriate view based on switch state
            document.getElementById('loadingIndicator').style.display = 'none';
            
            if (isAllCamViewEnabled) {
                // Show all cam grid
                document.getElementById('allCamGridContainer').style.display = 'block';
                populateAllCamGrid(projectData.cameras);
            } else {
                // Show single player view
                document.getElementById('videoPlayerContainer').style.display = 'block';
                createCameraThumbnails(projectData.cameras);
                
                // Initialize project connection
                projectConnection = new ProjectConnection(projectData);
                await projectConnection.initializeAllCameras();
            }

            console.log(`Project ${projectName} loaded with ${projectData.cameras.length} cameras`);

        } catch (error) {
            console.error('Error selecting project:', error);

            // Show error message
            document.getElementById('loadingIndicator').style.display = 'none';
            document.getElementById('errorMessage').style.display = 'block';
            document.getElementById('videoPlayerContainer').style.display = 'none';
            document.getElementById('allCamGridContainer').style.display = 'none';

            // Reset main container
            const mainVideoContainer = document.getElementById('mainVideoContainer');
            if (mainVideoContainer) {
                mainVideoContainer.innerHTML = `
                    <div class="flex items-center justify-center h-full text-white">
                        <p>Error loading cameras. Please try again.</p>
                    </div>
                `;
            }
        }
    }

    // Function to switch main camera
    async function switchCamera(cameraId) {
        console.log(`Switching to camera ${cameraId}`);

        if (projectConnection) {
            projectConnection.switchMainCamera(cameraId);
        }
    }

    // Video control functions
    function togglePlayPause() {
        const mainVideo = document.querySelector('#mainVideoContainer video');
        if (mainVideo) {
            const playPauseIcon = document.getElementById('play-pause-icon');

            if (mainVideo.paused) {
                mainVideo.play();
                if (playPauseIcon) {
                    playPauseIcon.src = "{{ asset('admin-theme/assets/images/pause.png') }}";
                }
            } else {
                mainVideo.pause();
                if (playPauseIcon) {
                    playPauseIcon.src = "{{ asset('admin-theme/assets/images/play.png') }}";
                }
            }
        }
    }

    function toggleMute() {
        const mainVideo = document.querySelector('#mainVideoContainer video');
        if (mainVideo) {
            const muteIcon = document.getElementById('mute-icon');
            const volumeSlider = document.getElementById('volume-slider');

            if (mainVideo.muted) {
                mainVideo.muted = false;
                if (muteIcon) {
                    muteIcon.src = "{{ asset('admin-theme/assets/images/speaker.png') }}";
                }
                if (volumeSlider) {
                    mainVideo.volume = volumeSlider.value;
                }
            } else {
                mainVideo.muted = true;
                if (muteIcon) {
                    muteIcon.src = "{{ asset('admin-theme/assets/images/speaker-n.png') }}";
                }
            }
        }
    }

    function toggleFullscreen() {
        const videoContainer = document.getElementById('mainVideoContainer');
        if (videoContainer) {
            if (!document.fullscreenElement) {
                videoContainer.requestFullscreen().catch(err => {
                    console.error(`Error attempting to enable fullscreen: ${err.message}`);
                });
            } else {
                document.exitFullscreen();
            }
        }
    }

    // Initialize first project on page load
    document.addEventListener('DOMContentLoaded', async () => {
        console.log('Page loaded, initializing...');

        // Get first project button and simulate click after a short delay
        const firstProjectButton = document.querySelector('.tab-button.active');
        if (firstProjectButton) {
            const projectId = firstProjectButton.getAttribute('onclick').match(/selectProject\((\d+)/)[1];
            const projectName = firstProjectButton.querySelector('p').textContent.trim();

            setTimeout(async () => {
                await selectProject(parseInt(projectId), firstProjectButton, projectName);
            }, 1000);
        }
    });

    // Cleanup connections when page unloads
    window.addEventListener('beforeunload', async () => {
        console.log('Cleaning up connections...');

        if (projectConnection) {
            await projectConnection.disconnect();
            projectConnection = null;
        }

        await disconnectAllGridCameras();

        currentProject = null;
        currentCameras = [];
    });

    // Expose global functions for debugging
    window.janusDebug = {
        currentProject,
        projectConnection,
        currentCameras,
        gridConnections,
        selectProject,
        switchCamera,
        toggleAllCamView
    };
</script>
@endpush