@extends('templates.auth.admin.master')
@section('content')
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">
            <form class="login100-form validate-form" method="post" action="{{ route('auth.admin.login')}}">
                @csrf
                <span class="login100-form-title p-b-55">
                    Đăng nhập
                </span>
                @include('errors.error')
                <div class="wrap-input100 validate-input m-b-16" data-validate = "Valid email is required: ex@abc.xyz">
                    <input class="input100" type="text" name="email" placeholder="Email">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <span class="lnr lnr-envelope"></span>
                    </span>
                </div>

                <div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
                    <input class="input100" type="password" name="password" placeholder="Mật khẩu">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <span class="lnr lnr-lock"></span>
                    </span>
                </div>
                
                <div class="container-login100-form-btn p-t-25">
                    <button class="login100-form-btn" type="submit">
                        Đăng nhập
                    </button>
                </div>

                    <a class="txt1 bo1 hov1" href="{{ route('admin.resetPassword') }}">
                        Reset password						
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection