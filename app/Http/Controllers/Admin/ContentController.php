<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Content;
use Validator;
use Auth;
use Session;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contents = Content::orderBy('order_position')->get();
        return view('backend.content.index')
                ->with('contents', $contents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.content.add');
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
        $destinationPath = 'uploads/contents/';
        $rEFileTypes = "/^\.(jpg|jpeg|gif|png){1}$/i";
        $maximum_filesize = 1 * 1024 * 1024;
                
        if($imageFile) {
            $filename = $imageFile->getClientOriginalName();
            $extension = strrchr($filename, '.');
            $size = $imageFile->getSize();                  
            $new_image_name = "content_" . time();
                    
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
        
        $content = new Content();
        $content->heading = $request->heading;
        $content->description = $request->description;
        $content->title = $request->title;
        $content->meta_tags = $request->meta_tags;
        $content->meta_description = $request->meta_description;
        $content->created_by = Auth::id();
        $content->show_footer = $request->show_footer;
        $content->is_active = $request->is_active;

        if($logo)
            $content->attachment = $logo;     
        $content->save();

        return redirect()->route('admin.contents')
                        ->with('status', 'success')
                        ->with('message', 'Content with heading "'. $content->heading.'" is added!');
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
        $content = Content::findOrFail($id);
            return view('backend.content.edit')
                ->with('content', $content);
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
        $destinationPath = 'uploads/contents/';
        $rEFileTypes = "/^\.(jpg|jpeg|gif|png){1}$/i";
        $maximum_filesize = 1 * 1024 * 1024;
                
        if($imageFile) {
            $filename = $imageFile->getClientOriginalName();
            $extension = strrchr($filename, '.');
            $size = $imageFile->getSize();                  
            $new_image_name = "content_" . time();
                    
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
        
        $content = Content::find($id);
        $content->heading = $request->heading;
        $content->description = $request->description;
        $content->title = $request->title;
        $content->meta_tags = $request->meta_tags;
        $content->meta_description = $request->meta_description;
        $content->updated_by = Auth::id();
        $content->is_active = $request->is_active;
        $content->show_footer = $request->show_footer;

        if($logo){
            if(file_exists('uploads/contents/'.$content->attachment) && $content->attachment!='')
                unlink('uploads/contents/'.$content->attachment);
            $content->attachment = $logo;     
        }    
        $content->save();

        return redirect()->route('admin.contents')
                        ->with('status', 'success')
                        ->with('message', 'Content with heading "'. $content->heading.'" is updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $rules = ['content_id'=>'required|exists:contents,id'];
        $validator = Validator::make($request->only('content_id'), $rules);
        if($validator->fails())
            return response()->json(['status'=>'error', 'message'=>$validator->errors()->all()], 422);
        
        $content = Content::find($request->content_id);
        if(file_exists("uploads/contents/".$content->attachment) && $content->attachment!=''){
            rename('uploads/contents/'. $content->attachment, 'uploads/contents/trash/'. $content->attachment);
        }
        $content->delete();
        $message = 'Your content is deleted successfully.';
        return response()->json(['status'=>'ok', 'message'=>$message, 'content'=>$content], 200);
    }

    /**
     * Change status of the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        $rules = ['content_id'=>'required|exists:contents,id'];
        $validator = Validator::make($request->only('content_id'), $rules);
        if($validator->fails())
            return response()->json(['status'=>'error', 'message'=>$validator->errors()->all()], 422);
        
        $content = Content::find($request->content_id);
        $message = '';
        if($content->is_active == 0){
            $content->is_active = 1;
            $message = 'Your content is published successfully.';
        } else {
            $content->is_active = 0;
            $message = 'Your content is unpublished successfully.';
        }
        $content->save();

        return response()->json(['status'=>'ok', 'message'=>$message, 'content'=>$content], 200);
    }

    /**
     * Remove the attachment of specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroyAttachment(Request $request)
    {
        $rules = ['content_id'=>'required|exists:contents,id'];
        $validator = Validator::make($request->only('content_id'), $rules);
        if($validator->fails())
            return response()->json(['status'=>'error', 'message'=>$validator->errors()->all()], 422);
        
        $content = Content::find($request->content_id);
        if(file_exists("uploads/contents/".$content->attachment) && $content->attachment!=''){
            unlink('uploads/contents/'. $content->attachment);
        }
        $content->attachment = null;
        $content->save();
        $message = 'Your content attachment is deleted successfully.';
        return response()->json(['status'=>'ok', 'message'=>$message, 'content'=>$content], 200);
    }

    /**
     * sort orders of the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sortOrder(Request $request)
    {
        $rules = ['contents'=>'required'];
        $validator = Validator::make($request->only('contents'), $rules);
        if($validator->fails())
            return response()->json(['status'=>'error', 'message'=>$validator->errors()->all()], 422);
        
        $contents = explode('&',str_replace('content[]=','',$request->contents));
        $position = 1;
        foreach ($contents as $contentId) {
            $content                 = Content::find($contentId);
            $content->order_position = $position;
            $content->save();
            $position++;
        }
        return response()->json(['status'=>'success', 'message'=>'Your contents are sorted successfully.'], 200);
    }
}
