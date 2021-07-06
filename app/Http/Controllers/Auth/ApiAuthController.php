<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiAuthController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $loginData = $request->validate([
            "email"    => 'required',
            "password" => 'required',
        ]);
        // TODO: login validation in json

        if (!auth()->attempt($loginData)) {
            return response()->json(['error' => "Invalid Credentials"], 401);
        } else {
            $user  = auth()->user();
            $token = $user->createToken('apiToken')->accessToken;
        }
        return response()->json(["user" => $user, "token" => $token]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        $userData             = $request->validate([
            'name'     => 'required',
            'email'    => 'required|unique:users',
            'password' => 'required'
        ]);
        $userData['password'] = bcrypt($request->password);

        // TODO: return validation result in json

        $user  = User::create($userData);
        $token = $user->createToken('apiToken')->accessToken;

        return response()->json(["user" => $user, "token" => $token]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logOut(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();

        return response()->json(["message" => "Log Out Successful"]);
    }
}
