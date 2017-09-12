@if(Session::has('success'))
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success:</strong> {{Session::get('success')}}
    </div>
@endif

@if(Session::has('error'))
    <div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Error:</strong> {{Session::get('error')}}
    </div>
@endif

@if (Session::has('status'))
    <div class="alert alert-success">
        {{ Session::get('status') }}
    </div>
@endif