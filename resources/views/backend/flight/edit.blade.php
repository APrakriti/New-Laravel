@extends('layout.backend.containerform')

@section('footer_js')
  <script>      
  $(document).ready(function() {
    $('.sidebar-menu li').removeClass('active');
    $('#flights').addClass('active');
    
    $('#flightEditForm').formValidation({
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
                        message: 'The flight name is required'
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
        <li class="active">Edit flight</li>
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
              <h3 class="box-title">Edit flight : {!! $flight->name !!}</h3>
            </div>
            <!-- /.box-header -->
            @include('layout.backend.alert')
            <!-- form start -->
            <form role="form" id="flightEditForm" name="flightEditForm" action="" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group col-md-6">
                  <label for="exampleInputflight">Flight Number *</label>
                  <input type="text" class="form-control" id="flight_no" name="flight_no" value="{!! $flight->flight_no !!}" placeholder="Enter flight number">
                </div>                        
              </div>
              <div class="box-body">
                   <div class="form-group col-md-6">
                  <label for="exampleInputflight">From *</label>
                  <input type="text" class="form-control" id="from" name="from" value="{{ $flight->from }}" placeholder="Enter From">
                </div>   
                <div class="form-group col-md-6">
                  <label for="exampleInputflight">To *</label>
                  <input type="text" class="form-control" id="to" name="to" value="{{ $flight->to }}" placeholder="Enter To">
                </div>  
                                     
              </div>
              <div class="box-body">
                   <div class="form-group col-md-6">
                  <label for="exampleInputflight">Departure *</label>
                  <input type="text" class="form-control" id="departure" name="departure" value="{{ $flight->departure }}" placeholder="Enter Departure">
                </div>   
                <div class="form-group col-md-6">
                  <label for="exampleInputflight">Arrival *</label>
                  <input type="text" class="form-control" id="arrival" name="arrival" value="{{ $flight->arrival }}" placeholder="Enter arrival">
                </div>  
              </div>
                 <div class="box-body">
                   <div class="form-group col-md-6">
                  <label for="exampleInputflight">Remarks *</label>
                  <input type="text" class="form-control" id="remarks" name="remarks" value="{{ $flight->remarks }}" placeholder="Enter Remarks">
                </div>   
                <div class="form-group col-md-6">
                  <label for="exampleInputflight">Flight Days *</label>
                  <input type="text" class="form-control" id="flight_days" name="flight_days" 
                  value="{{$flight->flight_days }}" placeholder="Enter flight days">
                </div>  
              </div>
              <div class="box-body">
                    
                <div class="form-group col-md-3">
                  <label for="exampleInputflight">Bhutan Price *</label>
                  <input type="text" class="form-control" id="bhutan_price" name="bhutan_price" 
                  value="{{ $flight->bhutan_price}}" placeholder="Enter Bhutan Price">
                </div>    
                 <div class="form-group col-md-3">
                  <label for="exampleInputflight">Saarc Price *</label>
                  <input type="text" class="form-control" id="saarc_price" name="saarc_price"
                   value="{{ $flight->saarc_price}}" placeholder="Enter Saarc Price">
                </div>   
                 <div class="form-group col-md-3">
                  <label for="exampleInputflight">Other Price *</label>
                  <input type="text" class="form-control" id="price" name="price" value="{{ $flight->price}}" placeholder="Enter price">
                </div>
                
              </div>
              <!-- /.box-body -->
           

            

              <div class="box-body">
                <div class="form-group col-md-6">
                  <label for="exampleInputflight">Published</label>
                  <select class="form-control" name="is_active">
                    <option value="0" <?php echo ($flight->is_active == '0')? 'selected="selected"' : '' ?> >No</option>
                    <option value="1" <?php echo (($flight->is_active == '1' || $flight->is_active == '')? 'selected="selected"' : '') ?> >Yes</option>
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