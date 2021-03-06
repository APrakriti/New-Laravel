@extends('layout.backend.containerform')

@section('footer_js')
  <script>
  $(document).ready(function() {
    $('.sidebar-menu li').removeClass('active');
    $('#markups').addClass('active');
    $('#markup_add').addClass('active');
    $('.dynamic').change(function() {
      if($(this).val() != '') {
           var value = $(this).val();
          // alert(value);
           $.ajax({
                url:"{{ route('admin.markup.fetch') }}",
                method:"GET",
                data:{value:value},
                success:function(result)
                {
                  
                 $('#user_id').html(result);
                }
           })
      }
 });

    $('#markupAddForm').formValidation({
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
                        message: 'The markup name is required.'
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
        Markup
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.markups') }}">Markup</a></li>
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
              <h3 class="box-title">Add New Markup</h3>
            </div>
            <!-- /.box-header -->
            @include('layout.backend.alert')
            <!-- form start -->
            <form role="form" id="markupAddForm" name="markupAddForm" action="" method="post" enctype="multipart/form-data">
              <div class="box-body">
             <!--     <div class="form-group col-md-6">
                                <label for="exampleInputEmail2">User Type *</label>
                                <select class="form-control dynamic" name="usertype_id" id="usertype_id">
                                    <option value="">Select User Type</option>
                                    @foreach($userType as $u)
                                        <option value="{{ $u->id }}">{{ $u->user_type_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail2">User *</label>
                                <select class="form-control" name="user_id" id="user_id">
                                    <option value="">Select User </option>
                                    @foreach($user as $use)
                                        <option value="{{ $use->id }}">{{ $use->first_name }}</option>
                                    @endforeach
                                </select>
                            </div> -->
                             <div class="form-group col-md-6">
                                <label for="exampleInputEmail2">Tier *</label>
                                <select class="form-control" name="tier_id" id="tier_id">
                                    <option value="">Select Tier </option>
                                    @foreach($tier as $t)
                                        <option value="{{ $t->id }}">{{ $t->tier_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                                        
              </div>
               <div class="box-body">
                <div class="form-group col-md-6">
                  <label for="exampleInputmarkup">Bhutanese Markup *</label>
                  <input type="text" class="form-control" id="bhutanese_markup" name="bhutanese_markup" value="{{ old('bhutanese_markup') }}" placeholder="Enter Bhutanese Markup">
                </div>                        
            
                <div class="form-group col-md-6">
                   <label for="exampleInputmarkup">Bhutanese Type *</label>
                  <select class="form-control" name="bhutanese_type">
                  
                    <option value="0">Flat</option>
                      <option value="1">Percent</option>
                  </select>
                 
                </div>                        
              </div>
               <div class="box-body">
                <div class="form-group col-md-6">
                  <label for="exampleInputmarkup">Saarc Markup*</label>
                  <input type="text" class="form-control" id="saarc_markup" name="saarc_markup" value="{{ old('saarc_markup') }}" placeholder="Enter Saarc Markup">
                </div>                        
             
             
                 <div class="form-group col-md-6">
                   <label for="exampleInputmarkup">Saarce Type *</label>
                  <select class="form-control" name="saarc_type">
                  
                    <option value="0">Flat</option>
                      <option value="1">Percent</option>
                  </select>
                 
                </div>                         
              </div>
               <div class="box-body">
                <div class="form-group col-md-6">
                  <label for="exampleInputmarkup">Other Markup *</label>
                  <input type="text" class="form-control" id="other_markup" name="other_markup" value="{{ old('other_markup') }}" placeholder="Enter Other Markup">
                </div>    
                    <div class="form-group col-md-6">
                   <label for="exampleInputmarkup">Other Type*</label>
                  <select class="form-control" name="other_type">
                  
                    <option value="0">Flat</option>
                      <option value="1">Percent</option>
                  </select>
                 
                </div>                     
              
                                    
              </div>
              <!-- /.box-body -->
             

              <div class="box-body">
                <div class="form-group col-md-6">
                  <label for="exampleInputmarkup">Published</label>
                  <select class="form-control" name="is_active">
                  
                    <option value="1">Yes</option>
                      <option value="0">No</option>
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