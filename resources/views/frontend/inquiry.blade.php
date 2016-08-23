@extends('layout.container')

@section('title', $package->title)
@section('meta_tags', $package->meta_tags)
@section('meta_description', $package->meta_description)

@section('footer_js')
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script type='text/javascript'>//<![CDATA[
        $(window).load(function () {
            var dateToday = new Date();
            var dates = $("#from, #to").datepicker({
                defaultDate: "+1w",
                changeMonth: false,
                numberOfMonths: 1,
                dateFormat: "yy-mm-dd",
                minDate: dateToday,
                onSelect: function (selectedDate) {
                    var option = this.id == "from" ? "minDate" : "maxDate",
                            instance = $(this).data("datepicker"),
                            date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
                    dates.not(this).datepicker("option", option, date);
                }
            });
        });//]]>

    </script>
@endsection

@section('dynamicdata')
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/base/jquery-ui.css"
          type="text/css" media="all">
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
                            <a href="{{ route('package.detail', $package->slug) }}"
                               class="breadcrumb">{{ $package->heading }}</a>
                            <a href="#!" class="breadcrumb">Online Booking</a>
                        </div>
                        <div class="sub_title mgb25">
                            <h2>Online Inquiry</h2>
                        </div>
                       <div class="" style="float: right; margin-top: -55px;">
                                            <a onclick="window.history.back(1);"  class="btn green" href="#">Back</a>

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
                                                    <input type="text" disabled value="{{ $package->heading }}"
                                                           id="disabled" name="heading" class="validate">
                                                    <input type="hidden" value="{{ $package->id }}" id="disabled"
                                                           name="package_id" class="validate">
                                                </div>
                                            </div>
                                            <div class="col l6 m6 s12">
                                                <div class="input-field ">
                                                    <select name="number_of_traveller" id="number_of_traveller">
                                                        <option selected="" value="">No of Travellers</option>
                                                        @for ($i = 1; $i <= 100; $i++)
                                                            <option value="{{ $i }}"> {{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="col l6 m6 s12">
                                                Arrival Date
                                                <input type="text" name="arrival_date" value="{{ old('arrival_date') }}"
                                                       id="from">
                                            </div>
                                            <div class="col l6 m6 s12">
                                                Departure Date
                                                <input type="text" name="departure_date"
                                                       value="{{ old('departure_date') }}" class="" id="to">

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
                                                    <input id="" name="first_name" type="text"
                                                           value="{{ old('first_name') }}" class="validate">
                                                    <label for="">First Name</label>
                                                </div>
                                            </div>
                                            <div class="col l6 m6 s12">
                                                <div class="input-field  ">
                                                    <input id="" name="last_name" type="text"
                                                           value="{{ old('last_name') }}" class="validate">
                                                    <label for="">Last Name</label>
                                                </div>
                                            </div>
                                            <div class="col l6 m6 s12">
                                                <div class="input-field  ">
                                                    <input id="" name="address" type="text" value="{{ old('address') }}"
                                                           class="validate">
                                                    <label for="">Address</label>
                                                </div>
                                            </div>
                                            <div class="col l6 m6 s12">
                                                <div class="input-field">
                                                    <select id="country_id" name="country_id" class="browser-default validate">
                                                        <option value="" selected="">Select Country</option>
                                                        @foreach($countries as $country)
                                                            <option value="{{ $country->country_name }}">{{ $country->country_name }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col l6 m6 s12">
                                                <div class="input-field">
                                                    <input id="" name="contact_number" type="text"
                                                           value="{{ old('contact_number') }}" class="validate">
                                                    <label for="">Contact No.</label>
                                                </div>
                                            </div>
                                            <div class="col l6 m6 s12">
                                                <div class="input-field">
                                                    <input id="email" name="email_address" type="email"
                                                           value="{{ old('email_address') }}" class="validate">
                                                    <label for="email">Email</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!--row end-->
                                    <!-- <div class="row">
                           <div class="col l6 m6 s12">
                              <div class="input-field  ">
                                 <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                              </div>
                           </div>
                        </div> -->
                                        <div>
                                            <button class="btn ">Submit</button>
                                        </div>
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
                                                <li>
                                                    <a href="{{ route('package.detail',$package->slug) }}">{{ $package->heading }}</a>
                                                </li>
                                            @endforeach

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