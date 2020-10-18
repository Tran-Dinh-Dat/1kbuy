<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Product_User;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithDrawings;
use DB;
use App\Models\Information;
use Illuminate\Support\Facades\File;

class ProductsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithDrawings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
	        ['#','Tổng hợp khách hàng đặt lệnh hôm nay'],
	        ['ID','Tên khách hàng','Email','Tên sản phẩm', 'Giá', 'Ngày đặt lệnh'],
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
        $query = "SELECT products.id as pid, users.name as username,users.email as user_email, products.name as pname , price, product_user.created_at as date_create FROM products INNER JOIN product_user ON products.id = product_user.product_id INNER JOIN users ON product_user.user_id = users.id WHERE product_user.created_at BETWEEN '$yesterday' AND  '$today'";
        $products = DB::select($query);
        foreach ($products as $product) {
        	$product->price = number_format($product->price,0,',','.') . ' VND';
        }
        $allproduct = collect($products);
        return $allproduct;
    }

    public function drawings()
    {
    	$info = Information::find(1)->first();
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath('./upload/images/'. $info->logo);
        $drawing->setHeight(200);
        $drawing->setCoordinates('F1');

        return $drawing;
    }
}
