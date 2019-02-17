@extends('admin.layout.app')
@section('title', 'Trashed User Type')

@section('main')
    <div class="container">
    <ol class="breadcrumb" style="margin-bottom: 5px;">
        <li><a href="{{ URL::route('admin.dashboard') }}">Home</a></li>
        <li><a href="{{ URL::route('admin.usertypes') }}">User Types</a></li>
        <li class="active">Trashed User Types</li>
    </ol>

    <div class="container">
        <div class="block-header">
            <h2>Trashed
                <small>User Types</small>
            </h2>
        </div>

        <div class="card">
            {{--<div class="card-header">--}}
                {{--@if(Access::hasAccess('user-type', 'access_add'))--}}
                    {{--<a href="{{ route('admin.usertype.add') }}" class="btn btn-primary waves-effect">Add New</a>--}}
                {{--@endif--}}
            {{--</div>--}}

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>S N</th>
                        <th>User Type</th>
                        @if(Access::hasAccess('user-type', 'access_delete') || Access::hasAccess('user-type', 'access_update'))
                            <th>Action</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user_types as $index=>$user_type)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $user_type->user_type_name }}</td>
                            <td>
                                @if(Access::hasAccess('user-type', 'access_reterive'))
                                    <a href="#" class="reterive-usertype" id="{!! $user_type->id !!}"><i
                                                class="zmdi zmdi-delete zmdi-hc-fw"></i>Reterive </a>
                                    <!-- <a href="#" class="delete-usertype" id="{!! $user_type->id !!}"><i class="zmdi zmdi-delete zmdi-hc-fw"></i>Delete </a> -->
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
                {!! $user_types->render() !!}
            </div>
        </div>
    </div>
</div>
@stop

@section('footer_js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.reterive-usertype').click(function (event) {
                event.preventDefault();
                $object = this;
                debugger;
                swal({
                    title: "Are you sure?",
                    text: "You will reterive this record!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, reterive it!",
                    closeOnConfirm: false
                }, function () {
                    $.ajax({
                        type: 'POST',
                        url: '{{ route("admin.usertype.reterive") }}',
                        data: {id: $object.id, _token: '{!! csrf_token() !!}'},
                        success: function (response) {
                            $($object).parent('td').parent('tr').remove();
                            swal("Reterived!", response.message, "success");
                        },
                        error: function (e) {
                            debugger;
                        },
                    });
                });
            });
        });
    </script>
@stop