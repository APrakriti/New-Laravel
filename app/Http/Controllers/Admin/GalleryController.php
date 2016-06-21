<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Package;
use App\Models\Gallery;
use Validator;
use Auth;
use Image;

class GalleryController extends Controller
{
    /**
     * Display all galleries
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $galleries = Gallery::with('package')->get();
        return view('backend.galleries')
                ->with('galleries', $galleries);
    }

    /**
     * Display all galleries for the package
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $package = Package::findOrfail($id);
        $galleries = Gallery::where('package_id', $id)->orderBy('order_position')->get();
        return view('backend.package.galleries')
                ->with('package', $package)
                ->with('galleries', $galleries);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $package = Package::findOrFail($id);
        
        return view('backend.package.add-gallery')
                ->with('package', $package);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $rules = ['caption'=>'required'];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator);
        
        $imageFile = $request->attachment;
        $destinationPath = 'uploads/gallery/';
        $destinationPathThumb = 'uploads/gallery/thumbs/';
        $rEFileTypes = "/^\.(jpg|jpeg|gif|png){1}$/i";
        $maximum_filesize = 1 * 1024 * 1024;
                
        if($imageFile) {
            $filename = $imageFile->getClientOriginalName();
            $extension = strrchr($filename, '.');
            $size = $imageFile->getSize();                  
            $new_image_name = "gallery_" . time();
                    
            if ($size <= $maximum_filesize && preg_match($rEFileTypes, $extension)) {
                $attachment = $imageFile->move($destinationPath, $new_image_name.$extension);
                
                $img = Image::make($destinationPath . $new_image_name . $extension);
                $height = $img->height();
                $width = $img->width();
                $thumb_height = env('THUMB_WIDTH');
                $thumb_width = env('THUMB_HEIGHT');

                if($width > $height){
                    $ratio = $width/$height;
                    $thumb_width = $thumb_height * $ratio;
                } else {
                    $ratio = $height/$width;
                    $thumb_height = $thumb_width * $ratio;
                }
                        
                $img->resize($thumb_width, $thumb_height, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $img->crop(env('THUMB_WIDTH'), env('THUMB_HEIGHT'));
                $thumb_attachment = $img->save($destinationPathThumb . $new_image_name . env('THUMB_EXTENSION'));
            } else if (preg_match($rEFileTypes, $extension) == false) {
                Session::flash('class', 'alert alert-error');
                Session::flash('message', 'Warning : Invalid Image File!');
            } else if ($size > $maximum_filesize) {
                Session::flash('class', 'alert alert-error');
                Session::flash('message', "Warning : The size of the image shouldn't be more than 1MB!");
            }               
        }
        $logo = isset($attachment) ? $new_image_name . $extension : NULL;
        $thumb_logo = isset($thumb_attachment) ? $new_image_name . $extension : NULL;

        $gallery = new Gallery();
        $gallery->caption = $request->caption;
        $gallery->created_by = Auth::id();
        $gallery->is_active = $request->is_active;

        if($logo)
            $gallery->attachment = $logo;
        if($thumb_logo)
            $gallery->thumb_attachment = $thumb_logo;

        $package = Package::findOrFail($id);
        $package->galleries()->save($gallery);

        return redirect()->route('admin.package.galleries', $id);
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
        $gallery = Gallery::findOrFail($id);
        
        return view('backend.package.edit-gallery')
                ->with('gallery', $gallery);
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
        $rules = ['caption'=>'required'];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator);
        
        $imageFile = $request->attachment;
        $destinationPath = 'uploads/gallery/';
        $destinationPathThumb = 'uploads/gallery/thumbs/';
        $rEFileTypes = "/^\.(jpg|jpeg|gif|png){1}$/i";
        $maximum_filesize = 1 * 1024 * 1024;
                
        if($imageFile) {
            $filename = $imageFile->getClientOriginalName();
            $extension = strrchr($filename, '.');
            $size = $imageFile->getSize();                  
            $new_image_name = "gallery_" . time();
                    
            if ($size <= $maximum_filesize && preg_match($rEFileTypes, $extension)) {
                $attachment = $imageFile->move($destinationPath, $new_image_name.$extension);
                
                $img = Image::make($destinationPath . $new_image_name . $extension);
                $height = $img->height();
                $width = $img->width();
                $thumb_height = env('THUMB_WIDTH');
                $thumb_width = env('THUMB_HEIGHT');

                if($width > $height){
                    $ratio = $width/$height;
                    $thumb_width = $thumb_height * $ratio;
                } else {
                    $ratio = $height/$width;
                    $thumb_height = $thumb_width * $ratio;
                }
                        
                $img->resize($thumb_width, $thumb_height, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $img->crop(env('THUMB_WIDTH'), env('THUMB_HEIGHT'));
                $thumb_attachment = $img->save($destinationPathThumb . $new_image_name . env('THUMB_EXTENSION'));
            } else if (preg_match($rEFileTypes, $extension) == false) {
                Session::flash('class', 'alert alert-error');
                Session::flash('message', 'Warning : Invalid Image File!');
            } else if ($size > $maximum_filesize) {
                Session::flash('class', 'alert alert-error');
                Session::flash('message', "Warning : The size of the image shouldn't be more than 1MB!");
            }               
        }
        $logo = isset($attachment) ? $new_image_name . $extension : NULL;
        $thumb_logo = isset($thumb_attachment) ? $new_image_name . $extension : NULL;

        $gallery = Gallery::with('package')->findOrFail($id);
        $gallery->caption = $request->caption;
        $gallery->updated_by = Auth::id();
        $gallery->is_active = $request->is_active;

        if($logo){
            if(file_exists($destinationPath.$gallery->attachment) && $gallery->attachment!='')
                unlink($destinationPath.$gallery->attachment);
            $gallery->attachment = $logo;
        }
        if($thumb_logo){
            if(file_exists($destinationPathThumb.$gallery->thumb_attachment) && $gallery->thumb_attachment!='')
                unlink($destinationPathThumb.$gallery->thumb_attachment);
            $gallery->thumb_attachment = $thumb_logo;
        }

        $gallery->save();
        
        return redirect()->route('admin.package.galleries', $gallery->package->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $rules = ['gallery_id'=>'required|exists:package_gallery,id'];
        $validator = Validator::make($request->only('gallery_id'), $rules);
        if($validator->fails())
            return response()->json(['status'=>'error', 'message'=>$validator->errors()->all()], 422);
        
        $gallery = Gallery::find($request->gallery_id);
        if(file_exists('uploads/gallery/'.$gallery->attachment) && $gallery->attachment!='')
            unlink('uploads/gallery/'.$gallery->attachment);
            
        $gallery->delete();
        $message = 'Your gallery is deleted successfully.';
        return response()->json(['status'=>'ok', 'message'=>$message, 'gallery'=>$gallery], 200);
    }

    /**
     * Change status of the gallery resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        $rules = ['gallery_id'=>'required|exists:package_gallery,id'];
        $validator = Validator::make($request->only('gallery_id'), $rules);
        if($validator->fails())
            return response()->json(['status'=>'error', 'message'=>$validator->errors()->all()], 422);
        
        $gallery = Gallery::find($request->gallery_id);
        $message = '';
        if($gallery->is_active == 0){
            $gallery->is_active = 1;
            $message = 'Your gallery is published successfully.';
        } else {
            $gallery->is_active = 0;
            $message = 'Your gallery is unpublished successfully.';
        }
        $gallery->save();

        return response()->json(['status'=>'ok', 'message'=>$message, 'gallery'=>$gallery], 200);
    }

     /**
     * Change cover of the gallery resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function makeCover(Request $request)
    {
        $rules = ['gallery_id'=>'required|exists:package_gallery,id'];
        $validator = Validator::make($request->only('gallery_id'), $rules);
        if($validator->fails())
            return response()->json(['status'=>'error', 'message'=>$validator->errors()->all()], 422);
        
        $gallery = Gallery::findOrFail($request->gallery_id);
        $package = Package::findOrFail($gallery->package_id);
        $package->galleries()->update(['is_cover' => 0]);
        
        $gallery = Gallery::find($request->gallery_id);
        $gallery->is_cover = 1;         
        $gallery->is_active = 1;         
        $gallery->save();
        $message = 'Your gallery is made as cover successfully.';
        
        return response()->json(['status'=>'ok', 'message'=>$message, 'gallery'=>$gallery], 200);
    }

    /**
     * sort orders of the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sortOrder(Request $request)
    {
        $rules = ['galleries'=>'required'];
        $validator = Validator::make($request->only('galleries'), $rules);
        if($validator->fails())
            return response()->json(['status'=>'error', 'message'=>$validator->errors()->all()], 422);
        
        $galleries = explode('&',str_replace('gallery[]=','',$request->galleries));
        $position = 1;
        foreach ($galleries as $galleryId) {
            $gallery                 = Gallery::find($galleryId);
            $gallery->order_position = $position;
            $gallery->save();
            $position++;
        }
        return response()->json(['status'=>'success', 'message'=>'Your galleries are sorted successfully.'], 200);
    }
}
