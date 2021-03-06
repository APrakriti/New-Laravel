@extends('layout.backend.containerform')

@section('footer_js')
  <script>      
  $(document).ready(function() {
    $('.sidebar-menu li').removeClass('active');
    $('#settings').addClass('active');
    
    $('#settingEditForm').formValidation({
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
                        message: 'The setting name is required'
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
        settings
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.settings') }}">settings</a></li>
        <li class="active">Edit setting</li>
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
              <h3 class="box-title">Edit setting : {!! $setting->name !!}</h3>
            </div>
            <!-- /.box-header -->
            @include('layout.backend.alert')
            <!-- form start -->
            <form role="form" id="settingEditForm" name="settingEditForm" action="" method="post" enctype="multipart/form-data">
                <div class="box-body">                
                <div class="form-group col-md-6">
                  <label for="exampleInputActivity">Name *</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ $setting->name }}" placeholder="Enter  name">
                </div>                         
              </div>
              <!-- /.box-body -->

             
              <div class="box-body">
                <div class="form-group col-md-6">
                  <label for="exampleInputActivity">Slug</label>
                  <input type="text" class="form-control" id="slug" name="slug" value="{{$setting->slug}}" placeholder="Enter slug">
                </div>                               
              </div>

              <div class="box-body">
                <div class="form-group col-md-12">
                  <label for="exampleInputActivity">Value</label>
                  <input type="text" class="form-control" id="value" name="value" value="{{ $setting->value }}" placeholder="Enter value">
                </div>                               
              </div>

              <div class="box-body">
                <div class="form-group col-md-12">
                  <label for="exampleInputActivity">Type</label>
                  <input type="text" class="form-control" id="type" name="type" value="{{ $setting->type }}" placeholder="Enter type">
                </div>                               
              </div>
              <!-- /.box-body -->
           

            

              <div class="box-body">
                <div class="form-group col-md-6">
                  <label for="exampleInputsetting">Published</label>
                  <select class="form-control" name="is_active">
                 
                    <option value="1" <?php echo (($setting->is_active == '1' || $setting->is_active == '')? 'selected="selected"' : '') ?> >Yes</option>
                       <option value="0" <?php echo ($setting->is_active == '0')? 'selected="selected"' : '' ?> >No</option>
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



