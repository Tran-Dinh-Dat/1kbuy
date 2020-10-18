<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";
    protected $fillable  = [
        'category_id',
        'name',
        'slug',
        'description',
        'ship',
        'price',
        'promotion_price',
        'image',
        'active',
        'size'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsToMany('App\User');
    }

    public function imagesProduct()
    {   
        return $this->hasMany(ImagesProduct::class);
    }

    public function order() {
        return $this->belongsToMany('App\Models\Order', 'order_products');
    }
}
