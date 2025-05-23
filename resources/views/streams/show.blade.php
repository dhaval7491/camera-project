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
        <p class="inline-block manrope-medium text-[15px] mt-[0px] mb-[10px] mr-[15px] text-[#43765statusText1] underline px-[15px]">
            <a href="{{ route('streams.index') }}">Back</a>
        </p>
        @foreach($projects as $index => $project)
        <div class="video-player px-[10px] relative w-[90%] {{ $index == 0 ? '' : 'hidden' }}" id="stream{{ $project['project_id'] }}" x-data="{ open: false }">
            <input type="hidden" id="roomIdInput" value="{{ $cameraId }}">
            <video class="w-full mt-[5px]" id="remoteVideo" autoplay playsinline></video>
            <p id="statusText" class="manrope-medium text-[14px] text-[#344563]">Not connected</p>
            <div class="video-controls">
                <nav class="flex justify-between bg-[#00000054] mt-[-53px] z-[9px] relative pt-[18px] pb-[10px] pl-[40px]">
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
                                <button id="play-pause"><img src="{{ asset('admin-theme/assets/images/play.png') }}" class="w-[20px] object-contain mr-[10px]"></button>
                            </li>
                            <li class="nav-item">
                                <button id="microphone"><img src="{{ asset('admin-theme/assets/images/microphone.png') }}" class="w-[20px] object-contain mr-[10px]"></button>
                            </li>
                            <li class="nav-item">
                                <button id="video-speed"><img src="{{ asset('admin-theme/assets/images/video-vid.png') }}" class="w-[20px] object-contain mr-[10px]"></button>
                            </li>
                            <li class="nav-item">
                                <button id="video-cut"><img src="{{ asset('admin-theme/assets/images/video-cut.png') }}" class="w-[20px] object-contain mr-[10px]"></button>
                            </li>
                            <li class="nav-item">
                                <button id="video-record"><img src="{{ asset('admin-theme/assets/images/video-record.png') }}" class="w-[20px] object-contain mr-[10px]"></button>
                            </li>
                            <li class="nav-item">
                                <button id="video-setting-menu"><img src="{{ asset('admin-theme/assets/images/video-settings.png') }}" class="w-[20px] object-contain mr-[10px]"></button>
                            </li>
                            <li class="nav-item">
                                <button id="listen-streams"><img src="{{ asset('admin-theme/assets/images/listen.png') }}" class="w-[20px] object-contain mr-[10px]"></button>
                            </li>
                            <li class="nav-item">
                                <button id="hang-up"><img src="{{ asset('admin-theme/assets/images/hangup.png') }}" class="w-[20px] object-contain mr-[10px]"></button>
                            </li>
                            <li class="nav-item">
                                <button id="reconnect"><img src="{{ asset('admin-theme/assets/images/reconnect.png') }}" class="w-[20px] object-contain mr-[10px]"></button>
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
                    class="absolute top-0 bg-[#0000007a] mr-[10px] shadow-lg rounded-md p-2 space-y-2 flex justify-center items-center space-x-4 z-[2]">
                    @foreach($project['camera'] as $camera)
                    <li class="flex flex-col items-center w-[15%]">
                        <a href="{{ route('streams.show', $camera['id']) }}">
                            <img src="{{ asset('admin-theme/assets/images/live-stream.png') }}" class="w-full">
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
                        <h4><img src="{{ asset('admin-theme/assets/images/sleep.png') }}">Sleep Timer</h4>
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

    #activeRoomsList li {
        padding: 5px 10px;
        background: #f0f0f0;
        margin-bottom: 5px;
        border-radius: 4px;
    }
