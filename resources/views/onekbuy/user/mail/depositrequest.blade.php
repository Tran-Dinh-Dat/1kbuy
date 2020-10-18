<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Init HTML</title>
    <link rel="stylesheet" href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'
        >
</head>
<body style="margin: 0; padding: 0;">
    <div
        style="background: #FAFBFC; margin: 0px; min-height: 300px; padding: 0px 30px 15px; font-family: ‘Open+Sans’, ‘Open Sans’, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.5;">
        <div style="max-width: 700px; margin: 0 auto;">
            <div style="text-align: center; padding-bottom: 20px; padding-top: 30px;">
                <span style="font-weight: 700; font-size: 32px; color: #000;">Yêu cầu nạp tiền</span>
            </div>
            <div style="border-top: 3px solid #B1E0E6; color: #525C65; padding: 10px; background: #fff;">
                <p style="margin: 5px 0;color: #525C65">Xin chào Admin,</p>
                <p style="margin: 5px 0;color: #525C65">Đây là yêu cầu chuyển tiền của {{ $data['d_name']}}</p>
            </div>
            <div >
                <table class="table table-striped table-inverse table-responsive">
                    <tbody>
                        <tr>
                            <td scope="row">ID</td>
                            <td>Email</td>
                            <td>Số điện thoại</td>
                            <td>Phương thức</td>
                            <td>Chủ tài khoản</td>
                            <td>Số tài khoản</td>
                            <td>Số tiền</td>
                            <td>Nội dung</td>
                        </tr>
                        <tr>
                            <td scope="row">{{ $data['id']}}</td>
                            <td>{{ $data['d_email']}}</td>
                            <td>{{ $data['d_phone']}}</td>
                            <td>{{ $data['d_payment']}}</td>
                            <td>{{ $data['d_account_holder']}}</td>
                            <td>{{ $data['d_account_number']}}</td>
                            <td>{{ number_format($data['d_money']) }} vnd</td>
                            <td>{{ $data['d_message']}}</td>
                        </tr>
                    </tbody>
            </table>
            </div>
            <div class="" style="text-align: center">
                <a href="{{ route('admin.depositrequest.index')}}">
                <button type="button"
                        style="background-color:#B1E0E6!important;border-color: #B1E0E6 ;
                        margin-top:0px; margin-bottom:20px;padding: .375rem .75rem; font-size: 1rem;
                        border-radius: .25rem;border: 1px solid transparent;">Kiểm tra
                </button>
                </a>
            </div>
            <div style="text-align: center;"><img style="max-width: 100%;" 
                    src="https://www.inithtml.com/demo/email/shadow.png" alt="Shadow"></div>
            <div style="text-align: center; margin-top: 45px; margin-bottom: 45px;">
                <div style="margin-bottom: 30px;">
                    <a href="#" style="margin-right: 20px;"><img alt=""
                            src="https://image.flaticon.com/icons/svg/1384/1384053.svg" width="26" height="26"></a>
                    <a href="#" style="margin-right: 20px"><img alt=""
                            src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fb/Facebook_icon_2013.svg/300px-Facebook_icon_2013.svg.png"
                            width="26" height="26"></a>
                </div>
            </div>
        </div>
    </div>
    <div
        style="text-align: center; background:#B1E0E6; padding: 10px 0; color: #fff; font-family: ‘Open+Sans’, ‘Open Sans’, Helvetica, Arial, sans-serif; font-size: 14px;">
        Cảm ơn bạn!</div>
</body>
</html>