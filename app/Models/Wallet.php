<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $table = 'wallet';
    protected $fillable = [
        'id',
        'credit_user',
        'credit_total',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
