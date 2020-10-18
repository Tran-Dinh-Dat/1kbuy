    <footer>
        <section class="footer-main" style="background-color: #ADD8E6;">
            <div class="container footer-custom">
                <div class="row footer-custom">
                    <div class="col-12 col-sm-6 col-xl-3" style="font-size: 18px">

                    <a href="{{route('onekbuy.index.index')}}"><img class="img-center" src="{{asset('./upload/images/'.$information->logofooter)}}" alt=""> </a>
                        <p>{!!$information->description!!}</p>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3">
                        <h4 style="color:#000055;font-size:140%;margin-bottom: 25px;"><i>NỀN TẢNG THANH TOÁN</i></h4>
                        <h5><i>Ví Điện Tử</i></h5>
                        <div>
                         @php
                            $wallet = $V_payment_wallet->chunk(3);
                            $bank = $V_payment_bank->chunk(3);
                         @endphp
                            @if(isset($wallet[0]))
                                @foreach ($wallet[0] as $wallet1)
                                    <a href="{{ route('onekbuy.post.info', 'thanh-toan') }}"><img src="{{ asset('upload/images/'. $wallet1->logo)}}" alt="" class="vi-dien"></a>
                                @endforeach
                            @endif
                        </div>
                        <div>
                            @if(isset($wallet[1]))
                                @foreach ($wallet[1] as $wallet2)
                                    <a href="{{ route('onekbuy.post.info', 'thanh-toan') }}"><img src="{{ asset('upload/images/'. $wallet2->logo)}}" alt="" class="vi-dien"></a>
                                @endforeach
                            @endif
                        </div>

                        <h5><i>Tài Khoản Ngân Hàng</i></h5>
                        <div>
                            @if(isset($bank[0]))
                                @foreach ($bank[0] as $bank1)
                                    <a href="{{ route('onekbuy.post.info', 'thanh-toan') }}"><img src="{{ asset('upload/images/'. $bank1->logo)}}" alt="" class="vi-dien"></a>
                                @endforeach
                            @endif
                        </div>
                        <div>
                            @if(isset($bank[1]))
                                @foreach ($bank[1] as $bank2)
                                    <a href="{{ route('onekbuy.post.info', 'thanh-toan') }}"><img src="{{ asset('upload/images/'. $bank2->logo)}}" alt="" class="vi-dien"></a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3" style="font-size: 18px">
                        <h4 style="color:#000055;font-size:140%;margin-bottom: 25px;"><i>VỀ 1KBUY VIỆT NAM</i></h4>
                        <p><strong>Địa chỉ : </strong>{{$information->address}}</p>
                        <p><strong>Hotline : </strong>{{$information->phone}}</p>
                        <p><strong>Email : </strong>{{$information->email}}</p>
                        <h5><a href="{{ route('onekbuy.index.sitemap') }}" target="_blank"><i style="color: black">Sơ đồ website</i></a></h5>
                        @if(!$information->bocongthuong)
                        <div class="container">
                            <a href="https://www.moit.gov.vn/"><img src="/asset/onekbuy/image/bo-cong-thuong-1.png" alt="" width="70%" style="margin-bottom: 15px"></a>
                            <a href="https://www.moit.gov.vn/"><img src="/asset/onekbuy/image/bo-cong-thuong-2.png" alt="" width="70%"></a>
                        </div>
                        @else
                            {!! $information->bocongthuong !!}
                        @endif
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3">
                        <h4 style="font-size:140%;margin-bottom:25px;"><i>THÔNG TIN CẦN BIẾT</i></h4>
                        @foreach($question_footer as $question)
                        <h5 style="margin-bottom:20px;"><a href="{{route('onekbuy.post.info', $question->slug)}}" target="_blank"><i class="hover-ifor" style="color:#000055">{{ $question->title }}</i></a></h5>
                        @endforeach
                    </div>
                </div>
            </div>

        </section>
        <div class="footer-bottom" style="background-color: #E6E6FA;">
            <div class="container">
                <div class="row">
                    {!! $information->copyright !!}
                </div>
            </div>
        </div>
    </footer>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/5efd48834a7c6258179bb9b1/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
{{-- <script>
    $( document).ready(function() {
        $('#lzd-nav-cart-mb').removeClass('d-none');
    });
</script> --}}
    <!--End of Tawk.to Script-->
@yield('js')
</body>
    
</html>