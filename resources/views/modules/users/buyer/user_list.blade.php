@extends('layout.backend.containerlist')
@section('footer_js')
     <script type="text/javascript">
      $(document).ready(function(){
        $('.sidebar-menu li').removeClass('active');
        $('#buyer').addClass('active');
        $('#buyer_list').addClass('active');

        $('table tbody').sortable({
          update: function (event, ui) {
            var $object = $(this);
            var buyer = $(this).sortable('serialize');
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
              data: {buyer:buyer,_token:'{{ csrf_token() }}'},
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
          var buyerId = $object.attr('id');
          $.ajax({
            type: "POST",
            url: "#",
            data: {buyer_id: buyerId, _token: '{{ csrf_token() }}'},
            success: function(response){
              swal("Thank You!", response.message, "success")
              if(response.buyer.is_active == 1){
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
          var buyerId = $object.attr('id');
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
              url: "#",
              data: {buyer_id: buyerId, _token: '{{ csrf_token() }}'},
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

<section class="content-header">
      <h1>
        Buyer
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Buyer</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
               
              <a href="{{ route('admin.buyer.add') }}" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-plus"></span> Add Buyer</a>
             
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
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Tier</th>
                        <th>User Type</th>
                        <th>Publish</th>
                        <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($users as $index=>$user)
                     <tr id="users_{{ $user->id }}">
                  <td><i class="fa fa-arrows"></i></td>
                        
                      <td>{{ ++$index }}</td>
                     <td> {{ $user->first_name }}{{ $user->last_name }}</td>
                      <td>{{ $user->username }}</td>
                      <td>{{ $user->email }}</td>
                      <td>{{ $user->tier->tier_name ?? ""  }}</td>
                     <td>{{ $user->userType->user_type_name }}</td>
                           
                          <td>
                    @if($user->is_active == 1)
                      <a href="javascript:void(0)" class="change-status" id="{{ $user->id }}" title="Change Status"><i class="fa fa-check-square-o"></i></a>
                    @else
                      <a href="javascript:void(0)" class="change-status" id="{{ $user->id }}" title="Change Status"><i class="fa fa-minus-circle"></i></a>
                    @endif
                  </td>
                  <td>
                    <a href="{{ route('admin.buyer.edit', $user->id) }}"><i class="fa fa-fw fa-edit"></i>Edit</a>&nbsp;&nbsp;
                    <a href="javascript:void(0)" class="delete" id="{{ $user->id }}" title="Delete Record"><i class="fa  fa-trash-o"></i>Delete</a>
                  </td>
                </tr>
                    @endforeach

                            
                </tbody>
                <tfoot>
                 <tr>
                  <th></th>
                   <th>S N</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Email</th>
                         <th>Tier</th>
                        <th>User Type</th>
                        <th>Publish</th>
                        <th>Action</th>
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

