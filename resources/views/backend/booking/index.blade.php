@extends('layout.backend.containerlist')

@section('footer_js')
    <script type="text/javascript">
      $(document).ready(function(){
        $('.sidebar-menu li').removeClass('active');
        $('#bookings').addClass('active');
        $('#booking_list').addClass('active');      
      });
    </script>
  @endsection

@section('dynamicdata')

<section class="content-header">
      <h1>
        Bookings
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Bookings</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              
            </div>
            <!-- /.box-header -->
            @include('layout.backend.alert')
            <!-- table start -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S N</th>
                  <th>Booked By</th>
                  <th>Package</th>
                  <th>Booked On</th>
                  <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @foreach($bookings as $index=>$booking)
                <tr id="booking_{{ $booking->id }}">
                  <td>{{ $index+1 }}</td>
                
                    <td>{{ $booking->first_name ??"" .' '.$booking->last_name ?? "" .'('. $booking->email ?? "".')' }}</td>  

                  <td>{{ $booking->package->heading }}</td>
                  <td>{{ date_format(date_create($booking->created_at), 'M d,Y') }}</td>                  
                  <td>
                    <a href="{{ route('admin.booking.view', $booking->id) }}"><i class="fa fa-fw fa-eye"></i>View</a>
                  </td>
                </tr>
                @endforeach                
                </tbody>
                <tfoot>
                <tr>
                  <th>S N</th>
                  <th>Booked By</th>
                  <th>Package</th>
                  <th>Booked On</th>
                  <th>Options</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

@stop