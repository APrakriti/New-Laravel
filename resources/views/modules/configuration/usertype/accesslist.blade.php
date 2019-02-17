@extends('layout.backend.containerlist')


@section('dynamicdata')
    <div class="container">
        <ol class="breadcrumb" style="margin-bottom: 5px;">
            <li><a href="{{ URL::route('admin.dashboard') }}">Home</a></li>
            <li><a href="{{ URL::route('admin.usertypes') }}">User Types</a></li>
            <li class="active">Access List</li>
        </ol>
        <div class="block-header">
            <h2>Access List</h2>
        </div>

        <div class="card">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th rowspan="2">User Type</th>
                        <th rowspan="2">Module Name</th>
                        <th colspan="8">Priviliges</th>
                    </tr>
                    <tr>
                        <!-- <th>All</th> -->
                        <th>View</th>
                        <th>Add</th>
                        <th>Publish</th>
                        <th>Update</th>
                        <th>Delete</th>
                        <th>View Trash</th>
                        <th>Reterive</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($usertype->modules as $index=>$module)

                        <tr>
                            @if($index == 0)
                                <td rowspan="{{ $usertype->modules->count() }}">{{ $usertype->user_type_name }}</td>
                            @endif
                        
                            @if($module->parent_id == 0)
                                <td><b>{{ $module->module }}</b></td>
                            @else
                                <td><b>{{ $module->module }}</b></td>
                            @endif
                            <td>
                                <label class="checkbox checkbox-inline m-r-20">
                                    <input type="checkbox" class="access" id="access_view-{{ $module->pivot->id }}"
                                           @if($module->pivot->access_view == 1) {{ 'checked' }} @endif value="">
                                    <i class="input-helper"></i>
                                </label>
                            </td>
                            <td>
                                <label class="checkbox checkbox-inline m-r-20">
                                    <input type="checkbox" class="access" id="access_add-{{ $module->pivot->id }}"
                                           @if($module->pivot->access_add == 1) {{ 'checked' }} @endif value="">
                                    <i class="input-helper"></i>
                                </label>
                            </td>
                            <td>
                                <label class="checkbox checkbox-inline m-r-20">
                                    <input type="checkbox" class="access" id="access_publish-{{ $module->pivot->id }}"
                                           @if($module->pivot->access_publish == 1) {{ 'checked' }} @endif value="">
                                    <i class="input-helper"></i>
                                </label>
                            </td>
                            <td>
                                <label class="checkbox checkbox-inline m-r-20">
                                    <input type="checkbox" class="access" id="access_update-{{ $module->pivot->id }}"
                                           @if($module->pivot->access_update == 1) {{ 'checked' }} @endif value="">
                                    <i class="input-helper"></i>
                                </label>
                            </td>
                            <td>
                                <label class="checkbox checkbox-inline m-r-20">
                                    <input type="checkbox" class="access" id="access_delete-{{ $module->pivot->id }}"
                                           @if($module->pivot->access_delete == 1) {{ 'checked' }} @endif value="">
                                    <i class="input-helper"></i>
                                </label>
                            </td>
                            <td>
                                <label class="checkbox checkbox-inline m-r-20">
                                    <input type="checkbox" class="access" id="access_trash-{{ $module->pivot->id }}"
                                           @if($module->pivot->access_trash == 1) {{ 'checked' }} @endif value="">
                                    <i class="input-helper"></i>
                                </label>
                            </td>
                            <td>
                                <label class="checkbox checkbox-inline m-r-20">
                                    <input type="checkbox" class="access" id="access_reterive-{{ $module->pivot->id }}"
                                           @if($module->pivot->access_reterive == 1) {{ 'checked' }} @endif value="">
                                    <i class="input-helper"></i>
                                </label>
                            </td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop
@section('footer_js')
<script type="text/javascript">
     $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });
    $(document).ready(function () {
      
        $('.access').change(function (event) {

            $object = this;
            var newArr = this.id.split('-');
            debugger;
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.change-access') }}",
                data: {column_name: newArr[0], id: newArr[1], _token: '{!! csrf_token() !!}'},
                success: function (response) {
                    swal({
                        title: "Success!",
                        text: response.message,
                        imageUrl: AdminAssetPath + "img/thumbs-up.png",
                        timer: 2000,
                        showConfirmButton: false
                    });
                    debugger;
                },
                error: function (e) {
                    debugger;
                },
            });
        });
    });
</script>
@stop