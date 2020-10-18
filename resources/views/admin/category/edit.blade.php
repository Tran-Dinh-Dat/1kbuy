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
                            <li><a href="#">Danh mục sản phẩm</a></li>
                            <li class="active">Cập nhật danh mục sản phẩm</li>
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
                    <div class="card-header"><strong>Cập nhật danh mục sản phẩm</strong></div>
                    @include('errors.success')
                    <form action="{{ route('admin.category.update', $category->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body card-block">
                            <div class="form-group">
                                <label for="name" class=" form-control-label">Tên danh mục</label>
                                <input type="text" name="name" class="form-control" value="{{ $category->name}}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Ảnh sản phẩm</label>
                                <img src="{{ asset('upload/images/'. $category->image)}}" width="100px"  alt="">
                                <input type="file" class="form-control-file" name="image" id="">
                              </div>
                            <div class="form-group">
                                <label for="position" class=" form-control-label">Vị trí</label>
                                <input type="number" name="position" class="form-control" value="{{ $category->position}}">
                                @if ($errors->has('position'))
                                    <span class="text-danger">{{ $errors->first('position') }}</span>
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