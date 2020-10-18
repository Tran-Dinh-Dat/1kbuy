<?php

namespace App;

use App\Models\UserOrders;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'verify_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'verify_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne(Models\Profile::class)->withDefault();
    }

    public function product()
    {
        return $this->belongsToMany('App\Models\Product');
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

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
}
