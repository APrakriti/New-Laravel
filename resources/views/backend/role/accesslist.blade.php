@extends('layout.backend.containerlist')

@section('dynamicdata')

<section class="content-header">
      <h1>
        Roles
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.roles') }}">Roles</a></li>
        <li class="active">Access Lists : {{ $role->role }}</li>
      </ol>
</section>

<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">              
            </div>
            <!-- /.box-header -->
            @include('layout.backend.alert')
            <!-- table start -->
            <div class="box-body">
              <table id="" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S N</th>
                  <th>Module Name</th>
                  <th>Access</th>
                </tr>
                </thead>
                <tbody>                
                @foreach($modules as $index=>$module)
                
                <tr id="module_{{ $module->id }}">
                  <td>{{ $index+1 }}</td>
                  <td>{{ $module->module }}</td>
                  <td>
                    @if(in_array($module->id, $accessedModules))
                      <a href="javascript:void(0)" class="change-access" id="{{ $module->id }}" title="Change Access"><i class="fa fa-check-square-o"></i></a>
                    @else
                      <a href="javascript:void(0)" class="change-access" id="{{ $module->id }}" title="Change Access"><i class="fa fa-minus-circle"></i></a>
                    @endif
                  </td>          
                </tr>
                @endforeach                
                </tbody>
                <tfoot>
                <tr>
                  <th>S N</th>
                  <th>Module Name</th>
                  <th>Access</th>
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
@section('footer_js')
<script type="text/javascript">
    $(document).ready(function () {
        var roleId = {{ $role->id }};
        $(".change-access").click(function(){
          $object = $(this);
          debugger;
          var moduleId = $object.attr('id');
          swal({
            title: "Are you sure to change access?",
            text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, change it!",
            closeOnConfirm: false
          }, function(){
              $.ajax({
              type: "POST",
              url: "{{ route('admin.role.change.access') }}",
              data: {role_id:roleId, module_id: moduleId, _token: '{{ csrf_token() }}'},
              success: function(response){
                debugger;
                swal("Thank You!", response.message, "success")
                if(response.type == 'denied'){
                    $($object).children().removeClass('fa-check-square-o');
                    $($object).children().addClass('fa-minus-circle');
                } else {
                  $($object).children().removeClass('fa-minus-circle');
                  $($object).children().addClass('fa-check-square-o');
                }
              },
              error: function(e){  
                    swal("Error!", "Server Error or You are trying to modify this application.", "error")
                }
            });
          });          
        });
    });
</script>
@stop