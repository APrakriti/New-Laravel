<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Banner;
use Validator;
use Auth;
use Session;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::orderBy('order_position')->get();
        return view('backend.banner.index')
            ->with('banners', $banners);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.banner.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = ['heading' => 'required','type'=>'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator);

        $imageFile = $request->attachment;
        $destinationPath = 'uploads/banners/';
        $rEFileTypes = "/^\.(jpg|jpeg|gif|png){1}$/i";
        $maximum_filesize = 1 * 1024 * 1024;

        if ($imageFile) {
            $filename = $imageFile->getClientOriginalName();
            $extension = strrchr($filename, '.');
            $size = $imageFile->getSize();
            $new_image_name = "banner_" . time();

            if ($size <= $maximum_filesize && preg_match($rEFileTypes, $extension)) {
                $attachment = $imageFile->move($destinationPath, $new_image_name . $extension);
            } else if (preg_match($rEFileTypes, $extension) == false) {
                Session::flash('class', 'alert alert-error');
                Session::flash('message', 'Warning : Invalid Image File!');
            } else if ($size > $maximum_filesize) {
                Session::flash('class', 'alert alert-error');
                Session::flash('message', "Warning : The size of the image shouldn't be more than 1MB!");
            }
        }
        $logo = isset($attachment) ? $new_image_name . $extension : NULL;

        $banner = new Banner();
        $banner->heading = $request->heading;
        $banner->type = $request->type;
        $banner->banner_url = $request->banner_url;
        $banner->created_by = Auth::id();
        $banner->is_active = $request->is_active;

        if ($logo)
            $banner->attachment = $logo;
        $banner->save();

        return redirect()->route('admin.banners');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('backend.banner.edit')
            ->with('banner', $banner);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = ['heading' => 'required','type'=>'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator);

        $imageFile = $request->attachment;
        $destinationPath = 'uploads/banners/';
        $rEFileTypes = "/^\.(jpg|jpeg|gif|png){1}$/i";
        $maximum_filesize = 1 * 1024 * 1024;

        if ($imageFile) {
            $filename = $imageFile->getClientOriginalName();
            $extension = strrchr($filename, '.');
            $size = $imageFile->getSize();
            $new_image_name = "banner_" . time();

            if ($size <= $maximum_filesize && preg_match($rEFileTypes, $extension)) {
                $attachment = $imageFile->move($destinationPath, $new_image_name . $extension);
            } else if (preg_match($rEFileTypes, $extension) == false) {
                Session::flash('class', 'alert alert-error');
                Session::flash('message', 'Warning : Invalid Image File!');
            } else if ($size > $maximum_filesize) {
                Session::flash('class', 'alert alert-error');
                Session::flash('message', "Warning : The size of the image shouldn't be more than 1MB!");
            }
        }
        $logo = isset($attachment) ? $new_image_name . $extension : NULL;

        $banner = Banner::find($id);
        $banner->heading = $request->heading;
        $banner->type = $request->type;
        $banner->banner_url = $request->banner_url;
        $banner->updated_by = Auth::id();
        $banner->is_active = $request->is_active;

        if ($logo) {
            if (file_exists('uploads/banners/' . $banner->attachment) && $banner->attachment != '')
                unlink('uploads/banners/' . $banner->attachment);
            $banner->attachment = $logo;
        }
        $banner->save();

        return redirect()->route('admin.banners');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $rules = ['banner_id' => 'required|exists:banners,id'];
        $validator = Validator::make($request->only('banner_id'), $rules);
        if ($validator->fails())
            return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 422);

        $banner = Banner::find($request->banner_id);
        if (file_exists("uploads/banners/" . $banner->attachment) && $banner->attachment != '') {
            rename('uploads/banners/' . $banner->attachment, 'uploads/banners/trash/' . $banner->attachment);
        }
        $banner->delete();
        $message = 'Your banner is deleted successfully.';
        return response()->json(['status' => 'ok', 'message' => $message, 'banner' => $banner], 200);
    }

    /**
     * Change status of the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        $rules = ['banner_id' => 'required|exists:banners,id'];
        $validator = Validator::make($request->only('banner_id'), $rules);
        if ($validator->fails())
            return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 422);

        $banner = Banner::find($request->banner_id);
        $message = '';
        if ($banner->is_active == 0) {
            $banner->is_active = 1;
            $message = 'Your banner is published successfully.';
        } else {
            $banner->is_active = 0;
            $message = 'Your banner is unpublished successfully.';
        }
        $banner->save();

        return response()->json(['status' => 'ok', 'message' => $message, 'banner' => $banner], 200);
    }

    /**
     * sort orders of the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function sortOrder(Request $request)
    {
        $rules = ['banners' => 'required'];
        $validator = Validator::make($request->only('banners'), $rules);
        if ($validator->fails())
            return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 422);

        $banners = explode('&', str_replace('banner[]=', '', $request->banners));
        $position = 1;
        foreach ($banners as $bannerId) {
            $banner = Banner::find($bannerId);
            $banner->order_position = $position;
            $banner->save();
            $position++;
        }
        return response()->json(['status' => 'success', 'message' => 'Your banners are sorted successfully.'], 200);
    }
}
