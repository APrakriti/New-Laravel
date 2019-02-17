@extends('layout.backend.containerform')

@section('footer_js')
  <script>
  $(document).ready(function() {
    $('.sidebar-menu li').removeClass('active');
    $('#flights').addClass('active');
    $('#flight_add').addClass('active');

    $('#flightAddForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'The flight name is required.'
                    }
                }
            },
            
            attachment: {
              validators: {
                  file: {
                      extension: 'jpeg,jpg,png',
                      type: 'image/jpeg,image/png',
                      maxSize: 1048576,   // 1024 * 1024
                      message: 'The selected file is not valid or file size greater than 1 MB.'
                  }
              }
            },
        }
    });
  });
</script>
@endsection

@section('dynamicdata')

<section class="content-header">
      <h1>
        flights
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.flights') }}">flights</a></li>
        <li class="active">Add New</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add New flight</h3>
            </div>
            <!-- /.box-header -->
            @include('layout.backend.alert')
            <!-- form start -->
            <form role="form" id="flightAddForm" name="flightAddForm" action="" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group col-md-6">
                  <label for="exampleInputflight">Flight Number *</label>
                  <input type="text" class="form-control" id="flight_no" name="flight_no" value="{{ old('flight_no') }}" placeholder="Enter flight number">
                </div>  
                                   
              </div>
                <div class="box-body">
                   <div class="form-group col-md-6">
                  <label for="exampleInputflight">From *</label>
                  <input type="text" class="form-control" id="from" name="from" value="{{ old('from') }}" placeholder="Enter From">
                </div>   
                <div class="form-group col-md-6">
                  <label for="exampleInputflight">To *</label>
                  <input type="text" class="form-control" id="to" name="to" value="{{ old('to') }}" placeholder="Enter To">
                </div>  
                                     
              </div>
               <div class="box-body">
                   <div class="form-group col-md-6">
                  <label for="exampleInputflight">Departure *</label>
                  <input type="text" class="form-control" id="departure" name="departure" value="{{ old('departure') }}" placeholder="Enter Departure">
                </div>   
                <div class="form-group col-md-6">
                  <label for="exampleInputflight">Arrival *</label>
                  <input type="text" class="form-control" id="arrival" name="arrival" value="{{ old('arrival') }}" placeholder="Enter arrival">
                </div>  
              </div>
                 <div class="box-body">
                   <div class="form-group col-md-6">
                  <label for="exampleInputflight">Remarks *</label>
                  <input type="text" class="form-control" id="remarks" name="remarks" value="{{ old('remarks') }}" placeholder="Enter Remarks">
                </div>   
                <div class="form-group col-md-6">
                  <label for="exampleInputflight">Flight Days *</label>
                  <input type="text" class="form-control" id="flight_days" name="flight_days" value="{{ old('flight_days') }}" placeholder="Enter flight days">
                </div>  
              </div>
              <div class="box-body">
                    
                 <div class="form-group col-md-3">
                  <label for="exampleInputflight">Bhutan Price *</label>
                  <input type="text" class="form-control" id="bhutan_price" name="bhutan_price" value="{{ old('bhutan_price') }}" placeholder="Enter Bhutan Price">
                </div>    
                 <div class="form-group col-md-3">
                  <label for="exampleInputflight">Saarc Price *</label>
                  <input type="text" class="form-control" id="saarc_price" name="saarc_price" value="{{ old('saarc_price') }}" placeholder="Enter Saarc Price">
                </div>  
                 <div class="form-group col-md-3">
                  <label for="exampleInputflight">Other Price *</label>
                  <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}" placeholder="Enter Other Price">
                </div> 
                
              </div>
              <!-- /.box-body -->
             

              <div class="box-body">
                <div class="form-group col-md-6">
                  <label for="exampleInputflight">Published</label>
                  <select class="form-control" name="is_active">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                  </select>
                </div>                              
              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
              {!! csrf_field() !!}
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (left) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

@stop