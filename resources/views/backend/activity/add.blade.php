@extends('layout.backend.containerform')

@section('footer_js')
  <script>
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        
        CKEDITOR.replace( 'description',{
          filebrowserBrowseUrl : "{{ asset('backend/plugins/ckfinder/ckfinder.html') }}",
          filebrowserImageBrowseUrl : "{{ asset('backend/plugins/ckfinder/ckfinder.html?type=Images') }}",
          filebrowserFlashBrowseUrl : "{{ asset('backend/plugins/ckfinder/ckfinder.html?type=Flash') }}",
          filebrowserUploadUrl : "{{ asset('backend/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
          filebrowserImageUploadUrl : "{{ asset('backend/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
          filebrowserFlashUploadUrl : "{{ asset('backend/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}",
          filebrowserWindowWidth : '1000',
          filebrowserWindowHeight : '700'
        });

        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
      });
  $(document).ready(function() {
    $('.sidebar-menu li').removeClass('active');
    $('#activities').addClass('active');
    $('#activity_add').addClass('active');
    
    $('#activityAddForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            activity_type: {
                validators: {
                    notEmpty: {
                        message: 'The activity type is not selected'
                    }
                }
            },
            heading: {
                validators: {
                    notEmpty: {
                        message: 'The activity name is required'
                    }
                }
            },
            description: {
                    validators: {
                        notEmpty: {
                            message: 'The description is required and cannot be empty'
                        },
                    }
                },

            title: {
                validators: {
                    notEmpty: {
                        message: 'The activity title is required'
                    }
                }
            },
            
            attachment: {
              validators: {
                  file: {
                      extension: 'jpeg,jpg,png',
                      type: 'image/jpeg,image/png',
                      maxSize: 1048576,   // 1024 * 1024
                      message: 'The selected file is not valid'
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
        Activities
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.activities') }}">Activities</a></li>
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
              <h3 class="box-title">Add New Activity</h3>
            </div>
            <!-- /.box-header -->
            @include('layout.backend.alert')
            <!-- form start -->
            <form role="form" id="activityAddForm" name="activityAddForm" action="" method="post" enctype="multipart/form-data">
              <div class="box-body">                
                <div class="form-group col-md-6">
                  <label for="exampleInputActivity">Activity Name *</label>
                  <input type="text" class="form-control" id="heading" name="heading" value="{{ old('heading') }}" placeholder="Enter activity name">
                </div>                        
              </div>
              <!-- /.box-body -->

              <div class="box-body">
                <div class="form-group col-md-12">
                  <label for="exampleInputActivity">Description *</label>
                  <textarea id="description" name="description" rows="10" cols="80">{{ old('description') }}</textarea>
                  </div>                               
              </div>

              <div class="box-body">
                <div class="form-group col-md-6">
                  <label for="exampleInputActivity">Activity Title *</label>
                  <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Enter activity title">
                </div>                               
              </div>

              <div class="box-body">
                <div class="form-group col-md-12">
                  <label for="exampleInputActivity">Meta Tags</label>
                  <input type="text" class="form-control" id="meta_tags" name="meta_tags" value="{{ old('meta_tags') }}" placeholder="Enter meta tags">
                </div>                               
              </div>

              <div class="box-body">
                <div class="form-group col-md-12">
                  <label for="exampleInputActivity">Meta Description</label>
                  <input type="text" class="form-control" id="meta_description" name="meta_description" value="{{ old('meta_description') }}" placeholder="Enter meta description">
                </div>                               
              </div>

              <div class="box-body">
                <div class="form-group col-md-12">
                  <label for="exampleInputBanner">Attachment *</label>
                  <div class="fileupload-new thumbnail" >
                    <img src="{{ asset('uploads/noimage.jpg') }}" alt="" id="upload-preview" />
                  </div>
                  <input type="file" name="attachment" id="attachment">
                  <p class="help-block">Valid file extensions are jpeg,jpg and png.</p>
                   <p>Maximum file size 1024 * 1024</p>
                  </div>                               
              </div>

              <div class="box-body">
                <div class="form-group col-md-6">
                  <label for="exampleInputActivity">Published</label>
                  <select class="form-control" name="is_active">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                  </select>
                </div>                              
              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" value="Submit">Submit</button>
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