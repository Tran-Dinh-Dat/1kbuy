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

class ExportOrder implements FromCollection, WithHeadings, ShouldAutoSize, WithDrawings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
	        ['ID','Tên người dùng','Email','Số điện thoại','Địa chỉ',  'Tên sản phẩm', 'Giá sản phẩm', 'Kích cỡ', 'Số lượng', 'Tổng tiền', 'Ngày đặt hàng'],
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
        $query = "SELECT DISTINCT orders.id as aid, orders.name as user_namme,  email, phone_number, address,  products.name as product_name, products.price, order_products.size, order_products.qty,  total, orders.created_at as created FROM orders 
        INNER JOIN order_products ON orders.id = order_products.order_id
        INNER JOIN products ON products.id = order_products.product_id 
        WHERE orders.created_at BETWEEN '$yesterday' AND  '$today' ORDER BY aid ASC";
        $orders = DB::select($query);
        $allorders = collect($orders);
        foreach($allorders as $item) {
            $item->total = $item->qty * $item->price;
        }
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
        $drawing->setCoordinates('K1');

        return $drawing;
    }
}
