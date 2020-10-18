@extends('templates.onekbuy.master')
@section('content')

    <div class="content">
        <div class="shop-background">
            <div class="container container-shop">
                <div class="row row-shop">
                    <div class="col-12 col-lg-8 col-xl-9 shop-left ">
                            @if($search->count()  > 0)
                            @foreach ($search as $item)
                            <div class="row row-blog-item">
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="blog-image">
                                        <a href={{route('onekbuy.post.detail',['id' => $item->id,'slug' => $item->slug]) }}>
                                            <img src="{{asset('./upload/images/'.$item->image)}}" alt="" class="image-box-3">
                                        </a>
                                    </div>
                                </div>
            
                                <div class="col-12 col-md-6 col-lg-8">
                                    <div class="blog-text">
                                    <a href={{route('onekbuy.post.detail',['id' => $item->id,'slug' => $item->slug]) }}>{{$item->title}}</a>
                                        <p style="">{!!$item->description!!}</p>
                                    </div>
                                </div>
                                
                            </div>
                            @endforeach
                            @else 
                            <p class="custom-notfound">Không tìm thấy tin tức nào</p>
                            @endif
                            
                            
                        
                        {{-- {{dd($search)}} --}}
                        <div style="clear:both;"></div>
                            <ul class="pagination">
                                {{ $search->links() }}
                            </ul>
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
    <title>Tin tức về 1kbuy.vn. Mua sắm trả góp 1.000 đồng mỗi ngày</title>
    <meta name="keywords" content="1kbuy, one k buy, 1k buy" />
    <meta name="news_keywords" content="1kbuy, one k buy, 1k buy" />
    <meta name="description" content="⭐Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn. ⭐ Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn" />
    <link rel="canonical" href="{{ route('onekbuy.post.search') }}" />
    <!-- Meta for Google -->
    <meta property="og:title" itemprop="name" content="Tin tức về 1kbuy.vn. Hệ thống mua hàng chỉ với 1.000 đồng" />    
    <meta property="og:url" itemprop="url" content="{{ route('onekbuy.post.search') }}" />
    <meta property="og:description" content="Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn. Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn" />
    <meta property="og:image" content="https://1kbuy.vn/upload/images/1594351195Screenshot_2-removebg-preview.png"  itemprop="thumbnailUrl" />
    <!-- Meta for Facebook -->
    <meta property="twitter:description" content="Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn. Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn" />
    <meta property="twitter:title" itemprop="name" content="Tin tức về 1kbuy.vn. Hệ thống mua hàng chỉ với 1.000 đồng" />    
    <meta name="twitter:image" content="https://1kbuy.vn/upload/images/1594351195Screenshot_2-removebg-preview.png" />
@endsection