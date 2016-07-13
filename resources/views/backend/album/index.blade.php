@extends('layout.backend.containerlist')

@section('footer_js')
    <script type="text/javascript">
      $(document).ready(function(){
        $('.sidebar-menu li').removeClass('active');
        $('#albums').addClass('active');
        $('#album_list').addClass('active');

        $('table tbody').sortable({
          update: function (event, ui) {
            var $object = $(this);
            var albums = $(this).sortable('serialize');
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
              url: "{{ route('admin.album.sort.order') }}",
              data: {albums:albums,_token:'{{ csrf_token() }}'},
              success: function(response){
                swal("Thank You!", response.message, "success")
              },
              error: function(error){
                swal("OOPS!", error.message, "error")
              }
            });
          }
        });

        $('.change-status').click(function(){
          $object = $(this);
          var albumId = $object.attr('id');
          $.ajax({
            type: "POST",
            url: "{{ route('admin.album.changestatus') }}",
            data: {album_id: albumId, _token: '{{ csrf_token() }}'},
            success: function(response){
              swal("Thank You!", response.message, "success")
              if(response.album.is_active == 1){
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

        $('.delete').click(function(){
          $object = $(this);
          var albumId = $object.attr('id');
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
              url: "{{ route('admin.album.delete') }}",
              data: {album_id: albumId, _token: '{{ csrf_token() }}'},
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
        Albums
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Albums</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
              <a href="{{ route('admin.album.add') }}" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-plus"></span> Add New</a>
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
                  <th>Album Name</th>
                  <th>Attachment</th>
                  <th>Publish</th>
                  <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @foreach($albums as $index=>$album)
                <tr id="album_{{ $album->id }}">
                  <td><i class="fa fa-arrows"></i></td>
                  <td>{{ $index+1 }}</td>
                  <td>{{ $album->heading }}</td>
                  <td>
                    @if(file_exists('uploads/albums/'.$album->attachment) && $album->attachment!='')
                      <img src="{{ asset('uploads/albums/'.$album->attachment) }}" style="width: 200px; height: 120px;">
                    @else
                      <img src="{{ asset('uploads/noimage.jpg') }}" style="width: 200px; height: 120px;">
                    @endif
                  </td>
                  <td>
                    @if($album->is_active == 1)
                      <a href="javascript:void(0)" class="change-status" id="{{ $album->id }}" title="Change Status"><i class="fa fa-check-square-o"></i></a>
                    @else
                      <a href="javascript:void(0)" class="change-status" id="{{ $album->id }}" title="Change Status"><i class="fa fa-minus-circle"></i></a>
                    @endif
                  </td>
                  <td>
                    <a href="{{ route('admin.album.edit', $album->id) }}"><i class="fa fa-fw fa-edit"></i>Edit</a>&nbsp;&nbsp;
                    <a href="javascript:void(0)" class="delete" id="{{ $album->id }}" title="Delete Record"><i class="fa  fa-trash-o"></i>Delete</a>
                  </td>
                </tr>
                @endforeach                
                </tbody>
                <tfoot>
                <tr>
                  <th></th>
                  <th>S N</th>
                  <th>Album Name</th>
                  <th>Attachment</th>
                  <th>Publish</th>
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