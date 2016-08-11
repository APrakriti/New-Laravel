@extends('layout.container')

@section('title', $destination->title)
@section('meta_tags', $destination->meta_tags)
@section('meta_description', $destination->meta_description)

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
                        <div class="breadcrumb-wrapper">
                            <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                            <a href="{{ route('destinations') }}" class="breadcrumb">Destinations</a>
                            <a href="#!" class="breadcrumb">{{ $destination->heading }}</a>
                        </div>
                        <div class="sub_title mgb25">
                            <h2>{{ $destination->heading }} </h2>
                        </div>
                        <div class="row">
                            <div class="col l12 m12 s12 linebreak">
                                <div class="overview">
                                    <div>{!! $destination->description !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col l12 m12 s12 linebreak">
                                <div class="sub_title mgb25">
                                    <h2>Related Packages </h2>
                                </div>
                                <div class="overview">

                                    @include('frontend.show-packages')
                           
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--body content end-->
                </div>
            </div>
        </div>
    </section>
    <!--body content wrap-->
@stop
@section('footer_js')

@endsection