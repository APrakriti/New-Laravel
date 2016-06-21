@extends('layout.backend.containerlist')

@section('footer_js')
    <script type="text/javascript">
      $(document).ready(function(){
        $('.sidebar-menu li').removeClass('active');
      });
    </script>
  @endsection

@section('dynamicdata')

<section class="content-header">
      <h1>
        Galleries
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Galleries</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
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
                  <th>Package</th>
                  <th>Attachment</th>
                  <th>Caption</th>
                  <th>Published On</th>
                </tr>
                </thead>
                <tbody>
                @foreach($galleries as $index=>$gallery)
                <tr id="gallery_{{ $gallery->id }}">
                  <td><i class="fa fa-arrows"></i></td>
                  <td>{{ $index+1 }}</td>
                  <td>{{ $gallery->package->heading }}</td>
                  <td>
                    @if(file_exists('uploads/gallery/'.$gallery->attachment) && $gallery->attachment!='')
                      <img src="{{ asset('uploads/gallery/'.$gallery->attachment) }}" style="width: 200px; height: 120px;">
                    @else
                      <img src="{{ asset('uploads/noimage.jpg') }}" style="width: 200px; height: 120px;">
                    @endif
                  </td>
                  <td>{{ $gallery->caption }}</td>                  
                  <td>{{ date_format(date_create($gallery->updated_at), 'M d,Y') }}</td>              
                </tr>
                @endforeach                
                </tbody>
                <tfoot>
                <tr>
                  <th></th>
                  <th>S N</th>
                  <th>Package</th>
                  <th>Attachment</th>
                  <th>Caption</th>
                  <th>Published On</th>
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