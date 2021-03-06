<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Customer
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->guest() || (Auth::user()->user_type != '3' )) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('member/login');
            }
        }
        return $next($request);
    }
}
//         if ($this->auth->guest() || $this->auth->user()->role_id != 3) {
//             if ($request->ajax()) {
//                 return response('Unauthorized.', 401);
//             } else {
//                 return redirect()->route('login');
//             }
//         }
//         $response = $next($request);
//         // $response->headers->set('Cache-Control','nocache, no-store, max-age=0, must-revalidate');
//         // $response->headers->set('Pragma','no-cache');
//         // $response->headers->set('Expires','Fri, 01 Jan 2016 00:00:00 GMT');
//         return $response;
//     }
// }
