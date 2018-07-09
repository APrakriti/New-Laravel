@extends('layout.container')

@section('title', 'Testimonial')
@section('meta_tags', 'Packages I BOOK MY TRIP')
@section('meta_description', 'Packages I BOOK MY TRIP')

@section('footer_js')
   
@endsection

@section('dynamicdata')
      <section class="inner_banner">
         <img src="{{ asset('images/inner_banner.jpg') }}">
         
         @include('layout.search')
         
      </section>
<!--slideshow end-->
<section class="body_content_wrap">
    <div class="container">
        <div class="row">
            <div class="col l12 m12 s12">
                <div class="body_content">
                    <div class="breadcrumb-wrapper"><a href="{{ route('home',Session::get('bound_type')) }}" class="breadcrumb">Home</a> <a
                                href="#!" class="breadcrumb">Testimonials</a></div>
                    <div class="sub_title mgb25">
                        <h2>Testimonials</h2>
                    </div>
                    <div class="row">

                        @if(count($testimonials)>0)

                            @foreach ($testimonials->chunk(1) as $chunk)
                                <div class="col l6 m12 delay-05s  fadeInLeft wow animated linebreak">

                                    <div class="row">
                                        @foreach($chunk  as $testimonial)
                                            <div class="col l3 m3 s3">
                                                <div class="testimonials_img">
                                                    @if(file_exists('uploads/testimonials/'.$testimonial->attachment) && $testimonial->attachment != '')
                                                        <img src="{{ asset('uploads/testimonials/'.$testimonial->attachment) }}"/>
                                                    @else
                                                        <img src="{{ asset('uploads/uploads/noimage.jpg') }}"/>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col l9 m9 s9"><strong>{!! $testimonial->name !!}</strong> <br>
                                                " {!! $testimonial->description !!} "
                                            </div>
                                            <div class="clear"></div>
                                            <div class="testdivider"></div>
                                        @endforeach

                                    </div>

                                </div>
                            @endforeach

                            {!! $testimonials->render() !!}


                        @else
                            <p>No Testimonials found.</p>
                        @endif
                    </div>
                </div>
                <!--body content end-->
            </div>
        </div>
    </div>
</section>
@stop