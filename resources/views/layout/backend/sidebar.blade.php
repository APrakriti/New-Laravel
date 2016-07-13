{{-- */ 

  $countActivity = \App\Models\Activity::count();
  $countBanner = \App\Models\Banner::count();
  $countContent = \App\Models\Content::count();
  $countDestination = \App\Models\Destination::count();
  $countPackage = \App\Models\Package::count();
  $countBooking = \App\Models\Booking::count();
  $countTestimonial = \App\Models\Testimonial::count();
  $countNews = \App\Models\News::count();

/* --}}
                                    
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('backend/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{!! Auth::user()->name; !!}</p>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="treeview" id="dashboard">
          <a href="{{ route('admin.dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
          </a>
        </li>
        
        @if(Access::hasAccess('activities'))
        <li class="treeview" id="activities">
          <a href="#">
            <i class="fa fa-square-o"></i>
            <span>Activities</span>
            <span class="label label-primary pull-right">{{ $countActivity }}</span>
          </a>
          <ul class="treeview-menu">
            <li id="activity_list"><a href="{{ route('admin.activities') }}"><i class="fa fa-circle-o"></i> List Activities</a></li>
            <li id="activity_add"><a href="{{ route('admin.activity.add') }}"><i class="fa fa-circle-o"></i> Add Activity</a></li>
          </ul>
        </li>
        @endif
        
        @if(Access::hasAccess('banners'))
        <li class="treeview" id="banners">
          <a href="#">
            <i class="fa fa-camera"></i>
            <span>Banners</span>
            <span class="label label-primary pull-right">{{ $countBanner }}</span>
          </a>
          <ul class="treeview-menu">
            <li id="banner_list"><a href="{{ route('admin.banners') }}"><i class="fa fa-circle-o"></i> List Banners</a></li>
            <li id="banner_add"><a href="{{ route('admin.banner.add') }}"><i class="fa fa-circle-o"></i> Add Banner</a></li>
          </ul>
        </li>
        @endif
        
        @if(Access::hasAccess('contents'))
        <li class="treeview" id="contents">
          <a href="#">
            <i class="fa fa-square-o"></i>
            <span>Contents</span>
            <span class="label label-primary pull-right">{{ $countContent }}</span>
          </a>
          <ul class="treeview-menu">
            <li id="content_list"><a href="{{ route('admin.contents') }}"><i class="fa fa-circle-o"></i> List Contents</a></li>
            <li id="content_add"><a href="{{ route('admin.content.add') }}"><i class="fa fa-circle-o"></i> Add Content</a></li>
          </ul>
        </li>
        @endif

        @if(Access::hasAccess('news'))
        <li class="treeview" id="news">
          <a href="#">
            <i class="fa fa-square-o"></i>
            <span>News</span>
            <span class="label label-primary pull-right">{{ $countNews }}</span>
          </a>
          <ul class="treeview-menu">
            <li id="news_list"><a href="{{ route('admin.news') }}"><i class="fa fa-circle-o"></i> List News</a></li>
            <li id="news_add"><a href="{{ route('admin.news.add') }}"><i class="fa fa-circle-o"></i> Add News</a></li>
          </ul>
        </li>
        @endif
        
        @if(Access::hasAccess('destinations'))
        <li class="treeview" id="destinations">
          <a href="#">
            <i class="fa fa-square-o"></i>
            <span>Destinations</span>
            <span class="label label-primary pull-right">{{ $countDestination }}</span>
          </a>
          <ul class="treeview-menu">
            <li id="destination_list"><a href="{{ route('admin.destinations') }}"><i class="fa fa-circle-o"></i> List Destinations</a></li>
            <li id="destination_add"><a href="{{ route('admin.destination.add') }}"><i class="fa fa-circle-o"></i> Add Destination</a></li>
          </ul>
        </li>
        @endif
        
        @if(Access::hasAccess('packages'))
        <li class="treeview" id="packages">
          <a href="#">
            <i class="fa fa-square-o"></i>
            <span>Packages</span>
            <span class="label label-primary pull-right">{{ $countPackage }}</span>
          </a>
          <ul class="treeview-menu">
            <li id="package_list"><a href="{{ route('admin.packages') }}"><i class="fa fa-circle-o"></i> List Packages</a></li>
            <li id="package_add"><a href="{{ route('admin.package.add') }}"><i class="fa fa-circle-o"></i> Add Package</a></li>
          </ul>
        </li>
        @endif
        
        @if(Access::hasAccess('bookings'))
        <li class="treeview" id="bookings">
          <a href="#">
            <i class="fa fa-square-o"></i>
            <span>Bookings</span>
            <span class="label label-primary pull-right">{{ $countBooking }}</span>
          </a>
          <ul class="treeview-menu">
            <li id="booking_list"><a href="{{ route('admin.bookings') }}"><i class="fa fa-circle-o"></i> List Bookings</a></li>
          </ul>
        </li>
        @endif
        
        @if(Access::hasAccess('testimonials'))
        <li class="treeview" id="testimonials">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Testimonials</span>
            <span class="label label-primary pull-right">{{ $countTestimonial }}</span>
          </a>
          <ul class="treeview-menu">
            <li id="testimonial_list"><a href="{{ route('admin.testimonials') }}"><i class="fa fa-circle-o"></i> List Testimonials</a></li>
            <li id="testimonial_add"><a href="{{ route('admin.testimonial.add') }}"><i class="fa fa-circle-o"></i> Add Testimonial</a></li>
          </ul>
        </li>
        @endif 
        
        <li><a href="{{ route('admin.logout') }}"><i class="fa  fa-power-off text-aqua"></i> <span>Logout</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>