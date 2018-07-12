@extends('layout.backend.containerform')

@section('footer_js')
  <script>      
  $(document).ready(function() {
    $('.sidebar-menu li').removeClass('active');
    $('#testimonials').addClass('active');
    
    $('#testimonialEditForm').formValidation({
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
                        message: 'The testimonial name is required'
                    }
                }
            },

            description: {
                validators: {
                    notEmpty: {
                        message: 'The description is required.'
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
        Testimonials
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.testimonials') }}">Testimonials</a></li>
        <li class="active">Edit Testimonial</li>
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
              <h3 class="box-title">Edit Testimonial : {!! $testimonial->name !!}</h3>
            </div>
            <!-- /.box-header -->
            @include('layout.backend.alert')
            <!-- form start -->
            <form role="form" id="testimonialEditForm" name="testimonialEditForm" action="" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group col-md-6">
                  <label for="exampleInputTestimonial">Testimonial Name *</label>
                  <input type="text" class="form-control" id="name" name="name" value="{!! $testimonial->name !!}" placeholder="Enter testimonial name">
                </div> 
                <div class="form-group col-md-6">
                <label for="exampleInputPackage">Type</label>
                  <select class="form-control" name="type">
                     <option value="">Select Type</option>
                                   
                        <option value="foreigner">For Foreigners</option>
                        <option value="nepalese">For Nepalese</option>
                                   
                                </select>
                  </div>                         
              </div>
              <!-- /.box-body -->
              <div class="box-body">
                <div class="form-group col-md-12">
                  <label for="exampleInputTestimonial">Description</label>
                  <textarea class="form-control" id="description" name="description">{!! $testimonial->description !!}</textarea>
                </div>                               
              </div>

              <div class="box-body">
                <div class="form-group col-md-12">
                  <label for="exampleInputTestimonial">Attachment *</label>
                  <div class="fileupload-new thumbnail">
                    @if(file_exists('uploads/testimonials/'.$testimonial->attachment) && $testimonial->attachment!='')
                      <img src="{{ asset('uploads/testimonials/'.$testimonial->attachment) }}" alt="" id="upload-preview" >
                    @else
                      <img src="{{ asset('uploads/noimage.jpg') }}" alt="" id="upload-preview" >
                    @endif
                  </div>
                  <input type="file" name="attachment" id="attachment">
                  <p class="help-block">Valid file extensions are jpeg,jpg and png.</p>
                  </div>                               
              </div>

              <div class="box-body">
                <div class="form-group col-md-6">
                  <label for="exampleInputTestimonial">Published</label>
                  <select class="form-control" name="is_active">
                    <option value="0" <?php echo ($testimonial->is_active == '0')? 'selected="selected"' : '' ?> >No</option>
                    <option value="1" <?php echo (($testimonial->is_active == '1' || $testimonial->is_active == '')? 'selected="selected"' : '') ?> >Yes</option>
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