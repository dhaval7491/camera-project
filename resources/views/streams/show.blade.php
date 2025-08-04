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
                <div class="main-video-container w-full h-full" id="mainVideo{{ $project['project_id'] }}" style="background-color: #000;">
                    <!-- Video element will be inserted here by JavaScript -->
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
                        <div class="cursor-pointer" onclick="janusSwitchCamera('{{ $camera['id'] }}', '{{ $project['project_id'] }}')">
                            <div class="video-box w-full" id="video-box-{{ $camera['id']}}">
                                <div width="140" height="80" id="video-{{ $camera['id']}}"></div>
                                <div class="video-info">
                                    <div class="video-status status-connecting" id="status-{{ $camera['id']}}"></div>
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

    .tab-button.bg-[#ededed] {
        background-color: #ededed !important;
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
    // Extract room ID from URL
    function getRoomIdFromUrl() {
        const path = window.location.pathname;
        const segments = path.split('/');
        const streamsIndex = segments.indexOf('streams');
        
        if (streamsIndex !== -1 && streamsIndex < segments.length - 1) {
            const roomId = segments[streamsIndex + 1];
            return parseInt(roomId);
        }
        
        // Fallback to default room ID if not found in URL
        console.warn('Room ID not found in URL, using default room 23');
        return 23;
    }

    // Get the dynamic room ID
    const ROOM_ID = getRoomIdFromUrl();
    console.log('Using room ID:', ROOM_ID);

    // Janus Gateway REST API integration
    const JANUS_URL = "https://unnifyy.com:8089/janus";
    let janusConnections = {}; // Store connections per project
    
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
    
    // Janus connection class
    class JanusConnection {
        constructor(projectId) {
            this.projectId = projectId;
            this.sessionId = null;
            this.handleId = null;
            this.feedId = null;
            this.pc = null;
            this.currentVideoElement = null;
            this.isPolling = false;
        }
        
        async createSession() {
            try {
                const res = await janusPost("", { janus: "create", transaction: randStr() });
                this.sessionId = res.data.id;
                console.log(`[PROJECT ${this.projectId}] Created session:`, this.sessionId);
                this.pollEvents();
                return true;
            } catch (error) {
                console.error(`[PROJECT ${this.projectId}] Session creation failed:`, error);
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
                console.log(`[PROJECT ${this.projectId}] Attached to plugin:`, this.handleId);
                return true;
            } catch (error) {
                console.error(`[PROJECT ${this.projectId}] Plugin attachment failed:`, error);
                return false;
            }
        }
        
        async joinAsSubscriber(feedId) {
            this.feedId = feedId;
            console.log(`[PROJECT ${this.projectId}] Joining as subscriber to feed:`, feedId, 'in room:', ROOM_ID);
            
            try {
                await janusPost(`/${this.sessionId}/${this.handleId}`, {
                    janus: "message",
                    body: {
                        request: "join",
                        ptype: "subscriber",
                        room: ROOM_ID, // Now using dynamic room ID
                        feed: feedId
                    },
                    transaction: randStr()
                });
                
                this.updateStatus("Connecting...");
                return true;
            } catch (error) {
                console.error(`[PROJECT ${this.projectId}] Join failed:`, error);
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
                    console.log(`[PROJECT ${this.projectId}] Received remote track`);
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
                    body: { request: "start", room: ROOM_ID }, // Using dynamic room ID
                    jsep: answer,
                    transaction: randStr()
                });
                
                console.log(`[PROJECT ${this.projectId}] Sent SDP answer for room:`, ROOM_ID);
            } catch (error) {
                console.error(`[PROJECT ${this.projectId}] StartSubscriber error:`, error);
                this.updateStatus("Connection failed");
            }
        }
        
        handleRemoteStream(stream) {
            // Create video element for main container
            const videoElement = document.createElement("video");
            videoElement.autoplay = true;
            videoElement.playsInline = true;
            videoElement.controls = false; // We'll use custom controls
            videoElement.style.width = '100%';
            videoElement.style.height = '100%';
            videoElement.style.objectFit = 'cover';
            videoElement.style.display = 'block';
            videoElement.style.borderRadius = '8px';
            videoElement.id = `remoteVideo${this.projectId}`;
            
            // Attach stream to video element
            videoElement.srcObject = stream;
            
            // Replace content in main video container
            const mainVideo = document.getElementById(`mainVideo${this.projectId}`);
            if (mainVideo) {
                mainVideo.innerHTML = '';
                mainVideo.appendChild(videoElement);
                this.currentVideoElement = videoElement;
                
                // Set up volume control
                this.setupVolumeControl();
            }
            
            this.updateStatus("Connected");
            this.updateOnlineStatus("Online");
        }
        
        setupVolumeControl() {
            if (this.currentVideoElement) {
                const volumeSlider = document.getElementById(`volume-slider${this.projectId}`);
                if (volumeSlider) {
                    // Set initial volume
                    this.currentVideoElement.volume = volumeSlider.value;
                    
                    // Update volume when slider changes
                    volumeSlider.addEventListener('input', () => {
                        this.currentVideoElement.volume = volumeSlider.value;
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
                        
                        // Check for publisher feed info
                        if (pluginData?.videoroom === "event" && pluginData.publishers?.length > 0) {
                            const feedId = pluginData.publishers[0].id;
                            console.log(`[PROJECT ${this.projectId}] Found publisher feed ID:`, feedId);
                            await this.joinAsSubscriber(feedId);
                        }
                        
                        // Handle JSEP offer
                        if (data.jsep) {
                            console.log(`[PROJECT ${this.projectId}] Got JSEP offer`);
                            await this.startSubscriber(data.jsep);
                        }
                    }
                } catch (err) {
                    console.error(`[PROJECT ${this.projectId}] Polling error:`, err);
                }
                
                await sleep(500);
            }
        }
        
        updateStatus(status) {
            const statusElement = document.getElementById(`statusText${this.projectId}`);
            if (statusElement) {
                statusElement.textContent = status;
            }
        }
        
        updateOnlineStatus(status) {
            const onlineElement = document.getElementById(`onlineStatus${this.projectId}`);
            if (onlineElement) {
                onlineElement.textContent = status;
            }
        }
        
        async disconnect() {
            this.isPolling = false;
            
            if (this.pc) {
                this.pc.close();
                this.pc = null;
            }
            
            if (this.currentVideoElement) {
                this.currentVideoElement.srcObject = null;
                this.currentVideoElement = null;
            }
            
            if (this.sessionId) {
                try {
                    await janusPost(`/${this.sessionId}`, { janus: "destroy", transaction: randStr() });
                } catch (error) {
                    console.error(`[PROJECT ${this.projectId}] Session destroy error:`, error);
                }
                this.sessionId = null;
            }
            
            this.updateStatus("Disconnected");
            this.updateOnlineStatus("Offline");
        }
    }
    
    // Global functions
    async function initJanusConnection(projectId) {
        if (janusConnections[projectId]) {
            await janusConnections[projectId].disconnect();
        }
        
        const connection = new JanusConnection(projectId);
        janusConnections[projectId] = connection;
        
        const sessionCreated = await connection.createSession();
        if (sessionCreated) {
            const pluginAttached = await connection.attachPlugin();
            if (pluginAttached) {
                // Try to list participants to find existing publishers
                await listParticipants(connection);
            }
        }
        
        return connection;
    }

    
    async function listParticipants(connection) {
        try {
            const res = await janusPost(`/${connection.sessionId}/${connection.handleId}`, {
                janus: "message",
                body: { request: "listparticipants", room: ROOM_ID }, // Using dynamic room ID
                transaction: randStr()
            });
            
            const data = res.plugindata?.data;
            if (data?.videoroom === "participants") {
                const publishers = data.participants.filter(p => p.publisher);
                if (publishers.length > 0) {
                    const feedId = publishers[0].id;
                    console.log(`[PROJECT ${connection.projectId}] Found publisher via list:`, feedId, 'in room:', ROOM_ID);
                    await connection.joinAsSubscriber(feedId);
                }
            }
        } catch (error) {
            console.error(`[PROJECT ${connection.projectId}] List participants error:`, error);
        }
    }
    
    async function janusSwitchCamera(cameraId, projectId) {
        console.log(`Switching to camera ${cameraId} for project ${projectId}`);
        // For now, just reinitialize connection
        // You might want to implement actual camera switching logic here
        await initJanusConnection(projectId);
    }
    
    // Video control functions
    function togglePlayPause(projectId) {
        const connection = janusConnections[projectId];
        if (connection && connection.currentVideoElement) {
            const video = connection.currentVideoElement;
            const playPauseIcon = document.getElementById(`play-pause-icon${projectId}`);
            
            if (video.paused) {
                video.play();
                if (playPauseIcon) {
                    playPauseIcon.src = "{{ asset('admin-theme/assets/images/pause.png') }}";
                }
            } else {
                video.pause();
                if (playPauseIcon) {
                    playPauseIcon.src = "{{ asset('admin-theme/assets/images/play.png') }}";
                }
            }
        }
    }
    
    function toggleMute(projectId) {
        const connection = janusConnections[projectId];
        if (connection && connection.currentVideoElement) {
            const video = connection.currentVideoElement;
            const muteIcon = document.getElementById(`mute-icon${projectId}`);
            const volumeSlider = document.getElementById(`volume-slider${projectId}`);
            
            if (video.muted) {
                video.muted = false;
                if (muteIcon) {
                    muteIcon.src = "{{ asset('admin-theme/assets/images/microphone.png') }}";
                }
                if (volumeSlider) {
                    video.volume = volumeSlider.value;
                }
            } else {
                video.muted = true;
                if (muteIcon) {
                    muteIcon.src = "{{ asset('admin-theme/assets/images/mute.png') }}";
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
    
    function openPTab(event, streamId) {
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
        
        // Update active tab styling
        const tabButtons = document.querySelectorAll('.tab-button');
        tabButtons.forEach(button => {
            button.classList.remove('bg-[#ededed]');
        });
        event.currentTarget.classList.add('bg-[#ededed]');
        
        // Extract project ID and initialize connection
        const projectId = streamId.replace('stream', '');
        initJanusConnection(projectId);
    }
    
    // Initialize when DOM is loaded
    document.addEventListener('DOMContentLoaded', () => {
        const projectsDataElement = document.getElementById('projectsData');
        if (!projectsDataElement) {
            console.error('projectsData element not found');
            return;
        }
        
        try {
            const projects = JSON.parse(projectsDataElement.textContent);
            if (projects.length > 0) {
                const firstProjectId = projects[0].project_id;
                // Initialize the first project
                setTimeout(() => {
                    initJanusConnection(firstProjectId);
                }, 1000);
            } else {
                console.error('No projects available');
            }
        } catch (err) {
            console.error('Error parsing projectsData:', err);
        }
    });
    
    // Cleanup connections when page unloads
    window.addEventListener('beforeunload', () => {
        Object.values(janusConnections).forEach(connection => {
            connection.disconnect();
        });
    });
</script>
@endpush