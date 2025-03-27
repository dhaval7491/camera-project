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
        const data = JSON.parse(message);
        console.log("Received event:", data);

        // Forward event to Laravel API
        try {
            await axios.post(`${API_URL}/video-event`, data);
            console.log("Event sent to Laravel successfully");
        } catch (error) {
            console.error("Error sending event to Laravel:", error.message);
        }
    });

    ws.on('close', () => console.log("Client disconnected"));
});
