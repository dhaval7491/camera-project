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
                    endpoint = 'join-room';
                    payload = { room_id: data.room_id, answer: data.answer };
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

            ws.send(JSON.stringify(response.data));
        } catch (error) {
            console.error('Error processing event:', error);
            ws.send(JSON.stringify({ error: 'Internal server error' }));
        }
    });

    ws.on('close', () => console.log("Client disconnected"));
});
