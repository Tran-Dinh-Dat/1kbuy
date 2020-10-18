@extends('../templates/admin/master')
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
                            <li><a href="#" class="active">Sản phẩm</a></li>
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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Nhập dữ liệu sản phẩm sản phẩm</strong>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8 offset-2">
                                <form action="{{ route('admin.product.import')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @include('errors.error')
                                    <a class="btn btn-warning mb-3" href="{{ asset('upload/excel/products.xlsx')}}">Tải dữ liệu mẫu</a>

                                    <div class="custom-file mb-5" >
                                        <input type="file" class="custom-file-input " id="customFile" name="import">
                                        <label class="custom-file-label" for="customFile">Chọn tệp</label>
                                        <span class="text-danger">* Tệp import cần đúng với cấu trúc dữ liệu mẫu </span>
                                      </div>
                                    <button type="submit" class="btn btn-primary text-white">Nhập dữ liệu</button>
                                    <a class="btn btn-success " href="{{ route('admin.product.exportproduct')}}">Xuất toàn bộ sản phẩm</a>
                                </form>
                            </div>
                        </div>
                    </div>
                
                    
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div>
{{-- <div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-2">
                <form action="{{ route('admin.product.import')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('errors.error')
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="import">
                        <label class="custom-file-label" for="customFile">Chọn tệp</label>
                      </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <a class="btn btn-warning" href="">Export User Data</a>
            </div>
        </div>
    </div>
</div> --}}
@endsection
