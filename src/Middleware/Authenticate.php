<?php

namespace Digi\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Log;
use Digi\Helpers\LogHelper;

class Authenticate
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
    if ($this->auth->guest()) {
      if ($request->ajax()) {
        LogHelper::logActivityId(gethostname(), __METHOD__, 0, 0, 0, "unauthorized login attempt ".$request->email, 74, 0);
        Log::info("login agent failed ".$request->email);
        return response('Unauthorized.', 401);
      } else {
        return redirect()->guest('auth/login');
      }
    }
    $user = Auth::user();
    if($user->to_logout){
      Log::info("agent should be logged out");
      Auth::logout();
      $user->to_logout = 0;;

      return redirect('/');
    }
    return $next($request);
  }
}
