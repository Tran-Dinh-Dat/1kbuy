<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepositRequest extends Model
{
    protected $table = "depositrequest";
    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'payment',
        'money',
        'message',
        'status',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
