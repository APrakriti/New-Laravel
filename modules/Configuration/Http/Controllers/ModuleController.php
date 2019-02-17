<?php namespace Modules\Configuration\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

use Modules\Configuration\Entities\Module;
use Modules\Configuration\Entities\UserType;
use Modules\Configuration\Entities\AccessList;

use Input;
use Validator;

class ModuleController extends Controller
{

    public function index()
    {
        $modules = Module::paginate(10);
        return view('configuration::module.index')->with('modules', $modules);
    }

    public function add()
    {
        return view('configuration::module.add');
    }

    public function create()
    {
        $rules = ['module_name' => 'required | unique:modules'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $objectModule = new Module();
        $objectModule->module_name = trim(Input::get('module_name'));
        $objectModule->save();

        $usertypes = UserType::where('id', '<>', 3)->get();
        foreach ($usertypes as $usertype) {
            $access = ($usertype->id == 1 || $usertype->id == 2) ? 1 : 0;
            $insertArray[] = [
                'user_type' => $usertype->id,
                'module_id' => $objectModule->id,
                'access_view' => $access,
                'access_add' => $access,
                'access_publish' => $access,
                'access_update' => $access,
                'access_delete' => $access,
                'access_trash' => $access,
                'access_reterive' => $access,
                'is_active' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];
        }
        AccessList::insert($insertArray);

        return redirect()->route('admin.modules');
    }

    public function changeStatus()
    {
        $rules = ['id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);
        }

        try {
            $objectModule  = Module::findOrFail(Input::get('id'));
            if ($objectModule->is_active == 1) {
                $objectModule->is_active = 0;
                $message = 'Module type unpublished successfully.';
            } else {
                $objectModule->is_active = 1;
                $message = 'Module published successfully.';
            }
            $objectModule->save();

            return response()->json(['status' => true, 'message' => $message, 'is_active' => $objectModule->is_active]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => Input::get('id')]);
        }
    }

}