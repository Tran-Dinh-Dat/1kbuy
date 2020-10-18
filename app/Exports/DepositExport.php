<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use DB;

class DepositExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            ['#','Yêu cầu nạp tiền'],
            ['ID', 'Tên khách hàng', 'Email', 'Số điện thoại', 'Phương thức thanh toán', 'Chủ tài khoản', 'Số tài khoản', 'Số tiền', 'Lời nhắn', 'Trạng thái','Thời gian yêu cầu', 'Thời gian nạp tiền'],
        ];
    }

    public function collection()
    {
        $query = "SELECT id, name, email, phone, payment,  account_holder,  account_number, money, message, status, created_at, updated_at  FROM depositrequest";
    
        $deposits = DB::select($query);
        foreach($deposits as $item){
            if($item->status == 1){
                $item->status = 'Đã hoàn thành';
            }else{
                $item->status = 'Đang chờ';
            }
        }
        $allDeposits = collect($deposits);
        return $allDeposits;
    }
}
