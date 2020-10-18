<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = "profile";
    protected $fillable = [
        'id',
        'user_id',
        'fullname',
        'birthday',
        'address',
        'gender',
        'phone_number',
        'avatar',
    ];

    public function user()
    {
        return $this->belongsTo(App\User::class);
    }
}
