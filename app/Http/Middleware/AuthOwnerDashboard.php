<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthOwnerDashboard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $time = Session::get('expireAt');
        $mytime = Carbon::now();

        if (Session::get('accessToken') !== null) {
            if ($mytime->toDateTimeString() >= date('Y-m-d H:i:s', $time)) {
                Session::forget('accessToken');
                return redirect()->route('login');
            }
        }

        if (Session::get('accessToken') === null) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
