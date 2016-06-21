@extends('layout.container')

@section('title', $destination->title)
@section('meta_tags', $destination->meta_tags)
@section('meta_description', $destination->meta_description)

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
                     <a href="#!" class="breadcrumb">Packages : {{ $destination->heading }}</a></div>
                     <div class="sub_title mgb25">
                        <h2>Packages : {{ $destination->heading }} </h2>
                     </div>
                     @if(count($packages) > 0)
                     <div class="row">
                        @foreach($packages as $package)
                        <div class="col l4 m6 s12 mgb25">
                           <div class="trip_img">                           
                              <a href="{{ route('package.detail', $package->slug) }}">
                                 @if(count($package->coverGallery) > 0)
                                 @foreach($package->coverGallery as $gallery)
                                 @endforeach 
                                 @if(file_exists('uploads/gallery/thumbs/'.$gallery->thumb_attachment) && $gallery->thumb_attachment != '')
                                 <img src="{{ asset('uploads/gallery/thumbs/'.$gallery->thumb_attachment) }}"/>
                                 @else
                                 <img src="{{ asset('images/special1.jpg') }}"/>
                                 @endif
                                 @else
                                 <img src="{{ asset('images/special1.jpg') }}"/>
                                 @endif
                              </a>
                              </div>
                           <div class="trip_brief">
                              <div class="trip_price">{{ '$'.$package->starting_price }}<br><span>{{ '$'.$package->previous_price }}</span></div>
                              <div class="trip_title"><a href="{{ route('package.detail', $package->slug) }}">
                                 @if($package->trip_duration) {{ $package->trip_duration }} Days @endif {{ str_limit($package->heading, 50) }}
                              </a></div>
                              <div class="trip_fact_brief">
                                 <div class="row">
                                    <div class="col l6 m6 s6">Duration: {{ $package->trip_duration }} Days</div>
                                 <!--    <div class="col l6 m6 s6">Rating: <img src="images/rating.png"></div>
                                  --></div>
                              </div>
                              <div class="trip_btns">
                                 <a href="{{ route('package.detail', $package->slug) }}" class="btn green">Details</a>
                                 <a href="{{ route('package.detail', $package->slug) }}" class="btn ">Book Now</a>
                              </div>
                           </div>
                        </div>
                        <!--col end-->
                        @endforeach 
                     </div>
                     {!! $packages->render() !!}
                     @else
                     	<div class="row">
                     		<div class="col l12 m12 s12">
                     			Packages are not found for this destination.
                     		</div>
                     	</div>
                     @endif
                     
                  </div>
                  <!--body content end-->
               </div>
            </div>
         </div>
      </section>
      <!--body content wrap-->
@stop