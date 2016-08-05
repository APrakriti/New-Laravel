<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <link href="images/favicon.png" type="images/png" rel="icon"/>
    <title>iBook My Tour</title>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <!-- CSS  -->
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/animate.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Lato:400,100,300,100italic,300italic,400italic,700,700italic,900,900italic'
          rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<!-- header start-->
@include('layout.header')
<!--header end-->
<section class="inner_banner">
    <img src="{{ asset('images/inner_banner2.jpg') }}">
</section>
<!--slideshow end-->
<section class="body_content_wrap">
    <div class="container">
        <div class="row">
            <div class="col l12 m12 s12">
                <div class="body_content">
                    <div class="breadcrumb-wrapper"><a href="{{ route('home') }}" class="breadcrumb">Home</a> <a
                                href="#!" class="breadcrumb">Testimonials</a></div>
                    <div class="sub_title mgb25">
                        <h2>Testimonials</h2>
                    </div>
                    <div class="row">

                        @if(count($testimonials)>0)

                            @foreach ($testimonials->chunk(3) as $chunk)
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
<!--body content wrap-->
<!-- footer start-->
@include('layout.footer')
<!-- footer end-->
<div class="scroll-top-wrapper"><span class="scroll-top-inner"> <i class="fa  fa-angle-up"></i> </span></div>
<!--  Scripts-->
<script src="js/jquery-1.10.2.js"></script>
<script src="js/materialize.js"></script>
<script src="js/customibook.js"></script>
<script src="js/wow.js"></script>
<script src="js/jquery.nicescroll.min.js"></script>
<script src="js/init.js"></script>

</body>
</html>