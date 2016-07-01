{{-- */ $destinations = App\Models\Destination::with('footerPackages')->where('is_active', 1)->orderBy('order_position')->get(); /* --}}
{{-- */ $packages = App\Models\Package::where('is_active', 1)->orderBy('order_position')->take(6)->get(); /* --}}
{{-- */ $contents = App\Models\Content::where('is_active', 1)->orderBy('order_position')->take(6)->get(); /* --}}

<section class="footer_destination pd">
         <div class="container">
            <div class="row">
               <div class="col l12 delay-05s  fadeInUp wow animated">
                  @foreach($destinations as $destination)
                  <div class="foot_link">
                     <ul>
                        <li><a href="#">{{ $destination->heading }}:</a></li>
                        @foreach($destination->footerPackages as $package)
                        <li><a href="#">{{ $package->heading }}</a></li>
                        @endforeach
                    </ul>
                     <div class="clear"></div>
                  </div>
                  @endforeach                  
               </div>
            </div>
         </div>
      </section>
      <div class="clear"></div>

<section class="footer_wrap pd">
    <div class="container ">
        <div class="row">
            <div class="col l3 m6 s12 delay-05s  fadeInUp wow animated linebreak">
                <div class="footer_head">
                    Popular Trips
                </div>
                <div class="footer_links">
                    <ul>
                        @foreach($packages as $package)
                        <li>
                            <a href="{{ route('package.detail', $package->slug) }}">
                                {{ $package->heading }}
                            </a>
                        </li>
                        @endforeach                        
                    </ul>
                    <div class="clear">
                    </div>
                </div>
            </div>
            <div class="col l3 m6 s12 delay-05s  fadeInUp wow animated linebreak">
                <div class="footer_head">
                    Quick Links
                </div>
                <div class="footer_links">
                    <ul>
                        <li>
                            <a href="{{ route('home') }}">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                What our  guests say?
                            </a>
                        </li>
                        <!-- <li>
                            <a href="#">
                                Photo Gallery
                            </a>
                        </li> -->
                        <!-- <li>
                            <a href="#">
                                Videos
                            </a>
                        </li> -->
                        <li>
                            <a href="#">
                                Contact Us
                            </a>
                        </li>
                    </ul>
                    <div class="clear">
                    </div>
                </div>
            </div>
            <div class="col l3 m6 s12 delay-05s  fadeInUp wow animated linebreak">
                <div class="footer_head">
                    &nbsp;
                </div>
                <div class="footer_links">
                    <ul>
                    @foreach($contents as $content)
                        <li>
                            <a href="{{ route('content.detail', $content->slug) }}">
                                {{ $content->heading }}
                            </a>
                        </li>
                    @endforeach                        
                    </ul>
                    <div class="clear">
                    </div>
                </div>
            </div>
            <div class="col l3 m6 s12 delay-05s  fadeInUp wow animated ">
                <div class="footer_head">
                    Get Connect With Us
                </div>
                <div class="social_link">
                    <ul>
                        <li>
                            <a href="" target="_blank" >
                                <i class="fa fa-facebook">
                                </i>
                            </a>
                        </li>
                        <li class="twitter">
                            <a href="" target="_blank" >
                                <i class="fa fa-twitter">
                                </i>
                            </a>
                        </li>
                        <li class="googleplus">
                            <a href="" target="_blank" >
                                <i class="fa fa-google-plus">
                                </i>
                            </a>
                        </li>
                        <li class="linkedin">
                            <a href="" target="_blank" >
                                <i class="fa fa-linkedin">
                                </i>
                            </a>
                        </li>
                        <li class="youtube">
                            <a href=""  >
                                <i class="fa fa-youtube ">
                                </i>
                            </a>
                        </li>
                    </ul>
                    <div class="clear">
                    </div>
                </div>
                <div class="accept">
                    We Accept
                    <br/>
                    <img src="{{ asset('images/accept.png') }}"/>
                </div>
                <div class="copyright">
                    Copyright © 2016. iBook My Tour <br />
                    Powered By: <a href="http://www.peacenepal.com" target="_blank">Peace Nepal DOT Com</a>
                </div>
            </div>
        </div>
        <!-- row end -->
    </div>
</section>
