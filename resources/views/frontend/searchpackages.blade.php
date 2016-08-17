@extends('layout.container')

@section('title', 'Packages I BOOK MY TRIP')
@section('meta_tags', 'Packages I BOOK MY TRIP')
@section('meta_description', 'Packages I BOOK MY TRIP')

@section('footer_js')

@endsection

@section('dynamicdata')
      <section class="inner_banner">
         <img src="{{ asset('images/inner_banner3.jpg') }}">  
         
         
         <div class="container inner_search_wrap">

<div class="row">
<!--<div class="col 12 m12 s6" style="font-weight:bold; font-size:20px; color:#fff">Travel & Tour</div>-->
                               

<div class="col l3 m6 s6">
<select class="browser-default  bdr0"  >
                                    
                                                                             <option selected="" >Select Destintion</option>
                                                                             <option  value="1">Nepal</option>
                                                                            <option value="2">Tibet</option>
                                                                            <option value="3">India</option>
                                                                            <option value="4">Bhutan</option>
                                </select>
                                </div>
                                <div class="col l3 m6 s6">
<select class="browser-default  bdr0"  >
                                    
                                                                             <option selected="" >Select Activity</option>
                                                                             <option  value="1">Trekking</option>
                                                                            <option value="2">Bird Watching</option>
                                                                            <option value="3">Rafting</option>
                                                                            <option value="4">Culture Tour</option>
                                </select>
                                </div>
                                <div class="col l2 m6 s6">
<select class="browser-default  bdr0"  >
                                    
                                                                             <option selected="" >Select Duration</option>
                                                                             <option  value="1">1-5 Days</option>
                                                                            <option value="2">6 - 10 Days</option>
                                                                            <option value="3">11 - 15 Days"</option>
                                                                            <option value="4">16 - 20 Days</option>
                                </select>
                                </div>
                                <div class="col l2 m6 s6">
<select class="browser-default  bdr0"  >
                                    
                                                                             <option selected="" >Select Price</option>
                                                                             <option  value="1">$100 - $500</option>
                                                                            <option value="2">$500 - $1000</option>
                                                                            <option value="3">$1000 - $1500</option>
                                                                            <option value="4">$1500 - $2000</option>
                                </select>
                                </div>
                                
                                
                                
                                <div class="col l2 m6 s6" style="margin-bottom:15px;">
<button class="btn btnfull">Search</button>
                                </div>
</div> <!--row end-->
</div>
         
         
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