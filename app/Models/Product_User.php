<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_User extends Model
{
    protected $table ="product_user";
    public $timestamps = true;
    public $fillable = ['user_id', 'product_id', 'tien_tra_gop', 'status', 'size'];

    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function product(){
    	return $this->belongsTo('App\Models\Product');
    }
}
