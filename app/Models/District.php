<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'district';
    protected $fillable = [
        '_name',
        '_prefix',
        '_province_id',
    ];

    public function province()
    {
        return $this->belongsTo('App\Models\Province');
    }

    public function ward()
    {
        return $this->hasMany('App\Models\Ward');
    }
}
