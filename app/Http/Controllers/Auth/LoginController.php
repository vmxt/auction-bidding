<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\ViewPermissions;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use Validator;
use Auth;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        if (Auth::attempt($request->only(['email', 'password']))) {
            if (auth()->user()->active) {
                return $this->sendLoginResponse($request);
            } else {
                auth()->logout();
                return back()->with('error', __('auth.login.inactive_user'));
            }
        }

        return back()->with('error', __('auth.login.incorrect_input'));
    }

    protected function redirectTo()
    {
        
        if (\Auth::user()->role_id == env('SUPPLIER_ID')) {
            if(\Auth::user()->account_updated == 1){
                return route('sms.auth.profile.view',Auth::id());           
            } else {
                return route('sms.auth.profile.edit');
            }
        } else if( \Auth::user()->role_id == env('APPROVER_ID')) {
            return route('approver.dashboard');
        } else if( \Auth::user()->role_id == env('EVALUATOR_ID')) {
            return route('evaluator.dashboard');
        }

        return route('dashboard');
    }

    protected function loggedOut()
    {
        $msg = Session::get('success');

        return redirect()->route('home')->with('msg', $msg);
    }
}
