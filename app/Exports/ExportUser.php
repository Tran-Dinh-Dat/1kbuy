<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithDrawings;
use DB;
use App\Models\Information;
use Illuminate\Support\Facades\File;

class ExportUser implements FromCollection, WithHeadings, ShouldAutoSize, WithDrawings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
	        ['ID','Tên người dùng','Email','Số tiền trong ví','Địa chỉ', 'Số điện thoại','Ngày đăng kí', 'Ngày kích hoạt', 'VIP'],
        ];
    }

    public function __construct($yesterday, $today){
        $this->yesterday = $yesterday;
        $this->today = $today;
    }

    public function collection()
    {
        $yesterday = $this->yesterday;
        $today = $this->today;
        $query = "SELECT users.id as uid, name, email, credit_total, address, phone_number, users.created_at as created, email_verified_at, vip FROM users 
        INNER JOIN profile ON users.id = profile.user_id
        INNER JOIN wallet ON users.id = wallet.user_id
        WHERE users.created_at BETWEEN '$yesterday' AND  '$today' ORDER BY uid ASC";
        $users = DB::select($query);
        foreach($users as $item){
            if($item->vip == 1){
                $item->vip = 'VIP';
            }else{
                $item->vip = 'Không';
            }
        }
        $alluser = collect($users);
        return $alluser;
    }

    public function drawings()
    {
    	$info = Information::find(1)->first();
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath('./upload/images/'. $info->logo);
        $drawing->setHeight(200);
        $drawing->setCoordinates('I1');

        return $drawing;
    }
}
