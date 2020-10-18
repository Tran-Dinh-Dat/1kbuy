<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_Product extends Model
{
    protected $table ="order_products";
    public $timestamps = true;
    public $fillable = ['order_id', 'product_id', 'qty', 'size'];

    public function orders(){
    	return $this->belongsTo('App\Models\Order', 'order_id');
    }
    public function products(){
    	return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
