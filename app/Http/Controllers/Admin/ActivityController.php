<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Activity;
use Validator;
use Auth;
use Session;

use App\Events\LogCreated;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $activities = Activity::orderBy('order_position')->get();
        return view('backend.activity.index')
                ->with('activities', $activities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.activity.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = ['heading'=>'required',
                    'description'=>'required'
                ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator);
        
        $imageFile = $request->attachment;
        $activityPath = 'uploads/activities/';
        $rEFileTypes = "/^\.(jpg|jpeg|gif|png){1}$/i";
        $maximum_filesize = 1 * 1024 * 1024;
                
        if($imageFile) {
            $filename = $imageFile->getClientOriginalName();
            $extension = strrchr($filename, '.');
            $size = $imageFile->getSize();                  
            $new_image_name = "activity_" . time();
                    
            if ($size <= $maximum_filesize && preg_match($rEFileTypes, $extension)) {
                $attachment = $imageFile->move($activityPath, $new_image_name.$extension);
            } else if (preg_match($rEFileTypes, $extension) == false) {
                Session::flash('class', 'alert alert-error');
                Session::flash('message', 'Warning : Invalid Image File!');
            } else if ($size > $maximum_filesize) {
                Session::flash('class', 'alert alert-error');
                Session::flash('message', "Warning : The size of the image shouldn't be more than 1MB!");
            }               
        }
        $logo = isset($attachment) ? $new_image_name . $extension : NULL;
        
        $activity = new Activity();
        $activity->heading = $request->heading;
        $activity->description = $request->description;
        $activity->title = $request->title;
        $activity->meta_tags = $request->meta_tags;
        $activity->meta_description = $request->meta_description;
        $activity->created_by = Auth::id();
        $activity->is_active = $request->is_active;

        if($logo)
            $activity->attachment = $logo;     
        $activity->save();

        $user = Auth::user();
        $message = 'Activity with heading "'. $activity->heading.'" is added.';
        event(new LogCreated($user, $message));

        return redirect()->route('admin.activities')
                        ->with('status', 'success')
                        ->with('message', $message);
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
        $activity = Activity::findOrFail($id);
        return view('backend.activity.edit')
                ->with('activity', $activity);
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
        $rules = ['heading'=>'required',
                    'description'=>'required'
                ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator);
        
        $imageFile = $request->attachment;
        $activityPath = 'uploads/activities/';
        $rEFileTypes = "/^\.(jpg|jpeg|gif|png){1}$/i";
        $maximum_filesize = 1 * 1024 * 1024;
                
        if($imageFile) {
            $filename = $imageFile->getClientOriginalName();
            $extension = strrchr($filename, '.');
            $size = $imageFile->getSize();                  
            $new_image_name = "activity_" . time();
                    
            if ($size <= $maximum_filesize && preg_match($rEFileTypes, $extension)) {
                $attachment = $imageFile->move($activityPath, $new_image_name.$extension);
            } else if (preg_match($rEFileTypes, $extension) == false) {
                Session::flash('class', 'alert alert-error');
                Session::flash('message', 'Warning : Invalid Image File!');
            } else if ($size > $maximum_filesize) {
                Session::flash('class', 'alert alert-error');
                Session::flash('message', "Warning : The size of the image shouldn't be more than 1MB!");
            }               
        }
        $logo = isset($attachment) ? $new_image_name . $extension : NULL;
        
        $activity = Activity::find($id);
        $activity->heading = $request->heading;
        $activity->description = $request->description;
        $activity->title = $request->title;
        $activity->meta_tags = $request->meta_tags;
        $activity->meta_description = $request->meta_description;
        $activity->updated_by = Auth::id();
        $activity->is_active = $request->is_active;

        if($logo){
            if(file_exists('uploads/activities/'.$activity->attachment) && $activity->attachment!='')
                unlink('uploads/activities/'.$activity->attachment);
            $activity->attachment = $logo;     
        }    
        $activity->save();

        $user = Auth::user();
        $message = 'Activity with heading "'. $activity->heading.'" is updated.';
        event(new LogCreated($user, $message));

        return redirect()->route('admin.activities')
                        ->with('status', 'success')
                        ->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $rules = ['activity_id'=>'required|exists:activities,id'];
        $validator = Validator::make($request->only('activity_id'), $rules);
        if($validator->fails())
            return response()->json(['status'=>'error', 'message'=>$validator->errors()->all()], 422);
        
        $activity = Activity::find($request->activity_id);
        if(file_exists("uploads/activities/".$activity->attachment) && $activity->attachment!=''){
            rename('uploads/activities/'. $activity->attachment, 'uploads/activities/trash/'. $activity->attachment);
        }
        $activity->delete();

        $user = Auth::user();
        $message = 'Activity with heading "'. $activity->heading.'" is deleted.';
        event(new LogCreated($user, $message));

        $message = 'Your activity is deleted successfully.';
        return response()->json(['status'=>'ok', 'message'=>$message, 'activity'=>$activity], 200);
    }

    /**
     * Change status of the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        $rules = ['activity_id'=>'required|exists:activities,id'];
        $validator = Validator::make($request->only('activity_id'), $rules);
        if($validator->fails())
            return response()->json(['status'=>'error', 'message'=>$validator->errors()->all()], 422);
        
        $activity = Activity::find($request->activity_id);
        $message = '';
        if($activity->is_active == 0){
            $activity->is_active = 1;
            $message = 'Activity with heading "'.$activity->heading.'" is published.';
        } else {
            $activity->is_active = 0;
            $message = 'Activity with heading "'.$activity->heading.'" is unpublished.';
        }
        $activity->save();

        $user = Auth::user();
        event(new LogCreated($user, $message));

        return response()->json(['status'=>'ok', 'message'=>$message, 'activity'=>$activity], 200);
    }

    /**
     * Remove the attachment of specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroyAttachment(Request $request)
    {
        $rules = ['activity_id'=>'required|exists:activities,id'];
        $validator = Validator::make($request->only('activity_id'), $rules);
        if($validator->fails())
            return response()->json(['status'=>'error', 'message'=>$validator->errors()->all()], 422);
        
        $activity = Activity::find($request->activity_id);
        if(file_exists("uploads/activities/".$activity->attachment) && $activity->attachment!=''){
            unlink('uploads/activities/'. $activity->attachment);
        }
        $activity->attachment = null;
        $activity->save();

        $user = Auth::user();
        $message = 'Attachment of activity with heading "'. $activity->heading .'" is deleted.';
        event(new LogCreated($user, $message));
        
        $message = 'Your activity attachment is deleted successfully.';
        return response()->json(['status'=>'ok', 'message'=>$message, 'activity'=>$activity], 200);
    }

    /**
     * sort orders of the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sortOrder(Request $request)
    {
        $rules = ['activities'=>'required'];
        $validator = Validator::make($request->only('activities'), $rules);
        if($validator->fails())
            return response()->json(['status'=>'error', 'message'=>$validator->errors()->all()], 422);
        
        $activities = explode('&',str_replace('activity[]=','',$request->activities));
        $position = 1;
        foreach ($activities as $activityId) {
            $activity                 = Activity::find($activityId);
            $activity->order_position = $position;
            $activity->save();
            $position++;
        }
        $user = Auth::user();
        $message = 'Activities are sorted.';
        event(new LogCreated($user, $message));

        return response()->json(['status'=>'success', 'message'=>'Your activities are sorted successfully.'], 200);
    }
}
