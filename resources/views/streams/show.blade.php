@extends('layouts.app')
@section('content')
<style>
    .video-box {
      width: 140px; /* Match video width */
      height: 80px; /* Match video height */
      max-width: 100%; /* Ensure responsiveness */
      position: relative; /* For positioning video-info */
      margin: 10px; /* Optional: spacing */
      overflow: hidden; /* Prevent overflow */
    }

    .video-box video {
      width: 100%; /* Fill video-box width */
      height: 100%; /* Fill video-box height */
      display: block; /* Remove extra space below video */
      object-fit: cover; /* Ensure video fills container without distortion */
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
      background-color: orange; /* Example styling for connecting status */
    }
  </style>
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
        <p class="inline-block manrope-medium text-[15px] mt-[0px] mb-[10px] mr-[15px] text-[#43765statusText1] underline px-[15px]">
            <a href="{{ route('streams.index') }}">Back</a>
        </p>
        @foreach($projects as $index => $project)
        <div class="video-player px-[10px] relative w-full {{ $index == 0 ? '' : 'hidden' }}" id="stream{{ $project['project_id'] }}" x-data="{ open: false }">
            <div class="video-container relative w-full" style="aspect-ratio: 16/9;">
                <video
                    class="w-full h-full object-cover rounded-lg"
                    id="mainVideo{{ $project['project_id'] }}"
                    autoplay
                    playsinline
                    style="background-color: #000;">
                </video>
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
                                <button id="microphone{{ $project['project_id'] }}"><img src="{{ asset('admin-theme/assets/images/microphone.png') }}" class="w-[20px] object-contain mr-[10px]"></button>
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
                            <li class="nav-item">
                                <button id="listen-streams{{ $project['project_id'] }}"><img src="{{ asset('admin-theme/assets/images/listen.png') }}" class="w-[20px] object-contain mr-[10px]"></button>
                            </li>
                            <li class="nav-item">
                                <button id="hang-up{{ $project['project_id'] }}"><img src="{{ asset('admin-theme/assets/images/hangup.png') }}" class="w-[20px] object-contain mr-[10px]"></button>
                            </li>
                            <li class="nav-item">
                                <button id="reconnect{{ $project['project_id'] }}"><img src="{{ asset('admin-theme/assets/images/reconnect.png') }}" class="w-[20px] object-contain mr-[10px]"></button>
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
                            <!-- <img src="{{ asset('admin-theme/assets/images/live-stream.png') }}" class="w-full"> -->
                            <div class="video-box w-full" id="video-box-{{ $camera['id']}}">
                                <video width="140" height="80" id="video-{{ $camera['id']}}" autoplay playsinline></video>
                                <div class="video-info">
                                    <div class="video-status status-connecting"></div>
                                </div>
                            </div>
                            <p class="manrope-medium bg-[white] text-[15px] inline-block w-full py-[1px] mb-0 text-center">{{ $camera['camera_name'] }}</p>
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
            <div class="absolute top-[73%] right-[30px] w-[210px]">
                <img src="{{ asset('admin-theme/assets/images/compas.png') }}" class="bg-[#00000057] py-[9px] px-[48px] rounded-full">
            </div>
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
    }

    .video-box video {
        display: block;
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
</style>
@endpush
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/9.22.0/firebase-app-compat.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/9.22.0/firebase-firestore-compat.min.js"></script>
<script>
    // Firebase configuration
    const firebaseConfig = {
        apiKey: "AIzaSyAYsYL3EVaxE_WQb2ngfozZ8Vy-z8mCFKU",
        authDomain: "cctv-646c8.firebaseapp.com",
        projectId: "cctv-646c8",
        storageBucket: "cctv-646c8.firebasestorage.app",
        messagingSenderId: "109248511108",
        appId: "1:109248511108:web:9874dceaf566ff29b516d1",
        measurementId: "G-DCY8K0PMT9"
    };

    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    const db = firebase.firestore();

    // Global variables
    const projectsData = JSON.parse(document.getElementById('projectsData').textContent);
    const peerConnections = new Map(); // Store all peer connections
    const remoteStreams = new Map(); // Store all remote streams
    let currentActiveProject = null;
    let currentActiveCamera = null;
    let firstStreamConnected = false; // Track if any stream has connected and started playing

    // WebRTC configuration
    const configuration = {
        iceServers: [{
            urls: [
                'stun:stun1.l.google.com:19302',
                'stun:stun2.l.google.com:19302'
            ]
        }],
        iceCandidatePoolSize: 10
    };

    // Initialize all cameras for all projects
    async function initializeAllCameras() {
        console.log('Initializing all cameras...', projectsData);

        for (const project of projectsData) {
            const projectId = String(project.project_id);
            console.log(`Processing project ${projectId} with ${project.camera.length} cameras`);

            // Set current active project to first project if not set
            if (!currentActiveProject) {
                currentActiveProject = projectId;
                console.log(`Set active project: ${currentActiveProject}`);
            }

            for (const camera of project.camera) {
                const cameraId = String(camera.id);
                console.log(`Initializing camera ${cameraId} for project ${projectId}`);

                // Add a small delay between connections to avoid overwhelming
                setTimeout(() => {
                    joinRoom(cameraId, projectId);
                }, Math.random() * 2000); // Random delay up to 2 seconds
            }
        }
    }

    // Function to set first connected stream as main video
    function setFirstConnectedStream(cameraId, projectId, remoteStream) {
        if (!firstStreamConnected) {
            console.log(`First stream connected: Camera ${cameraId} from Project ${projectId}`);

            // Switch to the project that has the first connected stream
            currentActiveProject = projectId;
            currentActiveCamera = cameraId;
            firstStreamConnected = true;

            // Show the correct project tab
            showProjectTab(projectId);

            // Set the main video for this project
            const mainVideo = document.getElementById(`mainVideo${projectId}`);
            if (mainVideo && remoteStream) {
                mainVideo.srcObject = remoteStream;
                console.log(`Set main video to first connected stream: Camera ${cameraId}`);

                // Update status
                const statusElement = document.getElementById(`statusText${projectId}`);
                if (statusElement) {
                    statusElement.textContent = `Now viewing camera ${cameraId} (first connected)`;
                }
            }
        }
    }

    // Function to show specific project tab
    function showProjectTab(projectId) {
        // Hide all tabs
        document.querySelectorAll('[id^="stream"]').forEach(tab => {
            if (tab.id.startsWith('stream')) {
                tab.classList.add('hidden');
            }
        });

        // Remove active class from all buttons
        document.querySelectorAll('.tab-button').forEach(tab => tab.classList.remove('bg-[#ededed]'));

        // Show selected tab
        const selectedTab = document.getElementById(`stream${projectId}`);
        if (selectedTab) {
            selectedTab.classList.remove('hidden');

            // Find and activate the corresponding button
            const correspondingButton = document.querySelector(`[onclick*="stream${projectId}"]`);
            if (correspondingButton) {
                correspondingButton.classList.add('bg-[#ededed]');
            }
        }
    }

    // Join a specific room using camera ID
    async function joinRoom(cameraId, projectId) {
        try {
            // Ensure cameraId is a string
            const roomId = String(cameraId);
            const connectionKey = `${projectId}-${roomId}`;

            console.log(`Attempting to join room: ${roomId} for project: ${projectId}`);

            // Close existing connection if any
            if (peerConnections.has(connectionKey)) {
                console.log(`Closing existing connection for ${connectionKey}`);
                peerConnections.get(connectionKey).close();
                peerConnections.delete(connectionKey);

                // Also clean up the stream
                if (remoteStreams.has(connectionKey)) {
                    const stream = remoteStreams.get(connectionKey);
                    stream.getTracks().forEach(track => track.stop());
                    remoteStreams.delete(connectionKey);
                }
            }

            const statusElement = document.getElementById(`statusText${projectId}`);
            if (statusElement && currentActiveProject == projectId) {
                statusElement.textContent = `Connecting to camera ${roomId}...`;
            }

            // Reference to the room in Firestore
            const roomRef = db.collection('rooms').doc(roomId);

            // Wait for room to exist with timeout
            let roomSnapshot;
            let attempts = 0;
            const maxAttempts = 10;

            do {
                roomSnapshot = await roomRef.get();
                if (!roomSnapshot.exists) {
                    console.log(`Room ${roomId} does not exist yet, attempt ${attempts + 1}/${maxAttempts}`);
                    if (attempts >= maxAttempts - 1) {
                        console.log(`Room ${roomId} does not exist after ${maxAttempts} attempts`);
                        return;
                    }
                    await new Promise(resolve => setTimeout(resolve, 2000)); // Wait 2 seconds
                }
                attempts++;
            } while (!roomSnapshot.exists && attempts < maxAttempts);

            const roomData = roomSnapshot.data();
            if (!roomData || !roomData.offer) {
                console.log(`Room ${roomId} exists but has no offer yet`);
                return;
            }

            // Validate offer structure
            if (!roomData.offer.type || !roomData.offer.sdp) {
                console.error(`Invalid offer structure for room ${roomId}:`, roomData.offer);
                return;
            }

            console.log(`Joining room ${roomId} for project ${projectId} with valid offer`);

            // Create a new RTCPeerConnection with error handling
            let peerConnection;
            try {
                peerConnection = new RTCPeerConnection(configuration);
            } catch (error) {
                console.error(`Failed to create RTCPeerConnection for ${roomId}:`, error);
                return;
            }

            peerConnections.set(connectionKey, peerConnection);

            // Set up remote stream
            const remoteStream = new MediaStream();
            remoteStreams.set(connectionKey, remoteStream);

            // Get video elements
            const thumbnailVideo = document.getElementById(`video-${roomId}`);
            const mainVideo = document.getElementById(`mainVideo${projectId}`);

            // Set thumbnail video source
            if (thumbnailVideo) {
                thumbnailVideo.srcObject = remoteStream;
            }

            // Register peer connection listeners BEFORE setting up candidates
            registerPeerConnectionListeners(peerConnection, roomId, projectId, remoteStream);

            // Set up ICE candidate handling
            const calleeCandidatesCollection = roomRef.collection('calleeCandidates');

            // When we find an ICE candidate
            peerConnection.onicecandidate = event => {
                if (event.candidate) {
                    console.log(`Got new ICE candidate for ${roomId}`);
                    try {
                        const candidateData = event.candidate.toJSON();
                        calleeCandidatesCollection.add(candidateData).catch(error => {
                            console.error(`Error adding ICE candidate for ${roomId}:`, error);
                        });
                    } catch (error) {
                        console.error(`Error processing ICE candidate for ${roomId}:`, error);
                    }
                }
            };

            // When we get a track from the remote peer
            peerConnection.ontrack = event => {
                console.log(`Got remote track for ${roomId}`);
                if (event.streams && event.streams[0]) {
                    event.streams[0].getTracks().forEach(track => {
                        console.log(`Adding track to remote stream for ${roomId}`);
                        remoteStream.addTrack(track);
                    });

                    // Check if this stream has video tracks and set as main if it's the first
                    const videoTracks = event.streams[0].getVideoTracks();
                    if (videoTracks.length > 0) {
                        console.log(`Video track detected for camera ${roomId}`);
                        // Wait a moment for the stream to be ready, then check if it should be the main video
                        setTimeout(() => {
                            setFirstConnectedStream(roomId, projectId, remoteStream);
                        }, 1000);
                    }
                }
            };

            // Set remote description with the offer
            try {
                const offer = roomData.offer;
                console.log(`Setting remote description for ${roomId}`);
                await peerConnection.setRemoteDescription(new RTCSessionDescription(offer));
            } catch (error) {
                console.error(`Error setting remote description for ${roomId}:`, error);
                peerConnection.close();
                peerConnections.delete(connectionKey);
                remoteStreams.delete(connectionKey);
                return;
            }

            // Create and set local description (answer)
            try {
                console.log(`Creating answer for ${roomId}`);
                const answer = await peerConnection.createAnswer();
                console.log(`Setting local description for ${roomId}`);
                await peerConnection.setLocalDescription(answer);

                // Update the room with the answer
                console.log(`Updating room ${roomId} with answer`);
                await roomRef.update({
                    answer: {
                        type: answer.type,
                        sdp: answer.sdp
                    }
                });
            } catch (error) {
                console.error(`Error creating/setting answer for ${roomId}:`, error);
                peerConnection.close();
                peerConnections.delete(connectionKey);
                remoteStreams.delete(connectionKey);
                return;
            }

            // Listen for remote ICE candidates
            console.log(`Setting up listener for caller candidates for ${roomId}`);
            roomRef.collection('callerCandidates').onSnapshot(snapshot => {
                snapshot.docChanges().forEach(change => {
                    if (change.type === 'added' && peerConnection.signalingState !== 'closed') {
                        const data = change.doc.data();
                        console.log(`Adding remote ICE candidate for ${roomId}`);

                        try {
                            peerConnection.addIceCandidate(new RTCIceCandidate(data))
                                .catch(error => console.error(`Error adding ICE candidate for ${roomId}:`, error));
                        } catch (error) {
                            console.error(`Error processing remote ICE candidate for ${roomId}:`, error);
                        }
                    }
                });
            }, error => {
                console.error(`Error listening to caller candidates for ${roomId}:`, error);
            });

            if (statusElement && currentActiveProject == projectId) {
                statusElement.textContent = `Connecting to camera ${roomId}...`;
            }

        } catch (error) {
            console.error(`Error joining room ${cameraId}:`, error);
            const statusElement = document.getElementById(`statusText${projectId}`);
            if (statusElement && currentActiveProject == projectId) {
                statusElement.textContent = `Error connecting to camera ${cameraId}: ${error.message}`;
            }
        }
    }

    // Switch camera stream in main video (manual selection)
    function switchCamera(cameraId, projectId) {
        const roomId = String(cameraId);
        const connectionKey = `${projectId}-${roomId}`;
        const remoteStream = remoteStreams.get(connectionKey);
        const mainVideo = document.getElementById(`mainVideo${projectId}`);

        if (remoteStream && mainVideo) {
            mainVideo.srcObject = remoteStream;
            currentActiveCamera = roomId;
            console.log(`Manually switched main video to camera ${roomId}`);

            const statusElement = document.getElementById(`statusText${projectId}`);
            if (statusElement) {
                statusElement.textContent = `Now viewing camera ${roomId}`;
            }
        } else {
            console.log(`Cannot switch to camera ${roomId} - stream or video element not found`);
        }
    }

    // Register peer connection listeners
    function registerPeerConnectionListeners(peerConnection, cameraId, projectId, remoteStream) {
        const roomId = String(cameraId);
        const statusElement = document.getElementById(`video-box-${roomId}`)?.querySelector('.video-status');

        peerConnection.onconnectionstatechange = () => {
            console.log(`Connection state change for ${roomId}: ${peerConnection.connectionState}`);

            if (statusElement) {
                statusElement.className = `video-status status-${peerConnection.connectionState === 'connected' ? 'connected' : 
                peerConnection.connectionState === 'connecting' ? 'connecting' : 'disconnected'}`;
            }

            const projectStatusElement = document.getElementById(`statusText${projectId}`);
            if (projectStatusElement && currentActiveProject == projectId && currentActiveCamera == roomId) {
                projectStatusElement.textContent = `Camera ${roomId}: ${peerConnection.connectionState}`;
            }

            if (peerConnection.connectionState === 'connected') {
                console.log(`Successfully connected to camera ${roomId}`);

                // Check if this should be set as the main video (first connected stream)
                if (!firstStreamConnected && remoteStream && remoteStream.getVideoTracks().length > 0) {
                    setTimeout(() => {
                        setFirstConnectedStream(roomId, projectId, remoteStream);
                    }, 500);
                }
            } else if (peerConnection.connectionState === 'failed') {
                console.error(`Connection failed for camera ${roomId}`);
                // Attempt to reconnect after a delay
                setTimeout(() => {
                    console.log(`Attempting to reconnect camera ${roomId}`);
                    joinRoom(roomId, projectId);
                }, 5000);
            }
        };

        peerConnection.oniceconnectionstatechange = () => {
            console.log(`ICE connection state change for ${roomId}: ${peerConnection.iceConnectionState}`);

            if (peerConnection.iceConnectionState === 'failed') {
                console.error(`ICE connection failed for camera ${roomId}`);
            }
        };

        peerConnection.onsignalingstatechange = () => {
            console.log(`Signaling state change for ${roomId}: ${peerConnection.signalingState}`);
        };

        peerConnection.onicegatheringstatechange = () => {
            console.log(`ICE gathering state change for ${roomId}: ${peerConnection.iceGatheringState}`);
        };

        // Handle errors
        peerConnection.onerror = (error) => {
            console.error(`Peer connection error for ${roomId}:`, error);
        };
    }

    // Hang up all connections
    async function hangUpAllConnections() {
        try {
            for (const [connectionKey, peerConnection] of peerConnections) {
                console.log(`Closing connection: ${connectionKey}`);
                peerConnection.close();
            }

            peerConnections.clear();
            remoteStreams.clear();
            firstStreamConnected = false; // Reset first stream flag

            // Clear all video sources
            document.querySelectorAll('video').forEach(video => {
                if (video.srcObject) {
                    const tracks = video.srcObject.getTracks();
                    tracks.forEach(track => track.stop());
                    video.srcObject = null;
                }
            });

            console.log('All connections closed');
        } catch (error) {
            console.error('Error during hangup:', error);
        }
    }

    // Listen for new rooms
    function listenForNewRooms() {
        db.collection('rooms').onSnapshot(snapshot => {
            snapshot.docChanges().forEach(change => {
                if (change.type === 'added') {
                    const roomId = change.doc.id;
                    const data = change.doc.data();

                    // Check if this room corresponds to any of our cameras
                    for (const project of projectsData) {
                        const camera = project.camera.find(cam => cam.id === roomId);
                        if (camera && data.offer) {
                            console.log(`New room detected for camera ${roomId}, connecting...`);
                            joinRoom(roomId, project.project_id);
                        }
                    }
                }
            });
        });
    }

    // Tab switching logic
    function openTab(event, tabId) {
        showProjectTab(tabId.replace('stream', ''));

        // Extract project ID from tab ID
        const projectId = tabId.replace('stream', '');
        currentActiveProject = projectId;

        // If there's already a connected camera for this project, show it
        const project = projectsData.find(p => p.project_id == projectId);
        if (project && project.camera.length > 0) {
            // Find first connected camera for this project
            let connectedCamera = null;
            for (const camera of project.camera) {
                const connectionKey = `${projectId}-${camera.id}`;
                if (remoteStreams.has(connectionKey)) {
                    connectedCamera = camera.id;
                    break;
                }
            }

            if (connectedCamera) {
                currentActiveCamera = connectedCamera;
                switchCamera(connectedCamera, projectId);
            }
        }
    }

    // Video controls setup
    function setupVideoControls() {
        projectsData.forEach(project => {
            const projectId = project.project_id;

            // Play/Pause button
            const playPauseButton = document.getElementById(`play-pause${projectId}`);
            const mainVideo = document.getElementById(`mainVideo${projectId}`);

            if (playPauseButton && mainVideo) {
                playPauseButton.addEventListener('click', () => {
                    if (mainVideo.paused) {
                        mainVideo.play();
                        playPauseButton.innerHTML = `<img src="{{ asset('admin-theme/assets/images/pause.png') }}" class="w-[20px] object-contain mr-[10px]">`;
                    } else {
                        mainVideo.pause();
                        playPauseButton.innerHTML = `<img src="{{ asset('admin-theme/assets/images/play.png') }}" class="w-[20px] object-contain mr-[10px]">`;
                    }
                });
            }

            // Volume slider
            const volumeSlider = document.getElementById(`volume-slider${projectId}`);
            if (volumeSlider && mainVideo) {
                volumeSlider.addEventListener('input', () => {
                    mainVideo.volume = volumeSlider.value;
                });
            }

            // Speed slider
            const speedSlider = document.getElementById(`custom-speed${projectId}`);
            if (speedSlider && mainVideo) {
                speedSlider.addEventListener('input', () => {
                    mainVideo.playbackRate = speedSlider.value;
                });
            }

            // Hang up button
            const hangUpButton = document.getElementById(`hang-up${projectId}`);
            if (hangUpButton) {
                hangUpButton.addEventListener('click', hangUpAllConnections);
            }

            // Reconnect button
            const reconnectButton = document.getElementById(`reconnect${projectId}`);
            if (reconnectButton) {
                reconnectButton.addEventListener('click', () => {
                    console.log('Reconnecting all cameras...');
                    hangUpAllConnections().then(() => {
                        setTimeout(initializeAllCameras, 1000);
                    });
                });
            }
        });
    }

    // Initialize everything when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Setup video controls
        setupVideoControls();

        // Start listening for new rooms
        listenForNewRooms();

        // Initialize all camera connections
        initializeAllCameras();

        // Cleanup on page unload
        window.addEventListener('beforeunload', hangUpAllConnections);
    });

    // Make functions globally available
    window.openTab = openTab;
    window.switchCamera = switchCamera;
</script>
@endpush