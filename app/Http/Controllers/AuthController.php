<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends Controller
{
    public function login (LoginRequest $request): JsonResponse
    {
        $user = User::where('email', $request->email)
                ->first();

        Log::info(['user' => $user]);

        if(!$user || !Hash::check($request->password, $user->password)){
            throw ValidationException::withMessages([
                'identifier' => trans('auth.failed'),
            ]);
        }

        $user->tokens()->delete();

        return response()->json([
            'user'  => $user,
            'token' => $user->createToken('login')->plainTextToken
        ]);
    }

    public function logout(): JsonResponse
    {
        $user = auth()->user();

        if ($user) {
            $user->currentAccessToken()->delete();
        }

        return response()->json(["message" => "Logged out succesfully"]);
    }
}
