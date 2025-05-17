<?php

namespace App\Http\Controllers;

use Kreait\Firebase\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SignalingController extends Controller
{
    protected $firestore;

    public function __construct()
    {
        Log:info(config('firebase.credentials'));
        $this->firestore = (new Factory)
            ->withServiceAccount('/Applications/XAMPP/xamppfiles/htdocs/Projects/camera-app/storage/app/firebase/credentials.json')
            ->createFirestore()
            ->database();
    }

    // Get room data (offer SDP)
    public function getRoom($roomId)
    {
        try {
            $roomRef = $this->firestore->collection('rooms')->document($roomId);
            $snapshot = $roomRef->snapshot();

            if (!$snapshot->exists()) {
                return response()->json(['error' => 'Room not found'], 404);
            }

            $data = $snapshot->data();
            return response()->json([
                'offer' => $data['offer'] ?? null,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Set answer SDP
    public function setAnswer(Request $request, $roomId)
    {
        $request->validate([
            'sdp' => 'required|string',
            'type' => 'required|string|in:answer',
        ]);

        try {
            $roomRef = $this->firestore->collection('rooms')->document($roomId);
            $roomRef->set([
                'answer' => [
                    'sdp' => $request->input('sdp'),
                    'type' => $request->input('type'),
                ]
            ], ['merge' => true]);

            return response()->json(['message' => 'Answer set successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Add callee ICE candidate
    public function addCalleeCandidate(Request $request, $roomId)
    {
        $request->validate([
            'candidate' => 'required|string',
            'sdpMid' => 'required|string',
            'sdpMLineIndex' => 'required|integer',
        ]);

        try {
            $candidateRef = $this->firestore->collection('rooms')
                ->document($roomId)
                ->collection('calleeCandidates')
                ->newDocument();

            $candidateRef->set([
                'candidate' => $request->input('candidate'),
                'sdpMid' => $request->input('sdpMid'),
                'sdpMLineIndex' => $request->input('sdpMLineIndex'),
            ]);

            return response()->json(['message' => 'ICE candidate added successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getCallerCandidates($roomId)
    {
        try {
            $candidatesRef = $this->firestore->collection('rooms')
                ->document($roomId)
                ->collection('callerCandidates');
            $snapshot = $candidatesRef->documents();

            $candidates = [];
            foreach ($snapshot as $doc) {
                $candidates[] = $doc->data();
            }

            return response()->json($candidates);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