</style>
@endpush
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/9.22.0/firebase-app-compat.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/9.22.0/firebase-firestore-compat.min.js"></script>
<script>
    // Firebase configuration - replace with your Firebase project config
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

    // WebRTC variables
    let peerConnection = null;
    let remoteStream = null;
    let currentRoomId = null;
    let roomsListener = null;

    // HTML elements
    const remoteVideo = document.getElementById('remoteVideo');
    // const joinButton = document.getElementById('joinButton');
    // const listenButton = document.getElementById('listenButton');
    // const hangupButton = document.getElementById('hangupButton');
    // const reconnectButton = document.getElementById('reconnectButton');
    const roomIdInput = document.getElementById('roomIdInput');
    const statusText = document.getElementById('statusText');
    // const roomItems = document.getElementById('roomItems');

    // WebRTC configuration
    const configuration = {
        iceServers: [{
            urls: [
                'stun:stun1.l.google.com:19302',
                'stun:stun2.l.google.com:19302'
            ]
        }, ],
        iceCandidatePoolSize: 10
    };

    // Join a specific room using its ID
    async function joinRoom(roomId) {
        try {
            // Close any existing connection first
            if (peerConnection) {
                peerConnection.close();
                peerConnection = null;
            }

            currentRoomId = roomId;
            statusText.textContent = `Attempting to join room: ${roomId}`;

            // Reference to the room in Firestore
            const roomRef = db.collection('rooms').doc(roomId);
            const roomSnapshot = await roomRef.get();

            if (!roomSnapshot.exists) {
                statusText.textContent = `Room ${roomId} does not exist!`;
                return;
            }

            const roomData = roomSnapshot.data();
            if (!roomData.offer) {
                statusText.textContent = `Room ${roomId} exists but has no offer!`;
                return;
            }

            statusText.textContent = `Joining room: ${roomId}`;
            console.log(`Joining room ${roomId} with data:`, roomData);

            // Create a new RTCPeerConnection
            peerConnection = new RTCPeerConnection(configuration);

            // Set up remote stream
            remoteStream = new MediaStream();
            remoteVideo.srcObject = remoteStream;

            // Register peer connection listeners
            registerPeerConnectionListeners();

            // Collect ICE candidates
            const calleeCandidatesCollection = roomRef.collection('calleeCandidates');

            // When we find an ICE candidate
            peerConnection.onicecandidate = event => {
                if (event.candidate) {
                    console.log('Got new ICE candidate:', event.candidate.candidate);
                    calleeCandidatesCollection.add(event.candidate.toJSON());
                }
            };

            // When we get a track from the remote peer
            peerConnection.ontrack = event => {
                console.log('Got remote track:', event.streams[0]);
                event.streams[0].getTracks().forEach(track => {
                    console.log('Adding track to remote stream:', track);
                    remoteStream.addTrack(track);
                });
            };

            // Get the offer from the room
            const offer = roomData.offer;
            console.log('Setting remote description with offer:', offer);
            await peerConnection.setRemoteDescription(new RTCSessionDescription(offer));

            // Create answer
            console.log('Creating answer');
            const answer = await peerConnection.createAnswer();
            console.log('Setting local description with answer:', answer);
            await peerConnection.setLocalDescription(answer);

            // Update the room with the answer
            console.log('Updating room with answer');
            await roomRef.update({
                answer: {
                    type: answer.type,
                    sdp: answer.sdp
                }
            });

            // Listen for remote ICE candidates
            console.log('Setting up listener for caller candidates');
            roomRef.collection('callerCandidates').onSnapshot(snapshot => {
                snapshot.docChanges().forEach(change => {
                    if (change.type === 'added') {
                        const data = change.doc.data();
                        console.log('Adding remote ICE candidate:', data);
                        peerConnection.addIceCandidate(new RTCIceCandidate(data))
                            .catch(error => console.error('Error adding ICE candidate:', error));
                    }
                });
            });

            // Enable/disable buttons
            // joinButton.disabled = true;
            // hangupButton.disabled = false;

            statusText.textContent = `Connecting to room: ${roomId}`;

            // Set a timeout to detect connection failures
            setTimeout(() => {
                if (peerConnection && peerConnection.connectionState !== 'connected') {
                    statusText.textContent = `Connection timeout. Verify that the mobile device is still streaming.`;
                }
            }, 30000);
        } catch (error) {
            console.error('Error joining room:', error);
            statusText.textContent = `Error joining room: ${error.message}`;
            hangUp();
        }
    }

    // Hang up the call
    async function hangUp() {
        try {
            if (peerConnection) {
                console.log('Closing peer connection');
                peerConnection.close();
                peerConnection = null;
            }

            // Clear the remote video
            if (remoteVideo.srcObject) {
                const tracks = remoteVideo.srcObject.getTracks();
                tracks.forEach(track => track.stop());
                remoteVideo.srcObject = null;
            }
            remoteStream = null;

            // Reset room ID
            if (currentRoomId) {
                // Optionally: Remove our answer from the room to signal we're no longer connected
                try {
                    await db.collection('rooms').doc(currentRoomId).update({
                        answer: firebase.firestore.FieldValue.delete()
                    });
                    console.log(`Removed answer from room ${currentRoomId}`);
                } catch (e) {
                    console.log('Could not update room, it may have been deleted:', e);
                }
                currentRoomId = null;
            }

            // Enable/disable buttons
            // joinButton.disabled = false;
            // hangupButton.disabled = true;

            statusText.textContent = 'Disconnected';
        } catch (error) {
            console.error('Error during hangup:', error);
            statusText.textContent = 'Error during disconnect';

            // Make sure UI is reset even if there was an error
            currentRoomId = null;
            // joinButton.disabled = false;
            // hangupButton.disabled = true;
        }
    }

    // Listen for active rooms
    function listenForRooms() {
        if (roomsListener) {
            // Already listening
            return;
        }

        roomsListener = db.collection('rooms')
            .onSnapshot(snapshot => {
                snapshot.docChanges().forEach(change => {
                    const roomId = change.doc.id;
                    const data = change.doc.data();

                    if (change.type === 'added') {
                        // A new room was created
                        addRoomToList(roomId, data);
                    } else if (change.type === 'modified') {
                        // Room was updated (e.g., someone joined)
                        updateRoomInList(roomId, data);
                    } else if (change.type === 'removed') {
                        // Room was removed
                        removeRoomFromList(roomId);
                    }
                });
            });

        // listenButton.textContent = 'Listening for Streams...';
        // listenButton.disabled = true;
        statusText.textContent = 'Listening for new streaming rooms...';
    }

    // Add a room to the list
    function addRoomToList(roomId, data) {
        const roomDiv = document.createElement('div');
        roomDiv.className = 'room-item';
        roomDiv.id = `room-${roomId}`;

        const statusDot = document.createElement('span');
        statusDot.className = 'room-status ' + (data.answer ? 'active' : 'inactive');

        const roomIdSpan = document.createElement('span');
        roomIdSpan.textContent = `Room: ${roomId}`;

        const timestampSpan = document.createElement('span');
        timestampSpan.textContent = new Date().toLocaleTimeString();

        roomDiv.appendChild(statusDot);
        roomDiv.appendChild(roomIdSpan);
        roomDiv.appendChild(timestampSpan);

        roomDiv.addEventListener('click', () => {
            roomIdInput.value = roomId;
            joinRoom(roomId);
        });

        // roomItems.appendChild(roomDiv);
    }

    // Update a room in the list
    function updateRoomInList(roomId, data) {
        const roomDiv = document.getElementById(`room-${roomId}`);
        if (roomDiv) {
            const statusDot = roomDiv.querySelector('.room-status');
            if (statusDot) {
                statusDot.className = 'room-status ' + (data.answer ? 'active' : 'inactive');
            }
        }
    }

    // Remove a room from the list
    function removeRoomFromList(roomId) {
        const roomDiv = document.getElementById(`room-${roomId}`);
        if (roomDiv) {
            roomDiv.remove();
        }
    }

    // Register peer connection listeners
    function registerPeerConnectionListeners() {
        peerConnection.onconnectionstatechange = () => {
            console.log(`Connection state change: ${peerConnection.connectionState}`);
            statusText.textContent = `Connection state: ${peerConnection.connectionState}`;

            if (peerConnection.connectionState === 'connected') {
                statusText.textContent = 'Connection established - Streaming';
                // reconnectButton.disabled = true;
            } else if (peerConnection.connectionState === 'disconnected') {
                statusText.textContent = 'Connection lost - Attempting to reconnect...';
                // reconnectButton.disabled = false;
            } else if (peerConnection.connectionState === 'failed') {
                statusText.textContent = 'Connection failed - Could not establish connection';
                console.error('Connection failed - See console for details');
                // reconnectButton.disabled = false;
            }
        };

        peerConnection.oniceconnectionstatechange = () => {
            console.log(`ICE connection state change: ${peerConnection.iceConnectionState}`);

            if (peerConnection.iceConnectionState === 'failed') {
                console.error('ICE connection failed - No suitable connection path found');
                statusText.textContent = 'ICE connection failed - Check firewall/network settings';
            }
        };

        peerConnection.onsignalingstatechange = () => {
            console.log(`Signaling state change: ${peerConnection.signalingState}`);
        };

        peerConnection.onicegatheringstatechange = () => {
            console.log(`ICE gathering state change: ${peerConnection.iceGatheringState}`);

            if (peerConnection.iceGatheringState === 'complete') {
                console.log('ICE gathering completed - All candidates gathered');
            }
        };

        // Log ice candidates for debugging
        peerConnection.onicecandidate = event => {
            if (event.candidate) {
                console.log('New ICE candidate:', event.candidate.candidate);
                // Still add to collection
                if (currentRoomId) {
                    const calleeCandidatesCollection = db.collection('rooms').doc(currentRoomId).collection('calleeCandidates');
                    calleeCandidatesCollection.add(event.candidate.toJSON());
                }
            }
        };
    }

    // Event listeners
    // joinButton.addEventListener('click', () => {
    //     const roomId = roomIdInput.value.trim();
    //     if (roomId) {
    //         joinRoom(roomId);
    //     } else {
    //         alert('Please enter a Room ID');
    //     }
    // });

    // listenButton.addEventListener('click', listenForRooms);

    // hangupButton.addEventListener('click', hangUp);

    // reconnectButton.addEventListener('click', () => {
    //     const roomId = currentRoomId || roomIdInput.value.trim();
    //     if (roomId) {
    //         statusText.textContent = 'Attempting to reconnect...';
    //         hangUp().then(() => {
    //             // Small delay to ensure clean hangup before reconnect
    //             setTimeout(() => joinRoom(roomId), 1000);
    //         });
    //     } else {
    //         alert('No room ID to reconnect to');
    //     }
    // });
</script>
<script>
    // JavaScript adapted from index.html
    document.addEventListener('DOMContentLoaded', function() {

        const roomId = roomIdInput?.value.trim();
        if (roomId) {
            joinRoom(roomId);
        } else {
            statusText.textContent = 'No Room ID provided';
        }
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

        // Video controls
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

        const speedSlider = document.getElementById('custom-speed');
        speedSlider.addEventListener('input', () => {
            remoteVideo.playbackRate = speedSlider.value;
        });

        // Cleanup on page unload
        window.addEventListener('beforeunload', hangUp);
    });
</script>
@endpush