@extends('layout.container')

@section('title', $title)
@section('meta_tags', $metaTags)
@section('meta_description', $metaDescription)

@section('footer_js')
    <!-- Owl Carousel Assets -->
    <script src="{{ asset('owl-carousel/owl.carousel.js') }}"></script>
    <link href="{{ asset('owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('owl-carousel/owl.theme.css') }}" rel="stylesheet">
    <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
    <link href="{{ asset('plugins/sweetalert/dist/sweetalert.css') }}" rel="stylesheet" type="text/css">
    <script>
        $(document).ready(function () {

            var owl = $("#owl-demo");

            owl.owlCarousel({
                items: 3, //10 items above 1000px browser width
                itemsDesktop: [1270, 3], //5 items between 1000px and 901px
                itemsDesktopSmall: [900, 2], // betweem 900px and 601px
                itemsTablet: [600, 1], //2 items between 600 and 0
                itemsMobile: false // itemsMobile disabled - inherit from itemsTablet option
            });

            // Custom Navigation Events
            $(".next").click(function () {
                owl.trigger('owl.next');
            })
            $(".prev").click(function () {
                owl.trigger('owl.prev');
            })
            $(".play").click(function () {
                owl.trigger('owl.play', 5000); //owl.play event accept autoPlay speed as second parameter
            })
            $(".stop").click(function () {
                owl.trigger('owl.stop');
            });

            $('#hotelInquiry').submit(function (e) {
                e.preventDefault();
                $object = $(this);
                var data = $object.serialize();
                var full_name = $object.find('.full_name').val();

                if (full_name == '') {
                    swal("Error ! ", "Full name is required.", "error");
                    return false;
                }

                var address = $object.find('.address').val();
                if (address == '') {
                    swal("Error ! ", "Address is required.", "error");
                    return false;
                }

                var phone_number = $object.find('.phone_number').val();

                if (phone_number == '') {
                    swal("Error ! ", "Phone number is required.", "error");
                    return false;
                }
                var email_address = $object.find('.email_address').val();

                if (email_address == '') {
                    swal("Error ! ", "Email Address is required.", "error");
                    return false;
                }


                var number_of_rooms = $object.find('.number_of_rooms').find(":selected").val();

                if (number_of_rooms == '') {
                    swal("Error ! ", "Number of room is required.", "error");
                    return false;
                }
                var number_of_person = $object.find('.number_of_person').find(":selected").val();
                if (number_of_person == '') {
                    swal("Error ! ", "Number of person is required.", "error");
                    return false;
                }
                swal({
                    title: "Make Inquiry!",
                    text: "Are you sure to make inquiry?",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                }, function () {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('submit.hotel.inquiry') }}",
                        data: {
                            full_name: full_name,
                            address: address,
                            email_address: email_address,
                            phone_number: phone_number,
                            number_of_rooms: number_of_rooms,
                            number_of_person: number_of_person,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            $("#hotelInquiry")[0].reset();
                            setTimeout(
                                    function () {
                                        swal("Your inquiry is submitted successfully.");
                                    }, 20);
                        },
                        error: function (error) {
                            setTimeout(
                                    function () {
                                        swal("Your inquiry is not submitted.");
                                    }, 20);
                        },
                    });
                });
            });

            $('#carRentInquiry').submit(function (e) {
                e.preventDefault();
                $object = $(this);
                var data = $object.serialize();
                var full_name = $object.find('.full_name').val();
                if (full_name == '') {
                    swal("Error ! ", "Full name is required.", "error");
                    return false;
                }
                var address = $object.find('.address').val();
                if (address == '') {
                    swal("Error ! ", "Address is required.", "error");
                    return false;
                }
                var phone_number = $object.find('.phone_number').val();

                if (phone_number == '') {
                    swal("Error ! ", "Phone number is required.", "error");
                    return false;
                }

                var email_address = $object.find('.email_address').val();

                if (email_address == '') {
                    swal("Error ! ", "Email is required.", "error");
                    return false;
                }

                var pick_up = $object.find('.pick_up').val();

                if (pick_up == '') {
                    swal("Error ! ", "Pick up is required.", "error");
                    return false;
                }
                var drop_out = $object.find('.drop_out').val();

                if (drop_out == '') {
                    swal("Error ! ", "Drop out up is required.", "error");
                    return false;
                }
                swal({
                    title: "Make Inquiry!",
                    text: "Are you sure to make inquiry?",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                }, function () {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('submit.carrent.inquiry') }}",
                        data: {
                            full_name: full_name,
                            address: address,
                            email_address: email_address,
                            phone_number: phone_number,
                            pick_up: pick_up,
                            drop_out: drop_out,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            $("#carRentInquiry")[0].reset();
                            setTimeout(
                                    function () {
                                        swal("Your inquiry is submitted successfully.");
                                    }, 20);
                        },
                        error: function (error) {
                            setTimeout(
                                    function () {
                                        swal("Your inquiry is not submitted.");
                                    }, 20);
                        },
                    });
                });
            });
        });
    </script>
