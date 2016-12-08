<?php

namespace Digi\Controllers\Auth;
/*
added for oauth
*/
use Illuminate\Http\Request;
use Socialite;
use Digi\Models\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use DB;
use Log;
use Digi\Models\agent;
use Digi\Helpers\LogHelper;
use Auth;

class AuthController extends Controller
{

    //This fixes the /home problem
    protected $redirectTo = "/";


    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers
    { 
        getLogout as authLogout;
    }
    use ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //    $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'agent_first_name' => 'required|max:255',
            'agent_middle_name' => 'max:255',
            'agent_last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'agency_id' => 'required',
            ]);
    }


    /**
    *   Overwriting logout method to toggle availablity
    */
    public function getLogout(Request $request)
    {
        if(Auth::user() !== null){
            $data = Auth::user();
            agent::where('id', '=', $data->id)->update(["agent_available"=>0]);
            LogHelper::logActivityId(gethostname(), __METHOD__, $data->id, 0, 0, "Last Logout", 18, 0);
        }
        return $this->authLogout();
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return Agent::create([
            'agent_first_name' => $data['agent_first_name'],
            'agent_middle_name' => $data['agent_middle_name'],
            'agent_last_name' => $data['agent_last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'agency_id' => '1',
            ]);
    }

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return Response
     */
    //    public function redirectToProvider()
    //    {
    //        return Socialite::driver('google')->redirect();
    //    }

    /**
     * Obtain the user information from Google.
     *
     * @return Response
     */
    //    public function handleProviderCallback(Request $request)
    //    {
    //        $user = Socialite::driver('google')->user();
    //        $request->session()->put('user', $user);
    //        return redirect("/agent")->with('name','authController')->with('user',$request->session()->get('displayName'))->with('sessionName',$request->session()->get('name'));
    //    }

}
