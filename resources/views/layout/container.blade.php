<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
<link href="images/favicon.png" type="images/png" rel="icon" />
<title>@yield('title')</title>
<meta name="description" content="@yield('meta_description')"/>
<meta name="keywords" content="@yield('meta_tags')"/>
<!-- CSS  -->
<link href="{{ asset('css/materialize.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
<link href="{{ asset('css/style.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
<link href="{{ asset('css/animate.css') }}" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Lato:400,100,300,100italic,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>

<!--header start-->
@include('layout.header')
<!--header end-->
@yield('dynamicdata')
<!-- footer start-->
@include('layout.footer')
<!-- footer end-->
<div class="scroll-top-wrapper">
  <span class="scroll-top-inner">
    <i class="fa fa-angle-up"></i>
  </span>
</div>
<!--  Scripts-->
<script src="{{ asset('js/jquery-1.10.2.js') }}"></script>
<script src="{{ asset('js/materialize.js') }}"></script>
<script src="{{ asset('js/customibook.js') }}"></script>
<script src="{{ asset('js/wow.js') }}"></script>
<script src="{{ asset('js/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('js/init.js') }}"></script>
@yield('footer_js')
</body>
</html>
