<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Classes\Helper;
use App\User;
use Validator;

class UserController extends Controller
{
    
    /**
     * Display a signup form.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
       return view('frontend.register'); 
    }

    /**
     * Display a signup form.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function registration(Request $request)
    {
        $rules = [
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6',
            'confirm_password'=>'required|same:password'
            ];
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
            return redirect()->back()->withErrors($validator);
        
        $user = new User();
        $user->role_id = 3;
        $user->first_name = $request->first_name; 
        $user->last_name = $request->last_name; 
        $user->email = $request->email; 
        $user->password = bcrypt($request->password);
        $user->verify_token = substr(str_shuffle('aAbBcCdDEeEfFgGhHiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYzZ0123456789'), 0, 60);
        $user->save();

        if($user){
            $receiver = env('ADMIN_EMAIL');
            $subject = "New user is registered.";
            $content = 'Dear Admin, <br /><br /> Customer with email address <strong>' . $user->email .
                        '</strong> is registered </strong>.<br>';

            $email = Helper::sendEmail($receiver, $subject, $content);

            $receiver = $user->email;
            $subject = "Activate your account";

            $content = 'Dear '.$user->first_name.' '.$user->last_name .',<br ><br >Thanks for signing up for '.env('SITE_NAME').'.<br />Please confirm your email address by clicking on the link below.<br />';
            $content .= ' <a href="'.route('verify', $user->verify_token) . '" target="_blank">Confirm email</a>';
            $email = Helper::sendEmail($receiver, $subject, $content);
            
            return redirect()->route('login')
                        ->with('status', 'success')
                        ->with('message','We just send an email to your email. Please verify your account.');
        } else {
            return redirect()->back()
                    ->withInput()
                    ->with('status', 'error')
                    ->with('message','Server Error.');
        }
    }

    public function verify($token)
    {
        $user = User::where('verify_token', $token)->first();
        if($user){
            $user->is_active = 1;
            $user->verify_token = NULL;
            $user->save();

            $receiver = $user->email;
            $subject = "Your account is activated.";

            $content = 'Dear '.$user->first_name.' '.$user->last_name .',<br ><br >Thanks for activating your account for '.env('SITE_NAME')
                        .'.<br />Now you can login and book packages with '.env('SITE_NAME').'<br />';
            $email = Helper::sendEmail($receiver, $subject, $content);
            
            return redirect()->route('login')
                            ->with('status', 'success')
                            ->with('message', 'You are successfully activated with '.env('SITE_NAME') .'.');
        } else {
            return redirect()->route('login')
                            ->with('status', 'error')
                            ->with('message', 'Your verification token seems expired or do not exists.');
        }
    } 
}
