<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Testimonial;
use Validator;
use Auth;
use Session;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonial::orderBy('order_position')->get();
        return view('backend.testimonial.index')
                ->with('testimonials', $testimonials);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.testimonial.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = ['name'=>'required',
                  'type'=>'required'];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator);
        
        $imageFile = $request->attachment;
        $destinationPath = 'uploads/testimonials/';
        $rEFileTypes = "/^\.(jpg|jpeg|gif|png){1}$/i";
        $maximum_filesize = 1 * 1024 * 1024;
                
        if($imageFile) {
            $filename = $imageFile->getClientOriginalName();
            $extension = strrchr($filename, '.');
            $size = $imageFile->getSize();                  
            $new_image_name = "testimonial_" . time();
                    
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
        
        $testimonial = new Testimonial();
        $testimonial->name = $request->name;
         $testimonial->type = $request->type;
        $testimonial->description = $request->description;
        $testimonial->created_by = Auth::id();
        $testimonial->is_active = $request->is_active;

        if($logo)
            $testimonial->attachment = $logo;     
        $testimonial->save();

        return redirect()->route('admin.testimonials');
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
        $testimonial = Testimonial::findOrFail($id);
        return view('backend.testimonial.edit')
                ->with('testimonial', $testimonial);
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
        $rules = ['name'=>'required',
                  'type'=>'required'];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator);
        
        $imageFile = $request->attachment;
        $destinationPath = 'uploads/testimonials/';
        $rEFileTypes = "/^\.(jpg|jpeg|gif|png){1}$/i";
        $maximum_filesize = 1 * 1024 * 1024;
                
        if($imageFile) {
            $filename = $imageFile->getClientOriginalName();
            $extension = strrchr($filename, '.');
            $size = $imageFile->getSize();                  
            $new_image_name = "testimonial_" . time();
                    
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
        
        $testimonial = Testimonial::find($id);
        $testimonial->name = $request->name;
        $testimonial->type = $request->type;
        $testimonial->description = $request->description;
        $testimonial->updated_by = Auth::id();
        $testimonial->is_active = $request->is_active;

        if($logo){
            if(file_exists('uploads/testimonials/'.$testimonial->attachment) && $testimonial->attachment!='')
                unlink('uploads/testimonials/'.$testimonial->attachment);
            $testimonial->attachment = $logo;     
        }
        $testimonial->save();

        return redirect()->route('admin.testimonials');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $rules = ['testimonial_id'=>'required|exists:testimonials,id'];
        $validator = Validator::make($request->only('testimonial_id'), $rules);
        if($validator->fails())
            return response()->json(['status'=>'error', 'message'=>$validator->errors()->all()], 422);
        
        $testimonial = Testimonial::find($request->testimonial_id);
        if(file_exists("uploads/testimonials/".$testimonial->attachment) && $testimonial->attachment!=''){
            rename('uploads/testimonials/'. $testimonial->attachment, 'uploads/testimonials/trash/'. $testimonial->attachment);
        }
        $testimonial->delete();
        $message = 'Your testimonial is deleted successfully.';
        return response()->json(['status'=>'ok', 'message'=>$message, 'testimonial'=>$testimonial], 200);
    }

    /**
     * Change status of the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        $rules = ['testimonial_id'=>'required|exists:testimonials,id'];
        $validator = Validator::make($request->only('testimonial_id'), $rules);
        if($validator->fails())
            return response()->json(['status'=>'error', 'message'=>$validator->errors()->all()], 422);
        
        $testimonial = Testimonial::find($request->testimonial_id);
        $message = '';
        if($testimonial->is_active == 0){
            $testimonial->is_active = 1;
            $message = 'Your testimonial is published successfully.';
        } else {
            $testimonial->is_active = 0;
            $message = 'Your testimonial is unpublished successfully.';
        }
        $testimonial->save();

        return response()->json(['status'=>'ok', 'message'=>$message, 'testimonial'=>$testimonial], 200);
    }

    /**
     * sort orders of the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sortOrder(Request $request)
    {
        $rules = ['testimonials'=>'required'];
        $validator = Validator::make($request->only('testimonials'), $rules);
        if($validator->fails())
            return response()->json(['status'=>'error', 'message'=>$validator->errors()->all()], 422);
        
        $testimonials = explode('&',str_replace('testimonial[]=','',$request->testimonials));
        $position = 1;
        foreach ($testimonials as $testimonialId) {
            $testimonial                 = Testimonial::find($testimonialId);
            $testimonial->order_position = $position;
            $testimonial->save();
            $position++;
        }
        return response()->json(['status'=>'success', 'message'=>'Your testimonials are sorted successfully.'], 200);
    }
}
