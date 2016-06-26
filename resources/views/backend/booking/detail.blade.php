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
              <div class="box-header">
                <h1>Booking Details</h1>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <tbody>
                <tr>
                  <td>Booked By</td>
                  <td>{{ $booking->customer->first_name .' '.$booking->customer->last_name .'('. $booking->customer->email .')' }}</td>                  
                </tr>
                <tr>
                  <td>Package</td>
                  <td><a href="{{ route('package.detail', $booking->package->slug) }}" target="_blank">{{ $booking->package->heading }}</a></td>
                </tr>
                <tr>
                  <td>Amount</td>
                  <td>{{ $booking->amount }}</td>
                </tr>
                <tr>
                  <td>No of Travellers</td>
                  <td>{{ $booking->number_of_traveller }}</td>
                </tr> 
                <tr>
                  <td>Arrival Date</td>
                  <td>{{ date_format(date_create($booking->arrival_date), 'M d,Y') }}</td>
                </tr> 
                <tr>
                  <td>Departure Date</td>
                  <td>{{ date_format(date_create($booking->departure_date), 'M d,Y') }}</td>
                </tr> 
                <tr>
                  <td>Booked On</td>
                  <td>{{ date_format(date_create($booking->created_at), 'M d,Y') }}</td>
                </tr> 
                <tr>
                  <td>Customer Name</td>
                  <td>{{ $booking->first_name .' '.$booking->last_name }}</td>
                </tr>             
                <tr>
                  <td>Address</td>
                  <td>{{ $booking->address .', '.$booking->country->country_name }}</td>
                </tr>
                <tr>
                  <td>Contact Number</td>
                  <td>{{ $booking->contact_number }}</td>
                </tr>                
                </tbody>                
              </table>
            </div>
            <!-- /.box-body -->
            <!-- table start -->
            <div class="box-body">
              <div class="box-header">
                <h1>Payment Details</h1>
              </div>
              <table id="example2" class="table table-bordered table-striped">
                <tbody>
                <tr>
                  <td>Transaction Id</td>
                  <td>{{ $booking->payment->transaction_id }}</td>                  
                </tr>
                <tr>
                  <td>Paymnet Status</td>
                  <td>{{ $booking->payment->status }}</td>                  
                </tr>
                <tr>
                  <td>Transaction Amount</td>
                  <td>{{ $booking->payment->transaction_amount }}</td>
                </tr>
                <tr>
                  <td>Transaction Fee</td>
                  <td>{{ $booking->payment->transaction_fee }}</td>
                </tr>
                <tr>
                  <td>Paypal Email</td>
                  <td>{{ $booking->payment->email }}</td>
                </tr>
                <tr>
                  <td>Paypal Customer Name</td>
                  <td>{{ $booking->payment->first_name .' '.$booking->payment->last_name }}</td>
                </tr>             
                <tr>
                  <td>Payer Id</td>
                  <td>{{ $booking->payment->payer_id }}</td>
                </tr>
                <!-- <tr>
                  <td>Desc</td>
                  <td>{{ $booking->payment->description }}</td>
                </tr> -->                
                </tbody>                
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