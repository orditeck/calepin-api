<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\User;
use App\Http\Resources\UserResource;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(StoreUserRequest $request)
    {
        $user = User::create([
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'email'         => $request->email,
            'password'      => $request->password
        ]);

        return $this->respondWithToken($user);
    }

    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        $user = User::where('email', $request->input('email'))->first();
        return $this->respondWithToken($user);
    }

    protected function respondWithToken($user)
    {
        return (new UserResource($user))
            ->additional([
                'meta' => [
                    'access_token' => $user->api_token
                ]
            ]);
    }
}
