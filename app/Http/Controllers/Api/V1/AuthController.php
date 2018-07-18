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
        $user = User::create($request->only(['first_name', 'last_name', 'email', 'password']));
        return $this->respondWithToken($user);
    }

    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json(['errors' => ['Invalid credentials']], 422);
        }

        $user = User::where('email', $request->input('email'))->first();
        (clone $user)->update(['last_login' => now()]);
        return $this->respondWithToken($user);
    }

    protected function respondWithToken($user)
    {
        return (new UserResource($user))->additional([
            'meta' => ['access_token' => $user->api_token]
        ]);
    }
}
