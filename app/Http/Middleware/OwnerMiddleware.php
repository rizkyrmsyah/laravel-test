<?php

namespace App\Http\Middleware;

use App\Enums\RoleEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class OwnerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $jwt = $request->bearerToken();
        if (empty($jwt)) {
            return response()->json(['message' => 'Unauthorize'], Response::HTTP_UNAUTHORIZED);
        }

        $token = JWT::decode($jwt, new Key(base64_encode(config('jwt.secret')), config('jwt.alg')));
        if ($token->data->env !== config('app.env')) {
            return response()->json(['message' => 'Invalid token environment'], Response::HTTP_UNAUTHORIZED);
        }

        if ($token->data->role !== RoleEnum::owner()->value) {
            return response()->json(['message' => 'Unauthorize'], Response::HTTP_UNAUTHORIZED);
        }

        $request->merge(['session' => $token->data]);

        return $next($request);
    }
}
