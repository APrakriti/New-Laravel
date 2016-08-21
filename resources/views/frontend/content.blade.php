@extends('layout.container')

@section('title', $content->title)
@section('meta_tags', $content->meta_tags)
@section('meta_description', $content->meta_description)

@section('footer_js')
   
@endsection

@section('dynamicdata')
      <section class="inner_banner">
         <img src="{{ asset('images/inner_banner.jpg') }}">
         
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
                        </select>
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