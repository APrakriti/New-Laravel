@extends('layout.backend.containerlist')


@section('dynamicdata')
    <div class="container">
    <ol class="breadcrumb" style="margin-bottom: 5px;">
        <li><a href="{{ URL::route('admin.dashboard') }}">Home</a></li>
        <li class="active">Modules</li>
    </ol>

    <div class="container">
        <div class="block-header">
            <h2>Modules</h2>
        </div>

        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.module.add') }}" class="btn btn-primary waves-effect">Add New</a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>S N</th>
                        <th>Module</th>
                        <th>Status</th>
                        {{--<th>Action</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($modules as $index=>$module)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $module->module }}</td>
                            <td>
                                @if($module->editable == 1)
                                    @if(Access::hasAccess('modules', 'access_update'))
                                        @if($module->is_active == 1)
                                            <a href="javascript:void(0)" class="change-status" id="{!! $module->id !!}"><i
                                                        class="zmdi zmdi-check-circle zmdi-hc-fw"></i></a>
                                        @else
                                            <a href="javascript:void(0)" class="change-status" id="{!! $module->id !!}"><i
                                                        class="zmdi zmdi-lock zmdi-hc-fw"></i></a>
                                        @endif
                                    @endif
                                @endif
                            </td>
                            {{--<td>--}}
                            {{--@if($module->editable == 1)--}}
                            {{--<i class="zmdi zmdi-edit zmdi-hc-fw"></i>Edit--}}
                            {{--<i class="zmdi zmdi-delete zmdi-hc-fw"></i>Delete--}}
                            {{--@endif--}}
                            {{--</td>--}}
                        </tr>
                    @endforeach
                    </tbody>

                </table>
                {!! $modules->render() !!}
            </div>
        </div>
    </div>
</div>
@stop

@section('footer_js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.change-status').click(function (event) {
                event.preventDefault();
                $object = this;
                debugger;
                $.ajax({
                    type: 'POST',
                    url: '{{ route("admin.module.change_status") }}',
                    data: {id: $object.id, _token: '{!! csrf_token() !!}'},
                    success: function (response) {
                        debugger;
                        if (response.is_active == 1) {
                            $($object).html('<i class="zmdi zmdi-check-circle zmdi-hc-fw"></i>');
                        } else {
                            $($object).html('<i class="zmdi zmdi-lock zmdi-hc-fw"></i>');
                        }
                        swal("Updated !", response.message, "success");
                    },
                    error: function (e) {
                        debugger;
                        swal("Error !", response.message, "error");
                    },
                });
            });
        });

    </script>
@stop