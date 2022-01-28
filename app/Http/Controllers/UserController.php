<?php

namespace App\Http\Controllers;

use App\Enums\UserTypeEnum;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;

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
}
