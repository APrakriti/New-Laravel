@extends('admin.layout.app')
@section('title', 'Change Password')
@section('header_css')
    {!! Html::style('backend/css/formValidation.min.css') !!}
@stop
@section('footer_js')
    {!! Html::script('backend/js/formValidation.min.js') !!}
    {!! Html::script('backend/js/form_bootstrap.min.js') !!}

    <script>
        $(document).ready(function () {
            $('#changePassword')
                    .formValidation({
                        framework: 'bootstrap',
                        excluded: [':disabled'],
                        icon: {
                            valid: 'glyphicon glyphicon-ok',
                            invalid: 'glyphicon glyphicon-remove',
                            validating: 'glyphicon glyphicon-refresh'
                        },
                        fields: {
                            old_password: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please Enter your current password.'
                                    }
                                }
                            },
                            password: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please Enter your new password.'
                                    }

                                }
                            },

                            password_confirmation: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please Enter your confirmation password.'
                                    },
                                    identical: {
                                        field: 'password',
                                        message: 'The password and its confirm are not the same'
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


@section('main')
    <div class="container">
        <ol class="breadcrumb" style="margin-bottom: 5px;">
            <li><a href="{{ URL::route('admin.dashboard') }}">Home</a></li>
            <li><a href="#">User</a></li>
            <li class="active">Change Password</li>
        </ol>

        <div class="card">
            <div class="card-header">
                <h2>Change Password
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
                <form action="" method="post" class="row" role="form" id="changePassword">
                    <div class="col-sm-6">
                        <div class="form-group fg-line">
                            <label class="" for="exampleInputEmail2">Current Password*</label>
                            <input type="password" class="form-control input-sm" name="old_password"
                                   id="exampleInputEmail2"
                                   placeholder="Enter Current Password">
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="col-sm-6">
                        <div class="form-group fg-line">
                            <label for="exampleInputEmail2">New Password*</label>
                            <input type="password" class="form-control input-sm" name="password"
                                   id="exampleInputEmail2"
                                   placeholder="Enter new Password"
                                   minlength="6"
                                   data-fv-stringlength-message="The password must be more than 6 characters">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-6">
                        <div class="form-group fg-line">
                            <label class="" for="exampleInputEmail2">Confirm Password*</label>
                            <input type="password" class="form-control input-sm" name="password_confirmation"
                                   id="exampleInputEmail2"
                                   placeholder="Enter confirm password"
                                   minlength="6"
                                   data-fv-stringlength-message="The confirm password must be more than 6 characters">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    {!! csrf_field() !!}
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary btn-sm m-t-5">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop