<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Validator;
use Auth;

class UserController extends Controller
{
    public function getLogin()
    {
        return view('backend.login');
    }

    public function postLogin(Request $request){
        $rules = ['username'=>'required', 'password'=>'required'];
        $validator = Validator::make($request->only('username', 'password'), $rules);
        
        if($validator->fails())
            return redirect()->back()->withErrors($validator);

        $auth = Auth::attempt(array(
                    'email' => $request->username,
                    'password' => $request->password));
        if($auth)
            return redirect()->route('admin.dashboard');

        return redirect()->back()->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo 'here';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
