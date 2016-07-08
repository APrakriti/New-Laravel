<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Activity;
use App\Models\Destination;
use App\Models\Package;
use Validator;
use Auth;
use Input;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($destinationId = null)
    {
        $destination = [];
        if($destinationId){
            $packages = Package::where('destination_id', $destinationId)
                        ->orderBy('order_position')->get();
            $destination = Destination::findOrFail($destinationId);
        } else {         
            $packages = Package::orderBy('order_position')->get();
        }
        return view('backend.package.index')
                ->with('destination', $destination)
                ->with('packages', $packages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $activities = Activity::select('id', 'heading')->get();
        $destinations = Destination::select('id', 'heading')->get();
        return view('backend.package.add')
                ->with('activities', $activities)
                ->with('destinations', $destinations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = ['activity_id'=>'required | exists:activities,id',
                    'destination_id'=>'required | exists:destinations,id',
                    'heading'=>'required',
                    'description'=>'required',
                    'itineraries'=>'required',
                    'maximum_altitude'=>'numeric',
                    'group_size'=>'numeric',
                    'trip_duration'=>'numeric',
                    'starting_price'=>'required | numeric',
                ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator);
        
        $package = new Package();
        $package->activity_id = $request->input('activity_id', 1);
        $package->destination_id = $request->input('destination_id', 1);
        $package->heading = $request->heading;
        $package->description = $request->description;
        $package->itineraries = $request->itineraries;
        $package->includes = $request->includes;
        $package->excludes = $request->excludes;
        $package->title = $request->title;
        $package->meta_tags = $request->meta_tags;
        $package->meta_description = $request->meta_description;
        $package->trip_duration = $request->trip_duration;
        $package->group_size = $request->group_size;
        $package->maximum_altitude = $request->maximum_altitude;
        $package->team_leader = $request->team_leader;
        $package->trip_season = $request->trip_season;
        $package->accommodation = $request->accommodation;
        $package->previous_price = $request->previous_price;
        $package->starting_price = $request->starting_price;        
        $package->created_by = Auth::id();
        $package->last_minute_deal = $request->last_minute_deal;
        $package->is_active = $request->is_active;
        $package->save();

        return redirect()->route('admin.package.gallery.add', $package->id)
                        ->with('status', 'success')
                        ->with('message', 'Package with heading "'. $package->heading.'" is added!');
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
        $package = Package::findOrFail($id);
        $activities = Activity::select('id', 'heading')->get();
        $destinations = Destination::select('id', 'heading')->get();
        return view('backend.package.edit')
                ->with('package', $package)
                ->with('activities', $activities)
                ->with('destinations', $destinations);
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
        $rules = ['activity_id'=>'required | exists:activities,id',
                    'destination_id'=>'required | exists:destinations,id',
                    'heading'=>'required',
                    'description'=>'required',
                    'itineraries'=>'required',
                    'maximum_altitude'=>'numeric',
                    'group_size'=>'numeric',
                    'trip_duration'=>'numeric',
                    'starting_price'=>'required | numeric',
                ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator);
        
        $package = Package::find($id);
        $package->activity_id = $request->input('activity_id');
        $package->destination_id = $request->input('destination_id');
        $package->heading = $request->heading;
        $package->description = $request->description;
        $package->itineraries = $request->itineraries;
        $package->includes = $request->includes;
        $package->excludes = $request->excludes;
        $package->title = $request->title;
        $package->meta_tags = $request->meta_tags;
        $package->meta_description = $request->meta_description;
        $package->trip_duration = $request->trip_duration;
        $package->group_size = $request->group_size;
        $package->maximum_altitude = $request->maximum_altitude;
        $package->team_leader = $request->team_leader;
        $package->trip_season = $request->trip_season;
        $package->accommodation = $request->accommodation;
        $package->previous_price = $request->previous_price;
        $package->starting_price = $request->starting_price;
        $package->updated_by = Auth::id();
        $package->last_minute_deal = $request->last_minute_deal;           
        $package->is_active = $request->is_active;           
        $package->save();

        return redirect()->route('admin.packages')
                        ->with('status', 'success')
                        ->with('message', 'Package with heading "'. $package->heading.'" is updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $rules = ['package_id'=>'required|exists:packages,id'];
        $validator = Validator::make($request->only('package_id'), $rules);
        if($validator->fails())
            return response()->json(['status'=>'error', 'message'=>$validator->errors()->all()], 422);
        
        $package = Package::find($request->package_id);
        if(file_exists("uploads/packages/".$package->attachment) && $package->attachment!=''){
            rename('uploads/packages/'. $package->attachment, 'uploads/packages/trash/'. $package->attachment);
        }
        $package->delete();
        $message = 'Your package is deleted successfully.';
        return response()->json(['status'=>'ok', 'message'=>$message, 'package'=>$package], 200);
    }

    /**
     * Change status of the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        $rules = ['package_id'=>'required|exists:packages,id'];
        $validator = Validator::make($request->only('package_id'), $rules);
        if($validator->fails())
            return response()->json(['status'=>'error', 'message'=>$validator->errors()->all()], 422);
        
        $package = Package::find($request->package_id);
        $message = '';
        if($package->is_active == 0){
            $package->is_active = 1;
            $message = 'Your package is published successfully.';
        } else {
            $package->is_active = 0;
            $message = 'Your package is unpublished successfully.';
        }
        $package->save();

        return response()->json(['status'=>'ok', 'message'=>$message, 'package'=>$package], 200);
    }

    /**
     * Change special of the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function makeSpecial(Request $request)
    {
        $rules = ['package_id'=>'required|exists:packages,id'];
        $validator = Validator::make($request->only('package_id'), $rules);
        if($validator->fails())
            return response()->json(['status'=>'error', 'message'=>$validator->errors()->all()], 422);
        
        $package = Package::find($request->package_id);
        $message = '';
        if($package->is_special == 0){
            $package->is_special = 1;
            $message = 'Your package is added to special successfully.';
        } else {
            $package->is_special = 0;
            $message = 'Your package is removed from special successfully.';
        }
        $package->save();

        return response()->json(['status'=>'ok', 'message'=>$message, 'package'=>$package], 200);
    }

    /**
     * Make last minute deal of the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function makeLastMinuteDeal(Request $request)
    {
        $rules = ['package_id'=>'required|exists:packages,id'];
        $validator = Validator::make($request->only('package_id'), $rules);
        if($validator->fails())
            return response()->json(['status'=>'error', 'message'=>$validator->errors()->all()], 422);
        
        $package = Package::find($request->package_id);
        $message = '';
        if($package->last_minute_deal == 0){
            $package->last_minute_deal = 1;
            $message = 'Your package is added to last minute deal successfully.';
        } else {
            $package->last_minute_deal = 0;
            $message = 'Your package is removed from last minute deal successfully.';
        }
        $package->save();

        return response()->json(['status'=>'ok', 'message'=>$message, 'package'=>$package], 200);
    }


    /**
     * sort orders of the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sortOrder(Request $request)
    {
        $rules = ['packages'=>'required'];
        $validator = Validator::make($request->only('packages'), $rules);
        if($validator->fails())
            return response()->json(['status'=>'error', 'message'=>$validator->errors()->all()], 422);
        
        $packages = explode('&',str_replace('package[]=','',$request->packages));
        $position = 1;
        foreach ($packages as $packageId) {
            $package                 = Package::find($packageId);
            $package->order_position = $position;
            $package->save();
            $position++;
        }
        return response()->json(['status'=>'success', 'message'=>'Your packages are sorted successfully.'], 200);
    }
}
