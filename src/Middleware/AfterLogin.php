<?php

namespace Digi\Middleware;

use Closure;
use Auth;
use Log;
use App;
use Carbon\Carbon;
use Digi\Models\agent;
use Digi\Helpers\LogHelper;

class AfterLogin
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
        $response = $next($request);
        $application = getenv("APPLICATION");
        if(Auth::check())
        {
            $user = Auth::user();
            if($user->to_logout){
                Log::info("agent should be logged out");
                Auth::logout();
                $user->update(['to_logout' => 0]);

                return redirect('/');
            }
            $agent = agent::find($user->id);
            // PROT-15
            if($agent->active != 1){
                LogHelper::logActivityId(gethostname(), __METHOD__, $user->id, 0, 0, "login attempt by inactive agent", 74, 0);
                Log::info("login attempt by inactive agent ".$request->email);
                Auth::logout();
                throw new \Exception("Access Denied"); 
            }
            // if the user is logging into the dashboard server they must minimally have admin rights
            // if the user is logging into the agent server they must have user rights
            if($application == 'admin' && !$agent->hasRole("ROLE_ADMIN")){
                LogHelper::logActivityId(gethostname(), __METHOD__, $user->id, 0, 0, "admin login failed", 74, 0);
                Log::info("login admin failed ".$request->email);
                Auth::logout();
                throw new \Exception("Access Denied");
            }elseif($application != 'admin' && !$agent->hasRole("ROLE_USER")){   
                LogHelper::logActivityId(gethostname(), __METHOD__, $user->id, 0, 0, "agent login failed", 74, 0);
                Log::info("login agent failed ".$request->email);
                Auth::logout();
                throw new \Exception("Access Denied");
            }
            // log something informative
            if($application == 'admin'){        
                LogHelper::logActivityId(gethostname(), __METHOD__, $user->id, 0, 0, "admin login", 17, 0);
            }else{
                LogHelper::logActivityId(gethostname(), __METHOD__, $user->id, 0, 0, "agent login", 17, 0);
            }
            $agent->agent_available = 0;
            $agent->last_login = Carbon::now();

            $new_sessid   = \Session::getId(); //get new session_id after user sign in
            $last_session = \Session::getHandler()->read($agent->last_sessid); // retrive last session

            if ($last_session) {
                Log::Info("Destroyed  this session: ".$agent->last_sessid);
                if (\Session::getHandler()->destroy($agent->last_sessid)) {
                    // session was destroyed
                }
            }

            $agent->last_sessid = $new_sessid;

            $agent->save();
        }
        return $response;
    }
}