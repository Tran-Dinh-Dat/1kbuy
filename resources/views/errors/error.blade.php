@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ Session::get('success')}}
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ Session::get('error')}}
    </div>
@endif

@if (Session::has('msg'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ Session::get('msg')}}
    </div>
@endif

@if (session('errors'))
    @foreach ($errors as $error)
        <li class="text-danger">{{$error}}</li>
    @endforeach
@endif

{{-- @if (count($errors) >0)
    <ul>
        @foreach($errors->all() as $error)
            <li class="text-danger"> {{ $error }}</li>
        @endforeach
    </ul>
@endif --}}

@if (session('status'))
    <ul>
        <li class="text-danger"> {{ session('status') }}</li>
    </ul>
@endif

@foreach($errors->all() as $error)
    <li class="text-danger">{{$error}}</li>
@endforeach