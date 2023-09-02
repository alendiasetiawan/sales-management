<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request) {
        $input = $request->all();

        if(auth()->attempt(array('email'=>$input['email'],'password'=>$input['password']))){
            if(auth()->user()->role_id==1) {
                if($request->has('simpanpwd')) {
                    Cookie::queue('saveuser',$request->email,20160);
                    Cookie::queue('savepwd',$request->password,20160);
                }
                return redirect()->route('sales::dashboard_sales');
            }
            elseif(auth()->user()->role_id==2) {
                if($request->has('simpanpwd')) {
                    Cookie::queue('saveuser',$request->email,20160);
                    Cookie::queue('savepwd',$request->password,20160);
                }
                return redirect()->route('salesmanager::dashboard_sales_manager');
            }
            else {
                if($request->has('simpanpwd')) {
                    Cookie::queue('saveuser',$request->email,20160);
                    Cookie::queue('savepwd',$request->password,20160);
                }
                return redirect()->route('/');
            }
        } else {
            return redirect()->route('login')->with('flash_message_error','GAGAL Login, NIP/Password Salah!');
        }
    }

    public function redirect() {
        return redirect()->route('login');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
