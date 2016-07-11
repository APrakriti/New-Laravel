@extends('layout.backend.containerlist')

@section('footer_js')
    <script type="text/javascript">
      $(document).ready(function(){
        $('.sidebar-menu li').removeClass('active');
        $('#logs').addClass('active');
        $('#log_list').addClass('active');
      });
    </script>
  @endsection

@section('dynamicdata')

<section class="content-header">
      <h1>
        Logs
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Logs</li>
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
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S N</th>
                  <th>User</th>
                  <th>Description</th>
                  <th>Created On</th>
                </tr>
                </thead>
                <tbody>
                @foreach($logs as $index=>$log)
                <tr id="log_{{ $log->id }}">
                  <td>{{ $index+1 }}</td>
                  <td>{{ $log->user->first_name .' ' .$log->user->last_name }}</td>                 
                  <td>{{ $log->description }}</td>                 
                  <td>{{ date_format(date_create($log->created_at), 'M d,Y') }}</td>                 
                </tr>
                @endforeach                
                </tbody>
                <tfoot>
                <tr>
                  <th>S N</th>
                  <th>User</th>
                  <th>Description</th>
                  <th>Created On</th>
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