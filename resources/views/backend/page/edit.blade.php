@extends('layout.backend.containerform')

@section('footer_js')
  <script>      
  $(document).ready(function() {
    $('.sidebar-menu li').removeClass('active');
    $('#pages').addClass('active');
    
    $('#pageEditForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            slug: {
                validators: {
                    notEmpty: {
                        message: 'The page slug is required'
                    }
                }
            },
            title: {
                validators: {
                    notEmpty: {
                        message: 'The page title is required'
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
        Pages
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.pages') }}">Pages</a></li>
        <li class="active">Edit Page</li>
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
              <h3 class="box-title">Edit Page : {!! $page->heading !!}</h3>
            </div>
            <!-- /.box-header -->
            @include('layout.backend.alert')
            <!-- form start -->
            <form page="form" id="pageEditForm" name="pageEditForm" action="" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group col-md-6">
                  <label for="exampleInputPage">Page Slug *</label>
                  <input type="text" class="form-control" id="slug" name="slug" value="{!! $page->slug !!}" placeholder="Enter page slug">
                </div>                        
              </div>
              <div class="box-body">
                <div class="form-group col-md-6">
                  <label for="exampleInputPage">Page Title *</label>
                  <input type="text" class="form-control" id="title" name="title" value="{!! $page->title !!}" placeholder="Enter page title">
                </div>                        
              </div>
              <div class="box-body">
                <div class="form-group col-md-12">
                  <label for="exampleInputContent">Meta Tags</label>
                  <input type="text" class="form-control" id="meta_tags" name="meta_tags" value="{!! $page->meta_tags !!}" placeholder="Enter meta tags">
                </div>                               
              </div>

              <div class="box-body">
                <div class="form-group col-md-12">
                  <label for="exampleInputContent">Meta Description</label>
                  <input type="text" class="form-control" id="meta_description" name="meta_description" value="{!! $page->meta_description !!}" placeholder="Enter meta description">
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