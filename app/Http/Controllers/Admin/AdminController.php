<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Destination;
use App\Models\Package;
use App\Models\Booking;
use App\User;

use Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countDestination = Destination::count();
  		$countPackage = Package::count();
        $countBooking = Booking::count();
  		$countCustomer = User::where('is_active',1)
                        ->where('role_id',3)->count();

		return view('backend.dashboard')
					->with('countDestination', $countDestination)
					->with('countPackage', $countPackage)
                    ->with('countBooking', $countBooking)
					->with('countCustomer', $countCustomer);
    }    
}
