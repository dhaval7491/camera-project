<!DOCTYPE html>
<html>
<head>
    <title>WebRTC Viewer</title>
</head>
<body>
    <video id="remoteVideo" autoplay playsinline></video>
    <button onclick="joinRoom()">Join Room</button>
    <script>
        const roomId = "123456"; // Replace with the roomId from the Flutter app
        const configuration = {
            iceServers: [
                { urls: ['stun:stun1.l.google.com:19302', 'stun:stun2.l.google.com:19302'] }
            ]
        };
        let peerConnection;
        let remoteStream;

        async function joinRoom() {
            // Initialize peer connection
            peerConnection = new RTCPeerConnection(configuration);

            // Handle remote stream
            peerConnection.ontrack = (event) => {
                console.log('Received remote track');
                remoteStream = event.streams[0];
                document.getElementById('remoteVideo').srcObject = remoteStream;
            };

            // Handle ICE candidates
            peerConnection.onicecandidate = async (event) => {
                if (event.candidate) {
                    console.log('Sending ICE candidate');
                    await fetch(`/Projects/camera-app/public/api/signaling/room/${roomId}/callee-candidate`, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            candidate: event.candidate.candidate,
                            sdpMid: event.candidate.sdpMid,
                            sdpMLineIndex: event.candidate.sdpMLineIndex,
                        }),
                    });
                }
            };

            // Fetch offer SDP
            const response = await fetch(`/Projects/camera-app/public/api/signaling/room/${roomId}`);
            const data = await response.json();
            if (data.offer) {
                await peerConnection.setRemoteDescription(new RTCSessionDescription(data.offer));
                const answer = await peerConnection.createAnswer();
                await peerConnection.setLocalDescription(answer);

                // Send answer SDP
                await fetch(`/Projects/camera-app/public/api/signaling/room/${roomId}/answer`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        sdp: answer.sdp,
                        type: answer.type,
                    }),
                });
            }

            // Listen for ICE candidates from caller (polling or WebSocket)
            // For simplicity, you can poll or use WebSockets for real-time updates
        }
    </script>
</body>
</html>