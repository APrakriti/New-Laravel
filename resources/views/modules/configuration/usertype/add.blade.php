@extends('layout.backend.containerlist')

@section('footer_js')
    <script type="text/javascript">
      $(document).ready(function(){
        $('.sidebar-menu li').removeClass('active');
        $('#bookings').addClass('active');
        $('#booking_list').addClass('active');      
      });
    </script>
  @endsection

@section('dynamicdata')

    <div class="container">
        <ol class="breadcrumb" style="margin-bottom: 5px;">
            <li><a href="{{ URL::route('admin.dashboard') }}">Home</a></li>
            <li><a href="{{ URL::route('admin.usertypes') }}">User Types</a></li>
            <li class="active">Add New User Type</li>
        </ol>

        <div class="card">
            <div class="card-header">
                <h2>Add New User Type
                    <small></small>
                </h2>
            </div>


            @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-body card-padding">
                <form action="" method="post" class="row" role="form">
                    <div class="col-sm-6">
                        <div class="form-group fg-line">
                            <label class="sr-only" for="exampleInputEmail2">User Type Name</label>
                            <input type="text" class="form-control input-sm" name="user_type_name"
                                   id="exampleInputEmail2"
                                   placeholder="Enter user type name">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    {!! csrf_field() !!}
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary btn-sm m-t-5">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop