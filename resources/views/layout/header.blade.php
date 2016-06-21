{{-- */ $route = \Request::route()->getName(); /* --}}
{{-- */ $destinations = App\Models\Destination::where('is_active', 1)->orderBy('order_position')->get(); /* --}}

<section class="header">
    <nav  role="navigation">
        <div class="nav-wrapper ">
            <div class="logo">
                <a  id="logo-container" href="{{ route('home') }}" class="brand-logo">
                    <img src="{{ asset('images/logo.png') }}"/>
                </a>
            </div>
            <div class="header-right ">
                <div class="top_menu">
                @if(Auth::id())
                    <ul>
                        <li>                            
                            Welcome, {{ Auth::user()->first_name .' '.Auth::user()->last_name }}
                        </li>
                        <li>
                            <a href="{{ route('logout') }}">
                                Logout
                            </a>
                        </li>
                    </ul>                    
                @else 
                    <ul>
                        <li>
                            <a href="{{ route('login') }}">
                                Login
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}">
                                Sign Up
                            </a>
                        </li>
                    </ul>
                @endif
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
                    <a href="{{ route('packages') }}">
                        Tour packages
                    </a>
                </li>
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
                <!-- <li>
                    <a href="#">
                        Hotels
                    </a>
                </li> -->
                <li>
                    <a href="{{ route('last.minute.deals') }}">
                        Last Minutes Deals
                    </a>
                </li>
            </ul>
            <ul id="nav-mobile" class="side-nav">
                <li>
                    <a href="{{ route('home') }}">
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('packages') }}">
                        Tour packages
                    </a>
                </li>
                <li>
                    <a class="dropdown-button" href="#!" data-activates="dropdown2">
                        Destinations
                        <i class="mdi-navigation-arrow-drop-down right">
                        </i>
                    </a>
                    <ul id="dropdown2" class="dropdown-content">
                        <li>
                            <a href="#!">
                                Nepal
                            </a>
                        </li>
                        <li class="divider">
                        </li>
                        <li>
                            <a href="#!">
                                India
                            </a>
                        </li>
                        <li class="divider">
                        </li>
                        <li>
                            <a href="#!">
                                Tibet
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- <li>
                    <a href="#">
                        Hotels
                    </a>
                </li> -->
                <li>
                    <a href="{{ route('last.minute.deals') }}">
                        Last Minutes Deals
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
</section>
