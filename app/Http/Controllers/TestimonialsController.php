<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Testimonial;


use Validator;
use Auth;

class TestimonialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonial::where('is_active', 1)
            ->orderBy('order_position')
            ->paginate(6);
//            ->paginate(env('PAGINATE'));
        return view('frontend.testimonials')
            ->with('testimonials', $testimonials);
    }


}
