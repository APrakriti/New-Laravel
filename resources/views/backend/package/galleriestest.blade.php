@extends('layout.backend.containerlist')

@section('header_css')

@endsection

@section('footer_js')

<script type="text/javascript">
    var packageId = {{ $package->id }};

      $(document).ready(function(){
        $('.sidebar-menu li').removeClass('active');
        $('#packages').addClass('active');
      });
</script>
@endsection

@section('dynamicdata')


@stop