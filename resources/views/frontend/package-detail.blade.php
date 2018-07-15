@extends('layout.container')

@section('title', $package->title)
@section('meta_tags', $package->meta_tags)
@section('meta_description', $package->meta_description)

@section('footer_js')
   <!-- Owl Carousel Assets -->
   <script src="{{ asset('owl-carousel/owl.carousel.js') }}"></script>
   <link href="{{ asset('owl-carousel/owl.carousel.css') }}" rel="stylesheet">
   <link href="{{ asset('owl-carousel/owl.theme.css') }}" rel="stylesheet">
   <script>
      $(document).ready(function(){          
         var owl = $("#owl-demo");
         owl.owlCarousel({
            items : 3, //10 items above 1000px browser width
            itemsDesktop : [1270,3], //5 items between 1000px and 901px
            itemsDesktopSmall : [900,2], // betweem 900px and 601px
            itemsTablet: [600,1], //2 items between 600 and 0
            itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
         });
         // Custom Navigation Events
         $(".next").click(function(){
            owl.trigger('owl.next');
         });
         $(".prev").click(function(){
            owl.trigger('owl.prev');
         });
         $(".play").click(function(){
            owl.trigger('owl.play',5000); //owl.play event accept autoPlay speed as second parameter
         });
         $(".stop").click(function(){
            owl.trigger('owl.stop');
         });
         var owl2 = $("#owl-demo2");         
         owl2.owlCarousel({
            items : 1, //10 items above 1000px browser width
         });          
      });
   </script>
@endsection

@section('dynamicdata')
      <section class="inner_banner">
         @if(file_exists('uploads/packages/'.$package->banner_attachment) && $package->banner_attachment != '')
         <img src="{{ asset('uploads/packages/'.$package->banner_attachment) }}" alt="{{ $package->heading }}">
         @else
         <img src="{{ asset('images/inner_banner.jpg') }}" alt="{{ $package->heading }}">
         @endif
         
         <?php
$allActivities = \App\Models\Activity::where('is_active', 1)->lists('heading', 'id');
$allDestinations = \App\Models\Destination::where('is_active', 1)->where('type',Session::get('bound_type'))->lists('heading', 'id');

