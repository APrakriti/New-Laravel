@extends('layout.backend.containerform')

@section('footer_js')

    <script>
        $(function () {
            {{--CKEDITOR.replace('description', {--}}
                {{--filebrowserBrowseUrl: "{{ asset('backend/plugins/ckfinder/ckfinder.html') }}",--}}
                {{--filebrowserImageBrowseUrl: "{{ asset('backend/plugins/ckfinder/ckfinder.html?type=Images') }}",--}}
                {{--filebrowserFlashBrowseUrl: "{{ asset('backend/plugins/ckfinder/ckfinder.html?type=Flash') }}",--}}
                {{--filebrowserUploadUrl: "{{ asset('backend/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",--}}
                {{--filebrowserImageUploadUrl: "{{ asset('backend/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",--}}
                {{--filebrowserFlashUploadUrl: "{{ asset('backend/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}",--}}
                {{--filebrowserWindowWidth: '1000',--}}
                {{--filebrowserWindowHeight: '700'--}}
            {{--});--}}
        });
        $(document).ready(function () {
            $('.sidebar-menu li').removeClass('active');
            $('#contents').addClass('active');
            $('#content_add').addClass('active');

            $('#contentAddForm')
                    .formValidation({
                        framework: 'bootstrap',
                        excluded: [':disabled'],
                        icon: {
                            valid: 'glyphicon glyphicon-ok',
                            invalid: 'glyphicon glyphicon-remove',
                            validating: 'glyphicon glyphicon-refresh'
                        },
                        fields: {

                            content_type: {
                                validators: {
                                    notEmpty: {
                                        message: 'The content type is not selected'
                                    }
                                }
                            },
                            heading: {
                                validators: {
                                    notEmpty: {
                                        message: 'The content name is required'
                                    }
                                }
                            },

                            description: {
                                // Use the same transformer for all validators
                                transformer: function ($field, validatorName, validator) {
                                    var value = $field.val();
                                    if (value === '') {
                                        return value;
                                    }

                                    // Get the plain text without HTML
                                    var div = $('<div/>').html(value).get(0),
                                            text = div.textContent || div.innerText;

                                    return text;
                                },
                                validators: {
                                    notEmpty: {
                                        message: 'The description is required and cannot be empty'
                                    }
                                }
                            },

                            title: {
                                validators: {
                                    notEmpty: {
                                        message: 'The content title is required'
                                    }
                                }
                            },

                            attachment: {
                                validators: {
                                    notEmpty: {
                                        message: 'The attachment is required'
                                    },
                                    file: {
                                        extension: 'jpeg,jpg,png',
                                        type: 'image/jpeg,image/png',
                                        maxSize: 1048576,   // 1024 * 1024
                                        message: 'The selected file is not valid or file size greater than 1 MB.'
                                    }
                                }
                            },
                        }
                    })
                    .find('[name="description"]')
                    .each(function () {
                        $(this)
                                .ckeditor()
                                .editor
                                .on('change', function (e) {
                                    $('#contentAddForm').formValidation('revalidateField', e.sender.name);
                                });
                    });


        });
    </script>
@endsection

@section('dynamicdata')

    <section class="content-header">
        <h1>
            Contents
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('admin.contents') }}">Contents</a></li>
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
                        <h3 class="box-title">Add New Content</h3>
                    </div>
                    <!-- /.box-header -->
                @include('layout.backend.alert')
                <!-- form start -->
                    <form role="form" id="contentAddForm" name="contentAddForm" action="" method="post"
                          enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group col-md-6">
                                <label for="exampleInputContent">Content Name *</label>
                                <input type="text" class="form-control" id="heading" name="heading"
                                       value="{{ old('heading') }}" placeholder="Enter content name">
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-body">
                            <div class="form-group col-md-12">
                                <label for="exampleInputContent">Description *</label>
                                <textarea id="description" name="description" rows="10"
                                          cols="80">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group col-md-6">
                                <label for="exampleInputContent">Content Title *</label>
                                <input type="text" class="form-control" id="title" name="title"
                                       value="{{ old('title') }}" placeholder="Enter content title">
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group col-md-12">
                                <label for="exampleInputContent">Meta Tags</label>
                                <input type="text" class="form-control" id="meta_tags" name="meta_tags"
                                       value="{{ old('meta_tags') }}" placeholder="Enter meta tags">
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group col-md-12">
                                <label for="exampleInputContent">Meta Description</label>
                                <input type="text" class="form-control" id="meta_description" name="meta_description"
                                       value="{{ old('meta_description') }}" placeholder="Enter meta description">
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group col-md-12">
                                <label for="exampleInputBanner">Attachment *</label>
                                <div class="fileupload-new thumbnail">
                                    <img src="{{ asset('uploads/noimage.jpg') }}" alt="" id="upload-preview"/>
                                </div>
                                <input type="file" name="attachment" id="attachment">
                                <p class="help-block">Valid file extensions are jpeg,jpg and png.</p>
                            </div>
                        </div>

                        <div class="box-body">


                            <input type="hidden" name="show_footer" value="1">

                            <div class="form-group col-md-6">
                                <label for="exampleInputContent">Published</label>
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