@extends('layout.container')

@section('title', $package->title)
@section('meta_tags', $package->meta_tags)
@section('meta_description', $package->meta_description)

@section('footer_js')
   
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
                  <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                  <a href="{{ route('packages') }}" class="breadcrumb">Tour Packages</a>
                  <a href="{{ route('package.detail', $package->slug) }}" class="breadcrumb">{{ $package->heading }}</a>
                  <a href="#!" class="breadcrumb">Online Booking</a>
               </div>
               <div class="sub_title mgb25">
                  <h2>Online Booking</h2>
               </div>
               <div class="row">
                  <div class="col l8 m8 s12">
                     <form action="" name="bookingForm" method="POST">
                     <div class="form_wrap">
                        @include('layout.alert')
                        <div class="row">
                           <div class="col l12 m12 s12">
                              <div class="inner_head">Package Details</div>
                           </div>
                           <div class="col l6 m6 s12">
                              <div class="input-field ">
                                 <input type="text" disabled value="{{ $package->heading }}" id="disabled" name="heading" class="validate">
                                 <input type="hidden" value="{{ $package->id }}" id="disabled" name="package_id" class="validate">
                              </div>
                           </div>
                           <div class="col l6 m6 s12">
                              <div class="input-field ">
                                 <select name="number_of_traveller" id="number_of_traveller">
                                    <option selected="" value="" >No of Travellers</option>
                                    @for ($i = 1; $i <= 100; $i++)
                                    <option value="{{ $i }}"> {{ $i }}</option>
                                    @endfor
                                 </select>
                              </div>
                           </div>
                           <div class="clear"></div>
                           <div class="col l6 m6 s12">
                              Arrival Date 
                              <input type="date" name="arrival_date" value="{{ old('arrival_date') }}" class="datepicker">
                           </div>
                           <div class="col l6 m6 s12">
                              Departure Date 
                              <input type="date" name="departure_date" value="{{ old('departure_date') }}" class="datepicker">
                           </div>
                        </div>
                        <!--row end-->
                     </div>
                     <!--form wrap end-->
                     <div class="form_wrap">
                        <div class="row">
                           <div class="col l12 m12 s12">
                              <div class="inner_head">Personal Details</div>
                           </div>
                           <div class="col l6 m6 s12">
                              <div class="input-field  ">
                                 <input id="" name="first_name" type="text" value="{{ old('first_name') }}" class="validate">
                                 <label for="">First Name</label>
                              </div>
                           </div>
                           <div class="col l6 m6 s12">
                              <div class="input-field  ">
                                 <input id="" name="last_name" type="text" value="{{ old('last_name') }}" class="validate">
                                 <label for="">Last Name</label>
                              </div>
                           </div>
                           <div class="col l6 m6 s12">
                              <div class="input-field  ">
                                 <input id="" name="address" type="text" value="{{ old('address') }}" class="validate">
                                 <label for="">Address</label>
                              </div>
                           </div>
                           <div class="col l6 m6 s12">
                              <div class="input-field">
                                 <select id="country_id" name="country_id" class="validate">
                                    <option value="" selected="" >Select Country</option>
                                    @foreach($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                    @endforeach
                                 </select>
                                 <label for="">Country</label>
                              </div>
                           </div>
                           <div class="col l6 m6 s12">
                              <div class="input-field  ">
                                 <input id="" name="contact_number" type="text" value="{{ old('contact_number') }}" class="validate">
                                 <label for="">Contact No.</label>
                              </div>
                           </div>
                           <div class="col l6 m6 s12">
                              <div class="input-field  ">
                                 <input id="email" name="email_address" type="email" value="{{ old('email_address') }}" class="validate">
                                 <label for="email">Email</label>
                              </div>
                           </div>
                        </div>
                        <!--row end-->
                        <div> <button class="btn ">Book Now</button></div>
                        <div class="clear"></div>
                     </div>
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