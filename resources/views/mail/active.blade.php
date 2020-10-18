@extends('templates.onekbuy.master')
@section('content')

    <div class="container">
        <div class="row row-form">
            <div class="col-md-2">
            </div>

            <div class="col-md-8">
                <div class="active-success text-center" style="background-color:white; padding:50px">
                    <h3>BẠN ĐÃ KÍCH HOẠT TÀI KHOẢN THÀNH CÔNG!</h3>
                    <a href={{route('auth.index.login')}}><button type="submit" class="btn btn-primary" style="margin-top:10px" >
                        Quay về trang đăng nhập</button></a>
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