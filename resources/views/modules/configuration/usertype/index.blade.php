@extends('layout.backend.containerlist')
@section('footer_js')
    <script type="text/javascript">
      $(document).ready(function(){
        $('.sidebar-menu li').removeClass('active');
        $('#usertypes').addClass('active');
        $('#usertype_list').addClass('active');

        $('table tbody').sortable({
          update: function (event, ui) {
            var $object = $(this);
            var usertypes = $(this).sortable('serialize');
            var count = parseInt($object.children().first().children('td:nth-child(2)').html());
            $object.children('tr').each(function() {              
              var sn = parseInt($(this).children('td:nth-child(2)').html());
              if(sn < count){
                count = sn;
              }
            });
            $object.children('tr').each(function() {              
              $(this).children('td:nth-child(2)').html(count);
              count++;
            });
            $.ajax({
              type: "POST",
              url: "#",
              data: {usertypes:usertypes,_token:'{{ csrf_token() }}'},
              success: function(response){
                swal("Thank You!", response.message, "success")
              },
              error: function(error){
                swal("OOPS!", error.message, "error")
              }
            });
          }
        });

        $("#example1").on("click", ".change-status", function(){
          $object = $(this);
          var usertypeId = $object.attr('id');
          $.ajax({
            type: "POST",
            url: "{{ route('admin.usertype.publish') }}",
            data: {usertype_id: usertypeId, _token: '{{ csrf_token() }}'},
            success: function(response){
              swal("Thank You!", response.message, "success")
              if(response.usertype.is_active == '1'){
                $($object).children().removeClass('fa-minus-circle');
                $($object).children().addClass('fa-check-square-o');
              } else {
                $($object).children().removeClass('fa-check-square-o');
                $($object).children().addClass('fa-minus-circle');
              }
            },
           error: function(e){
            }
          });
        });

        $("#example1").on("click", ".delete", function(){
          $object = $(this);
          var usertypeId = $object.attr('id');
          swal({

            title: "Are you sure?",
            text: "You will not be able to recover this record!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
          }, function(){


            $.ajax({

              type: "POST",
              url: "{{ route('admin.usertype.delete') }}",
              data: {usertype_id: usertypeId, _token: '{{ csrf_token() }}'},

              success: function(response){
                swal("Deleted!", response.message, "success");
                var oTable = $('#example1').dataTable();
                var nRow = $($object).parents('tr')[0];
                oTable.fnDeleteRow(nRow);
              },
              error: function(e){
                
              }
            });
          });
        });
      
      });
    </script>
  @endsection
@section('dynamicdata')
  <?php $success = Session::get('success'); ?>
            @if($success)
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    {{ $success }}
                </div>
            @endif

<section class="content-header">
      <h1>
        UserType
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">UserType</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
              <a href="{{ route('admin.usertype.add') }}" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-plus"></span> Add UserType</a>
              </h3>
            </div>
            <!-- /.box-header -->
            @include('layout.backend.alert')
            <!-- table start -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th></th>
                   <th>S N</th>
                        <th>User Type</th>
                        @if(Access::hasAccess('user-type', 'access_publish'))
                            <th>Published</th>
                        @endif
                        @if(Access::hasAccess('user-type', 'access_delete') || Access::hasAccess('user-type', 'access_update'))
                            <th>Action</th>
                        @endif
                </tr>
                </thead>
                <tbody>
                    @foreach($user_types as $index=>$user_type)
                     <tr id="usertype_{{ $user_type->id }}">
                  <td><i class="fa fa-arrows"></i></td>
                        
                            <td>{{ ++$index }}</td>
                     <td> <a href="{{ route('admin.users.type.index',[$user_type->id]) }}">  {{ $user_type->user_type_name }}</a></td>
                           
                                <td>
                                    @if($user_type->editable == 1)
                                        @if($user_type->is_active == 1)
                                            <a href="#" class="change-status" id="{!! $user_type->id !!}"><i
                                                        class="zmdi zmdi-check-circle zmdi-hc-fw"></i></a>
                                        @else
                                            <a href="#" class="change-status" id="{!! $user_type->id !!}"><i
                                                        class="zmdi zmdi-lock zmdi-hc-fw"></i></a>
                                        @endif
                                    @endif
                                </td>
                          
                            <td>
                               
                                    @if($user_type->editable == 1)
                                       
                                            <a href="{{ route('admin.usertype.edit', $user_type->id) }}"><i
                                                        class="zmdi zmdi-edit zmdi-hc-fw"></i>Edit </a>
                                     
                                         <a href="javascript:void(0)" class="delete" id="{{ $user_type->id }}" title="Delete Record"><i class="fa  fa-trash-o"></i>Delete</a>
                                       
                                        <a href="{{ route('admin.accesslist', $user_type->id) }}"><i
                                                    class="zmdi zmdi-eye zmdi-hc-fw"></i>View Access List</a>
                                  @endif
                            </td>
                        </tr>
                    @endforeach

                            
                </tbody>
                <tfoot>
                 <tr>
                  <th></th>
                   <th>S N</th>
                        <th>User Type</th>
                        @if(Access::hasAccess('user-type', 'access_publish'))
                            <th>Published</th>
                        @endif
                        @if(Access::hasAccess('user-type', 'access_delete') || Access::hasAccess('user-type', 'access_update'))
                            <th>Action</th>
                        @endif
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

@stop
