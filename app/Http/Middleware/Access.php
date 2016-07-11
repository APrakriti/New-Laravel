<?php

namespace App\Http\Middleware;

use App\Facades\AccessFacade;

use Auth;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use App\Models\Role;

class Access
{    
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $access;

    /**
     * Create a new filter instance.
     *
     * @param  Guard $access
     * @return void
     */
    public function __construct(Guard $access)
    {
        $this->access = $access;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $module_slug)
    {
        $role = Role::with('modules')->find(Auth::user()->role_id);
        $access_modules = [];
        foreach ($role->modules as $key => $module) {
            $access_modules[] = $module->slug;
        }
        $request->session()->put('access_modules', $access_modules);

        $flag = AccessFacade::hasAccess($module_slug);

        if ($this->access->guest() || !$flag) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return view('backend.denied');
            }
        }
        return $next($request);
    }
}
