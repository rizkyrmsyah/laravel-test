<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterOwnerRequest;
use App\Models\Owner;

class OwnerController extends Controller
{
    public function register(RegisterOwnerRequest $request)
    {
        Owner::create($request->validated());
        return response()->json(['message' => 'Registrasi owner berhasil']);
    }
}
