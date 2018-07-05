<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Destination;
use App\Models\Package;
use Session;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
        $destinations = Destination::with('activePackages')
                        ->where('is_active', 1)
                        ->where('type',Session::get('bound_type'))
                        ->orderBy('order_position')
                        ->where(function($destinations) use ($type) {
                    if(isset($type)) {
                        $destinations->where('type', $type);
                     }              
                     })
                ->paginate(env('PAGINATE'));

        return view('frontend.destinations')
                    ->with('destinations', $destinations);
    }

    /**
     * Display detail of destination
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $destination = Destination::where('slug', $slug)->where('type',Session::get('bound_type'))
                   
            ->first();

        if($destination){
            $packages = $destination->activePackages()
                                ->paginate(env('PAGINATE'));
            return view('frontend.destination-detail')
                    ->with('destination', $destination)
                    ->with('packages', $packages);
        } else {
            return view('frontend.404');
        }   
    }    
}
