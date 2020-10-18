<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $collection = $rows->take( - ($rows->count() -1));
    
        foreach ($collection as $row) 
        {
            $cats = Category::where('name', 'like', '%'.$row[0].'%')->first();
            if(!$cats){
                return back()->with('error','Không tồn tại tên danh mục');
            }
            Product::create([
                'category_id' => $cats->id,
                'name' => $row[1],
                'slug' => Str::slug($row[1]),
                'description' => $row[2],
                'price' => $row[3],
                'promotion_price' => $row[4],
                'image' => $row[5],
                'active' => $row[6],
                'SKU' => $row[7],
            ]);
        }
    }
}