@extends('templates.admin.master')
@section('content')

<div class="content">                    
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Edit Profile</h5>
                </div>
                <div class="card-body">
                    @include('errors.error')
                    <form action="{{ route('admin.profile.update', $user->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-5 pr-1">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" disabled="" value="{{ $user->email}}">
                                </div>
                            </div>
                            <div class="col-md-3 px-1">
                                <div class="form-group">
                                    <label>Họ và tên</label>
                                    <input type="text" name="fullname" class="form-control" placeholder="Username" value="{{ $user->name}}">
                                </div>
                            </div>
                            <div class="col-md-4 pl-1">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số điện thoại</label>
                                    <input type="text" name="phone_number" class="form-control" value="{{ $user->profile->phone_number}}">
                                </div>
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label>Giới tính</label>
                                    <input type="text" name="gender" class="form-control" value="{{ $user->profile->gender}}">
                                </div>
                            </div>
                            <div class="col-md-6 pl-1">
                                <div class="form-group">
                                    <label>Ngày sinh</label>
                                    <input type="date" name="birthday" class="form-control" value="{{date('Y-m-d', strtotime($user->profile->birthday))}}">
                                </div>
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <input type="text" name="address" class="form-control" value="{{ $user->profile->address}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="">Avatar</label>
                          <input type="file" class="form-control-file" name="avatar">
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-user">
                <div class="image">
                    <img src="https://demos.creative-tim.com/now-ui-dashboard/assets/img/bg5.jpg" alt="...">
                </div>
                <div class="card-body">
                    <div class="author">
                        <a href="#">
                        <img class="avatar border-gray" src="{{$user->profile->avatar ? asset('upload/images/'.$user->profile->avatar) : asset('upload/images/avatar.png')}}" alt="...">
                            <h5 class="title">{{ $user->profile->fullname}}</h5>
                        </a>
                        <p class="description">
                            {{ $user->name}}
                        </p>
                    </div>
                    {{-- <p class="description text-center">
                       
                    </p> --}}
                </div>
                <hr>
                <div class="button-container">
                    <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                    </button>
                    <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                    </button>
                    <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                        <i class="fa fa-google-plus" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection