<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterOwnerRequest;
use App\Http\Resources\OwnerResource;
use App\Libraries\Token;
use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class OwnerController extends Controller
{
    public function register(RegisterOwnerRequest $request)
    {
        Owner::create($request->validated());
        return response()->json(['message' => 'Registrasi owner berhasil'], Response::HTTP_CREATED);
    }

    public function login(LoginRequest $request)
    {
        $owner = Owner::where('phone', '=', $request->phone)->first();
        if (!$owner || !Hash::check($request->password, $owner->password)) {
            return response()->json(['message' => 'No HP atau password kurang tepat'], Response::HTTP_UNAUTHORIZED);
        }

        list($jwt, $expire) = Token::jwtEncode($owner->id, RoleEnum::owner());

        return response()->json([
            'message' => 'Login owner berhasil',
            'data' => [
                'access_token' => $jwt,
                'expire_at' => $expire,
            ],
        ]);
    }

    public function showProfile(Request $request)
    {
        $data = Owner::find($request->session->id);
        return new OwnerResource($data);
    }
}
