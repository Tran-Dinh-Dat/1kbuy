<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use DB;

class RefundExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            ['#','Yêu cầu hoàn tiền'],
            ['ID','Tên khách hàng','Email','Giá trị hoàn tiền', 'Số điện thoại' ,'Phương thức thanh toán', 'Chủ tài khoản', 'Số tài khoản', 'Trạng thái','Thời gian yêu cầu', 'Thời gian hoàn tiền'],
        ];
    }

    public function collection()
    {
        $query = "SELECT id, name, email, refund_value, phone, payment,  account_holder,  account_number, status, created_at, updated_at  FROM refund";
        $refunds = DB::select($query);
        foreach($refunds as $item){
        	// $c_at = strtotime($item->created_at);
        	// $u_at = strtotime($item->updated_at);
            // $item->created_at = date("Y-m-d G:i:s", strtotime('+7 hours',$c_at));
            // $item->updated_at = date("Y-m-d G:i:s", strtotime('+7 hours',$u_at));
            if($item->status == 1){
                $item->status = 'Đã hoàn thành';
            }else{
                $item->status = 'Đang chờ';
            }
        }
        $allRefunds = collect($refunds);
        return $allRefunds;
    }
}
