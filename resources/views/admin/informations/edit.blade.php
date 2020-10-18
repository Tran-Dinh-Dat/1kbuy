@extends('templates.admin.master')
@section('content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Trang Chủ</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Trang chủ</a></li>
                            <li><a href="#">Thông tin</a></li>
                            <li class="active">Thên thông tin</li>
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
                    <div class="card-header"><strong>Thêm thông tin</strong></div>
                    @include('errors.success')
                    <form action="{{ route('admin.informations.update',$information->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body card-block">
                    
                            <div class="form-group">
                                <label for="title" class=" form-control-label">HOME</label>
                                <input type="text" name="home" class="form-control" value="{{$information->home}}">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('home') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="title" class=" form-control-label">SHOP</label>
                                <input type="text" name="shop" class="form-control" value="{{$information->shop}}">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('shop') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="title" class=" form-control-label">BLOG</label>
                                <input type="text" name="blog" class="form-control" value="{{$information->blog}}">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('blog') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="title" class=" form-control-label">NOTIFY</label>
                                <input type="text" name="notify" class="form-control" value="{{$information->notify}}">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('notify') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Banner trên: (width: 1300 px)</label>
                                <input type="file" class="form-control-file" name="banner">
                            </div>
                            <div class="form-group">
                                <label for="title" class=" form-control-label">Link banner</label>
                                <input type="text" name="link" class="form-control" value="{{$information->link}}">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('link') }}</p>
                            </div>

                            <div class="form-group">
                                <label for="title" class=" form-control-label">Phone</label>
                                <input type="text" name="phone" class="form-control" value="{{$information->phone}}">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('phone') }}</p>
                            </div>

                            <div class="form-group">
                                <label for="" class=" form-control-label">Address</label>
                                <input type="text" name="address" class="form-control" value="{{$information->address}}">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('address') }}</p>
                            </div>

                            <div class="form-group">
                                <label for="description" class=" form-control-label">Email</label>
                                <input type="text" name="email" class="form-control" value="{{$information->email}}">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('email') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="description" class=" form-control-label">Xem phổ biển</label>
                                <input type="text" name="phobien" class="form-control" value="{{$information->phobien}}">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('phobien') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="description" class=" form-control-label">Đề xuất hấp dẫn</label>
                                <input type="text" name="dexuat" class="form-control" value="{{$information->dexuat}}">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('dexuat') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="description" class=" form-control-label">Lựa chọn nhiều nhất</label>
                                <input type="text" name="luachon" class="form-control" value="{{$information->luachon}}">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('luachon') }}</p>
                            </div>

                            <div class="form-group">
                                <label for="copyright" class=" form-control-label">Copyright</label>
                                <textarea name="copyright" class="form-control">{!!$information->copyright!!}</textarea>
                                <p class="help is-danger" style="color:red;">{{ $errors->first('copyright') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="bocongthuong" class=" form-control-label">Link bộ công thương nếu có:(Không nên sửa phần này nếu chưa đăng ký bộ công thương)</label>
                                <textarea name="bocongthuong" class="form-control">{!!$information->bocongthuong!!}</textarea>
                                <p class="help is-danger" style="color:red;">{{ $errors->first('bocongthuong') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="description" class=" form-control-label">Javascript quản lý</label>
                                <textarea name="header" class="form-control">{{$information->header}}</textarea>
                                <p class="help is-danger" style="color:red;">{{ $errors->first('header') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Logo header</label>
                                <input type="file" class="form-control-file" name="logo" id="">
                            </div>
                            <div class="form-group">
                                <label for="">Logo footer</label>
                                <input type="file" class="form-control-file" name="logofooter" id="">
                            </div>
                            <div class="form-group">
                                <label for="description" class=" form-control-label">Slogan</label>
                                <input type="text" name="slogan" class="form-control" value="{{$information->slogan}}">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('slogan') }}</p>
                            </div>

                            <div class="form-group">
                                <label for="header" class=" form-control-label">Nội dung</label>
                                <textarea name="description" class="form-control " id="editor1">{!! $information->description!!}</textarea>
                                <p class="help is-danger" style="color:red;">{{ $errors->first('description') }}</p>
                            </div>
                             
                            <button type="submit" class="btn btn-primary">Sửa</button>
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