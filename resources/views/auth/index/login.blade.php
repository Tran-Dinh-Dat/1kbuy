@extends('templates.onekbuy.master')
@section('content')
    <div class="container">
        <div class="row row-form">
            <div class="col-md-3 d-none d-md-block d-lg-block d-xl-block">
                <div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab" role="tablist"
                    aria-orientation="vertical">
                    <a class="nav-link mb-3 p-3 shadow {{ !Session::has('msg') ? 'active':'' }}" id="v-pills-home-tab" data-toggle="pill"
                        href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                        <i class="fa fa-user-circle-o mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">Đăng nhập</span></a>

                    <a class="nav-link mb-3 p-3 shadow {{ Session::has('msg') ? 'active':'' }}" id="v-pills-profile-tab" data-toggle="pill"
                        href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="true">
                        <i class="fa fa-calendar-minus-o mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">Đăng ký</span></a>

                </div>
            </div>

            <div class="col-md-9 d-none d-md-block d-lg-block d-xl-block">
                <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade shadow rounded bg-white p-4 {{ !Session::has('msg') ? 'show active':'' }}" id="v-pills-home" role="tabpanel"
                        aria-labelledby="v-pills-home-tab">
                        @include('errors.errors')
                        @include('errors.success')

                        <form class="form-update-info" action="{{ route('auth.index.login') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label >Email đăng nhập</label>
                                <input type="text" class="form-control" id="formGroupExampleInput"
                                    placeholder="Email đăng nhập của bạn..." name="loginemail" value="{{ old('loginemail') }}">
                                    <p class="help is-danger" style="color:red;">{{ $errors->first('loginemail') }}</p>

                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <div class="input-group" id="show_hide_password">
                                  <input class="form-control" type="password" name="loginpassword" placeholder="Nhập mật khẩu của bạn...">
                                  <div class="input-group-addon">
                                    <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                  </div>
                                </div>
                                <p class="help is-danger" style="color:red;">{{ $errors->first('loginpassword') }}</p>
                              </div>
                            <button type="submit" class="btn btn-primary">Đăng nhập</button>
                            <a href={{route('onekbuy.user.forgotpassword')}}><button type="button" class="btn btn-primary" style="float: right">Quên mật khẩu</button></a>
                        </form>
                    </div>

                    
                <div class="tab-pane fade shadow rounded bg-white p-4 {{ Session::has('msg') ?'active show':'' }}" id="v-pills-profile" role="tabpanel"
                        aria-labelledby="v-pills-profile-tab">
                        <h6>@include('errors.msg')</h6>
                        @if(!Session::has('msg') || Session::get('msg') == true)
                            <form class="form-reset-pass" action="{{route('auth.mail.register')}}" method="POST">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label >Tên đại diện</label>
                                <input type="text" value="{{ old('username') }}" class="form-control" id="formGroupExampleInput" name="username" placeholder="Tên đại diện của bạn...">
                                    <p class="help is-danger" style="color:red;">{{ $errors->first('username') }}</p>

                                </div>
                                <div class="form-group">
                                    <label >Email</label>
                                    <input type="email" value="{{ old('email') }}" class="form-control" id="formGroupExampleInput" name="email" placeholder="Email đăng nhập của bạn...">
                                    <p class="help is-danger" style="color:red;">{{ $errors->first('email') }}</p>

                                </div>
                                <div class="form-group">
                                    <label>Mật khẩu</label>
                                    <div class="input-group" id="show_hide_password">
                                      <input class="form-control" type="password" name="password" placeholder="Mật khẩu đăng nhập của bạn">
                                      <div class="input-group-addon">
                                        <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                      </div>
                                    </div>
                                    <p class="help is-danger" style="color:red;">{{ $errors->first('password') }}</p>
                                  </div>
                                  <div class="form-group">
                                    <label>Xác nhận mật khẩu</label>
                                    <div class="input-group" id="show_hide_password">
                                      <input class="form-control" type="password" name="re_password" placeholder="Xác nhận lại mật khẩu đăng nhập của bạn">
                                      <div class="input-group-addon">
                                        <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                      </div>
                                    </div>
                                    <p class="help is-danger" style="color:red;">{{ $errors->first('re_password') }}</p>
                                  </div>
                                <div class="form-group">
                                    <label class="container">
                                        <input type="checkbox" name="checkbox">
                                        <span class="checkmark">Tôi đã đọc và đồng ý với <a href="{{route('onekbuy.post.info','dieu-khoan')}}">Điều khoản sử dụng</a> của 1kbuy</span>
                                    </label>
                                    <p class="help is-danger" style="color:red;">{{ $errors->first('checkbox') }}</p>
                                </div>
                                <button type="submit" class="btn btn-primary">Đăng ký</button>
                            </form>
                        @endif
                        
                    </div>

                </div>
            </div>

            <div class="col-12 d-block d-md-none d-lg-none d-xl-none">
                <nav class="navbar ">
                    <button class="navbar-toggler my-3 signin-button-custom {{ !Session::has('msg') ? 'active':'' }}" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span>Đăng nhập</span>
                    </button>
                        @include('errors.errors')
                        @include('errors.success')
                  
                    <div class="collapse navbar-collapse {{ !Session::has('msg') ? 'show':'' }} signin-form-custom mb-3" id="navbarSupportedContent1">
                        <form class="form-update-info" action="{{ route('auth.index.login') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Email đăng nhập</label>
                                <input type="text" class="form-control" id="formGroupExampleInput"
                                    placeholder="Email đăng nhập của bạn" name="loginemail" value="{{ old('loginemail') }}">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('loginemail') }}</p>
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <div class="input-group" id="show_hide_password">
                                  <input class="form-control" type="password" name="loginpassword" placeholder="Nhập mật khẩu của bạn...">
                                  <div class="input-group-addon">
                                    <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                  </div>
                                </div>
                              </div>
                            <p class="help is-danger" style="color:red;">{{ $errors->first('loginpassword') }}</p>
                            <button type="submit" class="btn btn-primary">Đăng nhập</button>
                        </form>
                    </div>
                </nav>
                <nav class="navbar">
                    <button class="navbar-toggler mb-3 signin-button-custom {{ Session::has('msg') ? 'active':'' }}" type="button" data-toggle="collapse" data-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span>Đăng kí</span>
                    </button>
                    @include('errors.msg')
                    @if(!Session::has('msg') || Session::get('msg') == true)
                    <div class="collapse navbar-collapse  {{ Session::has('msg') ? 'show':'' }} signin-form-custom mb-3" id="navbarSupportedContent2">
                        <form class="form-reset-pass" action="{{route('auth.mail.register')}}" method="POST">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label >Tên đại diện</label>
                            <input type="text" value="{{ old('username') }}" class="form-control" id="formGroupExampleInput" name="username" placeholder="Tên đại diện của bạn...">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('username') }}</p>

                            </div>
                            <div class="form-group">
                                <label >Email</label>
                                <input type="email" value="{{ old('email') }}" class="form-control" id="formGroupExampleInput" name="email" placeholder="Email đăng nhập của bạn...">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('email') }}</p>

                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <div class="input-group" id="show_hide_password">
                                  <input class="form-control" type="password" name="password" placeholder="Xác nhận lại mật khẩu đăng nhập của bạn">
                                  <div class="input-group-addon">
                                    <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                  </div>
                                </div>
                                <p class="help is-danger" style="color:red;">{{ $errors->first('password') }}</p>
                              </div>
                              <div class="form-group">
                                <label>Xác nhận mật khẩu</label>
                                <div class="input-group" id="show_hide_password">
                                  <input class="form-control" type="password" name="re_password" placeholder="Xác nhận lại mật khẩu đăng nhập của bạn">
                                  <div class="input-group-addon">
                                    <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                  </div>
                                </div>
                                <p class="help is-danger" style="color:red;">{{ $errors->first('re_password') }}</p>
                              </div>
                            <div class="form-group">
                                <label class="container">
                                    <input type="checkbox" name="checkbox">
                                    <span class="checkmark">Tôi đã đọc và đồng ý với <a href="{{route('onekbuy.post.info','dieu-khoan')}}">Điều khoản sử dụng</a> của 1kbuy</span>
                                </label>
                                <p class="help is-danger" style="color:red;">{{ $errors->first('checkbox') }}</p>
                            </div>
                            <button type="submit" class="btn btn-primary">Đăng ký</button>
                        </form>
                    </div>
                    @endif
                </nav>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script>
        function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        }
      
        function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        }

        $(document).ready(function(){
            $('.signin-button-custom').click(function() {
                $(".signin-button-custom").removeClass("active");
                $(".signin-form-custom").removeClass("show");
                $(this).addClass("active");
                $(this).addClass("show");
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if($('#show_hide_password input').attr("type") == "text"){
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass( "fa-eye-slash" );
                    $('#show_hide_password i').removeClass( "fa-eye" );
                }else if($('#show_hide_password input').attr("type") == "password"){
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass( "fa-eye-slash" );
                    $('#show_hide_password i').addClass( "fa-eye" );
                }
            });
        });
    </script>
@endsection
