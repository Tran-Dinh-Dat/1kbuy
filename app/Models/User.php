<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Users extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

        public function profile()
    {
        return $this->hasOne(Models\Profile::class)->withDefault();
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function wallet()
    {
        return $this->hasOne(Models\Wallet::class);
    }

    public function refund()
    {
        return $this->hasOne(Models\Refund::class);
    }

    public function depositrequest()
    {
        return $this->hasMany('App\Models\DepositRequest');
    }
}
