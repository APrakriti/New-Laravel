@extends('layout.backend.containerform')

@section('footer_js')
  <script>
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace( 'description',{
          filebrowserBrowseUrl : sitePath + 'backend/plugins/ckfinder/ckfinder.html',
          filebrowserImageBrowseUrl : sitePath + 'backend/plugins/ckfinder/ckfinder.html?type=Images',
          filebrowserFlashBrowseUrl : sitePath + 'backend/plugins/ckfinder/ckfinder.html?type=Flash',
          filebrowserUploadUrl : sitePath + 'backend/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
          filebrowserImageUploadUrl : sitePath + 'backend/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
          filebrowserFlashUploadUrl : sitePath + 'backend/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
          filebrowserWindowWidth : '1000',
          filebrowserWindowHeight : '700'
        });
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
      });
      $(function () {
        CKEDITOR.replace( 'itineraries',{
          filebrowserBrowseUrl : "{{ asset('backend/plugins/ckfinder/ckfinder.html') }}",
          filebrowserImageBrowseUrl : "{{ asset('backend/plugins/ckfinder/ckfinder.html?type=Images') }}",
          filebrowserFlashBrowseUrl : "{{ asset('backend/plugins/ckfinder/ckfinder.html?type=Flash') }}",
          filebrowserUploadUrl : "{{ asset('backend/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
          filebrowserImageUploadUrl : "{{ asset('backend/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
          filebrowserFlashUploadUrl : "{{ asset('backend/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}",
          filebrowserWindowWidth : '1000',
          filebrowserWindowHeight : '700'
        });
        $(".itineraries").wysihtml5();
      });
      $(function () {
        CKEDITOR.replace( 'includes',{
          filebrowserBrowseUrl : "{{ asset('backend/plugins/ckfinder/ckfinder.html') }}",
          filebrowserImageBrowseUrl : "{{ asset('backend/plugins/ckfinder/ckfinder.html?type=Images') }}",
          filebrowserFlashBrowseUrl : "{{ asset('backend/plugins/ckfinder/ckfinder.html?type=Flash') }}",
          filebrowserUploadUrl : "{{ asset('backend/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
          filebrowserImageUploadUrl : "{{ asset('backend/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
          filebrowserFlashUploadUrl : "{{ asset('backend/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}",
          filebrowserWindowWidth : '1000',
          filebrowserWindowHeight : '700'
        });
        $(".textarea").wysihtml5();
      });
      $(function () {
        CKEDITOR.replace( 'hotel_information',{
          filebrowserBrowseUrl : "{{ asset('backend/plugins/ckfinder/ckfinder.html') }}",
          filebrowserImageBrowseUrl : "{{ asset('backend/plugins/ckfinder/ckfinder.html?type=Images') }}",
          filebrowserFlashBrowseUrl : "{{ asset('backend/plugins/ckfinder/ckfinder.html?type=Flash') }}",
          filebrowserUploadUrl : "{{ asset('backend/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
          filebrowserImageUploadUrl : "{{ asset('backend/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
          filebrowserFlashUploadUrl : "{{ asset('backend/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}",
          filebrowserWindowWidth : '1000',
          filebrowserWindowHeight : '700'
        });
        $(".textarea").wysihtml5();
      });
      $(function () {
        CKEDITOR.replace( 'excludes',{
          filebrowserBrowseUrl : "{{ asset('backend/plugins/ckfinder/ckfinder.html') }}",
          filebrowserImageBrowseUrl : "{{ asset('backend/plugins/ckfinder/ckfinder.html?type=Images') }}",
          filebrowserFlashBrowseUrl : "{{ asset('backend/plugins/ckfinder/ckfinder.html?type=Flash') }}",
          filebrowserUploadUrl : "{{ asset('backend/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
          filebrowserImageUploadUrl : "{{ asset('backend/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
          filebrowserFlashUploadUrl : "{{ asset('backend/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}",
          filebrowserWindowWidth : '1000',
          filebrowserWindowHeight : '700'
        });
        $(".textarea").wysihtml5();
      });

    function readURLL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          $('#upload-preview-banner').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }

  $(document).ready(function() {
    $('.sidebar-menu li').removeClass('active');
    $('#packages').addClass('active');
    $("#banner_attachment").change(function(){
        readURLL(this);
    });
    $('#packageEditForm').formValidation({
        framework: 'bootstrap',
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
            flight_details: {
                validators: {
                    notEmpty: {
                        message: 'The flight is not selected.'
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
                    validators: {
                        notEmpty: {
                            message: 'The description is required.'
                        },
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
                  file: {
                      extension: 'jpeg,jpg,png',
                      type: 'image/jpeg,image/png',
                      maxSize: 1048576,   // 1024 * 1024
                      message: 'The selected file is not valid.'
                  }
              }
            },
            googlemap_attachment: {
              validators: {
                  file: {
                      extension: 'jpeg,jpg,png',
                      type: 'image/jpeg,image/png',
                      maxSize: 1048576,   // 1024 * 1024
                      message: 'The selected file is not valid.'
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
        Packages
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.packages') }}">Packages</a></li>
        <li class="active">Edit Package</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">
              <a href="{{ route('admin.package.galleries', $package->id) }}" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-hand-up"></span> View Gallery</a>
              </h3>
            </div>
            <div class="box-header with-border">
              <h3 class="box-title">Edit Package : {!! $package->heading !!}</h3>
            </div>
            <!-- /.box-header -->
            @include('layout.backend.alert')
            <!-- form start -->
            <form role="form" id="packageEditForm" name="packageEditForm" action="" method="post" enctype="multipart/form-data">
              <div class="box-body">                
                <div class="form-group col-md-6">
                  <label for="exampleInputPackage">Package Name *</label>
                  <input type="text" class="form-control" id="heading" name="heading" value="{{ $package->heading }}" placeholder="Enter package name">
                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputPackage">Flight</label>
                  <select class="form-control select2" multiple="multiple" name="flight_details[]" data-placeholder="Select a Flight"
                        style="width: 100%;">
                 
                    <option value="">Select Flight</option>
                    @foreach($flight as $f)
                    <option value ="{{ $f->id }}" @if($f->id == $package->flight_details) selected="selected" @endif>{{ $f->flight_no }}</option>
                    @endforeach
                  </select>
                </div> 
               
                 
              </div>

              <!-- /.box-body -->

              <div class="box-body"> 
                <div class="form-group col-md-6">
                  <label for="exampleInputPackage">Activity</label>
                  <select class="form-control" name="activity_id">
                    <option value="">Select Activity</option>
                    @foreach($activities as $activity)
                    <option value="{{ $activity->id }}" @if($activity->id == $package->activity_id) selected="selected" @endif>{{ $activity->heading }}</option>
                    @endforeach
                  </select>
                </div> 
                <div class="form-group col-md-6">
                  <label for="exampleInputPackage">Destination</label>
                  <select class="form-control" name="destination_id">
                    <option value="">Select Destination</option>
                    @foreach($destinations as $destination)
                    <option value="{{ $destination->id }}" @if($destination->id == $package->destination_id) selected="selected" @endif>{{ $destination->heading }}</option>
                    @endforeach
                  </select>
                </div>                          
              </div>              

              <div class="box-body">
                <div class="form-group col-md-12">
                  <label for="exampleInputPackage">Description *</label>
                  <textarea id="description" name="description" rows="10" cols="80">{!! $package->description !!}</textarea>
                  </div>                               
              </div>

              <div class="box-body">
                <div class="form-group col-md-12">
                  <label for="exampleInputPackage">Itineraries *</label>
                  <textarea id="itineraries" name="itineraries" rows="10" cols="80">{!! $package->itineraries !!}</textarea>
                  </div>                               
              </div>

              <div class="box-body">
                <div class="form-group col-md-12">
                  <label for="exampleInputPackage">Includes</label>
                  <textarea id="includes" name="includes" rows="10" cols="80">{!! $package->includes !!}</textarea>
                  </div>                               
              </div>

              <div class="box-body">
                <div class="form-group col-md-12">
                  <label for="exampleInputPackage">Excludes</label>
                  <textarea id="excludes" name="excludes" rows="10" cols="80">{!! $package->excludes !!}</textarea>
                  </div>                               
              </div>
               <div class="box-body">
                <div class="form-group col-md-12">
                  <label for="exampleInputPackage">Hotel Information</label>
                  <textarea id="hotel_information" name="hotel_information" rows="10" cols="80">{!! $package->hotel_information !!}</textarea>
                  </div>                               
              </div>


              <div class="box-body">
                <div class="form-group col-md-6">
                  <label for="exampleInputPackage">Package Title *</label>
                  <input type="text" class="form-control" id="title" name="title" value="{{ $package->title }}" placeholder="Enter package title">
                </div>                               
              </div>

              <div class="box-body">
                <div class="form-group col-md-6">
                  <label for="exampleInputPackage">Meta Tags</label>
                  <input type="text" class="form-control" id="meta_tags" name="meta_tags" value="{{ $package->meta_tags }}" placeholder="Enter meta tags">
                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputPackage">Meta Description</label>
                  <input type="text" class="form-control" id="meta_description" name="meta_description" value="{{ $package->meta_description }}" placeholder="Enter meta description">
                </div>                               
              </div>

              <div class="box-body">
                <div class="form-group col-md-6">
                  <label for="exampleInputPackage">Trip Duration (In days)</label>
                  <input type="number" class="form-control" id="trip_duration" name="trip_duration" value="{{ $package->trip_duration }}" placeholder="Enter trip duration">
                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputPackage">Group Size </label>
                  <input type="number" class="form-control" id="group_size" name="group_size" value="{{ $package->group_size }}" placeholder="Enter group size">
                </div>                               
              </div>

              <div class="box-body">
                <div class="form-group col-md-6">
                  <label for="exampleInputPackage">Maximum Altitude (In meter)</label>
                  <input type="number" class="form-control" id="maximum_altitude" name="maximum_altitude" value="{{ $package->maximum_altitude }}" placeholder="Enter maximum altitude">
                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputPackage">Team Leader </label>
                  <input type="text" class="form-control" id="team_leader" name="team_leader" value="{{ $package->team_leader }}" placeholder="Enter team leader">
                </div>                               
              </div>

              <div class="box-body">
                <div class="form-group col-md-6">
                  <label for="exampleInputPackage">Trip Season</label>
                  <input type="text" class="form-control" id="trip_season" name="trip_season" value="{{ $package->trip_season }}" placeholder="Enter trip season">
                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputPackage">Accommodation </label>
                  <input type="text" class="form-control" id="accommodation" name="accommodation" value="{{ $package->accommodation }}" placeholder="Enter Accommodation">
                </div>                               
              </div>

              <!-- <div class="box-body">
                <div class="form-group col-md-6">
                  <label for="exampleInputPackage">Previous Price</label>
                  <input type="number" class="form-control" id="previous_price" name="previous_price" value="{{ $package->previous_price }}" placeholder="Enter Previous price">
                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputPackage">Starting Price </label>
                  <input type="number" class="form-control" id="starting_price" name="starting_price" value="{{ $package->starting_price }}" placeholder="Enter starting price">
                </div>                               
              </div> -->
              
                <div class="box-body">
                <div class="form-group col-md-4">
                  <label for="exampleInputPackage">Bhutan Price</label>
                  <input type="number" class="form-control" id="bhutan_price" name="bhutan_price" value="{{ $package->bhutan_price }}" placeholder="Enter Previous price">
                </div>
                <div class="form-group col-md-4">
                  <label for="exampleInputPackage">SAARC Price </label>
                  <input type="number" class="form-control" id="saarc_price" name="saarc_price" value="{{ $package->saarc_price }}" placeholder="Enter starting price">
                </div>  
                  <div class="form-group col-md-4">
                  <label for="exampleInputPackage">Other country Price </label>
                  <input type="number" class="form-control" id="other_price" name="other_price" value="{{ $package->other_price }}" placeholder="Enter starting price">
                </div>                              
              </div>

              <div class="box-body">
                <div class="form-group col-md-6">
                  <label for="exampleInputPackage">Start From</label>
                  <input type="text" class="form-control" id="start" name="start" value="{{ $package->start }}" placeholder="Enter start location">
                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputPackage">End To </label>
                  <input type="text" class="form-control" id="end" name="end" value="{{ $package->end }}" placeholder="Enter end location">
                </div>                               
              </div>

              <div class="box-body">
                <div class="form-group col-md-12">
                  <label for="exampleInputBanner">Banner Attachment *</label>
                  <div class="fileupload-new thumbnail" >
                    @if(file_exists('uploads/packages/'.$package->banner_attachment) && $package->banner_attachment!='')
                    <img src="{{ asset('uploads/packages/'.$package->banner_attachment) }}" alt="" id="upload-preview-banner" />
                    @else
                    <img src="{{ asset('uploads/noimage.jpg') }}" alt="" id="upload-preview-banner" />
                    @endif
                  </div>
                  <input type="file" name="banner_attachment" id="banner_attachment">
                  <p class="help-block">Valid file extensions are jpeg,jpg and png.</p>
                  <p>Maximum file size 1024 * 1024</p>
                  </div>                               
              </div>

              <div class="box-body">
                <div class="form-group col-md-12">
                  <label for="exampleInputBanner">Google Map *</label>
                  <div class="fileupload-new thumbnail" >
                    @if(file_exists('uploads/packages/'.$package->googlemap_attachment) && $package->googlemap_attachment!='')
                    <img src="{{ asset('uploads/packages/'.$package->googlemap_attachment) }}" alt="" id="upload-preview" />
                    @else
                    <img src="{{ asset('uploads/noimage.jpg') }}" alt="" id="upload-preview" />
                    @endif
                  </div>
                  <input type="file" name="googlemap_attachment" id="attachment">
                  <p class="help-block">Valid file extensions are jpeg,jpg and png.</p>
                  <p>Maximum file size 1024 * 1024</p>
                  </div>                               
              </div>         

              <div class="box-body">
                <div class="form-group col-md-6">
                  <label for="exampleInputPackage">Cultural Tour</label>
                  <select class="form-control" name="last_minute_deal">
                    <option value="0" <?php echo ($package->last_minute_deal == '0')? 'selected="selected"' : '' ?> >No</option>
                    <option value="1" <?php echo (($package->last_minute_deal == '1' || $package->last_minute_deal == '')? 'selected="selected"' : '') ?> >Yes</option>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputPackage">Published</label>
                  <select class="form-control" name="is_active">
                    <option value="0" <?php echo ($package->is_active == '0')? 'selected="selected"' : '' ?> >No</option>
                    <option value="1" <?php echo (($package->is_active == '1' || $package->is_active == '')? 'selected="selected"' : '') ?> >Yes</option>
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