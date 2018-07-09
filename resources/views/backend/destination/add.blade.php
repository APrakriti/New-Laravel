@extends('layout.backend.containerform')

@section('footer_js')
    <script>

        $(document).ready(function () {
            $('.sidebar-menu li').removeClass('active');
            $('#destinations').addClass('active');
            $('#destination_add').addClass('active');

            $('#destinationAddForm')
                    .formValidation({
                        framework: 'bootstrap',
                        excluded: [':disabled'],
                        icon: {
                            valid: 'glyphicon glyphicon-ok',
                            invalid: 'glyphicon glyphicon-remove',
                            validating: 'glyphicon glyphicon-refresh'
                        },
                        fields: {

                            destination_type: {
                                validators: {
                                    notEmpty: {
                                        message: 'The destination type is not selected'
                                    }
                                }
                            },
                            heading: {
                                validators: {
                                    notEmpty: {
                                        message: 'The destination name is required'
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
                                    },

                                    callback: {
                                        message: 'The description must be more than 100 characters long',
                                        callback: function (value, validator, $field) {
                                            if (value === '') {
                                                return true;
                                            }
                                            // Get the plain text without HTML
                                            var div = $('<div/>').html(value).get(0),
                                                    text = div.textContent || div.innerText;

                                            return text.length > 100;
                                        }
                                    }
                                }
                            },

                            title: {
                                validators: {
                                    notEmpty: {
                                        message: 'The destination title is required'
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
                                    $('#destinationAddForm').formValidation('revalidateField', e.sender.name);
                                });
                    });


        });
    </script>
@endsection

@section('dynamicdata')

    <section class="content-header">
        <h1>
            Destinations
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('admin.destinations') }}">Destinations</a></li>
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
                        <h3 class="box-title">Add New Destination</h3>
                    </div>
                    <!-- /.box-header -->
                @include('layout.backend.alert')
                <!-- form start -->
                    <form role="form" id="destinationAddForm" name="destinationAddForm" action="" method="post"
                          enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group col-md-6">
                                <label for="exampleInputDestination">Destination Name *</label>
                                <input type="text" class="form-control" id="heading" name="heading"
                                       value="{{ old('heading') }}" placeholder="Enter destination name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputPackage">Type</label>
                                <select class="form-control" name="type">
                                    <option value="">Select Type</option>
                                   <
                                         <option value="inbound">For Foreigners</option>
                                         <option value="outbound">For Nepalese</option>
                                   
                                </select>
                            </div> 
                        </div>
                        <!-- /.box-body -->

                        <div class="box-body">
                            <div class="form-group col-md-12">
                                <label for="exampleInputDestination">Description *</label>
                                <textarea id="description" name="description" rows="10"
                                          cols="80">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group col-md-6">
                                <label for="exampleInputDestination">Destination Title *</label>
                                <input type="text" class="form-control" id="title" name="title"
                                       value="{{ old('title') }}" placeholder="Enter destination title">
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group col-md-12">
                                <label for="exampleInputDestination">Meta Tags</label>
                                <input type="text" class="form-control" id="meta_tags" name="meta_tags"
                                       value="{{ old('meta_tags') }}" placeholder="Enter meta tags">
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group col-md-12">
                                <label for="exampleInputDestination">Meta Description</label>
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
                            <div class="form-group col-md-6">
                                <label for="exampleInputDestination">Published</label>
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