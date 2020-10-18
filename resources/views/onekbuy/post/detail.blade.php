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
                                    <img src="{{asset('./upload/images/'.$post->image)}}" alt="{{ $post->title }}">
                                </div>
                                <div class="post-text">
                                    <h2>{{$post->title}}</h2>
                                </div>
                                <div class="post-text">
                                    <p>{!!$post->content!!}</p>
                                </div>
                            </div>
        
                            <div class="col-6 col-xl-6 pl-3 word-blue">
                                @if (isset($previous))
                                    <a href={{route('onekbuy.post.detail',['id' => $previous->id,'slug' => $previous->slug])}}>
                                        <h5><i>Previous</i></h5>
                                    <h6><i>{{$previous->title}}</i></h6>
                                    </a>
                                @endif
                            </div>
        
                            <div class="col-6 col-xl-6 d-flex justify-content-end pr-3 word-blue">
                                @if (isset($next))
                                    <a href={{ route('onekbuy.post.detail',['id' => $next->id,'slug' => $next->slug]) }}>
                                        <h5><i>Next</i></h5>
                                        <h6><i>{{$next->title}}</i></h6>
                                    </a>
                               @endif
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                    @include('templates.onekbuy.post-bar')
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
@section('header')
    <title>{{ $post->title }} Mua sắm trả góp 1.000 đồng mỗi ngày</title>
    <meta name="keywords" content="1kbuy, one k buy, 1k buy" />
    <meta name="news_keywords" content="1kbuy, one k buy, 1k buy" />
    <meta name="description" content="⭐Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn. ⭐ Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn" />
    <link rel="canonical" href="{{ route('onekbuy.post.detail', ['slug' => $post->slug, 'id' => $post->id]) }}" />
    <!-- Meta for Google -->
    <meta property="og:title" itemprop="name" content="{{ $post->title }}" />    
    <meta property="og:url" itemprop="url" content="{{ route('onekbuy.post.detail', ['slug' => $post->slug, 'id' => $post->id]) }}" />
    <meta property="og:description" content="Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn. Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn" />
    <meta property="og:image" content="https://1kbuy.vn/upload/images/{{ $post->image }}"  itemprop="thumbnailUrl" />
    <!-- Meta for Facebook -->
    <meta property="twitter:description" content="Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn. Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn" />
    <meta property="twitter:title" itemprop="name" content="{{ $post->title }}" />    
    <meta name="twitter:image" content="https://1kbuy.vn/upload/images/{{ $post->image }}" />
@endsection