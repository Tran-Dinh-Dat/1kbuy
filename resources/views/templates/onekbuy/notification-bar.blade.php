<div class="col-12 col-lg-4 col-xl-3 shop-right">
    <div class="category">
        <form action="{{route('onekbuy.notification.search')}}" method="get">
            <div class="form-group">
                <input type="text" class="form-control" id="" aria-describedby="helpId"
                    placeholder="Tìm kiếm thông báo" name="title" required value="{{ request()->title}}">
                <button type="submit" class="button-blog"><i class="fa fa-search"
                        aria-hidden="true"></i></button>
            </div>
        </form>
    </div>

    <div class="category">
        <div class="text-category">
            <h6>Thông báo gần đây</h6>
        </div>
        <div class="recent-posts">
            <ul>
                @foreach ($V_rencentNotification as $item)
                    <li>
                        <a href={{route('onekbuy.notification.show',['id' => $item->id,'slug' => $item->slug])}}>{{$item->title}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    {{-- <div class="category">
        <div class="text-category">
            <h6>POPULAR POSTS</h6>
        </div>
        @foreach ($popularPosts as $item)
        <div class="products-3 d-flex justify-content-start">
            <div class="products-image-3">
                <a href={{route('onekbuy.post.detail',['id' => $item->id,'slug' => $item->slug]) }}>
                    <img src="{{ asset('upload/images/'. $item->image)}}"
                        alt="{{ $item->title}}" class="image-box-3"/>
                </a>
            </div>
            <div class="products-text-3">
                <div class="products-text-name">
                    <a href={{route('onekbuy.post.detail',['id' => $item->id,'slug' => $item->slug]) }}>
                        <h6>{{ $item->title}}</h6>
                    </a>
                </div>
                <div class="products-text-name">
                    <a href={{route('onekbuy.post.detail',['id' => $item->id,'slug' => $item->slug]) }}>
                        <p>{{date('d-m-Y', strtotime($item->created_at))}}</p>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div> --}}
</div>