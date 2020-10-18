<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Init HTML</title>
    <link rel="stylesheet" href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'>
</head>
<style>
    tbody tr td {
        padding: 5px 10px;
    }
</style>
<body style="margin: 0; padding: 0;">
    <div
        style="background: #FAFBFC; margin: 0px; min-height: 300px; padding: 0px 30px 15px; font-family: ‘Open+Sans’, ‘Open Sans’, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.5;">
        <div style="max-width: 700px; margin: 0 auto;">
            <div style="text-align: center; padding-bottom: 20px; padding-top: 30px;">
                <span style="font-weight: 700; font-size: 32px; color: #000;">Yêu cầu hoàn tiền!</span>
            </div>
            <div style="border-top: 3px solid #B1E0E6; color: #525C65; padding: 10px; background: #fff;">
                <p style="margin: 5px 0;color: #525C65">Xin chào Admin</p>
                <p style="margin: 5px 0;color: #525C65">Yêu cầu hoàn tiền của tôi</p>
                <div>
                    <table>
                        <tbody>
                            <tr>
                                <td scope="row">Id</td>
                                <td>Họ và tên</td>
                                <td>Email</td>
                                <td>Số điện thoại</td>
                                <td>Phương thức thanh toán</td>
                                <td>Chủ tài khoản</td>
                                <td>Số tài khoản</td>
                                <td>Số tiền</td>
                            </tr>
                            <tr>
                                <td scope="row">16</td>
                                <td>{{ $data['r_name']}}</td>
                                <td>{{ $data['r_email']}}</td>
                                <td>{{ $data['r_phone']}}</td>
                                <td>{{ $data['r_payment']}}</td>
                                <td>{{ $data['r_account_holder']}}</td>
                                <td>{{ $data['r_account_number']}}</td>
                                <td>{{ number_format($data['r_refund_value'])}} vnd</td>
                            </tr>
                        </tbody>
                </table>
                </div>
            </div>
          
            
            <div class="" style="text-align: center">
                <a href="{{ route('onekbuy.index.index') }}">
                <button type="button"
                        style="background-color:#B1E0E6!important;border-color: #B1E0E6 ;
                        margin-top:0px; margin-bottom:20px;padding: .375rem .75rem; font-size: 1rem;
                        border-radius: .25rem;border: 1px solid transparent;">Trang chủ
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