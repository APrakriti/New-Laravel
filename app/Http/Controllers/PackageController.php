<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Package;
use App\Models\Country;
use App\Models\Booking;

use Validator;
use Auth;
use App\Models\Activity;
use App\Models\Destination;
use App\Classes\Helper;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::with('coverGallery')
            ->where('is_active', 1)
            ->orderBy('order_position')
            ->paginate(env('PAGINATE'));
        return view('frontend.packages')
            ->with('packages', $packages);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deals()
    {
        $packages = Package::with('coverGallery')
            ->where('is_active', 1)
            ->where('last_minute_deal', 1)
            ->orderBy('order_position')
            ->paginate(env('PAGINATE'));
        return view('frontend.lastminutedeals')
            ->with('packages', $packages);
    }

    /**
     * Display a detail of the package resource.
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $package = Package::with('activeGalleries')
            ->where('slug', $slug)
            ->first();
        if ($package) {
            $relatedPackages = Package::where('is_active', 1)
                ->where('id', '<>', $package->id)
                ->orderBy('order_position')
                ->take(10)
                ->get();
            return view('frontend.package-detail')
                ->with('package', $package)
                ->with('relatedPackages', $relatedPackages);
        } else {
            return view('frontend.404');
        }
    }

    /**
     * Display booking form of the package resource.
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function booking($slug)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('booking', 'error')
                ->with('message', 'You should have logged in to book a package.');
        }

        $package = Package::with('activeGalleries')
            ->where('slug', $slug)
            ->first();
        if ($package) {
            $countries = Country::all();
            $relatedPackages = Package::where('is_active', 1)
                ->where('id', '<>', $package->id)
                ->orderBy('order_position')
                ->take(10)
                ->get();
            return view('frontend.booking')
                ->with('package', $package)
                ->with('countries', $countries)
                ->with('relatedPackages', $relatedPackages);
        } else {
            return view('frontend.404');
        }
    }

    /**
     * Display booking form of the package resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function book(Request $request, $slug)
    {
        $package = Package::with('activeGalleries')
            ->where('slug', $slug)
            ->first();
        if ($package) {
            $rules = [
                'email_address' => 'required',
                'arrival_date' => 'required',
                'first_name' => 'required',
                'country_id' => 'required|exists:countries,id',
                'number_of_traveller' => 'required|min:1',
                'contact_number' => 'required|max:16',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails())
                return redirect()->back()->withInput()->withErrors($validator);

            $relatedPackages = Package::where('is_active', 1)
                ->where('id', '<>', $package->id)
                ->orderBy('order_position')
                ->take(10)
                ->get();

            $booking = new Booking();
            $booking->package_id = $request->input('package_id', $package->id);
            $booking->user_id = Auth::user()->id;
            $booking->amount = $package->starting_price * $request->number_of_traveller;
            $booking->arrival_date = $request->arrival_date;
            $booking->departure_date = $request->departure_date;
            $booking->number_of_traveller = $request->number_of_traveller;
            $booking->first_name = $request->first_name;
            $booking->last_name = $request->last_name;
            $booking->address = $request->address;
            $booking->country_id = $request->country_id;
            $booking->contact_number = $request->contact_number;
            $booking->email_address = $request->email_address;
            $booking->payment_status = $request->input('payment_status', 0);
            $booking->is_active = $request->input('is_active', 0);
            $booking->save();
            $booking->delete();

            return view('frontend.booking-submit')
                ->with('package', $package)
                ->with('booking', $booking)
                ->with('relatedPackages', $relatedPackages);
        } else {
            return view('frontend.404');
        }
    }

    public function search(Request $request)
    {
        $package = Package::where('is_active', 1);
        if ($request->destination_id)
            $package->where('destination_id', $request->destination_id);
        if ($request->activity_id)
            $package->where('activity_id', $request->activity_id);
        if ($request->duration) {
            $duration = explode('-', $request->duration);
            $package->whereBetween('trip_duration', $duration);
        }
        if ($request->price) {
            $price = explode('-', $request->price);
            $package->whereBetween('starting_price', array(trim($price[0]) . '.00', trim($price[1]) . '.00'));
        }
        $packages = $package->paginate(env('PAGINATE'));

        $allActivities = Activity::where('is_active', 1)->lists('heading', 'id');
        $allDestinations = Destination::where('is_active', 1)->lists('heading', 'id');

        return view('frontend.searchpackages')
            ->with('packages', $packages)
            ->with('title', 'I BOOK MY TOUR')
            ->with('metaTags', 'I BOOK MY TOUR')
            ->with('metaDescription', 'I BOOK MY TOUR')
            ->with('allActivities', $allActivities)
            ->with('allDestinations', $allDestinations);

    }

    public function inquiry($slug)
    {
        $package = Package::with('activeGalleries')
            ->where('slug', $slug)
            ->first();
        if ($package) {
            $countries = Country::all();
            $relatedPackages = Package::where('is_active', 1)
                ->where('id', '<>', $package->id)
                ->orderBy('order_position')
                ->take(10)
                ->get();
            return view('frontend.inquiry')
                ->with('package', $package)
                ->with('countries', $countries)
                ->with('relatedPackages', $relatedPackages);
        } else {
            return view('frontend.404');
        }

    }

    public function postInquiry(Request $request, $slug)
    {
        $package = Package::with('activeGalleries')
            ->where('slug', $slug)
            ->first();
        if ($package) {
            $rules = [
                'email_address' => 'required',
                'arrival_date' => 'required',
                'first_name' => 'required',
                'country_id' => 'required|exists:countries,country_name',
                'number_of_traveller' => 'required|min:1',
                'contact_number' => 'required|max:16',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails())
                return redirect()->back()->withInput()->withErrors($validator);

            $relatedPackages = Package::where('is_active', 1)
                ->where('id', '<>', $package->id)
                ->orderBy('order_position')
                ->take(10)
                ->get();


            $receiverEmail = env('ADMIN_EMAIL');

            $subject = "Package Enquiry Received .";

            $content = '<table cellspacing="0" cellpadding="0" width="100%">';
            $content .= '<tr><td><p>Dear <strong>admin,</strong> <br />';
            $content .= '<br />A visitor <strong>' . $request->first_name . ' ' . $request->last_name . '</strong> has inquiry for the  <a href="' . route('package.detail', $package->slug) . '">' . $package->heading . '</a></td>';
            $content .= '</table>';

            $content .= '<table cellspacing="0" cellpadding="0" width="100%" border="0" style="border-collapse:collapse;margin-top: 20px;">';
            $content .= '<tr><td width="150">Full Name :</td><td>' . $request->first_name . ' ' . $request->last_name . '</td></tr>';
            $content .= '<tr style="margin-top: 10px;"><td width="150">Address :</td><td>' . $request->address . '</td></tr>';
            $content .= '<tr style="margin-top: 10px;"><td width="150">Country :</td><td>' . $request->country_id . '</td></tr>';
            $content .= '<tr style="margin-top: 10px;"><td width="150">Email :</td><td>' . $request->email_address . '</td></tr>';
            $content .= '<tr style="margin-top: 10px;"><td width="150">No of Travellers :</td><td>' . $request->number_of_traveller . '</td></tr>';
            $content .= '<tr style="margin-top: 10px;"><td width="150">Arrival Date :</td><td>' . $request->arrival_date . '</td></tr>';
            $content .= '<tr style="margin-top: 10px;"><td width="150">Departure Date :</td><td>' . $request->departure_date . '</td></tr>';


            $content .= '</table>';

            $content .= '<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse:collapse;margin-top: 20px;">';
            $content .= '<tr><td><p>Kind Regards,</strong> <br />';
            $content .= env('SITE_NAME') . '</td>';
            $content .= '</table>';

            $email = Helper::sendEmail($receiverEmail, $subject, $content);

            return view('frontend.inquiry-success')
                ->with('package', $package)
                ->with('relatedPackages', $relatedPackages);
        } else {
            return view('frontend.404');
        }

    }
}
