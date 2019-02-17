@extends('layout.backend.containerform')

@section('footer_js')
  <script>
  $(document).ready(function() {
    $('.sidebar-menu li').removeClass('active');
    $('#tiers').addClass('active');
    $('#tier_add').addClass('active');

    $('#tierAddForm').formValidation({
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
                        message: 'The tier name is required.'
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
        tiers
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.tiers') }}">tiers</a></li>
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
              <h3 class="box-title">Add New tier</h3>
            </div>
            <!-- /.box-header -->
            @include('layout.backend.alert')
            <!-- form start -->
            <form role="form" id="tierAddForm" name="tierAddForm" action="" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group col-md-6">
                  <label for="exampleInputtier">Tier Name *</label>
                  <input type="text" class="form-control" id="tier_name" name="tier_name" value="{{ old('tier_name') }}" placeholder="Enter tier name">
                </div>                        
              </div>
              <!-- /.box-body -->
             

              <div class="box-body">
                <div class="form-group col-md-6">
                  <label for="exampleInputtier">Published</label>
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