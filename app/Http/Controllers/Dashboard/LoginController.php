<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        return view('auth.login');
    }

    public function authenticate(LoginRequest $request)
    {
        $url = config('services.main_api.url') . "/api/owner/login";
        $resp = Http::post($url, [
            'phone' => $request->phone,
            'password' => $request->password,
        ]);
        if ($resp->getStatusCode() != Response::HTTP_OK) {
            return redirect()->route('login')->with('message-error', 'No HP atau Password kurang tepat');
        }

        $resArray = json_decode($resp->body(), true);
        $token = JWT::decode($resArray['data']['access_token'], new Key(base64_encode(config('jwt.secret')), config('jwt.alg')));
        Session::put(['accessToken' => $resArray['data']['access_token'], 'expireAt' => $token->exp]);

        return redirect()->route('property-dashboard.index');
    }

    public function logout()
    {
        Session::forget('accessToken');
        return redirect()->route('login');
    }
}
