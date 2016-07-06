@extends('layout.container')

@section('title', 'Packages I BOOK MY TRIP')
@section('meta_tags', 'Packages I BOOK MY TRIP')
@section('meta_description', 'Packages I BOOK MY TRIP')

@section('footer_js')

@endsection

@section('dynamicdata')
      <section class="inner_banner">
         <img src="{{ asset('images/inner_banner3.jpg') }}">  
      </section>
      <!--slideshow end-->
      
      <section class="body_content_wrap">
         <div class="container">
            <div class="row">
               <div class="col l12 m12 s12">
                  <div class="body_content">
                     <div class="breadcrumb-wrapper"> <a href="{{ route('home') }}" class="breadcrumb">Home</a> <a href="#!" class="breadcrumb">Search Packages</a></div>
                     <div class="sub_title mgb25">
                        <h2>Search Packages</h2>
                     </div>                     
                        @include('frontend.show-packages')
                  </div>
                  <!--body content end-->
               </div>
            </div>
         </div>
      </section>
      <!--body content wrap-->    
      
@stop