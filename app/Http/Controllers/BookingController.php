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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getCheckout(Request $request, $slug)
    {
        $package = Package::where('slug', $slug)->first();
        if($package){
            $rules = [
                'email_address'=>'required',
                'arrival_date'=>'required',
                'first_name'=>'required',
                'country_id'=>'required|exists:countries,id',
                'number_of_traveller'=>'required|min:1',
                'contact_number'=>'required|max:16',
            ];

            $validator = Validator::make($request->all(), $rules);
            if($validator->fails())
                return redirect()->back()->withInput()->withErrors($validator);
            
            if(!$package->starting_price > 0){
              return redirect()->back()
                        ->with('status', 'error')  
                        ->with('message', 'This package can not be booked.');  
            }

            // $captcha = $request->input('g-recaptcha-response');
            // $recaptchaSecret = env('RECAPTCHA_SECRET_KEY');
            // $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $recaptchaSecret . "&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
            // $response = json_decode($response);
            
            // if ($response->success == false) {
            //     return redirect()->back()
            //          ->withInput()
            //          ->with('status', 'error')
            //          ->with('message', 'Invalid captcha verification.');
            // }          
            
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

            $payer = PayPal::Payer();
            $payer->setPaymentMethod('paypal');

            $amount = PayPal:: Amount();
            $amount->setCurrency('USD')
                    ->setTotal($booking->amount);
            // This is the simple way,
            // you can alternatively describe everything in the order separately;
            // Reference the PayPal PHP REST SDK for details.

            $transaction = PayPal::Transaction();
            $transaction->setAmount($amount)
                        ->setDescription($package->heading);

            $redirectUrls = PayPal:: RedirectUrls();
            $redirectUrls->setReturnUrl(route('package.booking.success', $booking->token))
                        ->setCancelUrl(route('package.booking.success', $booking->token));

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
        if($booking){
            $booking->token = NULL;      
            $booking->is_active = 1;
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
                
                $request->session()->flash('type', 'success');
                $request->session()->flash('message', 'Booking was successful!');
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
