<?php

namespace Digi\Middleware;

use Closure;
use Session;
use Config;
use Log;
use Auth;
use DB;

class SessionExpireMiddleware
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
        $bag = Session::getMetadataBag();
        $max = Config::get('session.lifetime') * 60;

        $session = DB::table("sessions")->where("id", Session::getId())->update(["agent_id" => Auth::user()->id]);

        if ($bag && $max < (time() - $bag->getLastUsed())) {
            // Event::fire('idle.too-long');
            Log::info("Session Expired");
            return redirect()->guest('auth/login');
        }
        return $next($request);
    }
}
