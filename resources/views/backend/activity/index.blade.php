@extends('layout.backend.containerlist')

@section('footer_js')
    <script type="text/javascript">
      $(document).ready(function(){
        $('.sidebar-menu li').removeClass('active');
        $('#activities').addClass('active');
        $('#activity_list').addClass('active');

        $('table tbody').sortable({
          update: function (event, ui) {
            var $object = $(this);
            var activities = $(this).sortable('serialize');
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
              url: "{{ route('admin.activity.sort.order') }}",
              data: {activities:activities,_token:'{{ csrf_token() }}'},
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
          var activityId = $object.attr('id');
          $.ajax({
            type: "POST",
            url: "{{ route('admin.activity.changestatus') }}",
            data: {activity_id: activityId, _token: '{{ csrf_token() }}'},
            success: function(response){
              swal("Thank You!", response.message, "success")
              if(response.activity.is_active == 1){
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
          var activityId = $object.attr('id');
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
              url: "{{ route('admin.activity.delete') }}",
              data: {activity_id: activityId, _token: '{{ csrf_token() }}'},
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
        Activities
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Activities</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
              <a href="{{ route('admin.activity.add') }}" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-plus"></span> Add New</a>
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
                  <th>Activity Heading</th>
                  <th>Publish</th>
                  <th>Published On</th>
                  <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @foreach($activities as $index=>$activity)
                <tr id="activity_{{ $activity->id }}">
                  <td><i class="fa fa-arrows"></i></td>
                  <td>{{ $index+1 }}</td>
                  <td>{{ $activity->heading }}</td>                  
                  <td>
                    @if($activity->is_active == 1)
                      <a href="javascript:void(0)" class="change-status" id="{{ $activity->id }}" title="Change Status"><i class="fa fa-check-square-o"></i></a>
                    @else
                      <a href="javascript:void(0)" class="change-status" id="{{ $activity->id }}" title="Change Status"><i class="fa fa-minus-circle"></i></a>
                    @endif
                  </td>
                  <td>{{ date_format(date_create($activity->updated_at), 'M d,Y') }}</td>                  
                  <td>
                    <a href="{{ route('admin.activity.edit', $activity->id) }}"><i class="fa fa-fw fa-edit"></i>Edit</a>&nbsp;&nbsp;
                    <a href="javascript:void(0)" class="delete" id="{{ $activity->id }}" title="Delete Record"><i class="fa  fa-trash-o"></i>Delete</a>
                  </td>
                </tr>
                @endforeach                
                </tbody>
                <tfoot>
                <tr>
                  <th></th>
                  <th>S N</th>
                  <th>Activity Heading</th>
                  <th>Publish</th>
                  <th>Published On</th>
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
    <!-- /.content -->

@stop