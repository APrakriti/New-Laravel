<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Package;
use App\Models\Booking;
use App\Models\BookingPayment;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('payment','package','customer')
                            ->get();
        return view('backend.booking.index')
                ->with('bookings', $bookings);

    }

    public function detail($id)
    {
        $booking = Booking::with('payment','package','customer','country')->find($id);
        return view('backend.booking.detail')
                ->with('booking', $booking);
    }  
}
