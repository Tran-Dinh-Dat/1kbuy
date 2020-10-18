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
                            <li><a href="#">Nền tảng thanh toán</a></li>
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
                    <div class="card-header"><strong>Sửa nền tảng thanh toán</strong></div>
                    @include('errors.success')
                    <form action="{{ route('admin.payment.update', $payment->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body card-block">
                    
                            <div class="form-group">
                                <label for="title" class=" form-control-label">Tên nền tảng thanh toán</label>
                                <input type="name" name="name" class="form-control" value="{{  $payment->name}}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            
                            <div class="form-group">
                              <label for="">Loại nền tảng thanh toán</label>
                              <select class="form-control" name="type" style="padding-top: 7px">
                                <option {{ $payment->type == 1 ? 'selected' : ''}} value="1">Ví điện tử</option>
                                <option {{ $payment->type == 2 ? 'selected' : ''}} value="2">Tài khoản ngân hàng</option>
                              </select>
                            </div>
                            <div class="form-group">
                                <label for="">Logo</label>
                            <input type="file" class="form-control-file" name="logo" value="{{ $payment->logo}}">
                                <img width="100px" src="{{ asset('upload/images/'. $payment->logo)}}" alt="{{ $payment->name}}">
                                @if ($errors->has('logo'))
                                <span class="text-danger">{{ $errors->first('logo') }}</span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Sửa</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div>
@endsection
