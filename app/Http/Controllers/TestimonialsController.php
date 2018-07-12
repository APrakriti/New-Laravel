<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Testimonial;


use Validator;
use Session;
use Auth;

class TestimonialsController extends Controller
{
   
    public function index()
    {
       // dd('chbdc');
        $testimonials = Testimonial::where('is_active', 1)
             ->where('type',Session::get('bound_type'))
            ->orderBy('order_position')
            ->paginate(6);
        return view('frontend.testimonials')
            ->with('testimonials', $testimonials);
    }


}
