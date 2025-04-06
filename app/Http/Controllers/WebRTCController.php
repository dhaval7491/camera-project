<?php

namespace App\Http\Controllers;

use App\Models\IceCandidate;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebRTCController extends Controller
{
    public function initRoom() {
        $room = Room::create([
            'room_id' => uniqid(),
        ]);
        return response()->json($room);
    }

    public function createRoom(Request $request) {
        $room = Room::where('room_id', $request->room_id)->first();
        if (!$room) return response()->json(['error' => 'Room not found'], 404);
        if(!empty($request->offer)){
            $room->update(['offer' => $request->offer]);
        }
        return response()->json($room);
    }

    public function joinRoom(Request $request) {
        $room = Room::where('room_id', $request->room_id)->first();
        if (!$room) return response()->json(['error' => 'Room not found'], 404);
        if(!empty($request->answer)){
            $room->update(['answer' => $request->answer]);
        }
        return response()->json($room);
    }

    public function addCandidate(Request $request) {
        $roomId = Room::where('room_id', $request->room_id)->value('id');
        IceCandidate::create([
            'room_id' => $roomId,
            'type' => $request->type,
            'candidate' => $request->candidate
        ]);
        return response()->json(['message' => 'Candidate added']);
    }

    // public function getRoom($roomId) {
    //     $room = Room::where('room_id', $roomId)->first();
    //     return response()->json($room);
    // }

    public function getRoom() {
        $room = Room::latest()->first();
        return response()->json($room);
    }

    public function getCandidates(Request $request) {
        $roomId = Room::where('room_id', $request->room_id)->value('id');
        $candidates = IceCandidate::where('room_id', $roomId)->where('type',$request->type)->get();
        return response()->json($candidates);
    }
}
