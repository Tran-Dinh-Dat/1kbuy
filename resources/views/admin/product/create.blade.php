@extends('templates.admin.master')
@section('content')
<style type="text/css">
    input[type="file"] {
      display: block;
    }
    .imageThumb {
      height: 120px;
      width: 100px;
      border: 2px solid;
      padding: 1px;
      cursor: pointer;
      object-fit: cover
    }
    .pip {
      display: inline-block;
      margin: 10px 10px 0 0;
    }
    .remove {
      display: block;
      background: #444;
      border: 1px solid black;
      color: white;
      text-align: center;
      cursor: pointer;
    }
    .remove:hover {
      background: white;
      color: black;
    }
</style>
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
                            <li><a href="#">Sản phẩm</a></li>
                            <li class="active">Thên sản phẩm</li>
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
                    <div class="card-header"><strong>Thêm sản phẩm</strong></div>
                    @include('errors.success')
                    <form action="{{ route('admin.product.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body card-block">
                            <div class="form-group">
                              <label for="">Danh mục sản phẩm</label>
                              <select class="form-control px-18 py-0" name="category_id" id="">
                                  @foreach ($categories as $item)
                                    <option value="{{$item->id}}">{{ $item->name}}</option>
                                  @endforeach
                              </select>
                            </div>
                            <div class="form-group">
                                <label for="street" class=" form-control-label">Tên sản phẩm</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name')}}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                              <label for="street" class=" form-control-label">Mã sản phẩm</label>
                              <input type="text" name="sku" class="form-control" value="{{ old('sku')}}">
                              @if ($errors->has('sku'))
                                  <span class="text-danger">{{ $errors->first('sku') }}</span>
                              @endif
                          </div>

                            <div class="form-group">
                                <label for="description" class=" form-control-label">Mô tả</label>
                                <textarea name="description" class="form-control " id="editor1">{!! old('description')!!}</textarea>
                                @if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                              <label for="size" class=" form-control-label">Quy cách size <span class="text-danger">* Ví dụ: "S, M, L"</span></label>
                              <input type="text" name="size" class="form-control" value="{{ old('size')}}">
                              @if ($errors->has('size'))
                                  <span class="text-danger">{{ $errors->first('size') }}</span>
                              @endif
                          </div>
                            
                            <div class="form-group">
                                <label for="price" class=" form-control-label">Ship</label>
                                <input type="text" name="ship" class="form-control" value="{{ old('ship')}}">
                                @if ($errors->has('ship'))
                                    <span class="text-danger">{{ $errors->first('ship') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="price" class=" form-control-label">Giá</label>
                                <input type="text" name="price" class="form-control" value="{{ old('price')}}">
                                @if ($errors->has('price'))
                                    <span class="text-danger">{{ $errors->first('price') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="promotion_price" class=" form-control-label">Giá khuyến mãi</label>
                                <input type="number" name="promotion_price" class="form-control" value="{{ old('promotion_price')}}">
                                @if ($errors->has('promotion_price'))
                                    <span class="text-danger">{{ $errors->first('promotion_price') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                              <label for="">Ảnh sản phẩm</label>
                              <input type="file" class="form-control-file" name="image" id="">
                              @if ($errors->has('image'))
                                  <span class="text-danger">{{ $errors->first('image') }}</span>
                              @endif
                            </div>
                            <div class="form-group">
                                <label class="control-label">Ảnh slide:</label>
                                <div class="field" align="left">
                                  <input type="file" id="files" name="files[]" multiple />
                                  @if ($errors->has('files'))
                                      <span class="text-danger">{{ $errors->first('files') }}</span>
                                  @endif
                                </div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      if (window.File && window.FileList && window.FileReader) {
        $("#files").on("change", function(e) {
          var files = e.target.files,
            filesLength = files.length;
          for (var i = 0; i < filesLength; i++) {
            var f = files[i]
            var fileReader = new FileReader();
            fileReader.onload = (function(e) {
              var file = e.target;
              $("<span class=\"pip\">" +
                "<img class=\"imageThumb\" width='100px' src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                "<br/><span class=\"remove\">Remove image</span>" +
                "</span>").insertAfter("#files");
              $(".remove").click(function(){
                $(this).parent(".pip").remove();
              });
              
              
            });
            fileReader.readAsDataURL(f);
          }
        });
      } else {
        alert("Your browser doesn't support to File API")
      }
    });
</script>
@endsection
