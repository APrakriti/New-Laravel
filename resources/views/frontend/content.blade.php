@extends('layout.container')

@section('title', $content->title)
@section('meta_tags', $content->meta_tags)
@section('meta_description', $content->meta_description)

@section('footer_js')
   
@endsection

@section('dynamicdata')
      <section class="inner_banner">
         <img src="{{ asset('images/inner_banner.jpg') }}">
      </section>
      <!--slideshow end-->
      
      <section class="body_content_wrap">
         <div class="container">
            <div class="row">
               <div class="col l12 m12 s12">
                  <div class="body_content">
                     <div class="breadcrumb-wrapper"> <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                     <a href="#!" class="breadcrumb">{{ $content->heading }}</a></div>
                     <div class="sub_title mgb25">
                        <h2>{{ $content->heading }} </h2>
                     </div>
                     <div class="row">
                        <div class="col l8 m12 s12 linebreak">
                           <div class="overview" >
                              <div>{!! $content->description !!}</div>
                           </div>
                        </div>
                        <!-- col end-->
                        <div class="col l4 m12 s12 trip_detail_sidebar">
                           <div class="box related_trip_wrap">
                              <div class="inner_head">Related Packages</div>
                              <div class="list">
                                 <ul>
                                    @foreach($packages as $package)
                                    <li><a href="{{ route('package.detail', $package->slug) }}">{{ $package->heading }}</a></li>
                                    @endforeach
                                    <!-- <li><a href="services/domain-registration.html">Around Manaslu Larkya La Trek </a></li>
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