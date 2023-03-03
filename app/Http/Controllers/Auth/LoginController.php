<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use DB;
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

    public function logout(Request $request) {
      auth()->logout();
      return redirect('/login')->with('status', 'You have been logged out');
    }

    public function routeApiUser (Request $request) {
        return $request->user();
    }
    
    protected function authenticated(Request $request, $user)
    {
        $user_division = DB::table('commonlibrariesdb.pcaarrd_divisions')->where('id', $user->division)->pluck('division_acronym')->first();

        $request->session()->put('user_division', $user_division);
    }

}
