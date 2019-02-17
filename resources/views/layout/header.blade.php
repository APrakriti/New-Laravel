<?php $route = \Request::route()->getName(); ?>


<section class="header">
<div class="container">
    <nav  role="navigation">
        <div class="nav-wrapper ">
            <div class="logo">
                <a  id="logo-container" href="{{ route('home') }}" class="brand-logo">
                    <img src="{{ asset('images/logo.png') }}"/>
                </a>
            </div>

             <div class="header-right ">
                <div class="top_address">
           
                    
                   <i class="fa fa-phone"></i> +975 (2) 326482 &nbsp; &nbsp; 
                  <i class="fa fa-map-marker"></i> Thori Lam, behind BBS building,</li> &nbsp; &nbsp; 
                   <i class="fa fa-envelope"></i> <a href="mailto:drukairholidays@drukair.com.bt">drukairholidays@drukair.com.bt</a></li>
                        
                   
                
                    <div class="clear">
                    </div>
                </div>                
            </div>
            <div class="clear">
            </div>
            
          
            <ul class="right hide-on-med-and-down">
                <li>
                    <a href="{{ route('home') }}">
                        Home
                    </a>
                </li>

                <li>
                    <a href="{{ route('content.detail','about-us') }}">
                       About Us
                    </a>
                </li>
        
                <li>
                    <a href="{{ route('packages') }}">
                        Tour packages
                    </a>
                </li>
              <?php $destinations = App\Models\Destination::where('is_active', '1')->orderBy('order_position')->get(); ?>
              <?php $allActivities = App\Models\Activity::where('is_active', '1')->orderBy('order_position')->get(); ?>
     
                @if(count($destinations) > 0)
                    <li>
                        <a class="dropdown-button" href="#!" data-activates="dropdown1">
                            Destinations
                            <i class="mdi-navigation-arrow-drop-down right">
                            </i>
                        </a>
                        <!-- Dropdown Structure -->
                        <ul id="dropdown1" class="dropdown-content">
                            @foreach($destinations as $index=>$destination)
                                <li>
                                    <a href="{{ route('destination.detail', $destination->slug) }}">
                                        {{ $destination->heading }}
                                    </a>
                                </li>
                                <li class="divider">
                                </li>
                            @endforeach
                        </ul>
                    </li>
            @endif
                       @if(count($allActivities) > 0)
                    <li>
                        <a class="dropdown-button" href="#!" data-activates="dropdown3">
                            Activities
                            <i class="mdi-navigation-arrow-drop-down right">
                            </i>
                        </a>
                        <!-- Dropdown Structure -->
                        <ul id="dropdown3" class="dropdown-content">
                            @foreach($allActivities as $index=>$a)
                                <li>
                                    <a href="{{ route('activity.detail', $a->slug) }}">
                                        {{ $a->heading }}
                                    </a>
                                </li>
                                <li class="divider">
                                </li>
                            @endforeach
                        </ul>
                    </li>
            @endif
          
                 
                <!-- <li>
                    <a href="#">
                        Hotels
                    </a>
                </li> -->
               <!--  <li>
                    <a href="{{ route('last.minute.deals') }}">
                        Cultural Tours
                    </a>
                </li> -->
                 
              
                
                
                
            </ul>
            <ul id="nav-mobile" class="side-nav">
                <li>
                    <a href="{{ route('home') }}">
                        Home
                    </a>
                </li>
                <li>
                    <a href="http://ibookmytour.com/page/about-us">
                       About US
                    </a>
                </li>
                <li>
                    <a class="dropdown-button" href="#!" data-activates="dropdown2">
                        Destinations
                        <i class="mdi-navigation-arrow-drop-down right">
                        </i>
                    </a>
                   
                    <ul id="dropdown2" class="dropdown-content">
                        @foreach($destinations as $index=>$destination)
                        <li>
                            <a href="{{ route('destination.detail', $destination->slug) }}">
                                {{ $destination->heading }}
                            </a>
                        </li>
                        <li class="divider">
                        </li>
                        @endforeach                        
                    </ul>
                </li>
                
                <li>
                    <a href="{{ route('last.minute.deals') }}">
                        Cultural Tours
                    </a>
                </li>
               
            </ul>
            <a href="#" data-activates="nav-mobile" class="button-collapse">
                <i class="mdi-navigation-menu">
                </i>
            </a>
        </div>
    </nav>
    <!-- nav  end -->
    </div>
</section>
