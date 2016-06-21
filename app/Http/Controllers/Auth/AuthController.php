<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

use Auth;

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
     * @param  array  $data
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
     * @param  array  $data
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
    public function login(Request $request){
        $rules = [
            'username'=>'required | email',
            'password'=>'required'
            ];
        $validator = Validator::make($request->only('username', 'password'), $rules);
        
        if($validator->fails())
            return redirect()->back()->withErrors($validator);
        $auth = Auth::attempt(array(
                    'is_active' => 1,
                    'role_id' => 3,
                    'email' => $request->username,
                    'password' => $request->password));
        if($auth)
            return redirect()->route('home');

        return redirect()->back()->withInput();
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
    public function logout()
    {
        exit; print_r($hait); exit;
    }
}
