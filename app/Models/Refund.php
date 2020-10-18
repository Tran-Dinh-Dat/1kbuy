<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    protected $table = "refund";
    protected $fillable = [
        'email',
        'password',
        'refund_value',
        'status',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
