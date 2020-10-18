@if (Session::has('msg'))
@if(Session::get('msg') != true)
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ Session::get('msg1')}}
    </div>
@endif
@endif