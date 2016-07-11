@extends('layout.backend.container')

@section('footer_js')
    <script type="text/javascript">
      $(document).ready(function(){
        $('.sidebar-menu li').removeClass('active');
      });
    </script>
  @endsection

@section('dynamicdata')


<section class="content-header">
      <h1>
        Error 
        <small>Access Denied</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Error</li>
      </ol>
    </section>

<!-- Main content -->
<div class="content body">
  <section id="introduction">
    <h2 class="page-header"></h2>
    <p class="lead">
      An error has occurred while processing your request.
      This may occured because there was an attemt to manipulate this software.
      Users are prohibited from taking unauthorized actions to intentionally modify the system.
    </p>
  </section>
</div>

@stop