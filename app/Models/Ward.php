<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $table = 'ward';
    protected $fillable = [
        '_name',
        '_code',
        '_province_id',
        '_district_id'
    ];

    public function district()
    {
        return $this->belongsTo('App\Models\District');
    }

    public function province()
    {
        return $this->belongsTo('App\Models\Province');
    }
}
