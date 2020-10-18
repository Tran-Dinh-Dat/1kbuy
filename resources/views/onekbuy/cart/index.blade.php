@extends('/templates.onekbuy.master')
@section('content')
<div class="content cart_wrapper">
    @include('onekbuy.cart.cart_item_cp')
</div>
@endsection
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("body").on("change",".js_location",function(e){
            e.preventDefault();
            let id =  $(event.target).val();
            let type = $(this).attr('data-type');
            var token = $("meta[name='csrf-token']").attr("content");
            $.ajax({
                url: "{{route('onekbuy.user.info.getLocation')}}", //or you can use url: "company/"+id,
                type: 'GET',
                method: 'GET',
                data: {
                    _token: token,
                    id: id,
                    type: type
                },
                success: function (response){
                    console.log(response.data);
                    if (response.data) {
                        var html = '';
                        var element = '';
                        if (type == 'province') {
                            html = '<option value="">--- Mời bạn chọn huyện ---</option>';
                            element = '#district_option';        
                        } 
                        if (type == 'district') {
                            html = '<option value="">--- Mời bạn chọn xã ---</option>';
                            element = '#ward_option';     
                        }
                       
                        $.each(response.data, function(index, value) {
                            html += '<option value="'+ value.id+'">'+ value._name +'</option>';
                        })
                        $(element).html(' ').append(html);
                    }
                }
            });
                return false;
            });
        });
        </script>
        {{-- load quan huyen mobile --}}
        <script type="text/javascript">
            $(document).ready(function () {
                $("body").on("change",".js_location_mb",function(e){
                e.preventDefault();
                let id =  $(event.target).val();
                let type = $(this).attr('data-type');
                var token = $("meta[name='csrf-token']").attr("content");
                $.ajax({
                    url: "{{route('onekbuy.user.info.getLocation')}}", //or you can use url: "company/"+id,
                    type: 'GET',
                    method: 'GET',
                    data: {
                        _token: token,
                        id: id,
                        type: type
                    },
                    success: function (response){
                        console.log(response.data);
                        if (response.data) {
                            var html = '';
                            var element = '';
                            if (type == 'province') {
                                html = '<option value="">--- Mời bạn chọn huyện ---</option>';
                                element = '#district_option_mb';        
                            } 
                            if (type == 'district') {
                                html = '<option value="">--- Mời bạn chọn xã ---</option>';
                                element = '#ward_option_mb';     
                            }
                           
                            $.each(response.data, function(index, value) {
                                html += '<option value="'+ value.id+'">'+ value._name +'</option>';
                            })
                            $(element).html(' ').append(html);
                        }
                    }
                });
                    return false;
                });
            });
            </script>

<script>
    function cartUpdate(event) {
        event.preventDefault(); 
        let id = $(this).data('id');
        let qty = $(this).val();
        $.ajax({
            type: 'GET',
            url: "{{ route('onekbuy.order.update')}}",
            data: {
                id: id,
                qty: qty
            },
            success: function(data) {
                if (data.code === 200) {
                    $('.cart_wrapper').html(data.cart_item_cp);
                }
            },
            error: function() {
            }
        });
    }

    function cartDelete(event) {
        event.preventDefault();
        let id = $(this).data('id');

        $.ajax({
            type: 'GET',
            url: "{{ route('onekbuy.order.destroy')}}",
            data: {
                id: id,
            },
            success: function(data) {
                if (data.code === 200) {
                    console.log(data);
                    $('.cart_wrapper').html(data.cart_item_cp);
                }
            },
            error: function() {

            }
        });
    }

    $(document).on('change', '.cart_update', cartUpdate);
    $(document).on('click', '.cart_delete', cartDelete);
   
</script>
<script>
$(document).ready(function() {
    $('#form_checkout').bind("keypress", function(e) {
        if (e.keyCode == 13) {               
            e.preventDefault();
            return false;
        }
    });
});
</script>
@endsection
@section('header')
    <title>Mua sắm trả góp 1.000 đồng mỗi ngày</title>
    <meta name="keywords" content="1kbuy, one k buy, 1k buy" />
    <meta name="news_keywords" content="1kbuy, one k buy, 1k buy" />
    <meta name="description" content="⭐Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn. ⭐ Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn" />
    <link rel="canonical" href="https://1kbuy.vn" />
    <!-- Meta for Google -->
    <meta property="og:title" itemprop="name" content="Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn" />    
    <meta property="og:url" itemprop="url" content="https://1kbuy.vn" />
    <meta property="og:description" content="Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn. Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn" />
    <meta property="og:image" content="https://1kbuy.vn/upload/images/1594351195Screenshot_2-removebg-preview.png"  itemprop="thumbnailUrl" />
    <!-- Meta for Facebook -->
    <meta property="twitter:description" content="Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn. Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn" />
    <meta property="twitter:title" itemprop="name" content="Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn" />    
    <meta name="twitter:image" content="https://1kbuy.vn/upload/images/1594351195Screenshot_2-removebg-preview.png" />
@endsection