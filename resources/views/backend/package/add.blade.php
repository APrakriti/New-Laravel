@extends('layout.backend.containerform')

@section('footer_js')
    <script>

        function readURLL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#upload-preview-banner').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).ready(function () {
            
$('.dynamic').change(function() {
      if($(this).val() != '') {
           var value = $(this).val();
           //alert(value);
           $.ajax({
                url:"{{ route('admin.package.fetch') }}",
                method:"GET",
                data:{value:value},
                success:function(result)
                {
                  //alert(result);
                 $('#destination_id').html(result);
                }
           })
      }
 });


            $('.sidebar-menu li').removeClass('active');
            $('#packages').addClass('active');
            $('#package_add').addClass('active');

            $("#banner_attachment").change(function () {
                readURLL(this);
            });

            $(".is_fix_departure").change(function () {
                if (this.checked && this.value === "1") {
                    $("#fix_departure").show();
                } else {
                    $("#fix_departure").hide();
                }
            });


            $('#packageAddForm')
                    .formValidation({
                        framework: 'bootstrap',
                        excluded: [':disabled'],
                        icon: {
                            valid: 'glyphicon glyphicon-ok',
                            invalid: 'glyphicon glyphicon-remove',
                            validating: 'glyphicon glyphicon-refresh'
                        },
                        fields: {

                            activity_id: {
                                validators: {
                                    notEmpty: {
                                        message: 'The activity is not selected.'
                                    }
                                }
                            },
                            destination_id: {
                                validators: {
                                    notEmpty: {
                                        message: 'The destination is not selected.'
                                    }
                                }
                            },
                            heading: {
                                validators: {
                                    notEmpty: {
                                        message: 'The package name is required.'
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

                            itineraries: {
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
                                        message: 'The itineraries is required and cannot be empty'
                                    },

                                    callback: {
                                        message: 'The itineraries must be more than 100 characters long',
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
                                        message: 'The package title is required.'
                                    }
                                }
                            },
                            trip_duration: {
                                validators: {
                                    notEmpty: {
                                        message: 'The duration is required.'
                                    }
                                }
                            },
                            starting_price: {
                                validators: {
                                    notEmpty: {
                                        message: 'The starting price is required.'
                                    }
                                }
                            },

                            banner_attachment: {
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

                            googlemap_attachment: {
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
                    })
                    .find('[name="description"],[name="itineraries"],[name="includes"],[name="excludes"]')
                    .each(function () {
                        $(this)
                                .ckeditor()
                                .editor
                                .on('change', function (e) {
                                    $('#packageAddForm').formValidation('revalidateField', e.sender.name);
                                });
                    });
        });
    </script>
@endsection

@section('dynamicdata')

    <section class="content-header">
        <h1>
            Packages
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('admin.packages') }}">Packages</a></li>
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
                        <h3 class="box-title">Add New Package</h3>
                    </div>
                    <!-- /.box-header -->
                @include('layout.backend.alert')
                <!-- form start -->
                    <form role="form" id="packageAddForm" name="packageAddForm" action="" method="post"
                          enctype="multipart/form-data">
                         <!--  <li> <a href="#">Inbound</a> </li>
                       <li>  <a href="#">Outbound</a></li> -->

                        <div class="box-body">
                            <div class="form-group col-md-6">
                                <label for="exampleInputPackage">Package Name *</label>
                                <input type="text" class="form-control" id="heading" name="heading"
                                       value="{{ old('heading') }}" placeholder="Enter package name">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="exampleInputPackage">Is Fix Departure ?</label><br>
                                <label class="radio-inline"><input type="radio" class="is_fix_departure"
                                                                   name="is_fix_departure" value="0" checked>No</label>
                                <label class="radio-inline"><input type="radio" class="is_fix_departure"
                                                                   name="is_fix_departure" value="1"
                                                                   id="yes">Yes</label>
                            </div>
                            <div class="form-group col-md-4" id="fix_departure" style="display:none;">
                                <label for="exampleInputPackage">Fix Departure</label>
                                <input type="text" class="form-control" id="fix_departure" name="fix_departure"
                                       value="{{ old('fix_departure') }}" placeholder="Enter fix departure">
                            </div>

                        </div>
                         
                          
                        <!-- /.box-body -->
                            <div class="form-group col-md-6">
                                <label for="exampleInputPackage">Activity</label>
                                <select class="form-control" name="activity_id">
                                    <option value="">Select Activity</option>
                                    @foreach($activities as $activity)
                                        <option value="{{ $activity->id }}">{{ $activity->heading }}</option>
                                    @endforeach
                                </select>
                            </div>
                              <div class="box-body">
                            <div class="form-group col-md-6">
                                <label for="exampleInputPackage">Type</label>
                                <select class="form-control dynamic" name="type">
                                    <option value="">Select Type</option>
                                         <option value="inbound">For Foreigners</option>
                                         <option value="outbound">For Nepalese</option>
                                   
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputPackage">Destination</label>
                                <select class="form-control" name="destination_id" id="destination_id">
                                    <option value="">Select Destination</option>
                                    @foreach($destinations as $destination)
                                        <option value="{{ $destination->id }}">{{ $destination->heading }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group col-md-12">
                                <label for="exampleInputPackage">Description *</label>
                                <textarea id="description" name="description" rows="10"
                                          cols="80">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group col-md-12">
                                <label for="exampleInputPackage">Itineraries *</label>
                                <textarea id="itineraries" name="itineraries" rows="10"
                                          cols="80">{{ old('itineraries') }}</textarea>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group col-md-12">
                                <label for="exampleInputPackage">Includes</label>
                                <textarea id="includes" name="includes" rows="10"
                                          cols="80">{{ old('includes') }}</textarea>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group col-md-12">
                                <label for="exampleInputPackage">Excludes</label>
                                <textarea id="excludes" name="excludes" rows="10"
                                          cols="80">{{ old('excludes') }}</textarea>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group col-md-6">
                                <label for="exampleInputPackage">Package Title *</label>
                                <input type="text" class="form-control" id="title" name="title"
                                       value="{{ old('title') }}" placeholder="Enter package title">
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group col-md-6">
                                <label for="exampleInputPackage">Meta Tags</label>
                                <input type="text" class="form-control" id="meta_tags" name="meta_tags"
                                       value="{{ old('meta_tags') }}" placeholder="Enter meta tags">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputPackage">Meta Description</label>
                                <input type="text" class="form-control" id="meta_description" name="meta_description"
                                       value="{{ old('meta_description') }}" placeholder="Enter meta description">
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group col-md-6">
                                <label for="exampleInputPackage">Trip Duration (In days)</label>
                                <input type="number" class="form-control" id="trip_duration" name="trip_duration"
                                       value="{{ old('trip_duration') }}" placeholder="Enter trip duration">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputPackage">Group Size </label>
                                <input type="number" class="form-control" id="group_size" name="group_size"
                                       value="{{ old('group_size') }}" placeholder="Enter group size">
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group col-md-6">
                                <label for="exampleInputPackage">Maximum Altitude (In meter)</label>
                                <input type="number" class="form-control" id="maximum_altitude" name="maximum_altitude"
                                       value="{{ old('maximum_altitude') }}" placeholder="Enter maximum altitude">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputPackage">Team Leader </label>
                                <input type="text" class="form-control" id="team_leader" name="team_leader"
                                       value="{{ old('team_leader') }}" placeholder="Enter team leader">
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group col-md-6">
                                <label for="exampleInputPackage">Trip Season</label>
                                <input type="text" class="form-control" id="trip_season" name="trip_season"
                                       value="{{ old('trip_season') }}" placeholder="Enter trip season">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputPackage">Accommodation </label>
                                <input type="text" class="form-control" id="accommodation" name="accommodation"
                                       value="{{ old('accommodation') }}" placeholder="Enter Accommodation">
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group col-md-4">
                                <label for="exampleInputPackage">Currency Type *</label>
                            <input type="text" class="form-control" id="currency" name="currency"
                                 value="{{ old('currency') }}" placeholder="Enter Currency Type">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleInputPackage">Previous Price</label>
                                <input type="number" class="form-control" id="previous_price" name="previous_price"
                                       value="{{ old('previous_price') }}" placeholder="Enter Previous price">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleInputPackage">Starting Price *</label>
                                <input type="number" class="form-control" id="starting_price" name="starting_price"
                                       value="{{ old('starting_price') }}" placeholder="Enter starting price">
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group col-md-6">
                                <label for="exampleInputPackage">Start From</label>
                                <input type="text" class="form-control" id="start" name="start"
                                       value="{{ old('start') }}" placeholder="Enter start location">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputPackage">End To </label>
                                <input type="text" class="form-control" id="end" name="end" value="{{ old('end') }}"
                                       placeholder="Enter end location">
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group col-md-12">
                                <label for="exampleInputBanner">Banner Attachment *</label>
                                <div class="fileupload-new thumbnail">
                                    <img src="{{ asset('uploads/packages') }}" alt="" id="upload-preview-banner"/>
                                </div>
                                <input type="file" name="banner_attachment" id="banner_attachment">
                                <p class="help-block">Valid file extensions are jpeg,jpg and png.</p>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group col-md-12">
                                <label for="exampleInputBanner">Google Map </label>
                                <div class="fileupload-new thumbnail">
                                    <img src="{{ asset('uploads/noimage.jpg') }}" alt="" id="upload-preview"/>
                                </div>
                                <input type="file" name="googlemap_attachment" id="attachment">
                                <p class="help-block">Valid file extensions are jpeg,jpg and png.</p>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group col-md-6">
                                <label for="exampleInputPackage">Last Minute Deal</label>
                                <select class="form-control" name="last_minute_deal">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputPackage">Published</label>
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
@stop



