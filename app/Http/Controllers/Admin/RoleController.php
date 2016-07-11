<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Role;
use App\Models\Module;
use Validator;
use Auth;
use Session;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::get();
        return view('backend.role.index')
                ->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.role.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = ['heading'=>'required'];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator);
        
        $role = new Role();
        $role->role = $request->heading;
        
        $role->save();

        return redirect()->route('admin.roles');
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
        $role = Role::findOrFail($id);
        return view('backend.role.edit')
                ->with('role', $role);
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
        $rules = ['heading'=>'required'];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator);
        
        $role = Role::find($id);
        $role->role = $request->heading;
        $role->save();

        return redirect()->route('admin.roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $rules = ['role_id'=>'required|min:4|exists:roles,id'];
        $validator = Validator::make($request->only('role_id'), $rules);
        if($validator->fails())
            return response()->json(['status'=>'error', 'message'=>$validator->errors()->all()], 422);
        
        $role = Role::find($request->role_id); 
        $role->modules()->detach();       
        $role->delete();
        $message = 'Your role is deleted successfully.';
        return response()->json(['status'=>'ok', 'message'=>$message, 'role'=>$role], 200);
    }

    public function accessModules($id)
    {
        $modules = Module::get();
        $role = Role::with('modules')->findOrFail($id);
        $accessedModules = [];
        foreach ($role->modules as $key => $module) {
            $accessedModules[] = $module->id;
        }
        return view('backend.role.accesslist')
                ->with('modules', $modules)
                ->with('role', $role)
                ->with('accessedModules', $accessedModules);
    }

    public function changeAccess(Request $request)
    {
        $rules = [
            'role_id'=>'required|exists:roles,id',
            'module_id'=>'required|exists:modules,id',
            ];
        $validator = Validator::make($request->only('role_id', 'module_id'), $rules);
        if($validator->fails())
            return response()->json(['status'=>'error', 'message'=>$validator->errors()->all()], 422);
        
        $message = '';
        $role = Role::findOrFail($request->role_id);
        $module = Module::findOrFail($request->module_id);
        $exist = $role->modules->contains($request->module_id);
        if($exist){
            $role->modules()->detach($request->module_id);
            $message = $role->role . " has denied access to ". $module->module .'.';
            $type = 'denied';
        } else {
            $role->modules()->attach($request->module_id);
            $message = $role->role . " has given access to ". $module->module .'.';
            $type = 'given';
        }

        return response()->json(['status'=>'ok', 'type'=>$type, 'message'=>$message], 200);
    }
}
