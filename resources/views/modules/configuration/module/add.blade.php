@extends('layout.backend.containerlist')


@section('dynamicdata')
    <div class="container">
    <ol class="breadcrumb" style="margin-bottom: 5px;">
        <li><a href="{{ URL::route('admin.dashboard') }}">Home</a></li>
        <li><a href="{{ URL::route('admin.modules') }}">Modules</a></li>
        <li class="active">Add new module</li>
    </ol>

    <div class="card">
        <div class="card-header">
            <h2>Add new module
                <small></small>
            </h2>
        </div>

        <div class="card-body card-padding">
            @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    <ul class="list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="" method="post" class="row" role="form">
                <div class="col-sm-6">
                    <div class="form-group fg-line">
                        <label class="sr-only" for="exampleInputEmail2">Module Name</label>
                        <input type="text" class="form-control input-sm" name="module" id="exampleInputEmail2"
                               placeholder="Enter module name">
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