<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class EquipmentController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'camera_code' => 'required|string',
                'password' => 'required|string',
            ]);

            DB::beginTransaction();

            $equipment = Equipment::where('camera_code', $request->camera_code)->first();

            if (!$equipment || !Hash::check($request->password, $equipment->password)) {
                return response()->json([
                    'message' => 'Invalid camera code or password'
                ], 401);
            }

            if (!$equipment->is_active) {
                return response()->json([
                    'message' => 'Equipment is inactive'
                ], 403);
            }

            // Delete existing tokens to ensure single-device login
            $equipment->tokens()->delete();

            // Create new token
            $token = $equipment->createToken('equipment_auth_token')->plainTextToken;

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Successfully logged in',
                'data' => [
                    'equipment' => $equipment,
                    'access_token' => $token,
                ]
            ]);

        } catch (ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function refresh(Request $request)
    {
        try {
            DB::beginTransaction();

            $equipment = $request->user();
            $equipment->currentAccessToken()->delete();

            $token = $equipment->createToken('equipment_auth_token')->plainTextToken;

            DB::commit();

            return response()->json([
                'message' => 'Token refreshed successfully',
                'data' => [
                    'access_token' => $token,
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'An error occurred during token refresh'
            ], 500);
        }
    }
}
