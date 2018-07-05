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
                        <div class="breadcrumb-wrapper"><a href="{{ route('home',Session::get('bound_type')) }}" class="breadcrumb">Home</a> <a
                                    href="#!" class="breadcrumb">Fix Departures</a></div>
                        <div class="sub_title mgb25">
                            <h2>Fix Departures</h2>
                        </div>


                        @if(count($packages)>0)
                            @foreach ($packages->chunk(3) as $chunk)
                                <div class="row">
                                    @foreach($chunk as $package)
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
                                                <div class="trip_price">{{ '$'.$package->starting_price }}

                                                    @if($package->previous_price  && ($package->previous_price >0) && ($package->previous_price > $package->starting_price) )

                                                        <br><span>{{ '$'.$package->previous_price }}</span>
                                                    @endif


                                                </div>
                                                <div class="trip_title"><a href="{{ route('package.detail', $package->slug) }}">
                                                        {{ str_limit($package->heading, 50) }}
                                                    </a></div>
                                                <div class="trip_fact_brief">
                                                    <div class="row">
                                                        @if($package->trip_duration)
                                                            <div class="col l6 m6 s6">Duration: {{ $package->trip_duration }} Days</div>
                                                        @endif

                                                            <div class="col l6 m6 s6">Date: {{ $package->fix_departure }}</div>

                                                    </div>
                                                </div>
                                                <div class="trip_btns">
                                                    <a href="{{ route('package.detail', $package->slug) }}" class="btn green">Details</a>
                                                    <a href="{{ route('package.booking', $package->slug) }}" class="btn ">Buy Now</a>
                                                    <a href="{{ route('package.inquiry', $package->slug) }}" class="btn red">Inquiry</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!--col end-->
                                    @endforeach
                                </div>
                            @endforeach

                            {!! $packages->appends(Input::except('page'))->render() !!}
                        @else
                            <p> No Package Found.</p>
                        @endif




                    </div>
                    <!--body content end-->
                </div>
            </div>
        </div>
    </section>
    <!--body content wrap-->

@stop