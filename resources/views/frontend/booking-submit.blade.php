@extends('layout.container')

@section('title', $package->title)
@section('meta_tags', $package->meta_tags)
@section('meta_description', $package->meta_description)

@section('footer_js')
   <script>window.onload = document.confirm_payment.submit();</script>
@endsection
@section('dynamicdata')

<section class="inner_banner">
   <img src="{{ asset('images/inner_banner2.jpg') }}">
</section>
<!--slideshow end-->
<section class="body_content_wrap">
   <div class="container">
      <div class="row">
         <div class="col l12 m12 s12">
            <div class="body_content">
               <div class="breadcrumb-wrapper">
                  <a href="{{ route('home',Session::get('bound_type')) }}" class="breadcrumb">Home</a>
                  <a href="{{ route('packages',Session::get('bound_type')) }}" class="breadcrumb">Tour Packages</a>
                  <a href="{{ route('package.detail', $package->slug) }}" class="breadcrumb">{{ $package->heading }}</a>
                  <a href="#!" class="breadcrumb">Online Booking</a>
               </div>
               <div class="sub_title mgb25">
                  <h2>Online Booking</h2>
               </div>
               <?php   
                  $actionPage = "https://www.sandbox.paypal.com/cgi-bin/webscr";
                  //$actionPage = "https://www.paypal.com/cgi-bin/webscr";
               ?>
               <div class="row">
                  <div class="col l8 m8 s12">
                     <form action="{{ $actionPage }}" method="post" name="confirm_payment" id="confirm_payment">
                        <input type="hidden" name="amount" value="{{ $package->starting_amount }}">
                        <input name="cmd" type="hidden" value="_donations" /> 
                        <input type="hidden" name="business" value="{{ env('PAYPAL_EMAIL') }}">
                        <input type="hidden" name="item_name" value="{{ env('SITE_NAME') }}">
                        <input type="hidden" name="item_number" value="">
                        <input type="hidden" name="no_note" value="1">
                        <input type="hidden" name="currency_code" value="{{ 'USD' }}">
                        <input type="hidden" name="cancel_return" value="{{ route('package.detail', $package->slug) }}">
                        <input type="hidden" name="return" value="{{ route('paypal.success') }}">
                        <input type="hidden" name="notify_url" value="{{ route('paypal.booking.notify', $booking->id) }}" />
                        <input type='hidden' name="rm" value="2">
                        <input type="hidden" name="image_url" value="{{ asset('img/logo.png') }}">
                        <input type="hidden" name="upload" value="1">
                        {!! csrf_field() !!}
                      </form>
                     <!--form wrap end-->
                  </div>
                  <!--col end-->
                  <div class="col l4 m4 s12">
                     <div class="box related_trip_wrap">
                        <div class="inner_head">Related Packages</div>
                        <div class="list">
                           <ul>
                              @foreach($relatedPackages as $package)
                                 <li><a href="{{ route('package.detail',$package->slug) }}">{{ $package->heading }}</a></li>
                              @endforeach<li><a href="services/branding-and-identity.html">Annapurna Panchase Hill Trek</a></li>
                           </ul>
                           <div class="clear"></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!--body content end-->
         </div>
      </div>
   </div>
</section>
<!--body content wrap-->

@stop