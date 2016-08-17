@extends('layout.container')

@section('title', $package->title)
@section('meta_tags', $package->meta_tags)
@section('meta_description', $package->meta_description)


@section('dynamicdata')

    <section class="inner_banner">
        <img src="{{ asset('images/inner_banner2.jpg') }}">
    </section>
    <!--slideshow end-->
    <section class="body_content_wrap">
        <div class="container">
            <div class="row">
                <div class="col l12 m12 s12">
                    <div class="body_content">
                        <div class="breadcrumb-wrapper">
                            <a href="{{ route('home') }}" class="breadcrumb">Home</a>
                            <a href="{{ route('packages') }}" class="breadcrumb">Tour Packages</a>
                            <a href="{{ route('package.detail', $package->slug) }}"
                               class="breadcrumb">{{ $package->heading }}</a>
                            <a href="#!" class="breadcrumb">Online Inquery</a>
                        </div>
                        <div class="sub_title mgb25">
                            <h2>Online Inquiry</h2>
                        </div>

                        <div class="row">
                            <div class="col l8 m8 s12">

                                <p><h5>Thank You</h5>

                                Your Inquiry to <a
                                        href="{{  route('package.detail', $package->slug)  }}"> {{ $package->heading  }}</a>
                                has been submitted successfully. You will receive a reply from us within 1-2 working
                                day. Thank you for choosing {{ env('SITE_NAME') }}.
                                </p>


                            </div>
                            <!--col end-->
                            <div class="col l4 m4 s12">
                                <div class="box related_trip_wrap">
                                    <div class="inner_head">Related Packages</div>
                                    <div class="list">
                                        <ul>
                                            @foreach($relatedPackages as $package)
                                                <li>
                                                    <a href="{{ route('package.detail',$package->slug) }}">{{ $package->heading }}</a>
                                                </li>
                                            @endforeach
                                            <li><a href="services/branding-and-identity.html">Annapurna Panchase Hill
                                                    Trek</a></li>
                                        </ul>
                                        <div class="clear"></div>
                                    </div>
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