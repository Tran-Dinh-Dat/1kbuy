@extends('templates.onekbuy.master')
@section('content')
    <div class="content">
        <div class="shop-background">
            <div class="container container-shop">
                <div class="row row-shop">
                    <div class="col-12 col-lg-8 col-xl-9 shop-left ">
                        <div class="row row-post-item">
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="post-image">
                                    <img src={{asset('./upload/images/'.$notification->image)}} alt="">
                                </div>
                                <div class="post-text">
                                    <h1>{{$notification->title}}</h1>
                                </div>
                                @if ($notification->excel)
                                <div class="wp-block-file">
                                    <h4>Tài liệu tham khâo</h4>
                                    <a href="{{ asset('upload/excel/'. $notification->excel)}}" class="btn btn-dark mb-3" download="">Download</a>
                                </div>
                            @endif
                                <div class="post-text">
                                    <p>{!!$notification->content!!}</p>
                                </div>
                              
                            </div>
        
                            <div class="col-6 col-xl-6 pl-3 word-blue">
                                @if (isset($previous))
                                    <a href={{route('onekbuy.notification.show',['id' => $previous->id,'slug' => $previous->slug])}}>
                                        <h5><i>Previous</i></h5>
                                    <h6><i>{{$previous->title}}</i></h6>
                                    </a>
                                @endif
                            </div>
        
                            <div class="col-6 col-xl-6 d-flex justify-content-end pr-3 word-blue">
                                @if (isset($next))
                                    <a href={{ route('onekbuy.notification.show',['id' => $next->id,'slug' => $next->slug]) }}>
                                        <h5><i>Next</i></h5>
                                        <h6><i>{{$next->title}}</i></h6>
                                    </a>
                               @endif
                            </div>
        
                        </div>
        
        
                        <div style="clear:both;"></div>

                    </div>
                    @include('templates.onekbuy.notification-bar')
                </div>
            </div>
        </div>  
    </div>
@stop
@section('js')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        }
      
        function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        }
        $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
        })
      </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
@endsection