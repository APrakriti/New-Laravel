<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Destination;
use Validator;
use Auth;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $destinations = Destination::orderBy('order_position')->get();
        return view('backend.destination.index')
                ->with('destinations', $destinations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.destination.add');
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
        $destinationPath = 'uploads/destinations/';
        $rEFileTypes = "/^\.(jpg|jpeg|gif|png){1}$/i";
        $maximum_filesize = 1 * 1024 * 1024;
                
        if($imageFile) {
            $filename = $imageFile->getClientOriginalName();
            $extension = strrchr($filename, '.');
            $size = $imageFile->getSize();                  
            $new_image_name = "destination_" . time();
                    
            if ($size <= $maximum_filesize && preg_match($rEFileTypes, $extension)) {
                $attachment = $imageFile->move($destinationPath, $new_image_name.$extension);
            } else if (preg_match($rEFileTypes, $extension) == false) {
                Session::flash('class', 'alert alert-error');
                Session::flash('message', 'Warning : Invalid Image File!');
            } else if ($size > $maximum_filesize) {
                Session::flash('class', 'alert alert-error');
                Session::flash('message', "Warning : The size of the image shouldn't be more than 1MB!");
            }               
        }
        $logo = isset($attachment) ? $new_image_name . $extension : NULL;
        
        $destination = new Destination();
        $destination->heading = $request->heading;
        $destination->description = $request->description;
        $destination->title = $request->title;
        $destination->meta_tags = $request->meta_tags;
        $destination->meta_description = $request->meta_description;
        $destination->created_by = Auth::id();
        $destination->is_active = $request->is_active;

        if($logo)
            $destination->attachment = $logo;     
        $destination->save();

        return redirect()->route('admin.destinations')
                        ->with('status', 'success')
                        ->with('message', 'Destination with heading "'. $destination->heading.'" is added!');
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
        $destination = Destination::findOrFail($id);
        return view('backend.destination.edit')
                ->with('destination', $destination);
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
        $destinationPath = 'uploads/destinations/';
        $rEFileTypes = "/^\.(jpg|jpeg|gif|png){1}$/i";
        $maximum_filesize = 1 * 1024 * 1024;
                
        if($imageFile) {
            $filename = $imageFile->getClientOriginalName();
            $extension = strrchr($filename, '.');
            $size = $imageFile->getSize();                  
            $new_image_name = "destination_" . time();
                    
            if ($size <= $maximum_filesize && preg_match($rEFileTypes, $extension)) {
                $attachment = $imageFile->move($destinationPath, $new_image_name.$extension);
            } else if (preg_match($rEFileTypes, $extension) == false) {
                Session::flash('class', 'alert alert-error');
                Session::flash('message', 'Warning : Invalid Image File!');
            } else if ($size > $maximum_filesize) {
                Session::flash('class', 'alert alert-error');
                Session::flash('message', "Warning : The size of the image shouldn't be more than 1MB!");
            }               
        }
        $logo = isset($attachment) ? $new_image_name . $extension : NULL;
        
        $destination = Destination::find($id);
        $destination->heading = $request->heading;
        $destination->description = $request->description;
        $destination->title = $request->title;
        $destination->meta_tags = $request->meta_tags;
        $destination->meta_description = $request->meta_description;
        $destination->updated_by = Auth::id();
        $destination->is_active = $request->is_active;

        if($logo){
            if(file_exists('uploads/destinations/'.$destination->attachment) && $destination->attachment!='')
                unlink('uploads/destinations/'.$destination->attachment);
            $destination->attachment = $logo;     
        }    
        $destination->save();

        return redirect()->route('admin.destinations')
                        ->with('status', 'success')
                        ->with('message', 'Destination with heading "'. $destination->heading.'" is updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $rules = ['destination_id'=>'required|exists:destinations,id'];
        $validator = Validator::make($request->only('destination_id'), $rules);
        if($validator->fails())
            return response()->json(['status'=>'error', 'message'=>$validator->errors()->all()], 422);
        
        $destination = Destination::find($request->destination_id);
        if(file_exists("uploads/destinations/".$destination->attachment) && $destination->attachment!=''){
            rename('uploads/destinations/'. $destination->attachment, 'uploads/destinations/trash/'. $destination->attachment);
        }
        $destination->delete();
        $message = 'Your destination is deleted successfully.';
        return response()->json(['status'=>'ok', 'message'=>$message, 'destination'=>$destination], 200);
    }

    /**
     * Change status of the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        $rules = ['destination_id'=>'required|exists:destinations,id'];
        $validator = Validator::make($request->only('destination_id'), $rules);
        if($validator->fails())
            return response()->json(['status'=>'error', 'message'=>$validator->errors()->all()], 422);
        
        $destination = Destination::find($request->destination_id);
        $message = '';
        if($destination->is_active == 0){
            $destination->is_active = 1;
            $message = 'Your destination is published successfully.';
        } else {
            $destination->is_active = 0;
            $message = 'Your destination is unpublished successfully.';
        }
        $destination->save();

        return response()->json(['status'=>'ok', 'message'=>$message, 'destination'=>$destination], 200);
    }

    /**
     * Remove the attachment of specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroyAttachment(Request $request)
    {
        $rules = ['destination_id'=>'required|exists:destinations,id'];
        $validator = Validator::make($request->only('destination_id'), $rules);
        if($validator->fails())
            return response()->json(['status'=>'error', 'message'=>$validator->errors()->all()], 422);
        
        $destination = Destination::find($request->destination_id);
        if(file_exists("uploads/destinations/".$destination->attachment) && $destination->attachment!=''){
            unlink('uploads/destinations/'. $destination->attachment);
        }
        $destination->attachment = null;
        $destination->save();
        $message = 'Your destination attachment is deleted successfully.';
        return response()->json(['status'=>'ok', 'message'=>$message, 'destination'=>$destination], 200);
    }

    /**
     * sort orders of the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sortOrder(Request $request)
    {
        $rules = ['destinations'=>'required'];
        $validator = Validator::make($request->only('destinations'), $rules);
        if($validator->fails())
            return response()->json(['status'=>'error', 'message'=>$validator->errors()->all()], 422);
        
        $destinations = explode('&',str_replace('destination[]=','',$request->destinations));
        $position = 1;
        foreach ($destinations as $destinationId) {
            $destination                 = Destination::find($destinationId);
            $destination->order_position = $position;
            $destination->save();
            $position++;
        }
        return response()->json(['status'=>'success', 'message'=>'Your destinations are sorted successfully.'], 200);
    }
}
