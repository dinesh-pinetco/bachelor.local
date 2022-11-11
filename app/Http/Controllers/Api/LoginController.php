<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        if (! Auth::attempt($request->only('email', 'password')) || auth()->user()->hasRole(ROLE_APPLICANT)) {
            return response()->json(['message' => __('auth.failed')], 401);
        }

        $user = auth()->user();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['message' => 'Hallo '.$user->first_name.', willkommen bei NORDAKADEMIE', 'access_token' => $token, 'token_type' => 'Bearer']);
    }

    // method for user logout and delete token
    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return response()->json(['message' => __('User logout successfully.')]);
    }
}
