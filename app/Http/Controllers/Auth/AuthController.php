<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Input;

use Auth;
use Redirect;

class AuthController extends Controller
{
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

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Get user login form
     *
     * @param Illuminate\Http\Request
     * @return Redirect
     */
    public function login(Request $request)
    {
        $rules = [
            'username' => 'required | email',
            'password' => 'required'
        ];
        $validator = Validator::make($request->only('username', 'password'), $rules);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator);


        if (Auth::attempt([
            'is_active' => 1,
            'role_id' => 3,
            'email' => $request->username,
            'password' => $request->password
        ])
        ) {
            $backUrl = Input::get('backUrl');

            if ($backUrl) {

                return Redirect::to($backUrl);

            } else {

                return redirect()->route('home');
            }


        } else {

            $checkRegister = User::where('email', $request->username)->whereNotNull('verify_token')->first();

            if ($checkRegister) {
                return redirect()->back()->withInput()->with('status', 'error')
                    ->with('message', 'Your account has not been activated. please check your email to activate your account.');

            } else {
                return redirect()->back()->withInput()->with('status', 'error')
                    ->with('message', 'Invalid username or password. Please try again.');
            }


        }
    }

    /**
     * Get user login form
     *
     * @return Illuminate\View\View
     */
    public function getLogin()
    {
        return view('frontend.login');
    }

    /**
     * logout user
     *
     * @return Redirect
     */
    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
