<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Album;
use Validator;
use Auth;
use Session;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = Album::orderBy('order_position')->get();
        return view('backend.album.index')
                ->with('albums', $albums);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.album.add');
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
        
        $imageFile = $request->attachment;
        $destinationPath = 'uploads/albums/';
        $rEFileTypes = "/^\.(jpg|jpeg|gif|png){1}$/i";
        $maximum_filesize = 1 * 1024 * 1024;
                
        if($imageFile) {
            $filename = $imageFile->getClientOriginalName();
            $extension = strrchr($filename, '.');
            $size = $imageFile->getSize();                  
            $new_image_name = "album_" . time();
                    
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
        
        $album = new Album();
        $album->heading = $request->heading;
        $album->created_by = Auth::id();
        $album->is_active = $request->is_active;

        if($logo)
            $album->attachment = $logo;     
        $album->save();

        return redirect()->route('admin.albums');
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
        $album = Album::findOrFail($id);
        return view('backend.album.edit')
                ->with('album', $album);
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
        
        $imageFile = $request->attachment;
        $destinationPath = 'uploads/albums/';
        $rEFileTypes = "/^\.(jpg|jpeg|gif|png){1}$/i";
        $maximum_filesize = 1 * 1024 * 1024;
                
        if($imageFile) {
            $filename = $imageFile->getClientOriginalName();
            $extension = strrchr($filename, '.');
            $size = $imageFile->getSize();                  
            $new_image_name = "album_" . time();
                    
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
        
        $album = Album::find($id);
        $album->heading = $request->heading;
        $album->updated_by = Auth::id();
        $album->is_active = $request->is_active;

        if($logo){
            if(file_exists('uploads/albums/'.$album->attachment) && $album->attachment!='')
                unlink('uploads/albums/'.$album->attachment);
            $album->attachment = $logo;     
        }
        $album->save();

        return redirect()->route('admin.albums');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $rules = ['album_id'=>'required|exists:albums,id'];
        $validator = Validator::make($request->only('album_id'), $rules);
        if($validator->fails())
            return response()->json(['status'=>'error', 'message'=>$validator->errors()->all()], 422);
        
        $album = Album::find($request->album_id);
        if(file_exists("uploads/albums/".$album->attachment) && $album->attachment!=''){
            rename('uploads/albums/'. $album->attachment, 'uploads/albums/trash/'. $album->attachment);
        }
        $album->delete();
        $message = 'Your album is deleted successfully.';
        return response()->json(['status'=>'ok', 'message'=>$message, 'album'=>$album], 200);
    }

    /**
     * Change status of the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        $rules = ['album_id'=>'required|exists:albums,id'];
        $validator = Validator::make($request->only('album_id'), $rules);
        if($validator->fails())
            return response()->json(['status'=>'error', 'message'=>$validator->errors()->all()], 422);
        
        $album = Album::find($request->album_id);
        $message = '';
        if($album->is_active == 0){
            $album->is_active = 1;
            $message = 'Your album is published successfully.';
        } else {
            $album->is_active = 0;
            $message = 'Your album is unpublished successfully.';
        }
        $album->save();

        return response()->json(['status'=>'ok', 'message'=>$message, 'album'=>$album], 200);
    }

    /**
     * sort orders of the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sortOrder(Request $request)
    {
        $rules = ['albums'=>'required'];
        $validator = Validator::make($request->only('albums'), $rules);
        if($validator->fails())
            return response()->json(['status'=>'error', 'message'=>$validator->errors()->all()], 422);
        
        $albums = explode('&',str_replace('album[]=','',$request->albums));
        $position = 1;
        foreach ($albums as $albumId) {
            $album                 = Album::find($albumId);
            $album->order_position = $position;
            $album->save();
            $position++;
        }
        return response()->json(['status'=>'success', 'message'=>'Your albums are sorted successfully.'], 200);
    }
}
