@extends('layout.backend.containerform')

@section('footer_js')
  <script>
  $(document).ready(function() {
    $('.sidebar-menu li').removeClass('active');
    $('#albums').addClass('active');

    $('#galleryEditForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            caption: {
                validators: {
                    notEmpty: {
                        message: 'The gallery caption is required'
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
        Album Galleries
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.albums') }}">Albums</a></li>
        <li><a href="{{ route('admin.album.galleries', $gallery->album->id) }}">Galleries : {{ $gallery->album->caption }}</a></li>
        <li class="active">Edit Gallery</li>
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
              <h3 class="box-title">Edit Gallery</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="galleryEditForm" name="galleryEditForm" action="" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group col-md-6">
                  <label for="exampleInputGallery">Gallery caption *</label>
                  <input type="text" class="form-control" id="caption" name="caption" value="{{ $gallery->caption }}" placeholder="Enter caption">
                </div>                        
              </div>
              <!-- /.box-body -->

              <div class="box-body">
                <div class="form-group col-md-12">
                  <label for="exampleInputGallery">Attachment *</label>
                  <div class="fileupload-new thumbnail" >
                    @if(file_exists('uploads/albums/galleries/'.$gallery->attachment) && $gallery->attachment!='')
                      <img src="{{ asset('uploads/albums/galleries/'.$gallery->attachment) }}" alt="" id="upload-preview" >
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
                  <label for="exampleInputGallery">Published</label>
                  <select class="form-control" name="is_active">
                    <option value="0" <?php echo ($gallery->is_active == '0')? 'selected="selected"' : '' ?> >No</option>
                    <option value="1" <?php echo (($gallery->is_active == '1' || $gallery->is_active == '')? 'selected="selected"' : '') ?> >Yes</option>
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