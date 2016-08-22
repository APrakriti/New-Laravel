<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Destination;
use App\Models\Package;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $destinations = Destination::with('activePackages')
                        ->where('is_active', 1)
                        ->orderBy('order_position')
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
        $destination = Destination::where('slug', $slug)
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
