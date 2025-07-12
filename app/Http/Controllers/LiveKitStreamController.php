<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Agence104\LiveKit\AccessToken;
use Agence104\LiveKit\AccessTokenOptions;
use Agence104\LiveKit\VideoGrant;

class LiveKitStreamController extends Controller
{
    private $apiKey;
    private $secretKey;
    private $serverUrl;
    

    public function __construct()
    {
        $this->apiKey = config('services.livekit.api_key');
        $this->secretKey = config('services.livekit.api_secret');
        $this->serverUrl = config('services.livekit.server_url');
    }

    /**
     * Generate token for joining a room
     */
    public function generateToken(Request $request): JsonResponse
    {
        // dd($request);
        $request->validate([
            'room_name' => 'required|string|max:255',
            'participant_name' => 'required|string|max:255',
            'permissions' => 'nullable|array',
        ]);

        try {
            $roomName = $request->room_name;
            $participantName = $request->participant_name;
            $permissions = $request->permissions ?? [];

            // Define the token options
            $tokenOptions = (new AccessTokenOptions())
                ->setIdentity($participantName);

            // Define the video grants
            $videoGrant = (new VideoGrant())
                ->setRoomJoin()
                ->setRoomName($roomName);

            // Set additional permissions if provided
            if (!empty($permissions['canPublish'])) {
                $videoGrant->setCanPublish();
            }

            if (!empty($permissions['canSubscribe'])) {
                $videoGrant->setCanSubscribe();
            }

            if (!empty($permissions['canPublishData'])) {
                $videoGrant->setCanPublishData();
            }

            if (!empty($permissions['canUpdateOwnMetadata'])) {
                $videoGrant->setCanUpdateOwnMetadata();
            }

            if (!empty($permissions['hidden'])) {
                $videoGrant->setHidden();
            }

            if (!empty($permissions['recorder'])) {
                $videoGrant->setRecorder();
            }

            // Generate the token
            $token = (new AccessToken($this->apiKey, $this->secretKey))
                ->init($tokenOptions)
                ->setGrant($videoGrant)
                ->toJwt();

            return response()->json([
                'success' => true,
                'message' => 'LiveKit token generated successfully',
                'data' => [
                    'token' => $token,
                    'server_url' => $this->serverUrl,
                    'room_name' => $roomName,
                    'participant_name' => $participantName,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to generate token: ' . $e->getMessage(),
            ], 400);
        }
    }
}
