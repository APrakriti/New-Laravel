@extends('layout.container')

@section('title', 'Packages I BOOK MY TRIP')
@section('meta_tags', 'Packages I BOOK MY TRIP')
@section('meta_description', 'Packages I BOOK MY TRIP')

@section('footer_js')

@endsection

@section('dynamicdata')
      <section class="inner_banner">
         <img src="{{ asset('images/inner_banner3.jpg') }}">

         @include('layout.search')
         
         
      </section>
      <!--slideshow end-->     
      <section class="body_content_wrap">
         <div class="container">
            <div class="row">
               <div class="col l12 m12 s12">
                  <div class="body_content">
                     <div class="breadcrumb-wrapper"> <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                     <a href="#!" class="breadcrumb">Destinations</a></div>
                     <div class="sub_title mgb25">
                        <h2>Destinations</h2>
                     </div>
                     @if(count($destinations) > 0)
                     <div class="row">
                        @foreach($destinations as $destination)
                        <div class="col l3 m6 s12 mgb25">
                           <div class="trip_img">                           
                              <a href="{{ route('destination.detail', $destination->slug) }}">
                                  
                                 @if(file_exists('uploads/destinations/'.$destination->attachment) && $destination->attachment != '')
                                 <img src="{{ asset('uploads/destinations/'.$destination->attachment) }}"/>
                                 @else
                                 <img src="{{ asset('images/special1.jpg') }}"/>
                                 @endif
                                 
                              </a>
                              </div>
                           <div class="trip_brief">
                              
                              <div class="trip_title">
                              	<a href="{{ route('destination.detail', $destination->slug) }}">
                                	{{ str_limit($destination->heading) }}
                              	</a>
                              </div>
                              <div style="font-weight:bold">{{ count($destination->packages) }} Packages</div>
                           </div>
                        </div>
                        <!--col end-->
                        @endforeach 
                     </div>
                     {!! $destinations->render() !!}
                     @else
                     	<div class="row">
                     		<div class="col l12 m12 s12">
                     			Destinations are not found.
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