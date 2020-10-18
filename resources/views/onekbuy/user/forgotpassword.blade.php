@extends('templates.onekbuy.master')
@section('content')

    <div class="container">
        <div class="row row-form">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade shadow rounded bg-white p-4 show active" id="v-pills-home" role="tabpanel"
                        aria-labelledby="v-pills-home-tab">
                        <form class="form-update-info" action="{{ route('onekbuy.user.forgotpassword') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="formGroupExampleInput">Email</label>
                                <input type="text" class="form-control" id="formGroupExampleInput"
                                    placeholder="Email của bạn...." name="emailforgot">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('emailforgot') }}</p>

                                @include('errors.errors')
                            </div>
                            <a>
                                <button type="submit" class="btn btn-primary">Xác nhận</button>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>

@endsection