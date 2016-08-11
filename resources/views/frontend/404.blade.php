@extends('layout.container')

@section('title', 'I BOOK MY TOUR')
@section('meta_tags', 'I BOOK MY TOUR')
@section('meta_description', 'I BOOK MY TOUR')

@section('footer_js')
  
@endsection

@section('dynamicdata')

<section class="inner_banner">
   <img src="{{ asset('images/inner_banner2.jpg') }}">
</section>

<section class="body_content_wrap">
   <div class="container">
      <div class="row">
         <div class="col l12 m12 s12">
            <div class="body_content">
               <div class="breadcrumb-wrapper">
                  <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                  <a href="#!" class="breadcrumb">404 Error</a>
               </div>
               <div class="sub_title mgb25">
                  <h2>404 Error</h2>
               </div>
               <div class="row">
                  <div class="col l12 m12 s12">
                     Page is temporarirly unavailable or completely removed.
                  </div>
                  <!--col end-->                  
               </div>
            </div>
            <!--body content end-->
         </div>
      </div>
   </div>
</section>
<!--body content wrap-->
@stop