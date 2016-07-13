<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\News;
use Validator;
use Auth;
use Session;

use App\Events\LogCreated;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newss = News::orderBy('published_date')->get();
        return view('backend.news.index')
                ->with('newss', $newss);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.news.add');
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
                    'description'=>'required',
                    'title'=>'required',
                ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator);
        
        $imageFile = $request->attachment;
        $destinationPath = 'uploads/news/';
        $rEFileTypes = "/^\.(jpg|jpeg|gif|png){1}$/i";
        $maximum_filesize = 1 * 1024 * 1024;
                
        if($imageFile) {
            $filename = $imageFile->getClientOriginalName();
            $extension = strrchr($filename, '.');
            $size = $imageFile->getSize();                  
            $new_image_name = "news_" . time();
                    
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
        
        $news = new News();
        $news->heading = $request->heading;
        $news->description = $request->description;
        $news->title = $request->title;
        $news->meta_tags = $request->meta_tags;
        $news->meta_description = $request->meta_description;
        $news->created_by = Auth::id();
        $news->published_date = $request->published_date;
        $news->is_active = $request->is_active;

        if($logo)
            $news->attachment = $logo;     
        $news->save();

        $user = Auth::user();
        $message = 'News with heading "'. $news->heading.'" is added.';
        event(new LogCreated($user, $message));

        return redirect()->route('admin.news')
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
        $news = News::findOrFail($id);
        return view('backend.news.edit')
                ->with('news', $news);
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
                    'description'=>'required',
                    'title'=>'required'
                ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator);
        
        $imageFile = $request->attachment;
        $destinationPath = 'uploads/news/';
        $rEFileTypes = "/^\.(jpg|jpeg|gif|png){1}$/i";
        $maximum_filesize = 1 * 1024 * 1024;
                
        if($imageFile) {
            $filename = $imageFile->getClientOriginalName();
            $extension = strrchr($filename, '.');
            $size = $imageFile->getSize();                  
            $new_image_name = "news_" . time();
                    
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
        
        $news = News::find($id);
        $news->heading = $request->heading;
        $news->description = $request->description;
        $news->title = $request->title;
        $news->meta_tags = $request->meta_tags;
        $news->meta_description = $request->meta_description;
        $news->updated_by = Auth::id();
        $news->is_active = $request->is_active;
        $news->published_date = $request->published_date;

        if($logo){
            if(file_exists('uploads/news/'.$news->attachment) && $news->attachment!='')
                unlink('uploads/news/'.$news->attachment);
            $news->attachment = $logo;     
        }    
        $news->save();

        $user = Auth::user();
        $message = 'News with heading "'. $news->heading.'" is updated.';
        event(new LogCreated($user, $message));

        return redirect()->route('admin.news')
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
        $rules = ['news_id'=>'required|exists:news,id'];
        $validator = Validator::make($request->only('news_id'), $rules);
        if($validator->fails())
            return response()->json(['status'=>'error', 'message'=>$validator->errors()->all()], 422);
        
        $news = News::find($request->news_id);
        if(file_exists("uploads/news/".$news->attachment) && $news->attachment!=''){
            rename('uploads/news/'. $news->attachment, 'uploads/news/trash/'. $news->attachment);
        }
        $news->delete();

        $user = Auth::user();
        $message = 'News with heading "'. $news->heading.'" is deleted.';
        event(new LogCreated($user, $message));
        
        return response()->json(['status'=>'ok', 'message'=>$message, 'news'=>$news], 200);
    }

    /**
     * Change status of the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        $rules = ['news_id'=>'required|exists:news,id'];
        $validator = Validator::make($request->only('news_id'), $rules);
        if($validator->fails())
            return response()->json(['status'=>'error', 'message'=>$validator->errors()->all()], 422);
        
        $news = News::find($request->news_id);
        $message = '';
        if($news->is_active == 0){
            $news->is_active = 1;
            $message = 'News with heading "'. $news->heading.'" is published.';
        } else {
            $news->is_active = 0;
            $message = 'News with heading "'. $news->heading.'" is unpublished.';
        }
        $news->save();
        $user = Auth::user();
        event(new LogCreated($user, $message));
        
        return response()->json(['status'=>'ok', 'message'=>$message, 'news'=>$news], 200);
    }

    /**
     * Remove the attachment of specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroyAttachment(Request $request)
    {
        $rules = ['news_id'=>'required|exists:news,id'];
        $validator = Validator::make($request->only('news_id'), $rules);
        if($validator->fails())
            return response()->json(['status'=>'error', 'message'=>$validator->errors()->all()], 422);
        
        $news = News::find($request->news_id);
        if(file_exists("uploads/news/".$news->attachment) && $news->attachment!=''){
            unlink('uploads/news/'. $news->attachment);
        }
        $news->attachment = null;
        $news->save();

        $user = Auth::user();
        $message = 'Attachment of News with heading "'. $news->heading.'" is deleted.';
        event(new LogCreated($user, $message));
        
        return response()->json(['status'=>'ok', 'message'=>$message, 'news'=>$news], 200);
    }
}
