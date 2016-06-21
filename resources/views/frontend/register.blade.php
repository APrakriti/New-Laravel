<!DOCTYPE html>
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
      <link href="images/favicon.png" type="images/png" rel="icon" />
      <title>iBook My Tour</title>
      <meta name="description" content=""/>
      <meta name="keywords" content=""/>
      <!-- CSS  -->
      <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
      <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
      <link href="css/animate.css" rel="stylesheet">
      <link href='https://fonts.googleapis.com/css?family=Lato:400,100,300,100italic,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
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
                     <div class="breadcrumb-wrapper"> <a href="index.html" class="breadcrumb">Home</a> <a href="#!" class="breadcrumb">Sign Up</a> </div>
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
      <!--body content wrap-->
      <!-- footer start-->
      @include('layout.footer')
      <!-- footer end-->
      <div class="scroll-top-wrapper"> <span class="scroll-top-inner"> <i class="fa  fa-angle-up"></i> </span> </div>
      <!--  Scripts-->
      <script src="js/jquery-1.10.2.js"></script>
      <script src="js/materialize.js"></script>
      <script src="js/customibook.js"></script>
      <script src="js/wow.js"></script>
      <script src="js/jquery.nicescroll.min.js"></script>
      <script src="js/init.js"></script>
      
   </body>
</html>