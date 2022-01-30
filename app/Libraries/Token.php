<?php
namespace App\Libraries;

use \Firebase\JWT\JWT;

class Token
{
    public static function jwtEncode($id, $role) {
        $key       = base64_encode(config('jwt.secret'));
        $tokenId   = base64_encode(uniqid(32));
        $issuedAt  = time();
        $notBefore = $issuedAt + config('jwt.nbf');
        $expire    = $notBefore + config('jwt.exp');

        $token = [
            "jti"  => $tokenId,
            "iss"  => config('jwt.iss'),
            "iat"  => $issuedAt,
            "nbf"  => $notBefore,
            'exp'  => $expire,
            'data' => [
                'id'   => $id,
                'env' => config('app.env'),
                'role' => $role,
            ],
        ];
        JWT::$leeway = 5;
        $jwt = JWT::encode($token, $key, config('jwt.alg'));
        return [$jwt, $expire];
    }
}
