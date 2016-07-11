@extends('layout.backend.containerlist')

@section('footer_js')
    <script type="text/javascript">
      $(document).ready(function(){
        $('.sidebar-menu li').removeClass('active');
        $('#roles').addClass('active');
        $('#role_list').addClass('active');

        $('.delete').click(function(){
          $object = $(this);
          var roleId = $object.attr('id');
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
              url: "{{ route('admin.role.delete') }}",
              data: {role_id: roleId, _token: '{{ csrf_token() }}'},
              success: function(response){
                swal("Deleted!", response.message, "success");
                var oTable = $('#example1').dataTable();
                var nRow = $($object).parents('tr')[0];
                oTable.fnDeleteRow(nRow);
              },
              error: function(e){
                swal("Error!", "You can not delete roles anymore.", "error");
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
        Roles
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Roles</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
              <a href="{{ route('admin.role.add') }}" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-plus"></span> Add New</a>
              </h3>
            </div>
            <!-- /.box-header -->
            @include('layout.backend.alert')
            <!-- table start -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S N</th>
                  <th>Role Name</th>
                  <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $index=>$role)
                <tr id="role_{{ $role->id }}">
                  <td>{{ $index+1 }}</td>
                  <td>{{ $role->role }}</td>
                  <td>
                    <a href="{{ route('admin.role.edit', $role->id) }}"><i class="fa fa-fw fa-edit"></i>Edit</a>&nbsp;&nbsp;
                    <a href="{{ route('admin.role.modules', $role->id) }}"><i class="fa fa-fw fa-edit"></i>Access Modules</a>&nbsp;&nbsp;
                    @if($role->id > 3)
                    <a href="javascript:void(0)" class="delete" id="{{ $role->id }}" title="Delete Record"><i class="fa  fa-trash-o"></i>Delete</a>
                    @endif
                  </td>
                </tr>
                @endforeach                
                </tbody>
                <tfoot>
                <tr>
                  <th>S N</th>
                  <th>Role Name</th>
                  <th>Options</th>
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
    <!-- /.content --

@stop