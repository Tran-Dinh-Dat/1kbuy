<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithDrawings;
use DB;
use App\Models\Information;
use Illuminate\Support\Facades\File;

class ExportProduct implements FromCollection, WithHeadings, ShouldAutoSize, WithDrawings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
	        ['ID','Tên danh mục','Tên sản phẩm','Giá khuyến mãi','Tình trạng', 'Lượt xem','Giá gốc', 'Ngày tạo', 'Nội dung ship', 'SKU'],
        ];
    }

    public function collection()
    {
        $query = "SELECT products.id as pid, categories.name as cname, products.name as pname, promotion_price, active, view,price, products.created_at as created, ship, sku FROM products 
        INNER JOIN categories ON products.category_id = categories.id ORDER BY pid ASC";
        $products = DB::select($query);
	    foreach ($products as $key => $product) {
	        if($product->active == 0){
	        	$product->active == 'Đã ẩn';
	        }else{
	        	$product->active == 'Đang hiển thị';
	        }
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
        $drawing->setCoordinates('K1');

        return $drawing;
    }
}
