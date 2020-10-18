 <!-- Right Panel -->
 <div id="right-panel" class="right-panel">
    <!-- Header-->
    <header id="header" class="header">
        <div class="top-left">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ route('admin.index')}}"><img src="{{asset('asset/admin/images/logo.png')}}" alt="Logo"></a>
                <a class="navbar-brand hidden" href="{{ route('admin.index')}}"><img src="{{asset('asset/admin/images/logo2.png')}}" alt="Logo"></a>
                <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
            </div>
        </div>
        <div class="top-right">
            <div class="header-menu">
                <div class="user-area dropdown float-right">
                    <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="user-avatar rounded-circle" src="{{asset('upload/images/avatar.png')}}" alt="User Avatar">
                    </a>

                    <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="{{ route('admin.edit')}}"><i class="fa fa-power -off"></i>Đổi mật khẩu</a>
                        <a class="nav-link" href="{{ route('admin.resetPassword')}}"><i class="fa fa-power -off"></i>Reset mật khẩu</a>
                        <a class="nav-link" href="{{ route('auth.admin.logout')}}"><i class="fa fa-power -off"></i>Đăng xuất</a>
                    </div>
                </div>

            </div>
        </div>
    </header>
    <!-- /#header -->