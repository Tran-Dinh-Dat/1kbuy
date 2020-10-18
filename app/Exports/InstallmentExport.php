<?php

namespace App\Exports;

use DB;
use App\Models\Information;
use App\Models\Product_User;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class InstallmentExport implements  FromCollection, WithHeadings, ShouldAutoSize, WithDrawings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
	        ['ID','Tên người dùng','Email', 'Địa chỉ', 'Số điện thoại', 'Tên sản phẩm', 'Giá sản phẩm', 'Size', 'Số tiền đã trả góp','Ngày đặt hàng'],
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
        
        $query = "SELECT DISTINCT product_user.id as puid, 
            users.name as username, 
            email, 
            profile.address as address,
            profile.phone_number as phone,
            products.name as productname,
            products.price as productprice, 
            product_user.size, 
            product_user.tien_tra_gop,
            product_user.created_at as created
        FROM product_user 
        INNER JOIN users ON users.id = product_user.user_id
        INNER JOIN profile ON profile.user_id = product_user.user_id
        INNER JOIN products ON products.id = product_user.product_id 
        WHERE product_user.created_at BETWEEN '$yesterday' AND  '$today' ORDER BY puid ASC";
        $orders = DB::select($query);
        $allorders = collect($orders);
        return $allorders;
    }

    public function drawings()
    {
    	$info = Information::find(1)->first();
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath('./upload/images/'. $info->logo);
        $drawing->setHeight(200);
        $drawing->setCoordinates('H1');

        return $drawing;
    }
}
