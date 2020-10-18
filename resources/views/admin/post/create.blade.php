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
                            <li><a href="#">Tin tức</a></li>
                            <li class="active">Thên tin tức</li>
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
                    <div class="card-header"><strong>Thêm tin tức</strong></div>
                    @include('errors.success')
                    <form action="{{ route('admin.post.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body card-block">
                    
                            <div class="form-group">
                                <label for="title" class=" form-control-label">Tiêu đề</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title')}}">
                                @if ($errors->has('title'))
                                    <span class="text-danger">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="" class=" form-control-label">Từ khóa</label>
                                <input type="text" name="key_word" class="form-control" value="{{ old('key_word')}}">
                                @if ($errors->has('key_word'))
                                    <span class="text-danger">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="description" class=" form-control-label">Mô tả</label>
                                <input type="text" name="description" class="form-control" value="{{ old('description')}}">
                                @if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="content" class=" form-control-label">Nội dung</label>
                                <textarea name="content" class="form-control " id="editor1">{!! old('content')!!}</textarea>
                                @if ($errors->has('content'))
                                    <span class="text-danger">{{ $errors->first('content') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="content" class=" form-control-label">Loại tin tức</label>
                                <select class="form-control" name="active" style="padding:0 18px; height:calc(2.25rem + 3px)">
                                    <option value="1" selected>Tin tức</option>
                                    <option value="0">Câu hỏi thường gặp</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Ảnh</label>
                                <input type="file" class="form-control-file" name="image" id="">
                                @if ($errors->has('image'))
                                <span class="text-danger">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Thêm</button>
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