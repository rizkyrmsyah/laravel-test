<?php

namespace App\Http\Controllers;

use App\Enums\UserTypeEnum;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Libraries\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        $credit = 20;
        if ($request->type == UserTypeEnum::premium()) {
            $credit = 40;
        }

        User::create($request->validated() + ['credit' => $credit]);
        return response()->json(['message' => 'Registrasi user berhasil']);
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('phone', '=', $request->phone)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'No HP atau password kurang tepat'], Response::HTTP_UNAUTHORIZED);
        }

        list($jwt, $expire) = Token::jwtEncode($user->id, 'user');

        return response()->json([
            'message' => 'Login user berhasil',
            'data' => [
                'access_token' => $jwt,
                'expire_at' => $expire,
            ],
        ]);
    }

    public function showProfile(Request $request)
    {
        $data = User::find($request->session->id);
        return response()->json(['message' => 'success', 'data' => $data]);
    }
}
