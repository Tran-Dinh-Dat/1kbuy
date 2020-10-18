<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagesProduct extends Model
{
    protected $table = "imagesproduct";
    protected $fillable  = [
        'image_name',
        'alt',
        'product_id',
    ];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
