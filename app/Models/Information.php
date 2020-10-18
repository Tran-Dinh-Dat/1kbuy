<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    public $table = "informations";
    protected $fillable = [
        'id',
        'phone',
        'address',
        'email',
        'description',
        'logo',
        'logofooter',
        'header',
    ];
}
