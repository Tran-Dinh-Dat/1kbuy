<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = [
        'name',
        'logo',
        'account_number',
        'account_holder',
        'type',
    ];
}
