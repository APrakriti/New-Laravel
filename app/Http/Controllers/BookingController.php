<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Package;
use App\Models\Booking;
use App\Models\BookingPayment;
use Redirect;
use Paypal;
use Validator;
use Auth;
use App\Classes\Helper;

class BookingController extends Controller
{
    private $_apiContext;

    public function __construct()
    {
        $this->_apiContext = PayPal::ApiContext(
            config('services.paypal.client_id'),
            config('services.paypal.secret'));

        $this->_apiContext->setConfig(array(
            'mode' => env('PAYPAL_MODE'),
            'service.EndPoint' => env('PAYPAL_ENDPOINT'),
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'FINE'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postBooking(Request $request, $slug)
    {
        $package = Package::where('slug', $slug)->first();
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

            if (!$package->starting_price > 0) {
                return redirect()->back()
                    ->with('status', 'error')
                    ->with('message', 'This package can not be booked.');
            }
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
            $booking->is_active = $request->input('is_active', 0);
            $booking->token = substr(str_shuffle('aAbBcCdDEeEfFgGhHiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYzZ0123456789'), 0, 30);
            $booking->save();
            $booking->delete();

            if ($booking->id) {
                return view('frontend.booking_detail')->with(array('package' => $package, 'bookingInfo' => $booking, 'relatedPackages' => $relatedPackages));
            } else {
                redirect()->back()->with('status', 'error')
                    ->with('message', 'This package can not be booked.');
            }

            // redirect to review page

        } else {
            return view('frontend.404');
        }
    }


    public function getCheckout($slug, $id)
    {
        $package = Package::where('slug', $slug)->first();
        if ($package) {

            $booking = Booking::onlyTrashed()->find($id);


            $payer = PayPal::Payer();
            $payer->setPaymentMethod('paypal');

            $bookedPackage = PayPal::Item();
            $bookedPackage->setName($package->heading)
                ->setDescription($package->heading)
                ->setCurrency('USD')
                ->setQuantity($booking->number_of_traveller)
                ->setPrice($package->starting_price);

            $itemList = PayPal::ItemList();
            $itemList->addItem($bookedPackage);


            $amount = PayPal::Amount();
            $amount->setCurrency("USD")
                ->setTotal($booking->amount);
            //->setDetails($details);

            $transaction = PayPal::Transaction();
            $transaction->setAmount($amount)
                ->setItemList($itemList)
                ->setInvoiceNumber(uniqid())
                ->setDescription($package->heading . ' Payment');


            $presentation = PayPal::Presentation();
            $presentation->setLogoImage("http://ibookmytour.com/images/paypal_logo.png")->setBrandName("I Book My Tour");

            $redirectUrls = PayPal:: RedirectUrls();
            $redirectUrls->setReturnUrl(route('package.booking.success', $booking->token))
                ->setCancelUrl(route('package.booking.cancel', $booking->token));


            $payment = PayPal::Payment();
            $payment->setIntent('sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirectUrls)
                ->setTransactions(array($transaction));

            $response = $payment->create($this->_apiContext);
            $redirectUrl = $response->links[1]->href;

            return Redirect::to($redirectUrl);
        } else {
            return view('frontend.404');
        }
    }

    public function getSuccess(Request $request, $ttoken)
    {

        $booking = Booking::onlyTrashed()->where('token', $ttoken)->first();
        $package = Package::find($booking->package_id);

        if ($booking) {
            $booking->token = NULL;
            $booking->is_active = 1;
            $booking->call_back = serialize($request->all());
            $booking->restore();

            $id = $request->get('paymentId');
            $token = $request->get('token');
            $payer_id = $request->get('PayerID');

            try {
                $payment = PayPal::getById($id, $this->_apiContext);
                $paymentExecution = PayPal::PaymentExecution();
                $paymentExecution->setPayerId($payer_id);
                $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

                $bookingPayment = new BookingPayment();
                $bookingPayment->transaction_id = $executePayment->id;
                $bookingPayment->status = $executePayment->payer->status;
                $bookingPayment->first_name = $executePayment->payer->payer_info->first_name;
                $bookingPayment->last_name = $executePayment->payer->payer_info->last_name;
                $bookingPayment->email = $executePayment->payer->payer_info->email;
                $bookingPayment->payer_id = $executePayment->payer->payer_info->payer_id;
                $bookingPayment->currency = $executePayment->transactions[0]->amount->currency;
                $bookingPayment->transaction_amount = $executePayment->transactions[0]->amount->total;
                $bookingPayment->transaction_fee = $executePayment->transactions[0]->related_resources[0]->sale->transaction_fee->value;
                $bookingPayment->description = $executePayment;

                $booking->payment()->save($bookingPayment);


                // send email to the user

                $receiverEmail = $booking->email_address;
                $subject = "Package Pooking Confirmation";
                $content = '<table cellspacing="0" cellpadding="0" width="100%">';
                $content .= '<tr><td><p>Dear <strong>'.$booking->first_name.' '.$booking->last_name.',</strong> <br />';
                $content .= '<br />Booking for <strong>'.$package->heading.'</strong> Package has been received and is being processed, we will be in contact with you shortly.</td>';
                $content .= '</table>';

                $content .= '<table cellspacing="0" cellpadding="0" width="100%" border="0" style="border-collapse:collapse;margin-top: 20px;">';
                $content .= '<tr><td colspan="2">Booking Detail</td></tr>';
                $content .= '<tr><td width="150">Full Name :</td><td>'.$booking->first_name.' '.$booking->last_name.'</td></tr>';
                $content .= '<tr><td width="150">Package Name:</td><td>'.$package->heading.'</td></tr>';
                $content .= '<tr style="margin-top: 10px;"><td width="150">Number of traveller :</td><td>' . $booking->number_of_traveller . '</td></tr>';
                $content .= '<tr style="margin-top: 10px;"><td width="150">Total Amount(USD) :</td><td>' . $booking->amount . '</td></tr>';
                $content .= '<tr style="margin-top: 10px;"><td width="150">Arrival Date :</td><td>' . $booking->arrival_date . '</td></tr>';
                $content .= '<tr style="margin-top: 10px;"><td width="150">Departure Date :</td><td>' . $booking->departure_date . '</td></tr>';

                $content .= '</table>';

                $content .= '<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse:collapse;margin-top: 20px;">';
                $content .= '<tr><td><p>Kind Regards,</strong> <br />';
                $content .= env('SITE_NAME') . '</td>';
                $content .= '</table>';

                Helper::sendEmail($receiverEmail, $subject, $content);


                $receiverAdminEmail = env('ADMIN_EMAIL');
                $subject = "Package Pooking Confirmation";
                $contentAdmin = '<table cellspacing="0" cellpadding="0" width="100%">';
                $contentAdmin .= '<tr><td><p>Dear <strong>Admin</strong>';
                $contentAdmin .= '<br />Booking for <strong>'.$package->heading.'</strong> Package has been received.</td>';
                $contentAdmin .= '</table>';

                $contentAdmin .= '<table cellspacing="0" cellpadding="0" width="100%" border="0" style="border-collapse:collapse;margin-top: 20px;">';
                $contentAdmin .= '<tr><td colspan="2">Booking Detail</td></tr>';
                $contentAdmin .= '<tr><td width="150">Full Name :</td><td>'.$booking->first_name.' '.$booking->last_name.'</td></tr>';
                $contentAdmin .= '<tr><td width="150">Package Name:</td><td>'.$package->heading.'</td></tr>';
                $contentAdmin .= '<tr style="margin-top: 10px;"><td width="150">Number of traveller :</td><td>' . $booking->number_of_traveller . '</td></tr>';
                $contentAdmin .= '<tr style="margin-top: 10px;"><td width="150">Total Amount(USD) :</td><td>' . $booking->amount . '</td></tr>';
                $contentAdmin .= '<tr style="margin-top: 10px;"><td width="150">Arrival Date :</td><td>' . $booking->arrival_date . '</td></tr>';
                $contentAdmin .= '<tr style="margin-top: 10px;"><td width="150">Departure Date :</td><td>' . $booking->departure_date . '</td></tr>';

                $contentAdmin .= '</table>';

                $contentAdmin .= '<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse:collapse;margin-top: 20px;">';
                $contentAdmin .= '<tr><td><p>Kind Regards,</strong> <br />';
                $contentAdmin .= env('SITE_NAME') . '</td>';
                $contentAdmin .= '</table>';

                Helper::sendEmail($receiverAdminEmail, $subject, $contentAdmin);
                // sending admin email ends

                $request->session()->flash('type', 'success');
                $request->session()->flash('message', 'Thank You <br>Booking for <strong>'.$package->heading.'</strong> Package has been received and is being processed, we will be in contact with you shortly.<br>
                '.env('SITE_NAME').'');
                return view('frontend.success');

            } catch (PayPal\Exception\PayPalConnectionException $ex) {
                $booking->is_active = 0;
                $booking->delete();
                $error = json_decode($ex->getData());
                $request->session()->flash('type', 'error');
                $request->session()->flash('message', $error->message);
                return view('frontend.error');
            } catch (Exception $ex) {
                $booking->is_active = 0;
                $booking->delete();
                $request->session()->flash('type', 'error');
                $request->session()->flash('message', 'Booking was unsuccessful!');
                return view('frontend.error');
            }
        } else {
            $request->session()->flash('type', 'error');
            $request->session()->flash('message', 'Oops! Either you tried to manipulate the system or you referesh the page after succssful booking.');
            return view('frontend.error');
        }
    }

    public function getCancel(Request $request, $token)
    {
        $booking = Booking::onlyTrashed()->where('token', $token)->first();
        $booking->token = NULL;
        $booking->save();

        $request->session()->flash('type', 'success');
        $request->session()->flash('message', 'Booking is canceled!');
        return view('frontend.cancel');
    }
}
