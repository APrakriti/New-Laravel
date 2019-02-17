<?php namespace App\Http\Controllers\Admin;

use App\Classes\Email;
use App\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Input;
use App\UserType;
use App\Http\Controllers\Controller;

use Validator;

/**
 * @author Kokil Thapa <thapa.kokil@gmail.com>
 */
class UsersController extends Controller
{

    public function index()
    {   
        $users = User::where('user_type','!=','5')->get();
        return view('modules.users.admin.user_list')->with(array('users' => $users));
    }

    public function changeStatus()
    {
        $rules = ['id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);
        }

        try {
            $objectUser = User::findOrFail(Input::get('id'));
            if ($objectUser->is_active == '1') {
                $objectUser->is_active = '0';
                $message = 'User suspended successfully.';
            } else {
                $objectUser->is_active = '1';
                $message = 'User activated successfully.';
            }
            $objectUser->save();

            return response()->json(['status' => true, 'message' => $message, 'is_active' => $objectUser->is_active]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => 'Oops something went wrong. Please try again later']);
        }
    }

    public function delete()
    {
        $rules = ['id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);

        try {
            User::findOrFail(Input::get('id'))->delete();
            return response()->json(['status' => true, 'message' => 'User deleted successfully.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => 'Access denied.']);
        }
    }

    public function changePasswordRequest()
    {
        return view('modules.users.admin.change_password');
    }

    public function changePassword()
    {
        $user = Auth::user();

        $rules = array(
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            if (Hash::check(Input::get('old_password'), $user->password)) {
                $user->password = bcrypt(Input::get('password'));
                $user->save();
                return redirect()->route('admin.users.change_password')->withInput()->with('success', 'Password changed successfully.');

            } else {
                return redirect()->route('admin.users.change_password')->withInput()->with('error', 'Old Password doesnot match - please try again.');
            }
        }
    }

    public function updateProfileRequest()
    {
        $user = Auth::user();
        return view('modules.users.admin.profile')->with(array('user' => $user));
    }

    public function updateProfile()
    {
        $rules = array(
            'first_name' => 'required',
            'last_name' => 'required',
        );
        $messages = [
            'first_name.required' => 'First Name is required.',
            'last_name.required' => 'Last Name is required.',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $objectUser = Auth::user();
            $objectUser->first_name = Input::get('first_name');
            $objectUser->last_name = Input::get('last_name');
            $objectUser->full_name = Input::get('first_name') . ' ' . Input::get('last_name');
            if (Input::file('attachment')) {
                $destinationPath = 'uploads/users';
                $extension = Input::file('attachment')->getClientOriginalExtension();
                $fileName = 'users_' . str_random(20) . '.' . $extension;
                Input::file('attachment')->move($destinationPath, $fileName);
                $objectUser->attachment = $fileName;
            }
            $objectUser->save();
            if ($objectUser->id) {
                return redirect()->route('admin.users.profile')->withInput()->with('success', 'Profile updated successfully.');
            } else {
                return redirect()->route('admin.users.profile')->withInput()->with('error', 'Oops something went worng. Please try again later.');
            }
        }

    }

    public function add()
    {
        $userType = UserType::where('is_active', '1')->where('id', '!=', '1')->pluck('user_type_name', 'id')->toArray();
        return view('modules.users.admin.add')->with('userType' , $userType);
    }

    public function create(Request $request)
    {
        $rules = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'user_types' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $password = substr(str_shuffle('aAbBcCdDEeEfFgGhHiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYzZ0123456789'), 0, 10);
            $objectUser = new User();
            $objectUser->user_type = trim(Input::get('user_types'));
            $objectUser->first_name = trim(Input::get('first_name'));
            $objectUser->last_name = trim(Input::get('last_name'));
            $objectUser->username = trim(Input::get('username'));
            $objectUser->email = trim(Input::get('email'));
            $objectUser->password = Hash::make($password);
            $objectUser->is_active = trim(Input::get('is_active'));
         
          // dd($request->all());
            $objectUser->save();

            if ($objectUser->id) {

                $receiverEmail = $objectUser->email_address;
                $subject = "Your account is created.";
                $content = '<br>Your account on Druk is created by <strong>' . Auth::user()->email . '</strong>.<br>';
                $content .= '<br>Your login details are as follows<br>';
                $content .= '<br>Username = ' . $objectUser->email . '<br>';
                $content .= '<br>Password = ' . $password . '<br>';

                $email = Email::sendEmail($receiverEmail, $subject, $content);

                return redirect()->route('admin.users.index')->withInput()->with('success', 'User created successfully. And Login credential has been emailed');
            } else {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
    }

}