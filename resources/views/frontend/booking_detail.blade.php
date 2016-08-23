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
                            <a href="#!" class="breadcrumb">Booking Detail</a>
                        </div>
                        <div class="sub_title mgb25">
                            <h2>
                                Booking Detail</h2>
                        </div>
                        <div class="row">
                            <div class="col l8 m8 s12">
                                <table class="striped">
                                    <thead>
                                    <tr>
                                        <th colspan="2">Booking Detail</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Package</td>
                                        <td>{{ $package->heading }}</td>
                                    </tr>
                                    <tr>
                                        <td>No of Travellers</td>
                                        <td>{{ $bookingInfo->number_of_traveller }}</td>
                                    </tr>
                                    <tr>
                                        <td>Total Amount</td>
                                        <td>$ {{ $bookingInfo->amount }}</td>
                                    </tr>
                                    <tr>
                                        <td>Arrival Date</td>
                                        <td>{{ $bookingInfo->arrival_date }}</td>
                                    </tr>

                                    <tr>
                                        <td>Departure Date</td>
                                        <td>{{ $bookingInfo->departure_date }}</td>
                                    </tr>
                                    <tr>
                                        <td>Full Name</td>
                                        <td>{{ $bookingInfo->first_name.' '.$bookingInfo->last_name }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="text-align: center;">Total Payment Amount :
                                            <strong>$ {{ $bookingInfo->amount }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="text-align: center;"><a href="{{ route('package.booking.checkout',array($package->slug,$bookingInfo->id)) }}" class="btn green" style="vertical-align: middle;    padding: 5px 15px;    height: 39px;
    font-size: 19px;"><i class="fa fa-paypal" aria-hidden="true"></i> Proceed to Paypal Payment</a></td>
                                    </tr>

                                    </tbody>
                                </table>
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