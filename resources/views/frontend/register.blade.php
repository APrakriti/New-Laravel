@extends('layout.container')

@section('title', 'Register')
@section('meta_tags', 'Packages I BOOK MY TRIP')
@section('meta_description', 'Packages I BOOK MY TRIP')

@section('footer_js')
   
@endsection

@section('dynamicdata')
      <section class="inner_banner">
         <img src="{{ asset('images/inner_banner.jpg') }}">
         
         @include('layout.search')
         
      </section>

      <section class="body_content_wrap">
         <div class="container">
            <div class="row">
               <div class="col l12 m12 s12">
                  <div class="body_content">
                     <div class="breadcrumb-wrapper"> <a href="{{ route('home',Session::get('bound_type')) }}" class="breadcrumb">Home</a> <a href="#!" class="breadcrumb">Sign Up</a> </div>
                     <div class="sub_title mgb25">
                        <h2>Sign Up</h2>
                     </div>
                     <div class="row">
                        <div class="col l3 m2 s12">&nbsp;</div>
                        <div class="col l6 m8 s12">
                           <form action="" method="post" id="signupForm">
                           <div class="form_wrap">
                              @include('layout.alert')
                              <div class="input-field  ">
                                 <input name="first_name" id="first_name" type="text" class="validate" value="{{ old('first_name') }}">
                                 <label for="">First Name</label>
                              </div>
                              <div class="input-field  ">
                                 <input name="last_name" id="last_name" type="text" class="validate" value="{{ old('last_name') }}">
                                 <label for="">Last Name</label>
                              </div>
                              <div class="input-field  ">
                                 <input name="email" id="email" type="email" class="validate" value="{{ old('email') }}">
                                 <label for="email">Email</label>
                              </div>
                              <div class="input-field  ">
                                 <input name="password" id="password" type="password" class="validate">
                                 <label for="password">Password</label>
                              </div>
                              <div class="input-field  ">
                                 <input name="confirm_password" id="confirm_password" type="password" class="validate">
                                 <label for="password">Confirm Password</label>
                              </div>
                              <div> <button class="btn">Sign Up</button></div>
                              <div class="clear"></div>
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