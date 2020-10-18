@extends('templates.admin.master')
@section('content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Trang chủ</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Trang chủ</a></li>
                            <li><a href="#">User</a></li>
                            <li class="active">Tạo tài khoản</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <!--/.col-->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Cập nhật tài khoản</strong></div>
                    @include('errors.success')
                    <form action="{{ route('admin.edit')}}" method="post">
                        @csrf
                        <div class="card-body card-block">
                            <div class="form-group">
                                <label for="street" class=" form-control-label">Tên email</label>
                                <input type="text" name="email" class="form-control" value="{{ $user->email}}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="password" class=" form-control-label">Password</label>
                                <input type="password" name="password" class="form-control" value="">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div>
@endsection