?>
         <div class="container inner_search_wrap">
            <form action="{{ route('search') }}" id="searchForm" method="get">
                <div class="row">

                    <div class="col l3 m6 s6">

                        <select class="browser-default  bdr0" name="destination_id">
                            <option value="">
                                Select Destination
                            </option>
                            @foreach($allDestinations as $id=>$heading)
                                <option value="{{ $id }}"
                                        @if(Input::get('destination_id')==$id ) selected="selected" @endif>
                                    {{ $heading }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col l3 m6 s6">
                        <select class="browser-default  bdr0" name="activity_id">
                            <option value="">
                                Select Activity
                            </option>
                            @foreach($allActivities as $id=>$heading)
                                <option value="{{ $id }}"
                                        @if(Input::get('activity_id')==$id ) selected="selected" @endif>
                                    {{ $heading }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col l2 m6 s6">
                        <select class="browser-default  bdr0" name="duration">
                            <option value="">
                                Select Duration
                            </option>
                            <option value="1-5" @if(Input::get('duration')=='1-5' ) selected="selected" @endif>
                                1-5 Days
                            </option>
                            <option value="6-10" @if(Input::get('duration')=='6-10' ) selected="selected" @endif>
                                6 - 10 Days
                            </option>
                            <option value="11-15" @if(Input::get('duration')=='11-15' ) selected="selected" @endif>
                                11 - 15 Days
                            </option>
                            <option value="16-20" @if(Input::get('duration')=='16-20' ) selected="selected" @endif>
                                16 - 20 Days
                            </option>
                        </select>
                    </div>
                    <div class="col l2 m6 s6">

                       @if(Session::get('bound_type') && Session::get('bound_type') == 'foreigner') 
                <select class="browser-default  bdr0" name="price">
                    <option value="">Select Price</option>
                    <option value="100 - 500" @if(Input::get('price')=='100 - 500' ) selected="selected" @endif>
                        $100 - $500
                    </option>
                    <option value="500 - 1000"
                            @if(Input::get('price')=='500 - 1000' ) selected="selected" @endif>$500 - $1000
                    </option>
                    <option value="1000 - 1500"
                            @if(Input::get('price')=='1000 - 1500' ) selected="selected" @endif>$1000 - $1500
                    </option>
                    <option value="1500 - 2000"
                            @if(Input::get('price')=='1500 - 2000' ) selected="selected" @endif>$1500 - $2000
                    </option>

                    <option @if(Input::get('price')=='2000 - 20000' ) selected="selected" @endif
                    value="2000 - 20000">$2000 and above
                    </option>
                </select>
                 @else(Session::get('bound_type') && Session::get('bound_type') == 'nepalese') 
                <select class="browser-default  bdr0" name="price">
                    <option value="">Select Price</option>
                     <option value="10000 - 5000" @if(Input::get('price')=='10000 - 5000' ) selected="selected" @endif>
                        Nrs.10000 - Nrs.5000
                    </option>
                    <option value="50000 - 100000"
                            @if(Input::get('price')=='50000 - 100000' ) selected="selected" @endif>Nrs.50000 - Nrs.100000
                    </option>
                    <option value="100000 - 150000"
                            @if(Input::get('price')=='100000 - 150000' ) selected="selected" @endif>Nrs.100000 - Nrs.150000
                    </option>
                    <option value="150000 - 200000"
                            @if(Input::get('price')=='150000 - 200000' ) selected="selected" @endif>Nrs.150000 - Nrs.200000
                    </option>

                    <option @if(Input::get('price')=='200000 - 200000' ) selected="selected" @endif
                    value="2000 - 20000">Nrs.200000 and above
                    </option>
                </select>
                @endif
                        
                    </div>


                    <div class="col l2 m6 s6" style="margin-bottom:15px;">
                        <button class="btn btnfull">Search</button>
                    </div>
                </div> <!--row end-->
            </form>
        </div>
         
      </section>
      <!--slideshow end-->
      <section class="body_content_wrap">
         <div class="container">
            <div class="row">
               <div class="col l12 m12 s12">
                  <div class="body_content">
                     <div class="breadcrumb-wrapper">
                        <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                        <a href="{{ route('packages',Session::get('bound_type')) }}" class="breadcrumb">Tour Packages</a>
                        <a href="#!" class="breadcrumb">{{ $package->heading }}</a>
                     </div>
                     <div class="sub_title mgb25">
                        <h2>{{ $package->heading }}</h2>
                     </div>
                     <div class="row">
                        <div class="col l8 m12 s12 linebreak">
                           
                           @if(count($package->activeGalleries) > 0)
                           <div class="trip_slide">
                              <div id="owl-demo2" class="owl-carousel owl-theme">
                                 @foreach($package->activeGalleries as $gallery)
                                 @if(file_exists('uploads/gallery/'.$gallery->attachment) && $gallery->attachment != '')
                                 <div class="item">
                                    <img src="{{ asset('uploads/gallery/'.$gallery->attachment) }}">
                                 </div>
                                 @endif
                                 @endforeach
                                 <!-- <div class="item"><img src="images/slide2.jpg"></div> -->
                                 <!-- <div class="item"><img src="images/slide3.jpg"></div> -->
                              </div>
                           </div>                           
                           <!--trip slide end-->
                           @endif
                           <div class="overview" >
                              <div class="sub_head">Overview</div>
                              <div>{!! $package->description !!}</div>
                           </div>
                           <div class="tab_wrapper">
                              <ul class="tabs">
                                 <li class="tab "><a class="active" href="#itidetails">Itinerary Details</a></li>
                                 <li class="tab "><a href="#includes">Includes / Excludes</a></li>
                                 @if(file_exists('uploads/packages/'.$package->googlemap_attachment) && $package->googlemap_attachment != '')
                                 <li class="tab "><a href="#map">Map</a></li>
                                 @endif
                              </ul>
                              <div class="clear"></div>
                              <div id="itidetails">
                                 <div>{!! $package->itineraries !!}</div>
                              </div>
                              <div id="includes" >
                                 @if($package->includes)
                                 <div class="sub_head">Includes</div>
                                 <div>{!! $package->includes !!}</div>
                                 @endif
                                 @if($package->excludes)
                                 <div class="sub_head">Excludes</div>
                                 <div>{!! $package->excludes !!}</div>
                                 @endif
                              </div>
                              @if(file_exists('uploads/packages/'.$package->googlemap_attachment) && $package->googlemap_attachment != '')
                              <div id="map">
                                 <img src="{{ asset('uploads/packages/'.$package->googlemap_attachment) }}" alt="{{ $package->heading }}">
                              </div>
                              @endif
                              <div class="clear"></div>
                           </div>
                        </div>
                        <!-- col end-->
                        <div class="col l4 m12 s12 trip_detail_sidebar">
                        <div class="trip_highlight_wrap">
                              <div class="row">
                                 <div class="col l12">
                                    @if($package->starting_price)
                                    <div class="detail_price">
                                       Starting Price <span>{{$package->currency.$package->starting_price }}</span>
                                    </div>
                                    @endif
                                    <div class="booknow"><a href="{{ route('package.booking', $package->slug) }}" class="btn">Book Now</a>  <a href="{{ route('package.inquiry', $package->slug) }}" class="btn green">Inquiry</a> </div>
                                 </div>
                                 <!--<div class="col l8 m8 s12">
                                    <div class="trip_highlight">
                                       <div class="row">
                                          <div class="col l3 m3 s3 trip_highlight_single"><i class="fa fa-bus"></i> <br>Transport</div>
                                          <div class="col l3 m3 s3 trip_highlight_single"><i class="fa fa-building"></i> <br> Hotel</div>
                                          <div class="col l3 m3 s3 trip_highlight_single"><i class="fa fa-cutlery"></i> <br> Food</div>
                                          <div class="col l3 m3 s3 trip_highlight_single"><i class="fa fa-binoculars "></i> <br> Sight Seeing</div>
                                       </div>
                                    </div>
                                 </div>-->
                              </div>
                           </div>
                           
                           
                           <div class="box trip_fact_wrap">
                              <div class="inner_head">Trip Facts</div>
                              <div class="tripfact_list">
                                 <ul>
                                    @if($package->trip_duration)
                                    <li>
                                       <img src="{{ asset('images/trip_icons/length_icon.png') }}">
                                       <span>Trip Duration :</span> {{ $package->trip_duration }} Days
                                    </li>
                                    @endif
                                    @if($package->team_leader)
                                    <li>
                                       <img src="{{ asset('images/trip_icons/lead_icon.png') }}">
                                       <span>Team Leader :</span> {{ $package->team_leader }}
                                    </li>
                                    @endif
                                    @if($package->activity)
                                    <li>
                                       <img src="{{ asset('images/trip_icons/grade_icon.png') }}">
                                       <span>Activity :</span> {{ $package->activity->heading }}
                                    </li>
                                    @endif
                                    @if($package->accommodation)
                                    <li>
                                       <img src="{{ asset('images/trip_icons/acc_icon.png') }}">
                                       <span>Accommodation :</span> {{ $package->accommodation }}
                                    </li>
                                    @endif
                                    @if($package->start && $package->end)
                                    <li>
                                       <img src="{{ asset('images/trip_icons/start_icon.png') }}">
                                       <span>Start - End :</span> {{ $package->start }} - {{ $package->end }} 
                                    </li>
                                    @endif
                                    <!-- <li>
                                       <img src="{{ asset('images/trip_icons/location_icon.png') }}">
                                       <span>Trip Destination :</span> License Holder
                                    </li> -->
                                    @if($package->group_size)
                                    <li>
                                       <img src="{{ asset('images/trip_icons/group_icon.png') }}">
                                       <span>Group Size :</span> {{ $package->group_size }}
                                    </li>
                                    @endif
                                    @if($package->maximum_altitude)
                                    <li>
                                       <img src="{{ asset('images/trip_icons/altitude_icon.png') }}">
                                       <span>Max. Altitude : </span> {{ $package->maximum_altitude }} m
                                    </li>
                                    @endif
                                    @if($package->transportation)
                                    <li>
                                       <img src="{{ asset('images/trip_icons/transport_icon.png') }}">
                                       <span>Transportation :</span> {{ $package->transportation }}
                                    </li>
                                    @endif
                                    @if($package->trip_season)
                                    <li>
                                       <img src="{{ asset('images/trip_icons/season_icon.png') }}">
                                       <span>Trip Season :</span> {{ $package->trip_season }}
                                    </li>
                                    @endif
                                    @if($package->joining_date)
                                    <li>
                                       <img src="{{ asset('images/trip_icons/date_icon.png') }}">
                                       <span>Group Joining Date :</span> {{ $package->joining_date }}
                                    </li>
                                    @endif
                                 </ul>
                                 <div class="clear"></div>
                              </div>
                           </div>
                           <!--trip facts end-->
                           <div class="box related_trip_wrap">
                              <div class="inner_head">Related Packages</div>
                              <div class="list">
                                 <ul>
                                 @foreach($relatedPackages as $package)
                                    <li><a href="{{ route('package.detail',$package->slug) }}">{{ $package->heading }}</a></li>
                                 @endforeach
                                 <!--    <li><a href="services/branding-and-identity.html">Annapurna Panchase Hill Trek</a></li>
                                    <li><a href="services/domain-registration.html">Around Manaslu Larkya La Trek </a></li>
                                    <li><a href="services/ecommerce.html">Everest Panorama Thyangboche Trek</a></li>
                                    <li><a href="services/facebook-application.html">Ganesh Himal Panorama Trek  </a></li>
                                    <li><a href="services/graphics-and-logo-design.html">Annapurna Panchase Hill Trek </a></li>
                                    <li><a href="services/application-development.html">Annapurna Circuit Thorang La</a></li>
                                    <li><a href="services/branding-and-identity.html">Annapurna Panchase Hill Trek</a></li>
                                    <li><a href="services/domain-registration.html">Around Manaslu Larkya La Trek </a></li>
                                    <li><a href="services/ecommerce.html">Everest Panorama Thyangboche Trek</a></li>
                                  -->
                                 </ul>
                                 <div class="clear"></div>
                              </div>
                           </div>
                        </div>
                        <!-- col end-->
                     </div>
                  </div>
                  <!--body content end-->
               </div>
            </div>
         </div>
      </section>
      <!--body content wrap-->
@stop