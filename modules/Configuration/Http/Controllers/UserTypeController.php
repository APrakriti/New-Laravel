<?php namespace Modules\Configuration\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

use Modules\Configuration\Entities\UserType;
use Modules\Configuration\Entities\Module;
use Modules\Configuration\Entities\AccessList;

use App\Classes\Email;

use Input;
use Validator;
use Auth;

/**
* @auther Sunil Adhikari <adhikarysunil.1@gmail.com>
*/

class UserTypeController extends Controller
{
	public function index()
	{
		$user_types = UserType::paginate(10);
		return view('configuration::usertype.index')->with('user_types', $user_types);
	}	

	public function add()
	{
		return view('configuration::usertype.add');
	}

	public function create()
	{
		$rules = ['user_type_name' =>'required | unique:user_types'];
		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

		$objectUserType = new UserType();
		$objectUserType->user_type_name = trim(Input::get('user_type_name'));
		$objectUserType->save();
		
		$modules = Module::get();
		foreach($modules as $module){
			$access = 0;
			$insertArray[] = [
				'user_type'	=> $objectUserType->id,
				'module_id'	=> $module->id,
				'access_view'	=> $access,
				'access_add'	=> $access,
				'access_publish'	=> $access,
				'access_update'	=> $access,
				'access_delete'	=> $access,
				'access_trash'	=> $access,
				'access_reterive'	=> $access,
				'is_active'	=> 1,
				'created_at'	=> date("Y-m-d H:i:s"),
				'updated_at'	=> date("Y-m-d H:i:s")															
			];
		}

		AccessList::insert($insertArray);

		return redirect()->route('admin.usertypes')->with('message', 'User type created successfully!');
	}

	public function edit($id)
	{
		try{
			$userType = UserType::where('id', '>', 3)->findOrFail($id);
			return view('configuration::usertype.edit')->with('userType', $userType);
		} catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
			return view('admin/denied');
		}
	}

	public function update($id)
	{
		$rules = ['id'=>'required','user_type_name' =>'required | unique:user_types'];
		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

		try{
			$objectUserType = UserType::where('id', '>', 3)->findOrFail(Input::get('id'));
			$objectUserType->user_type_name = trim(Input::get('user_type_name'));
			$objectUserType->save();
			return redirect()->route('admin.usertypes')->with('message', 'User type updated successfully!');
		} catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
			return view('admin/denied');
		}
	}

	public function delete()
	{
		$rules = ['id'=>'required'];
		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails())
			return response()->json(['status'=>false, 'message'=>$validator->errors()->all() ]);
		
		try{
			$objectUserType = UserType::where('id', '>', 3)->findOrFail(Input::get('id'))->delete();
			return response()->json(['status'=>true, 'message'=>'User type deleted successfully.']);
		} catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
			return response()->json(['status'=>false, 'message'=>'Access denied.']);
		}
	} 

	public function changeStatus()
	{
		$rules = ['id'=>'required'];
		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()){
			return response()->json(['status'=>false, 'message'=>$validator->errors()->all() ]);
		}
		
		try{
			$objectUserType = UserType::where('id', '>', 3)->findOrFail(Input::get('id'));
			if($objectUserType->is_active == 1){
				$objectUserType->is_active = 0;
				$message = 'User type unpublished successfully.';
			} else {
				$objectUserType->is_active = 1;
				$message = 'User type published successfully.';
			}
			$objectUserType->save();

			return response()->json(['status'=>true, 'message'=>$message, 'is_active'=>$objectUserType->is_active ]);
		} catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
			return response()->json(['status'=>false, 'message'=>Input::get('id') ]);
		}
	} 

	/**
	* get access lists user type wise 
	*
	* @param $id int
	* @return Illuminate\View\View
	*/
	public function accesslist($id)
	{
		$usertype = UserType::with(['modules'=> function($query){
			$query->where('modules.id', '<>', 2);
			$query->where('modules.is_active', 1);
		}])->find($id);
		
		return view('configuration::usertype.accesslist')->with('usertype', $usertype);
	}

	/**
	* change access of usertype on module action
	*
	* @return JSON
	*/
	public function changeAccess()
	{
		$objectAccessList = AccessList::find(Input::get('id'));

		$column = Input::get('column_name');
		$words = explode("_", $column);
		$module = Module::find($objectAccessList->module_id);

		if($objectAccessList->$column == 0) {
			$objectAccessList->$column = 1;
			$message = ucfirst($words[1]) .' '. $words[0] . ' has given for '.
						strtolower($module->module_name) .' section.';
		} else {
			$objectAccessList->$column = 0;
			$message = ucfirst($words[1]) .' '. $words[0] . ' has denied for '.
						strtolower($module->module_name) .' section.';
		}
		$objectAccessList->save();

		return response()->json(['status'=>true, 'message'=>$message, 'access'=>$objectAccessList]);
	}

	public function trashes()
	{
		$user_types = UserType::onlyTrashed()->paginate(10);
		return view('configuration::usertype.trash')->with('user_types', $user_types);
	}

	public function reterive()
	{
		$rules = ['id'=>'required'];
		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails())
			return response()->json(['status'=>false, 'message'=>$validator->errors()->all() ]);
		
		try{
			$objectUserType = UserType::onlyTrashed()
								->where('id', '>', 3)
								->findOrFail(Input::get('id'))
								->restore();
			$userType = UserType::findOrFail(Input::get('id'));
			return response()->json(['status'=>true, 'message'=>'User type '. $userType->user_type_name .' is reterived successfully.']);
		} catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
			return response()->json(['status'=>false, 'message'=>'Access denied.']);
		}
	} 
	
}