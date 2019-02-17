@extends('layout.backend.containerform')

@section('footer_js')
  <script>      
  $(document).ready(function() {
    $('.sidebar-menu li').removeClass('active');
    $('#buyers').addClass('active');
    
    $('#buyerEditForm').formValidation({
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
                        message: 'The buyer name is required'
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
        buyers
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Buyers</li>
        <li class="active">Edit buyer</li>
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
              <h3 class="box-title">Edit buyer : {!! $buyer->name !!}</h3>
            </div>
            <!-- /.box-header -->
            @include('layout.backend.alert')
            <!-- form start -->
            <form role="form" id="buyerEditForm" name="buyerEditForm" action="" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group col-md-6">
                  <label for="exampleInputbuyer">First Name *</label>
                  <input type="text" class="form-control" id="first_name" name="first_name" value="{!! $buyer->first_name !!}" placeholder="Enter buyer name">
                </div>  
                <div class="form-group col-md-6">
                  <label for="exampleInputbuyer">Lat Name *</label>
                  <input type="text" class="form-control" id="last_name" name="last_name" value="{!! $buyer->last_name !!}" placeholder="Enter Last name">
                </div>                       
              </div>
               <div class="box-body">
                <div class="form-group col-md-6">
                  <label for="exampleInputbuyer"> Email *</label>
                  <input type="text" class="form-control" id="email" name="email" value="{!! $buyer->email !!}" placeholder="Enter email">
                </div>                        
             
                <div class="form-group col-md-6">
                  <label for="exampleInputbuyer"> Username *</label>
                  <input type="text" class="form-control" id="username" name="username" value="{!! $buyer->username !!}" placeholder="Enter username">
                </div>                        
              </div>
              <!-- /.box-body -->
           

            

              <div class="box-body">
                 <div class="form-group col-md-6">
                  <label for="exampleInputPackage">Tier Type *</label>
                  <select class="form-control" name="tier_id">
                    <option value="">Select Type *</option>
                    @foreach($tier as $t)
                    <option value="{{ $t->id }}" @if($t->id == $buyer->tier_id) selected="selected" @endif>{{ $t->tier_name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputbuyer">Published</label>
                  <select class="form-control" name="is_active">
                    <option value="0" <?php echo ($buyer->is_active == '0')? 'selected="selected"' : '' ?> >No</option>
                    <option value="1" <?php echo (($buyer->is_active == '1' || $buyer->is_active == '')? 'selected="selected"' : '') ?> >Yes</option>
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