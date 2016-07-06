<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Jobs\SendEmail;
use App\Classes\Helper;

use App\Models\Activity;
use App\Models\Banner;
use App\Models\Content;
use App\Models\Destination;
use App\Models\Package;
use App\Models\Testimonial;
use Validator;

class HomeController extends Controller
{
    /**
     * Display home page.
     *
     * @return \Illuminate\View\View
     */
    public function getHomePage()
    {
        $banners = Banner::where('is_active', 1)
                    ->orderBy('order_position')
                    ->get();
        $specialPackages = Package::with('coverGallery')
                            ->where('is_active', 1)
                            ->where('is_special', 1)
                            ->orderBy('order_position')
                            ->take(6)
                            ->get();
        $lastMinuteDeals = Package::with('coverGallery')
                            ->where('is_active', 1)
                            ->where('last_minute_deal', 1)
                            ->orderBy('order_position')
                            ->take(4)
                            ->get();
        $fixedDeparturePackage = Package::with('coverGallery')
                                ->where('is_active', 1)
                                ->orderBy('order_position')
                                ->first();
        $destinations = Destination::with('activePackages')
                                    ->where('is_active', 1)
                                    ->orderBy('order_position')
                                    ->take(4)->get();
        
        $testimonials = Testimonial::where('is_active', 1)
                                    ->orderBy('order_position')
                                    ->take(2)->get();

        $allActivities = Activity::where('is_active', 1)->lists('heading', 'id');
        $allDestinations = Destination::where('is_active', 1)->lists('heading', 'id');
        
        return view('frontend.index')
                    ->with('banners', $banners)
                    ->with('specialPackages', $specialPackages)
                    ->with('lastMinuteDeals', $lastMinuteDeals)
                    ->with('fixedDeparturePackage', $fixedDeparturePackage)
                    ->with('destinations', $destinations)
                    ->with('testimonials', $testimonials)
                    ->with('allActivities', $allActivities)
                    ->with('allDestinations', $allDestinations)
                    ->with('title', 'I BOOK MY TRIP')
                    ->with('metaTags', 'I BOOK MY TRIP')
                    ->with('metaDescription', 'I BOOK MY TRIP');
    }

    /**
     * Display contact page.
     *
     * @return \Illuminate\View\View
     */
    public function getContactPage()
    {
        $page = Page::where('slug', 'contact')->first();
        return view('frontend.contact')
                ->with('page', $page);
    }

    /**
     * Submit contact form
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function submitContactPage(Request $request)
    {
        $rules = [
                    'full_name' => 'required',
                    'email_address' => 'required|email',
                    'subject' => 'required',
                    'message' => 'required'
                ];      
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails()) 
            return redirect()->back()->withInput()->withErrors($validator);

            $receiverEmail  = env('ADMIN_EMAIL');
            $ccEmail  = 'adhikarysunil.1@outlook.com';
            
            $subject     = "Contact form submitted.";
            
            $content     = '<table cellspacing="0" cellpadding="0" width="100%">';
            $content    .= '<tr><td><p>Dear <strong>admin,</strong> <br />';
            $content    .= '<br />A visitor <strong>' . $request->full_name . '</strong> has given feedback with following details.</td>';
            $content    .= '</table>';
            
            $content    .= '<table cellspacing="0" cellpadding="0" width="100%" border="0" style="border-collapse:collapse;margin-top: 20px;">';                
            $content    .= '<tr><td width="150">Full Name :</td><td>' . $request->full_name .'</td></tr>';
            $content    .= '<tr style="margin-top: 10px;"><td width="150">Email Address :</td><td>' . $request->email_address .'</td></tr>';
            $content    .= '<tr style="margin-top: 10px;"><td width="150">Subject :</td><td>' . $request->subject .'</td></tr>';
            $content    .= '<tr style="margin-top: 10px;"><td width="150">Message :</td><td>' . $request->message .'</td></tr>';           
            $content    .= '</table>';
            
            $content    .= '<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse:collapse;margin-top: 20px;">';
            $content    .= '<tr><td><p>Kind Regards,</strong> <br />';
            $content    .= env('SITE_NAME') .'</td>';
            $content    .= '</table>';

            $this->dispatch(new SendEmail($receiverEmail, $subject, $content));

        return redirect()->route('contact')
                        ->with('status', 'success')
                        ->with('message', 'Your contact form is submitted successfully !');
    }

    public function content($slug)
    {
        $content = Content::where('slug', $slug)
                    ->where('is_active',1)->first();
        $packages = Package::where('is_active',1)
                    ->orderBy(\DB::raw('RAND()'))
                    ->take(8)->get();
        return view('frontend.content')
                    ->with('content', $content)
                    ->with('packages', $packages);
    }

    public function hotelInquiry(Request $request)
    {
        $rules = [
                'full_name'=>'required',
                'email_address'=>'required | email',
                ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
            return response()->json(['message'=>$validator->errors()->all(), 'type'=>'error'], 422);

        $receiverEmail  = env('ADMIN_EMAIL');
            
        $subject     = "Hotel Inquiry form submitted.";
            
        $content     = '<table cellspacing="0" cellpadding="0" width="100%">';
        $content    .= '<tr><td><p>Dear <strong>admin,</strong> <br />';
        $content    .= '<br />A visitor <strong>' . $request->full_name . '</strong> has given hotel inquiry with following details.</td>';
        $content    .= '</table>';
            
        $content    .= '<table cellspacing="0" cellpadding="0" width="100%" border="0" style="border-collapse:collapse;margin-top: 20px;">';                
        $content    .= '<tr><td width="150">Full Name :</td><td>' . $request->full_name .'</td></tr>';
        $content    .= '<tr style="margin-top: 10px;"><td width="150">Address :</td><td>' . $request->address .'</td></tr>';
        $content    .= '<tr style="margin-top: 10px;"><td width="150">Email Address :</td><td>' . $request->email_address .'</td></tr>';
        $content    .= '<tr style="margin-top: 10px;"><td width="150">Phone Number :</td><td>' . $request->phone_number .'</td></tr>';
        $content    .= '<tr style="margin-top: 10px;"><td width="150">No of Rooms :</td><td>' . $request->number_of_rooms .'</td></tr>';           
        $content    .= '<tr style="margin-top: 10px;"><td width="150">No of Person :</td><td>' . $request->number_of_person .'</td></tr>';           
        $content    .= '</table>';
            
        $content    .= '<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse:collapse;margin-top: 20px;">';
        $content    .= '<tr><td><p>Kind Regards,</strong> <br />';
        $content    .= env('SITE_NAME') .'</td>';
        $content    .= '</table>';

        // $this->dispatch(new SendEmail($receiverEmail, $subject, $content));
        $email = Helper::sendEmail($receiverEmail, $subject, $content);

        return response()->json(['message'=>$request->all(), 'type'=>'success'], 200);
    }

    public function carRentInquiry(Request $request)
    {
        return response()->json(['message'=>$request->all(), 'type'=>'error'], 422);
    }    
}
