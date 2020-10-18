<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Init HTML</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body style="margin: 0; padding: 0;">

    <div
        style="background: #fafbfc; margin: 0px; min-height: 300px; padding: 0px 30px 15px; font-family: 'Open+Sans', 'Open Sans', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.5;">
        <div style="max-width: 600px; margin: 0 auto;">
            <div style="text-align: center; padding-bottom: 20px; padding-top: 30px;">
                <span style="font-weight: 700; font-size: 32px; color: #000;">Đăng ký thành công</span>
            </div>
            <div style="border-top: 3px solid #B1E0E6; color: #525c65; padding: 10px; background: #fff;">

                <p style="margin: 5px 0;color: #000; font-weight:600">Xin chào bạn {{$data['name']}},</p>
                <p style="margin: 5px 0;color: #525c65">Bạn đã đăng ký thành viên 1kbuy.vn thành công vào thời gian {{$data['created_at']}}.
                     Chúng tôi rất vui vì bạn đã và sẻ tin tưởng sử dụng nền tảng và kết nối với mọi thành viên khác. Để hoàn tất quá trình đăng ký và trải nghiệm bạn hãy nhấn vào kích hoạt bên dưới.”</p>
            </div>  

            <div class="" style="text-align: center">
            <a href="{{route('auth.mail.activeAccount',$data['verify_token'])}}">
                <button type="button" 
                        style="background-color:#B1E0E6!important;border-color: #B1E0E6 ; 
                        margin-top:0px; margin-bottom:20px;padding: .375rem .75rem; font-size: 1rem;
                        border-radius: .25rem;border: 1px solid transparent;">Kích
                        Hoạt
                    </button>
                </a>


            </div>
            <div style="text-align: center;"><img style="max-width: 100%;"
                    src="https://www.inithtml.com/demo/email/shadow.png" alt="Shadow" /></div>
            <div style="text-align: center; margin-top: 45px; margin-bottom: 45px;">
                <div style="margin-bottom: 30px;">
                    <a href="#" style="margin-right: 20px;"><img alt=""
                            src="https://image.flaticon.com/icons/svg/1384/1384053.svg" width="26" height="26" /></a>
                    <a href="#" style="margin-right: 20px"><img alt=""
                            src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fb/Facebook_icon_2013.svg/300px-Facebook_icon_2013.svg.png"
                            width="26" height="26" /></a>

                </div>
            </div>
        </div>
    </div>
    <div
        style="text-align: center; background:#B1E0E6; padding: 10px 0; color: #fff; font-family: 'Open+Sans', 'Open Sans', Helvetica, Arial, sans-serif; font-size: 14px;">
        Cảm ơn bạn!</div>
</body>

</html>