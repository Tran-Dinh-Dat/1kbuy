<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'province';
    protected $fillable = [
        '_name',
        '_code'
    ];

    public function district()
    {
        return $this->hasMany('App\Models\District');
    }
}
