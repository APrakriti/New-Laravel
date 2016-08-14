@extends('layout.backend.containerform')

@section('footer_js')
    <script>

        $(document).ready(function () {
            $('.sidebar-menu li').removeClass('active');
            $('#activities').addClass('active');

            $('.delete-attachment').click(function () {
                $object = $(this);
                var activityId = $object.attr('id');
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this record!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                }, function () {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.activity.delete.attachment') }}",
                        data: {activity_id: activityId, _token: '{{ csrf_token() }}'},
                        success: function (response) {
                            $object.hide();
                            $('.fileupload-new img').attr('src', "{{ asset('uploads/noimage.jpg')}}");
                            swal("Deleted!", response.message, "success");
                        },
                        error: function (e) {

                        }
                    });
                });
            });


            $('#activityEditForm')
                    .formValidation({
                        framework: 'bootstrap',
                        excluded: [':disabled'],
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
                                        message: 'The summary must be more than 100 characters long',
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
                                        message: 'The activity title is required'
                                    }
                                }
                            },

                            attachment: {
                                validators: {
//                                    notEmpty: {
//                                        message: 'The attachment is required'
//                                    },
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
                                    $('#activityEditForm').formValidation('revalidateField', e.sender.name);
                                });
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
            <li class="active">Edit Activity</li>
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
                        <h3 class="box-title">Edit Activity : {!! $activity->heading !!}</h3>
                    </div>
                    <!-- /.box-header -->
                @include('layout.backend.alert')
                <!-- form start -->
                    <form role="form" id="activityEditForm" name="activityEditForm" action="" method="post"
                          enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group col-md-6">
                                <label for="exampleInputActivity">Activity Name *</label>
                                <input type="text" class="form-control" id="heading" name="heading"
                                       value="{{ $activity->heading }}" placeholder="Enter activity name">
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-body">
                            <div class="form-group col-md-12">
                                <label for="exampleInputActivity">Description *</label>
                                <textarea id="description" name="description" rows="10"
                                          cols="80">{!! $activity->description !!}</textarea>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group col-md-6">
                                <label for="exampleInputActivity">Activity Title *</label>
                                <input type="text" class="form-control" id="title" name="title"
                                       value="{{ $activity->title }}" placeholder="Enter activity title">
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group col-md-12">
                                <label for="exampleInputActivity">Meta Tags</label>
                                <input type="text" class="form-control" id="meta_tags" name="meta_tags"
                                       value="{{ $activity->meta_tags }}" placeholder="Enter meta tags">
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group col-md-12">
                                <label for="exampleInputActivity">Meta Description</label>
                                <input type="text" class="form-control" id="meta_description" name="meta_description"
                                       value="{{ $activity->meta_description }}" placeholder="Enter meta description">
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group col-md-12">
                                <label for="exampleInputBanner">Attachment *</label>
                                <div class="fileupload-new thumbnail">
                                    @if(file_exists('uploads/activities/'.$activity->attachment) && $activity->attachment!='')
                                        <img src="{{ asset('uploads/activities/'.$activity->attachment) }}" alt=""
                                             id="upload-preview">
                                    @else
                                        <img src="{{ asset('uploads/noimage.jpg') }}" alt="" id="upload-preview">
                                    @endif
                                </div>
                                <input type="file" name="attachment" id="attachment">
                                <p class="help-block">Valid file extensions are jpeg,jpg and png.</p>
                            </div>
                            @if(file_exists('uploads/activities/'.$activity->attachment) && $activity->attachment!='')
                                <a href="javascript:void(0)" class="delete-attachment" id="{{ $activity->id }}">Delete
                                    Attachment</a>
                            @endif
                        </div>

                        <div class="box-body">
                            <div class="form-group col-md-6">
                                <label for="exampleInputActivity">Published</label>
                                <select class="form-control" name="is_active">
                                    <option value="0" <?php echo ($activity->is_active == '0') ? 'selected="selected"' : '' ?> >
                                        No
                                    </option>
                                    <option value="1" <?php echo(($activity->is_active == '1' || $activity->is_active == '') ? 'selected="selected"' : '') ?> >
                                        Yes
                                    </option>
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