@endsection

@section('dynamicdata')
    <section class="slideshow">
        <div class="slider">
            <ul class="slides">
                @foreach($banners as $index=>$banner)
                    <li>
                        <img src="{{ asset('uploads/banners/'.$banner->attachment) }}"/>
                        <div class="caption center-align">
                            Enjoy the Grand trip
                            <br/>
                            <h3>
                                {{ $banner->heading }}
                            </h3>
                            @if($banner->banner_url)
                                <div class="view_details"><a href="{{ $banner->banner_url }}">View Details</a></div>
                            @endif
                        </div>
                    </li>
                @endforeach

            </ul>
        </div>
        <div class="search_tab_wrapper">
            <ul class="tabs">
                <li class="tab">
                    <a class="active" href="#travel_tab">
                        <i class="fa fa-umbrella"></i>
                        Travel & Tour
                    </a>
                </li>
                <li class="tab">
                    <a href="#hotel_tab">
                        <i class="fa fa-bed"></i> Hotel
                    </a>
                </li>
                <li class="tab">
                    <a href="#car_rent_tab">
                        <i class="fa fa-car"></i> Car Rent
                    </a>
                </li>
            </ul>
            <div class="clear">
            </div>
            <div id="travel_tab">
                <div class="tab_search_content">
                    <form action="{{ route('search') }}" id="searchForm" method="get">
                        <div class="row">
                            <div class="col l6 m6 s6">
                                <select class="browser-default  bdr0" name="destination_id">
                                    <option value="">
                                        Select Destination
                                    </option>
                                    @foreach($allDestinations as $id=>$heading)
                                        <option value="{{ $id }}">
                                            {{ $heading }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col l6 m6 s6">
                                <select class="browser-default  bdr0" name="activity_id">
                                    <option value="">
                                        Select Activity
                                    </option>
                                    @foreach($allActivities as $id=>$heading)
                                        <option value="{{ $id }}">
                                            {{ $heading }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col l6 m6 s6">
                                <select class="browser-default  bdr0" name="duration">
                                    <option value="">
                                        Select Duration
                                    </option>
                                    <option value="1-5">
                                        1-5 Days
                                    </option>
                                    <option value="6-10">
                                        6 - 10 Days
                                    </option>
                                    <option value="11-15">
                                        11 - 15 Days
                                    </option>
                                    <option value="16-20">16 - 20 Days</option>
                                </select>
                            </div>
                            <div class="col l6 m6 s6">
                                <select class="browser-default  bdr0" name="price">
                                    <option value="">Select Price</option>
                                    <option value="100 - 500">$100 - $500</option>
                                    <option value="500 - 1000">$500 - $1000</option>
                                    <option value="1000 - 1500">$1000 - $1500</option>
                                    <option value="1500 - 2000">$1500 - $2000</option>
                                </select>
                            </div>
                            <!-- <div class="col l6 m6 s6">
                               <select class="default_field bdr0">
                                  <option value="" >Select Rating</option>
                                  <option value="1">1 Star</option>
                                  <option value="2">2 Star</option>
                                  <option value="3">3 Star</option>
                                  <option value="4">4 Star</option>
                               </select>
                            </div> -->
                            <div class="clear"></div>
                            <div class="col l6 m6 s6">
                                <button class="btn btnfull" name="search" value="search">Search</button>
                            </div>
                        </div>
                        <!--row end-->
                    </form>
                </div>
            </div>
            <div id="hotel_tab">
                <div class="tab_search_content">
                    <form name="hotelInquiry" id="hotelInquiry" action="" method="post">
                        <div class="row">
                            <div class="col l6 m6 s6">
                                <input type="text" name="full_name" class="default_field bdr0 full_name" value=""
                                       placeholder="Full Name"/>
                            </div>
                            <div class="col l6 m6 s6">
                                <input type="text" name="address" class="default_field bdr0 address" value=""
                                       placeholder="Address"/>
                            </div>
                            <div class="col l6 m6 s6">
                                <input type="text" name="phone_number" class="default_field bdr0 phone_number" value=""
                                       placeholder="Phone"/>
                            </div>
                            <div class="col l6 m6 s6">
                                <input type="email" name="email_address" class="default_field bdr0 email_address"
                                       value="" placeholder="Email Address"/>
                            </div>
                            <div class="col l6 m6 s6">
                                <select class="browser-default bdr0 number_of_rooms" name="number_of_rooms">
                                    <option value="">No of Rooms</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="more than 5">more than 5</option>
                                </select>
                            </div>
                            <div class="col l6 m6 s6">
                                <select class="browser-default bdr0 number_of_person" name="number_of_person">
                                    <option value="">No of Person</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="more than 10">more than 10</option>
                                </select>
                            </div>
                            <div class="clear"></div>
                            <div class="col l6 m6 s6">
                                <button class="btn btnfull" type="submit">Make Inquiry</button>
                            </div>
                        </div>
                        <!--row end-->
                    </form>

                </div>
            </div>
            <div id="car_rent_tab">
                <div class="tab_search_content">
                    <form name="carRentInquiry" id="carRentInquiry" action="" method="post">
                        <div class="row">
                            <div class="col l6 m6 s6">
                                <input type="text" name="full_name" class="full_name default_field bdr0" value=""
                                       placeholder="Full Name"/>
                            </div>
                            <div class="col l6 m6 s6">
                                <input type="text" name="address" class="address default_field bdr0" value=""
                                       placeholder="Address"/>
                            </div>
                            <div class="col l6 m6 s6">
                                <input type="text" name="phone_number" class="phone_number default_field bdr0" value=""
                                       placeholder="Phone"/>
                            </div>
                            <div class="col l6 m6 s6">
                                <input type="email" name="email_address" class="email_address default_field bdr0"
                                       value="" placeholder="Email Address"/>
                            </div>
                            <div class="col l6 m6 s6">
                                <input type="text" name="pick_up" class="pick_up default_field bdr0" value=""
                                       placeholder="Pick Up"/>
                            </div>
                            <div class="col l6 m6 s6">
                                <input type="text" name="drop_out" class="drop_out default_field bdr0" value=""
                                       placeholder="Drop Out"/>
                            </div>
                            <div class="clear"></div>
                            <div class="col l6 m6 s6">
                                <button class="btn btnfull" type="submit">Make Inquiry</button>
                            </div>
                        </div>
                        <!--row end-->
                    </form>
                </div>
            </div>
            <div class="clear">
            </div>
        </div>
    </section>
    <!--slideshow end-->

    <section class="special pd">
        <div class="container ">
            <div class="row">
                <div class="col l3">&nbsp;</div>
                <div class="col l6 delay-05s  fadeInUp wow animated">
                    <div class="title">
                        <h1>Special Packages</h1>
                        <span>ibook My Tour gather special packages so you can spend less time searching and more time dreaming about where you will go next.</span>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="col l12 m12 s12 delay-05s  fadeInUp wow animated">
                    <div class="special_cont">
                        <div class="customNavigation">
                            <a class=" prev"></a>
                            <a class=" next"></a>
                        </div>
                        <div id="owl-demo" class="owl-carousel owl-theme">
                            @foreach($specialPackages as $package)
                                <div class="item ">
                                    <div class="trip_img">
                                        <a href="{{ route('package.detail', $package->slug) }}">
                                            @if(count($package->coverGallery) > 0)
                                                @foreach($package->coverGallery as $gallery)
                                                @endforeach
                                                @if(file_exists('uploads/gallery/'.$gallery->attachment) && $gallery->attachment != '')
                                                    <img src="{{ asset('uploads/gallery/'.$gallery->attachment) }}"/>
                                                @else
                                                    <img src="{{ asset('images/special1.jpg') }}"/>
                                                @endif
                                            @else
                                                <img src="{{ asset('images/special1.jpg') }}"/>
                                            @endif
                                        </a>
                                    </div>
                                    <div class="trip_brief">


                                        @if($package->starting_price)
                                            <div class="trip_price">${{ $package->starting_price }}
                                                @if($package->previous_price  && ($package->previous_price >0) && ($package->previous_price > $package->starting_price) )
                                                    <br/><span>${{ $package->previous_price }}</span>
                                                @endif
                                            </div>
                                        @endif


                                        <div class="trip_title">
                                            <a href="{{ route('package.detail', $package->slug) }}">
                                                {{ $package->heading }}
                                            </a>
                                        </div>
                                        <div class="trip_desc">
                                            {!! str_limit($package->overview, 80) !!}
                                        </div>
                                        <div class="trip_fact_brief">
                                            <div class="row">
                                                @if($package->trip_duration)
                                                    <div class="col l6 m6 s6">Duration: {{ $package->trip_duration }}
                                                        Days
                                                    </div>
                                                @endif
                                                @if($package->activity)
                                                    <div class="col l6 m6 s6">
                                                        Activity: {{ $package->activity->heading }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="trip_btns">
                                            <a href="{{ route('package.detail', $package->slug) }}" class="btn green">Details</a>
                                            <a href="{{ route('package.booking', $package->slug) }}" class="btn ">Book
                                                Now</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!--main row end-->
        </div>
        <!--main container end-->
    </section>
    <!--services end-->
    <section class="video_wrap">
        <div class="container">
            <div class="row">
                <div class=" col l12 m12 s12 vdo">

                    <embed width="100%" height="600"
                           src="https://www.youtube.com/v/tjWZM2hMogU">


                    </embed>
                </div>
            </div>
        </div>
    </section>

    <section class="fixed_last pd">
        <div class="container">
            <div class="row">
                <div class="col l6 m12 s12 delay-05s  fadeInLeft wow animated linebreak">
                    <div class="fixed_dep">
                        <div class="sub_title h2block">
                            <h2>Fixed Departure</h2>
                        </div>
                        <div class="fixed">
                            <div class="trip_img">
                                <a href="{{ route('package.detail', $fixedDeparturePackage->slug) }}">
                                    @if(count($fixedDeparturePackage->coverGallery) > 0)
                                        @foreach($fixedDeparturePackage->coverGallery as $gallery)
                                        @endforeach
                                        @if(file_exists('uploads/gallery/'.$gallery->attachment) && $gallery->attachment != '')
                                            <img src="{{ asset('uploads/gallery/'.$gallery->attachment) }}"/>
                                        @else
                                            <img src="{{ asset('images/fixed1.jpg') }}"/>
                                        @endif
                                    @else
                                        <img src="{{ asset('images/fixed1.jpg') }}"/>
                                    @endif
                                </a>
                            </div>
                            <div class="trip_brief">
                                <div class="trip_price">${{ $fixedDeparturePackage->starting_price }}

                                    @if($fixedDeparturePackage->previous_price  && ($fixedDeparturePackage->previous_price >0) && ($fixedDeparturePackage->previous_price > $fixedDeparturePackage->starting_price) )
                                        <br/> <span>${{ $fixedDeparturePackage->previous_price }}</span>
                                    @endif


                                </div>


                                <div class="trip_title">
                                    <a href="{{ route('package.detail', $fixedDeparturePackage->slug) }}">{{ $fixedDeparturePackage->heading }}</a>
                                </div>
                                <div class="trip_fact_brief">
                                    <div class="row">
                                        @if($fixedDeparturePackage->trip_duration)
                                            <div class="col l4 m6 s6">
                                                Duration: {{ $fixedDeparturePackage->trip_duration}} Days
                                            </div>
                                        @endif
                                        @if($fixedDeparturePackage->activity)
                                            <div class="col l8 m6 s6">
                                                Activity: {{ $fixedDeparturePackage->activity->heading }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--fixed departure end-->
                    <div class="why_us center-align">
                        <div class="sub_title">
                            <h2>Why travel with us?</h2>
                        </div>
                        <div class="row">
                            <div class="col l3 m3 s6">
                                <div class="why">
                                    <img src="images/why1.png"/><br/>
                                    Well Experienced
                                </div>
                            </div>
                            <!--col end-->
                            <div class="col l3 m3 s6">
                                <div class="why">
                                    <img src="images/why2.png"/><br/>
                                    Recommended
                                </div>
                            </div>
                            <!--col end-->
                            <div class="col l3 m3 s6">
                                <div class="why">
                                    <img src="images/why3.png"/><br/>
                                    Luxury Stay
                                </div>
                            </div>
                            <!--col end-->
                            <div class="col l3 m3 s6">
                                <div class="why">
                                    <img src="images/why4.png"/><br/>
                                    Safe Travel
                                </div>
                            </div>
                            <!--col end-->
                        </div>
                    </div>
                </div>
                <!--col end-->
                <div class="col l6 m12 s12 delay-05s  fadeInRight wow animated">
                    <div class="last_minute_wrap">
                        <div class="sub_title h2block">
                            <h2>Last Minute Deals</h2>
                        </div>
                        <div class="last_minute">
                            <div class="row">
                                @foreach($lastMinuteDeals as $index=>$package)
                                    <div class="col l3 m3 s3">
                                        <div class="trip_img">
                                            <a href="{{ route('package.detail', $package->slug) }}">
                                                @if(count($package->coverGallery) > 0)
                                                    @foreach($package->coverGallery as $gallery)
                                                    @endforeach
                                                    @if(file_exists('uploads/gallery/'.$gallery->attachment) && $gallery->attachment != '')
                                                        <img src="{{ asset('uploads/gallery/'.$gallery->attachment) }}"/>
                                                    @else
                                                        <img src="{{ asset('images/last1.jpg') }}"/>
                                                    @endif
                                                @else
                                                    <img src="{{ asset('images/last1.jpg') }}"/>
                                                @endif
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col l9 m9 s9 pdl0">
                                        <div class="trip_brief">
                                            <div class="trip_title">
                                                <a href="{{ route('package.detail', $package->slug) }}">{{ $package->heading }}</a>
                                            </div>
                                            <div class="trip_fact_brief">
                                                <div class="row">
                                                    @if($package->trip_duration)
                                                        <div class="col l6 m6 s6">
                                                            Duration: {{ $package->trip_duration }} Days
                                                        </div>
                                                    @endif
                                                    @if($package->activity)
                                                        <div class="col l6 m6 s6">
                                                            Activity: {{ $package->activity->heading }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="details">
                                                <a href="{{ route('package.detail', $package->slug) }}">View Details</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    @if($index != 3)
                                        <div class="lastdivider"></div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!--last minute wrap end-->
                </div>
                <!--col end-->
            </div>
        </div>
    </section>

    <section class="destination pd">
        <div class="container">
            <div class="row">
                <div class="col l12 m12 s12 delay-05s  fadeInUp wow animated">
                    <div class="title">
                        <h1>Destination</h1>
                        <span>See where people are travelling around the world</span>
                    </div>
                </div>
                <div class="clear"></div>
                <!-- <div class="col l3 m3 s6 destination_block delay-05s  fadeInUp wow animated">
                  <a href="#"><img src="images/dest1.jpg"/></a>
                </div> -->
                @foreach($destinations as $destination)
                    <div class="col l3 m3 s6 destination_block delay-05s  fadeInUp wow animated">
                        <a href="{{ route('destination.detail',$destination->slug) }}">
                            @if(file_exists('uploads/destinations/'.$destination->attachment) && $destination->attachment != '')
                                <img src="{{ asset('uploads/destinations/'.$destination->attachment) }}"/>
                            @else
                                <img src="{{ asset('images/special1.jpg') }}"/>
                            @endif
                        </a>
                    </div>
            @endforeach
            <!-- <div class="col l3 m3 s6 destination_block delay-05s  fadeInUp wow animated">
        <a href="#"><img src="images/dest3.jpg"/></a>
      </div>
      <div class="col l3 m3 s6 destination_block delay-05s  fadeInUp wow animated">
        <a href="#"><img src="images/dest4.jpg"/></a>
      </div> -->
            </div>
        </div>
    </section>

    <section class="ad_wrap">
        <div class="ad delay-05s  fadeInUp wow animated">
            <img src="images/avia.jpg"/>
        </div>
    </section>

    <section class="testimonials pd">
        <div class="container">
            <div class="row">
                <div class="col l6 m12 delay-05s  fadeInLeft wow animated linebreak">
                    <div class="sub_title center-align">
                        <h2>What happy guests say about us?</h2>
                    </div>
                    <div class="row">
                        @foreach($testimonials as $index=>$testimonial)
                            <div class="col l3 m3 s3">
                                <div class="testimonials_img">
                                    @if(file_exists('uploads/testimonials/'.$testimonial->attachment) && $testimonial->attachment != '')
                                        <img src="{{ asset('uploads/testimonials/'.$testimonial->attachment) }}"/>
                                    @endif
                                </div>
                            </div>
                            <div class="col l9 m9 s9">
                                <strong>{!! $testimonial->name !!}</strong>
                                <br/>" {!! $testimonial->description !!} "
                            </div>
                            @if($index != 1)
                                <div class="clear"></div>
                                <div class="testdivider"></div>
                        @endif
                    @endforeach
                    <!-- <div class="col l3 m3 s3">
            <div class="testimonials_img">
              <img src="images/test2.jpg"/>
            </div>
          </div>
          <div class="col l9 m9 s9">
            <strong>Adri Dreyer</strong>
              <br/>“I would really just like to say thanks!!! This is exactly what I needed, we all needed.
              I came away form the class recognizing that I really need to take time for myself more often.
              I actually like the foods that I’m eating now, and the way they make me feel is very special..... more
          </div> -->
                    </div>
                </div>
                <div class="col l6 m12 delay-05s  fadeInRight wow animated">
                    <a href="#hotel_tab"><img src="{{ asset('images/hotel.jpg') }}"/></a>
                </div>
            </div>
        </div>
    </section>
@stop