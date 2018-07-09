@extends('layout.container')

@section('title', 'Forget-Password')
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
                    <div class="breadcrumb-wrapper"><a href="{{ route('home') }}" class="breadcrumb">Home</a> <a
                                href="#!" class="breadcrumb">Forget Password</a></div>
                    <div class="sub_title mgb25">
                        <h2>Forget Password</h2>
                    </div>
                    <div class="row">
                        <div class="col l3 m2 s12">&nbsp;</div>
                        <div class="col l6 m8 s12">
                            <form action="{{ route('user.forget.password') }}" method="post" id="loginForm">
                                <div class="form_wrap">
                                    @include('layout.alert')
                                    <div class="input-field">
                                        <input name="email" id="email" type="email" class="validate" required>
                                        <label for="email">Email</label>
                                    </div>

                                    <div>
                                        <button class="btn" type="submit">Submit</button>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="divider"></div>
                                    <p class="small">Dont you have account?
                                        <a href="{{ route('register') }}">Sign Up</a> here
                                        <span class="floatright"><a href="{{ route('login') }}">Login</a></span>
                                    </p>
                                    <div>
                                        <!-- <button class="btn btnfull"><i class="fa fa-facebook"></i> Login with facebook</button> -->
                                    </div>
                                </div>
                                {!! csrf_field() !!}
                            </form>
                            <!--form wrap end-->
                        </div>
                        <!--col end-->
                        <div class="col l3 m2 s12">&nbsp;</div>
                    </div>
                </div>
                <!--body content end-->
            </div>
        </div>
    </div>
</section>
@stop