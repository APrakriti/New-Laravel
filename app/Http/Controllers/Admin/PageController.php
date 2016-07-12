<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Page;
use App\Models\Module;
use Validator;
use Auth;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::get();
        return view('backend.page.index')
                ->with('pages', $pages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.page.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = ['slug'=>'required','title'=>'required'];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator);
        
        $page = new Page();
        $page->slug = $request->slug;
        $page->title = $request->title;
        $page->meta_tags = $request->meta_tags;
        $page->meta_description = $request->meta_description;
        $page->save();

        return redirect()->route('admin.pages');
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
        $page = Page::findOrFail($id);
        return view('backend.page.edit')
                ->with('page', $page);
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
        $rules = ['slug'=>'required','title'=>'required'];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator);
        
        $page = Page::find($id);
        $page->slug = $request->slug;
        $page->title = $request->title;
        $page->meta_tags = $request->meta_tags;
        $page->meta_description = $request->meta_description;
        $page->save();

        return redirect()->route('admin.pages');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $rules = ['page_id'=>'required|exists:pages,id'];
        $validator = Validator::make($request->only('page_id'), $rules);
        if($validator->fails())
            return response()->json(['status'=>'error', 'message'=>$validator->errors()->all()], 422);
        
        $page = Page::find($request->page_id); 
        $page->delete();
        $message = 'Your page is deleted successfully.';
        return response()->json(['status'=>'ok', 'message'=>$message, 'page'=>$page], 200);
    }
}
