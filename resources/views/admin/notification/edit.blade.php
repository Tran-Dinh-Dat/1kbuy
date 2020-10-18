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
                            <li><a href="#">Thông báo</a></li>
                            <li class="active">Sửa thông báo</li>
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
                    <div class="card-header"><strong>Sửa thông báo</strong></div>
                    @include('errors.success')
                    <form action="{{ route('admin.notification.update', $notification->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body card-block">
                    
                            <div class="form-group">
                                <label for="title" class=" form-control-label">Tiêu đề</label>
                                <input type="text" name="title" class="form-control" value="{{ $notification->title}}">
                                @if ($errors->has('title'))
                                    <span class="text-danger">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                <label for="description" class=" form-control-label">Mô tả</label>
                                <input type="text" name="description" class="form-control" value="{{ $notification->description }}">
                                @if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                <label for="content" class=" form-control-label">Nội dung</label>
                                <textarea name="content" class="form-control " id="editor1">{!! $notification->content !!}</textarea>
                                @if ($errors->has('content'))
                                    <span class="text-danger">{{ $errors->first('content') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="">Ảnh</label>
                                <img style="width: 150px" src="{{ asset('upload/images/'. $notification->image)}}" alt="">
                                <input type="file" class="form-control-file" name="image" id="">
                                @if ($errors->has('content'))
                                    <span class="text-danger">{{ $errors->first('image') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="">File excel</label>
                                <input type="file" class="form-control-file" name="excel" accept=".xlsx, .xls, .csv">
                                @if ($errors->has('excel'))
                                    <span class="text-danger">{{ $errors->first('excel') }}</span>
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
<script>
    var options = {
      filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
      filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
      filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
      filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
</script>
<script>
    CKEDITOR.replace('editor1', options);
</script>

<script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
<script>
$('textarea.editor1').ckeditor(options);
</script>
@endsection