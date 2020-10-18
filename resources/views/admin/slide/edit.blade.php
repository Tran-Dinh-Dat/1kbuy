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
                            <li><a href="#">Slide</a></li>
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
                    <div class="card-header"><strong>Thêm slide</strong></div>
                    @include('errors.success')
                    <form action="{{ route('admin.slide.update', $slide->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body card-block">
                            <div class="form-group">
                                <label for="">Ảnh</label>
                                <input type="file" class="form-control-file" name="image">
                                <img style="width: 200px; margin: 10px" src="{{ asset('upload/images/'. $slide->image)}}" alt="">
                              </div>
                            <div class="form-group">
                                <label class=" form-control-label">Link</label>
                                <input type="text" name="link" class="form-control" value="{{ $slide->link }}">
                                @if ($errors->has('link'))
                                    <span class="text-danger">{{ $errors->first('link') }}</span>
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