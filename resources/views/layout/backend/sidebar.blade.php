<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
       
      
          <p>{!! Auth::user()->first_name; !!}</p>
     
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="treeview" id="dashboard">
          <a href="{{ route('admin.dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
          </a>
        </li>
         @if(Access::hasAccess('user-type', 'access_view') || Access::hasAccess('modules', 'access_view'))
        <li class="treeview" id="testimonials">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Configurations</span>
            <span class="label label-primary pull-right"></span>
          </a>
          <ul class="treeview-menu">
           @if(Access::hasAccess('user-type', 'access_view'))
                            <li><a href="{{ URL::route('admin.usertypes') }}"
                                   class="{{ (Request::segment(3)=='usertypes' ? 'active':'') }}"><i
                                            class="zmdi zmdi-apps zmdi-hc-fw"></i> User Types</a></li>
                        @endif
            @if(Access::hasAccess('modules', 'access_view'))
                            <li><a href="{{ URL::route('admin.modules') }}"
                                   class="{{ (Request::segment(3)=='modules' ? 'active':'') }}"><i
                                            class="zmdi zmdi-view-module zmdi-hc-fw"></i> Modules</a></li>
                        @endif
          
              @if(Access::hasAccess('users', 'access_view'))
                <li class="{{ (Request::segment(2)=='users' ? 'active':'') }}"><a
                            href="{{ route('admin.users.index') }}"><i class="zmdi zmdi-accounts-list zmdi-hc-fw"></i>
                        Users</a></li>
            @endif

        
          </ul>
        </li>
        @endif 
       
         



        
         
    
           
        <li><a href="{{ route('admin.logout') }}"><i class="fa  fa-power-off text-aqua"></i> <span>Logout</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>