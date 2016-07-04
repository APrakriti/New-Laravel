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
                        @include('frontend.show-packages')
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