@extends('layout.backend.containerlist')


@section('dynamicdata')
    <div class="container">
        <ol class="breadcrumb" style="margin-bottom: 5px;">
            <li><a href="{{ URL::route('admin.dashboard') }}">Home</a></li>
            <li><a href="{{ route('admin.users.index') }}">User</a></li>
            <li class="active">Add User</li>
        </ol>

        <div class="card">
            <div class="card-header">
                <h2>Add User
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
            <?php $success = Session::get('success'); ?>
            @if($success)
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    {{ $success }}
                </div>
            @endif
            <div class="card-body card-padding">
                <form action="" method="post" class="row" role="form" id="profile" enctype="multipart/form-data">
                    <div class="col-sm-6">
                        <div class="form-group fg-line">
                            <label class="" for="exampleInputEmail2">First Name</label>
                            <input type="text" class="form-control input-sm" name="first_name"
                                   id="exampleInputEmail2" value="{{ old('first_name') }}"
                                   placeholder="Enter First Name">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group fg-line">
                            <label for="exampleInputEmail2">Last Name</label>
                            <input type="text" class="form-control input-sm" name="last_name"
                                   id="" placeholder="Enter Last Name" value="{{ old('last_name') }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group fg-line">
                            <label for="exampleInputEmail2">Email</label>
                            <input type="email" class="form-control input-sm" name="email"
                                   value="{{ old('email') }}" placeholder="Email">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group fg-line">
                            <label for="exampleInputEmail2">Username</label>
                            <input type="text" class="form-control input-sm" value="{{ old('username') }}"
                                   name="username" placeholder="Username">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-6">
                        <div class="form-group fg-line">
                            <label class="" for="exampleInputEmail2">Type *</label>
                            {!! Form::select('user_types', $userType, '', array('class'=>'selectpicker form-control input-sm','placeholder'=>'Choose User Type')) !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group fg-line">
                            <label class="" for="exampleInputEmail2">Status *</label>
                            <select name="is_active" class="selectpicker form-control input-sm">
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>

                        </div>
                    </div>
                    <div class="clearfix"></div>
                  <!--   <div class="col-sm-6">
                        <div class="form-group fg-line">


                            <label class="" for="">Profile Image</label>
                            <br/>

                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                                </div>
                                <div>
                                    <span class="btn btn-info btn-file">
                                        <span class="fileinput-new">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" name="attachment">
                                    </span>
                                    <a href="#" class="btn btn-danger fileinput-exists"
                                       data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>

                        </div>
                    </div> -->
                    <div class="clearfix"></div>
                    {!! csrf_field() !!}
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary btn-sm m-t-5">Add User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('footer_js')
    {!! Html::script('backend/js/formValidation.min.js') !!}
    {!! Html::script('backend/js/form_bootstrap.min.js') !!}
    {!! Html::script('backend/plugins/bootstrap-select/dist/js/bootstrap-select.js') !!}
    {!! Html::script('backend/plugins/fileinput/fileinput.min.js') !!}
    {!! Html::script('backend/plugins/chosen_v1.4.2/chosen.jquery.min.js') !!}

    <script>
        $(document).ready(function () {
            $('#profile')
                    .formValidation({
                        framework: 'bootstrap',
                        excluded: [':disabled'],
                        icon: {
                            valid: 'glyphicon glyphicon-ok',
                            invalid: 'glyphicon glyphicon-remove',
                            validating: 'glyphicon glyphicon-refresh'
                        },
                        fields: {
                            first_name: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please Enter first name.'
                                    }
                                }
                            },
                            last_name: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please Enter last name.'
                                    }

                                }
                            },
                            email: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please Enter Email.'
                                    }

                                }
                            },
                            username: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please Enter Username.'
                                    }

                                }
                            },


                        }
                    })
                    .on('err.form.fv', function (e) {
                    })
                    .end();
        });
    </script>
@stop
