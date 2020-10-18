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
                            <li><a href="#" class="active">Slide</a></li>
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
                        <strong class="card-title">Quản lý slide</strong>
                    </div>
                    <div class="card-header">
                        <a href="{{ route('admin.slide.create')}}" class="btn btn-success">Thêm</a>
                    </div>
                    <div class="">
                        <p class="mb-0 text-white" id="success"></p>
                    </div>
                    @include('errors.error')
                    <div class="table-stats order-table ov-h">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>Stt</th>
                                    <th>Hình ảnh</th>
                                    <th>Link</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($slides as $key => $item)
                                    <tr id="tableSlideId{{$item->id}}">
                                        <td>#{{ $key+1 }} </td>
                                        <td><img width="100px" src="{{ asset('upload/images/'. $item->image)}}" alt=""></td>
                                        <td><a href="">{{ $item->link}}</a> </td>
                                        <td>
                                            <a href="{{ route('admin.slide.edit', $item->id)}}" class="btn btn-info">Sửa</a>
                                            <a href="" data-toggle="modal" data-target="#modelId{{$item->id}}" class="btn btn-danger">Xóa</a>
                                            <!-- Button trigger modal -->
                                            
                                            <!-- Modal -->
                                            <div class="modal fade" id="modelId{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Bạn có châc chắn xóa bài viết này không?</h5>
                                                        </div>
                                                        
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                            <a href="{{ route('admin.slide.destroy', $item->id)}}" class="btn btn-danger deleteSlide" data-id="{{ $item->id }}" data-dismiss="modal">Xóa</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- /.table-stats -->
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div>
<div class="clearfix"></div>
@endsection
@section('javascript')
    <script src="{{ asset('asset/admin/assets/js/adminJs/slide.js')}}"></script>
@endsection