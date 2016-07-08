@extends('layout.backend.containerlist')

@section('footer_js')
    <script type="text/javascript">
      $(document).ready(function(){
        $('.sidebar-menu li').removeClass('active');
        $('#packages').addClass('active');

        $('table tbody').sortable({
          update: function (event, ui) {
            var $object = $(this);
            var galleries = $(this).sortable('serialize');
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
              url: "{{ route('admin.package.gallery.sort.order') }}",
              data: {galleries:galleries,_token:'{{ csrf_token() }}'},
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
          var galleryId = $object.attr('id');
          $.ajax({
            type: "POST",
            url: "{{ route('admin.package.gallery.changestatus') }}",
            data: {gallery_id: galleryId, _token: '{{ csrf_token() }}'},
            success: function(response){
              swal("Updated!", response.message, "success")
              if(response.gallery.is_active == 1){
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

        $('.make-cover').click(function(){
          $object = $(this);
          var galleryId = $object.attr('id');
          $.ajax({
            type: "POST",
            url: "{{ route('admin.package.gallery.makecover') }}",
            data: {gallery_id: galleryId, _token: '{{ csrf_token() }}'},
            success: function(response){
              swal("Updated!", response.message, "success")
              $(".table").find(".make-cover").children().removeClass('fa-check-square-o').addClass('fa-minus-circle');
              $($object).children().removeClass('fa-minus-circle');
              $($object).children().addClass('fa-check-square-o');
            },
            error: function(e){
              
            }
          });
        });
        $('.delete').click(function(){
          $object = $(this);
          var galleryId = $object.attr('id');
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
              url: "{{ route('admin.package.gallery.delete') }}",
              data: {gallery_id: galleryId, _token: '{{ csrf_token() }}'},
              success: function(response){
                swal("Deleted!", response.message, "success");
                var oTable = $('#example1').dataTable();
                var nRow = $($object).parents('tr')[0];
                oTable.fnDeleteRow(nRow);
              },
              error: function(error){
                debugger;
                swal("Error!", error.responseJSON.message, "error");
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
        Package Galleries
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.packages') }}"><i class="fa"></i> Packages</a></li>
        <li class="active">Galleries : {{ $package->heading }} </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
              <a href="{{ route('admin.package.gallery.add', $package->id) }}" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-plus"></span> Add New</a>
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
                  <th>Caption</th>                  
                  <th>Attachment</th>
                  <th>Publish</th>
                  <th>Cover Image</th>
                  <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @foreach($galleries as $index=>$gallery)
                <tr id="gallery_{{ $gallery->id }}">
                  <td><i class="fa fa-arrows"></i></td>
                  <td>{{ $index+1 }}</td>
                  <td>{{ $gallery->caption }}</td>                  
                  <td>
                    @if(file_exists('uploads/gallery/'.$gallery->attachment) && $gallery->attachment!='')
                      <img src="{{ asset('uploads/gallery/'.$gallery->attachment) }}" style="width: 200px; height: 120px;">
                    @else
                      <img src="{{ asset('uploads/noimage.jpg') }}" style="width: 200px; height: 120px;">
                    @endif
                  </td>
                  <td>
                    @if($gallery->is_active == 1)
                      <a href="javascript:void(0)" class="change-status" id="{{ $gallery->id }}" title="Change Status"><i class="fa fa-check-square-o"></i></a>
                    @else
                      <a href="javascript:void(0)" class="change-status" id="{{ $gallery->id }}" title="Change Status"><i class="fa fa-minus-circle"></i></a>
                    @endif
                  </td>
                  <td>
                    @if($gallery->is_cover == 1)
                      <a href="javascript:void(0)" class="make-cover" id="{{ $gallery->id }}" title="Make Cover"><i class="fa fa-check-square-o"></i></a>
                    @else
                      <a href="javascript:void(0)" class="make-cover" id="{{ $gallery->id }}" title="Make Cover"><i class="fa fa-minus-circle"></i></a>
                    @endif
                  </td>
                  <td>
                    <a href="{{ route('admin.package.gallery.edit', $gallery->id) }}"><i class="fa fa-fw fa-edit"></i>Edit</a>&nbsp;&nbsp;
                    <a href="javascript:void(0)" class="delete" id="{{ $gallery->id }}" title="Delete Record"><i class="fa  fa-trash-o"></i>Delete</a>
                  </td>
                </tr>
                @endforeach                
                </tbody>
                <tfoot>
                <tr>
                  <th></th>
                  <th>S N</th>
                  <th>Caption</th>                  
                  <th>Attachment</th>
                  <th>Publish</th>
                  <th>Cover Image</th>
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