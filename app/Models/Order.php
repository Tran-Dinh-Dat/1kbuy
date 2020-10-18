<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";
    protected $fillable = [
        'user_id',
        'total',
        'payment',
        'note',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function product() {
        return $this->belongsToMany('App\Models\Product', 'order_products')->withPivot('qty', 'created_at', 'size');
    }
}
