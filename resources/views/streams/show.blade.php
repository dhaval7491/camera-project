@extends('layouts.app')
@section('content')
<style>
    .video-box {
        width: 140px;
        height: 80px;
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
</style>

<div class="flex flex-wrap">
    <div class="lg:w-1/6 md:w-1/6 w-full">
        <div class="crane-list py-[10px] pl-[5px] pr-[10px] h-[90%] overflow-y-scroll">
            @foreach($projects as $index => $project)
            <button class="w-full tab-button tab-shadow py-[15px] px-[10px] rounded-[10px] mb-[10px] cursor-pointer {{ $index == 0 ? 'active' : '' }}" 
                    onclick="openPTab(event, 'stream{{ $project['project_id'] }}', '{{ $project['project_id'] }}')">
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
                <div class="main-video-container w-full h-full" id="mainVideo{{ $project['project_id'] }}" style="background-color: #000;">
                    <!-- Main video stream will be inserted here -->
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
                                <button id="play-pause{{ $project['project_id'] }}" class="control-btn" onclick="togglePlayPause('{{ $project['project_id'] }}')">
                                    <img src="{{ asset('admin-theme/assets/images/play.png') }}" class="w-[20px] object-contain mr-[10px]" id="play-pause-icon{{ $project['project_id'] }}">
                                </button>
                            </li>
                            <li class="nav-item">
                                <button id="microphone{{ $project['project_id'] }}" class="control-btn" onclick="toggleMute('{{ $project['project_id'] }}')">
                                    <img src="{{ asset('admin-theme/assets/images/microphone.png') }}" class="w-[20px] object-contain mr-[10px]" id="mute-icon{{ $project['project_id'] }}">
                                </button>
                            </li>
                            <li class="nav-item">
                                <button id="video-speed{{ $project['project_id'] }}" class="control-btn">
                                    <img src="{{ asset('admin-theme/assets/images/video-vid.png') }}" class="w-[20px] object-contain mr-[10px]">
                                </button>
                            </li>
                            <li class="nav-item">
                                <button id="video-cut{{ $project['project_id'] }}" class="control-btn">
                                    <img src="{{ asset('admin-theme/assets/images/video-cut.png') }}" class="w-[20px] object-contain mr-[10px]">
                                </button>
                            </li>
                            <li class="nav-item">
                                <button id="video-record{{ $project['project_id'] }}" class="control-btn">
                                    <img src="{{ asset('admin-theme/assets/images/video-record.png') }}" class="w-[20px] object-contain mr-[10px]">
                                </button>
                            </li>
                            <li class="nav-item">
                                <button id="video-setting-menu{{ $project['project_id'] }}" class="control-btn">
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
                                    <input type="range" id="size-slider{{ $project['project_id'] }}" min="0" max="1" step="0.1" value="0.5">
                                    <img src="{{ asset('admin-theme/assets/images/max-size.png') }}" alt="max size" class="size-icon w-[15px] object-contain ml-[5px]">
                                </div>
                            </li>
                            <li class="nav-item">
                                <button class="control-btn" onclick="toggleFullscreen('{{ $project['project_id'] }}')">
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
                    class="absolute top-0 bg-[#0000007a] mr-[10px] shadow-lg rounded-md p-2 space-y-2 flex justify-center items-center space-x-4 z-[2] w-full">
                    @foreach($project['camera'] as $camera)
                    <li class="flex flex-col items-center">
                        <div class="cursor-pointer" onclick="switchCamera('{{ $camera['id'] }}', '{{ $project['project_id'] }}')">
                            <div class="video-box w-full" id="video-box-{{ $project['project_id'] }}-{{ $camera['id']}}">
                                <div width="140" height="80" id="video-{{ $project['project_id'] }}-{{ $camera['id']}}"></div>
                                <div class="video-info">
                                    <div class="video-status status-connecting" id="status-{{ $project['project_id'] }}-{{ $camera['id']}}"></div>
                                </div>
                            </div>
                            <p class="manrope-medium bg-[white] text-[13px] inline-block w-full py-[1px] mb-0 text-center">{{ $camera['camera_name'] }}</p>
                        </div>
                    </li>
                    @endforeach
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
                    {{ count($project['camera']) }}
                </p>
            </div>
            
            <!-- Weather info -->
            <div class="absolute top-[30%] right-[30px] bg-[#00000054] py-[45px] px-[10px] rounded-full">
                <div class="text-white text-[20px] cursor-pointer mb-[30px]">
                    <img src="{{ asset('admin-theme/assets/images/weather.png') }}" class="w-[40px] object-contain mx-auto mb-[8px]">
                    <p class="text-white manrope-bold text-[18px] text-center">5'</p>
                </div>
                <div class="text-white text-[20px] cursor-pointer">
                    <img src="{{ asset('admin-theme/assets/images/wind.png') }}" class="w-[25px] object-contain mx-auto mb-[8px]">
                    <p class="text-white manrope-bold text-[16px] text-center">15 mph</p>
                </div>
            </div>
            
            <!-- Online status -->
            <div x-show="!open" class="online absolute top-[20px] right-[30px] bg-[#00000054] py-[5px] px-[19px] rounded-full">
                <p class="flex text-white">
                    <img src="{{ asset('admin-theme/assets/images/online.png') }}" class="w-[20px] object-contain mr-[5px]">
                    <span id="onlineStatus{{ $project['project_id'] }}">Offline</span>
                </p>
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
    let projectConnections = {}; // Store all project connections
    let currentActiveProject = null;
    
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
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(body),
            });
            return await res.json();
        } catch (error) {
            console.error("Janus POST error:", error);
            throw error;
        }
    }
    
    // Camera connection class for individual cameras
    class CameraConnection {
        constructor(projectId, cameraId, isMainCamera = false) {
            this.projectId = projectId;
            this.cameraId = cameraId;
            this.roomId = cameraId; // Room ID equals camera ID
            this.isMainCamera = isMainCamera;
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
                const res = await janusPost("", { janus: "create", transaction: randStr() });
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
                    iceServers: [{ urls: "stun:stun.l.google.com:19302" }]
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
                            candidate: { completed: true },
                            transaction: randStr()
                        });
                    }
                };
                
                await this.pc.setRemoteDescription(jsep);
                const answer = await this.pc.createAnswer();
                await this.pc.setLocalDescription(answer);
                
                await janusPost(`/${this.sessionId}/${this.handleId}`, {
                    janus: "message",
                    body: { request: "start", room: this.roomId },
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
            videoElement.style.width = '100%';
            videoElement.style.height = '100%';
            videoElement.style.objectFit = 'cover';
            videoElement.style.display = 'block';
            videoElement.style.borderRadius = '8px';
            videoElement.id = `video-${this.projectId}-${this.cameraId}-element`;
            
            // Attach stream to video element
            videoElement.srcObject = stream;
            this.videoElement = videoElement;
            
            // // Place video in appropriate container
            // if (this.isMainCamera) {
            //     this.placeInMainContainer();
            // } else {
            //     this.placeInThumbnailContainer();
            // }

            // Always place in thumbnail container first
            this.placeInThumbnailContainer();
            
            // If this is the main camera, also place in main container
            if (this.isMainCamera) {
                this.placeInMainContainer();
            }
            
            this.isConnected = true;
            this.updateStatus("Connected");
        }
        
        placeInMainContainer() {
            const mainVideo = document.getElementById(`mainVideo${this.projectId}`);
            if (mainVideo && this.videoElement) {
                mainVideo.innerHTML = '';
                mainVideo.appendChild(this.videoElement);
                this.setupVolumeControl();
                this.updateOnlineStatus("Online");
            }
        }
        
        placeInThumbnailContainer() {
            const thumbnailContainer = document.getElementById(`video-${this.projectId}-${this.cameraId}`);
            if (thumbnailContainer && this.videoElement) {
                // Clone the video element for thumbnail
                const thumbnailVideo = this.videoElement.cloneNode();
                thumbnailVideo.srcObject = this.videoElement.srcObject;
                thumbnailVideo.style.width = '100%';
                thumbnailVideo.style.height = '100%';
                thumbnailVideo.id = `thumbnail-${this.projectId}-${this.cameraId}`;
                
                thumbnailContainer.innerHTML = '';
                thumbnailContainer.appendChild(thumbnailVideo);
            }
        }
        
        moveToMainContainer() {
            if (this.videoElement && this.isConnected) {
                this.isMainCamera = true;
                this.placeInMainContainer();
                
                // Update other cameras to not be main
                const projectConnection = projectConnections[this.projectId];
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
            if (this.videoElement) {
                const volumeSlider = document.getElementById(`volume-slider${this.projectId}`);
                if (volumeSlider) {
                    this.videoElement.volume = volumeSlider.value;
                    volumeSlider.addEventListener('input', () => {
                        this.videoElement.volume = volumeSlider.value;
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
                    body: { request: "listparticipants", room: this.roomId },
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
            const statusElement = document.getElementById(`status-${this.projectId}-${this.cameraId}`);
            if (statusElement) {
                statusElement.className = `video-status ${
                    status === 'Connected' ? 'status-connected' :
                    status === 'Connecting...' ? 'status-connecting' :
                    'status-disconnected'
                }`;
            }
            
            // Update main status if this is main camera
            if (this.isMainCamera) {
                const mainStatusElement = document.getElementById(`statusText${this.projectId}`);
                if (mainStatusElement) {
                    mainStatusElement.textContent = status;
                }
            }
        }
        
        updateOnlineStatus(status) {
            if (this.isMainCamera) {
                const onlineElement = document.getElementById(`onlineStatus${this.projectId}`);
                if (onlineElement) {
                    onlineElement.textContent = status;
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
                    await janusPost(`/${this.sessionId}`, { janus: "destroy", transaction: randStr() });
                } catch (error) {
                    console.error(`[CAMERA ${this.cameraId}] Session destroy error:`, error);
                }
                this.sessionId = null;
            }
            
            this.updateStatus("Disconnected");
            if (this.isMainCamera) {
                this.updateOnlineStatus("Offline");
            }
        }
    }
    
    // Project connection manager
    class ProjectConnection {
        constructor(projectId, cameras) {
            this.projectId = projectId;
            this.cameras = {};
            this.isInitialized = false;
            
            // Initialize camera connections
            cameras.forEach((camera, index) => {
                const isMainCamera = index === 0; // First camera is main by default
                this.cameras[camera.id] = new CameraConnection(projectId, camera.id, isMainCamera);
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
                        // Try to list participants to find existing publishers
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
    
    // Global functions
    async function initializeProject(projectId) {
        console.log(`Initializing project: ${projectId}`);
        
        // Get project data
        const projectsDataElement = document.getElementById('projectsData');
        const projects = JSON.parse(projectsDataElement.textContent);
        const project = projects.find(p => p.project_id == projectId);
        
        if (!project || !project.camera || project.camera.length === 0) {
            console.error(`Project ${projectId} not found or has no cameras`);
            return;
        }
        
        // Create project connection if not exists
        if (!projectConnections[projectId]) {
            projectConnections[projectId] = new ProjectConnection(projectId, project.camera);
        }
        
        // Initialize all cameras for this project
        await projectConnections[projectId].initializeAllCameras();
        
        // Update current active project
        currentActiveProject = projectId;
    }
    
    async function switchCamera(cameraId, projectId) {
        console.log(`Switching to camera ${cameraId} for project ${projectId}`);
        
        const projectConnection = projectConnections[projectId];
        if (projectConnection) {
            projectConnection.switchMainCamera(cameraId);
        }
    }
    
    async function openPTab(event, streamId, projectId) {
        console.log(`Opening tab for project: ${projectId}`);
        
        // Update tab active state
        const tabButtons = document.querySelectorAll('.tab-button');
        tabButtons.forEach(button => {
            button.classList.remove('active');
        });
        event.currentTarget.classList.add('active');
        
        // Hide all video players
        const videoPlayers = document.querySelectorAll('.video-player');
        videoPlayers.forEach(player => {
            player.classList.add('hidden');
        });
        
        // Show selected stream
        const selectedStream = document.getElementById(streamId);
        if (selectedStream) {
            selectedStream.classList.remove('hidden');
        }
        
        // Initialize project if not already done or if switching projects
        if (currentActiveProject !== projectId) {
            await initializeProject(projectId);
        }
    }
    
    // Video control functions
    function togglePlayPause(projectId) {
        const projectConnection = projectConnections[projectId];
        if (projectConnection) {
            const videoElement = projectConnection.getMainCameraVideoElement();
            if (videoElement) {
                const playPauseIcon = document.getElementById(`play-pause-icon${projectId}`);
                
                if (videoElement.paused) {
                    videoElement.play();
                    if (playPauseIcon) {
                        playPauseIcon.src = "{{ asset('admin-theme/assets/images/pause.png') }}";
                    }
                } else {
                    videoElement.pause();
                    if (playPauseIcon) {
                        playPauseIcon.src = "{{ asset('admin-theme/assets/images/play.png') }}";
                    }
                }
            }
        }
    }
    
    function toggleMute(projectId) {
        const projectConnection = projectConnections[projectId];
        if (projectConnection) {
            const videoElement = projectConnection.getMainCameraVideoElement();
            if (videoElement) {
                const muteIcon = document.getElementById(`mute-icon${projectId}`);
                const volumeSlider = document.getElementById(`volume-slider${projectId}`);
                
                if (videoElement.muted) {
                    videoElement.muted = false;
                    if (muteIcon) {
                        muteIcon.src = "{{ asset('admin-theme/assets/images/microphone.png') }}";
                    }
                    if (volumeSlider) {
                        videoElement.volume = volumeSlider.value;
                    }
                } else {
                    videoElement.muted = true;
                    if (muteIcon) {
                        muteIcon.src = "{{ asset('admin-theme/assets/images/mute.png') }}";
                    }
                }
            }
        }
    }
    
    function toggleFullscreen(projectId) {
        const videoContainer = document.getElementById(`mainVideo${projectId}`);
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
    
    // Initialize when DOM is loaded
    document.addEventListener('DOMContentLoaded', async () => {
        const projectsDataElement = document.getElementById('projectsData');
        if (!projectsDataElement) {
            console.error('projectsData element not found');
            return;
        }
        
        try {
            const projects = JSON.parse(projectsDataElement.textContent);
            if (projects.length > 0) {
                const firstProjectId = projects[0].project_id;
                console.log('Initializing first project:', firstProjectId);
                
                // Initialize the first project after a short delay
                setTimeout(async () => {
                    await initializeProject(firstProjectId);
                }, 1000);
            } else {
                console.error('No projects available');
            }
        } catch (err) {
            console.error('Error parsing projectsData:', err);
        }
    });
    
    // Cleanup connections when page unloads
    window.addEventListener('beforeunload', async () => {
        console.log('Cleaning up all connections...');
        
        const disconnectPromises = Object.values(projectConnections).map(project => project.disconnect());
        await Promise.all(disconnectPromises);
        
        projectConnections = {};
        currentActiveProject = null;
    });
    
    // Optional: Add reconnection logic for failed connections
    function scheduleReconnection(projectId, cameraId, delay = 5000) {
        setTimeout(async () => {
            const projectConnection = projectConnections[projectId];
            if (projectConnection && projectConnection.cameras[cameraId]) {
                const camera = projectConnection.cameras[cameraId];
                if (!camera.isConnected && camera.sessionId) {
                    console.log(`Attempting to reconnect camera ${cameraId} for project ${projectId}`);
                    await camera.listParticipants();
                }
            }
        }, delay);
    }
    
    // Expose global functions for debugging
    window.janusDebug = {
        projectConnections,
        currentActiveProject,
        initializeProject,
        switchCamera,
        scheduleReconnection
    };
    
</script>
@endpush