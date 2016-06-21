<div class="box-body">
  @if (count($errors) > 0)
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
            &times;
        </button>
        <h4>
            <i class="icon fa fa-ban">
            </i>
            Error!
        </h4>
        <ul>
            @foreach ($errors->all() as $error)
            <li>
                {{ $error }}
            </li>
            @endforeach
        </ul>
    </div>
  @endif
  
  @if (session('status') == 'success' && session('message'))
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
            &times;
        </button>
        <h4>
            <i class="icon fa fa-check">
            </i>
            Success!
        </h4>
        {{ session('message') }}
    </div>
  @endif
</div>
<!--
    /.box-body
-->