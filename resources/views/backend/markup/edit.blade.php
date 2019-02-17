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
           //alert(value);
           $.ajax({
                url:"{{ route('admin.markup.fetch') }}",
                method:"GET",
                data:{value:value},
                success:function(result)
                {
                  //alert(result);
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
                 <!-- <div class="form-group col-md-6">
                  <label for="exampleInputPackage">User Type *</label>
                  <select class="form-control dynamic" name="usertype_id" id ="usertype_id">
                    <option value="">Select User Type *</option>
                    @foreach($usertype as $u)
                    <option value="{{ $u->id }}" @if($u->id == $markup->usertype_id) selected="selected" @endif>{{ $u->user_type_name }}</option>
                    @endforeach
                  </select>
                </div>
                 <div class="form-group col-md-6">
                                <label for="exampleInputEmail2">User *</label>
                                <select class="form-control" name="user_id" id="user_id">
                                    <option value="">Select User </option>
                                    @foreach($user as $use)
                                        <option value="{{ $use->id }}"@if($use->id == $markup->user_id) selected="selected" @endif>{{ $use->first_name }}</option>
                                    @endforeach
                                </select>
                            </div> -->
                 <div class="form-group col-md-6">
                  <label for="exampleInputPackage">Tier Type *</label>
                  <select class="form-control" name="tier_id">
                    <option value="">Select Type *</option>
                    @foreach($tier as $t)
                    <option value="{{ $t->id }}" @if($t->id == $markup->tier_id) selected="selected" @endif>{{ $t->tier_name }}</option>
                    @endforeach
                  </select>
                </div>
                                
             
                                 
              </div>
               <div class="box-body">
                <div class="form-group col-md-6">
                  <label for="exampleInputmarkup">Bhutanese Markup *</label>
                  <input type="text" class="form-control" id="bhutanese_markup" name="bhutanese_markup" value="{{ $markup->bhutanese_markup }}" placeholder="Enter Bhutanese Markup">
                </div>                        
            
                <div class="form-group col-md-6">
                  
                    <label for="exampleInputPackage">Bhutanese Type *</label>
                  <select class="form-control" name="bhutanese_type">
                    <option value="0" <?php echo ($markup->bhutanese_type == '0')? 'selected="selected"' : '' ?> >Flat</option>
                    <option value="1" <?php echo (($markup->bhutanese_type == '1' || $markup->bhutanese_type == '')? 'selected="selected"' : '') ?> >Percent</option>
                  </select>
                 
                </div>                        
              </div>
               <div class="box-body">
                <div class="form-group col-md-6">
                  <label for="exampleInputmarkup">Saarc Markup*</label>
                  <input type="text" class="form-control" id="saarc_markup" name="saarc_markup" value="{{ $markup->saarc_markup }}" placeholder="Enter Saarc Markup">
                </div>                        
             
             
               <div class="form-group col-md-6">
                   <label for="exampleInputmarkup">Other Type*</label>
                  <select class="form-control" name="saarc_type">
                  
                     <option value="0" <?php echo ($markup->saarc_type == '0')? 'selected="selected"' : '' ?> >Flat</option>
                    <option value="1" <?php echo (($markup->saarc_type == '1' || $markup->saarc_type == '')? 'selected="selected"' : '') ?> >Percent</option>
                  </select>
                 
                </div>       
               <div class="box-body">
                <div class="form-group col-md-6">
                  <label for="exampleInputmarkup">Other Markup *</label>
                  <input type="text" class="form-control" id="other_markup" name="other_markup" value="{{ $markup->other_markup }}" placeholder="Enter Other Markup">
                </div>    
                    <div class="form-group col-md-6">
                   <label for="exampleInputmarkup">Other Type*</label>
                  <select class="form-control" name="other_type">
                  
                     <option value="0" <?php echo ($markup->other_type == '0')? 'selected="selected"' : '' ?> >Flat</option>
                    <option value="1" <?php echo (($markup->other_type == '1' || $markup->other_type == '')? 'selected="selected"' : '') ?> >Percent</option>
                  </select>
                 
                </div>                     
              
                                    
              </div>
              <!-- /.box-body -->
             

              <div class="box-body">
               <div class="form-group col-md-6">
                  <label for="exampleInputPackage">Published</label>
                  <select class="form-control" name="is_active">
                    <option value="0" <?php echo ($markup->is_active == '0')? 'selected="selected"' : '' ?> >No</option>
                    <option value="1" <?php echo (($markup->is_active == '1' || $markup->is_active == '')? 'selected="selected"' : '') ?> >Yes</option>
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