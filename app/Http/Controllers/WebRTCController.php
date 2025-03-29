<?php

namespace App\Http\Controllers;

use App\Models\IceCandidate;
use App\Models\Room;
use Illuminate\Http\Request;

class WebRTCController extends Controller
{
    public function createRoom(Request $request) {
        $room = Room::create([
            'room_id' => uniqid(),
            'offer' => $request->offer
        ]);
        return response()->json($room);
    }

    public function joinRoom(Request $request) {
        $room = Room::where('room_id', $request->room_id)->first();
        if (!$room) return response()->json(['error' => 'Room not found'], 404);

        $room->update(['answer' => $request->answer]);
        return response()->json(['message' => 'Answer saved']);
    }

    public function addCandidate(Request $request) {
        IceCandidate::create([
            'room_id' => $request->room_id,
            'type' => $request->type,
            'candidate' => $request->candidate
        ]);
        return response()->json(['message' => 'Candidate added']);
    }

    public function getRoom($roomId) {
        $room = Room::where('room_id', $roomId)->first();
        return response()->json($room);
    }

    public function getCandidates($roomId) {
        $candidates = IceCandidate::where('room_id', $roomId)->get();
        return response()->json($candidates);
    }
}
