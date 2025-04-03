require('dotenv').config();
const WebSocket = require('ws');
const axios = require('axios');

const PORT = process.env.PORT || 3001;
const API_URL = process.env.API_URL || "http://localhost/Projects/camera-app/public/api";

// Create a WebSocket server on port 3001
const wss = new WebSocket.Server({ port: 3001 });

console.log(`WebSocket Server running on ws://localhost:${PORT}`);

// Listen for connections
wss.on('connection', (ws) => {
    console.log("Client connected");

    ws.on('message', async (message) => {
        try {
            const data = JSON.parse(message);
            if (!data.event) {
                ws.send(JSON.stringify({ error: 'Invalid event' }));
                return;
            }

            let endpoint = '';
            let payload = {};

            switch (data.event) {
                case 'create-room':
                    endpoint = 'create-room';
                    payload = { offer: data.offer };
                    break;

                case 'join-room':
                    // endpoint = 'join-room';
                    // payload = { room_id: data.room_id, answer: data.answer };
                    // If the join-room message includes an answer, then the joiner is sending its answer
                    // to the room creator. Otherwise, the joiner is requesting the stored offer.
                    if (data.answer) {
                        endpoint = 'join-room'; // API endpoint to save the answer
                        payload = { room_id: data.room_id, answer: data.answer };
                        data.event = 'answer'; // broadcast as answer
                    } else {
                        endpoint = 'join-room'; // API endpoint to fetch the stored offer
                        payload = { room_id: data.room_id };
                        data.event = 'offer'; // broadcast as offer
                    }
                    break;

                case 'add-candidate':
                    endpoint = 'add-candidate';
                    payload = { room_id: data.room_id, type: data.type, candidate: data.candidate };
                    break;

                case 'get-candidate':
                    endpoint = 'get-candidates'
                    payload = { room_id: data.room_id, type: data.type };
                    break;

                default:
                    ws.send(JSON.stringify({ error: 'Unknown event' }));
                    return;
            }

            const response = await axios.post(`${API_URL}${endpoint}`, payload, {
                headers: { 'Content-Type': 'application/json' }
            });

            // Broadcast to all connected clients
            wss.clients.forEach(client => {
                if (client.readyState === WebSocket.OPEN) {
                    client.send(JSON.stringify({
                        event: data.event,
                        data: response.data
                    }));
                }
            });
        } catch (error) {
            console.error('Error processing event:', error);
            ws.send(JSON.stringify({ error: 'Internal server error' }));
        }
    });

    ws.on('close', () => console.log("Client disconnected"));
});
