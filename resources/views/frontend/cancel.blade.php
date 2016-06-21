@extends('layout.container')

@section('title', 'I BOOK DOT COM')
@section('meta_tags', 'I BOOK DOT COM')
@section('meta_description', 'I BOOK DOT COM')

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
                  <a href="#!" class="breadcrumb">Cancel</a>
               </div>
               <div class="sub_title mgb25">
                  <h2>Cancel</h2>
               </div>
               <div class="row">
                  <div class="col l12 m12 s12">
                     {{ Session::get('message') }}
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