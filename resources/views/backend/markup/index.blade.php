@extends('layout.backend.containerlist')
@section('footer_js')
    <script type="text/javascript">
      $(document).ready(function(){
        $('.sidebar-menu li').removeClass('active');
        $('#markups').addClass('active');
        $('#markup_list').addClass('active');

        $('table tbody').sortable({
          update: function (event, ui) {
            var $object = $(this);
            var markups = $(this).sortable('serialize');
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
              url: "{{ route('admin.markup.sort.order') }}",
              data: {markups:markups,_token:'{{ csrf_token() }}'},
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
          var markupId = $object.attr('id');
          $.ajax({
            type: "POST",
            url: "{{ route('admin.markup.changestatus') }}",
            data: {markup_id: markupId, _token: '{{ csrf_token() }}'},
            success: function(response){
              swal("Thank You!", response.message, "success")
              if(response.markup.is_active == '1'){
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
          var markupId = $object.attr('id');
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
              url: "{{ route('admin.markup.delete') }}",
              data: {markup_id: markupId, _token: '{{ csrf_token() }}'},
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
        Markup
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Markup</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
              <a href="{{ route('admin.markup.add') }}" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-plus"></span> Add New</a>
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
                 <!--  <th>User Type</th>
                  <th>User</th> -->
                 <th> Tier </th>
                 <th> Bhutanese Markup</th>
                 <th> Bhutanese Type</th>
                  <th> Saarc Markup</th>
                 <th> Saarc Type</th>
                  <th>  Other Markup</th>
                 <th> Other Type</th>
                  <th>Publish</th>
                  <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @foreach($markups as $index=>$markup)
                <tr id="markup_{{ $markup->id }}">
                  <td><i class="fa fa-arrows"></i></td>
                  <td>{{ $index+1 }}</td>
                

                  <td>{{ $markup->tier->tier_name ?? ""  }}</td>
                  <td>{{ $markup->bhutanese_markup }}</td>
                  <td>@if($markup->bhutanese_type == 0)
                    Flat
                  @elseif($markup->bhutanese_type == 1)
                  Percent
                  @endif</td>
                  <td>{{ $markup->saarc_markup }}</td>
                <td>@if($markup->saarc_type == 0)
                    Flat
                  @elseif($markup->saarc_type == 1)
                  Percent
                  @endif</td>
                  <td>{{ $markup->other_markup }}</td>
                  <td>@if($markup->other_type == 0)
                    Flat
                  @elseif($markup->other_type == 1)
                  Percent
                  @endif</td>



          
                  <td>
                    @if($markup->is_active == '1')
                      <a href="javascript:void(0)" class="change-status" id="{{ $markup->id }}" title="Change Status"><i class="fa fa-check-square-o"></i></a>
                    @else
                      <a href="javascript:void(0)" class="change-status" id="{{ $markup->id }}" title="Change Status"><i class="fa fa-minus-circle"></i></a>
                    @endif
                  </td>
                  <td>
                    <a href="{{ route('admin.markup.edit', $markup->id) }}"><i class="fa fa-fw fa-edit"></i>Edit</a>&nbsp;&nbsp;
                    <a href="javascript:void(0)" class="delete" id="{{ $markup->id }}" title="Delete Record"><i class="fa  fa-trash-o"></i>Delete</a>
                  </td>
                </tr>
                @endforeach                
                </tbody>
                <tfoot>
                  <tr>
                 <th></th>
                  <th>S N</th>
                 <!--  <th>User Type</th>
                  <th>User</th> -->
                 <th> Tier </th>
                 <th> Bhutanese Markup</th>
                 <th> Bhutanese Type</th>
                  <th> Saarc Markup</th>
                 <th> Saarc Type</th>
                  <th>  Other Markup</th>
                 <th> Other Type</th>
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
