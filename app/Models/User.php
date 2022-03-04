<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\Events\Registered;


class User extends Authenticatable implements MustVerifyEmail
{

    use HasApiTokens;//trate 
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'type',
        'user_name',
    ];

    public function profile(){
        return $this->hasOne(Profile::class,'user_id','id')->withDefault();
    }

    public function products(){
        return $this->hasMany(Product::class,'user_id','id')->withDefault();
    }

    public function cart(){
        return $this->hasMany(Cart::class,'user_id','id')->withDefault();
    }
    
    public function orders(){
        return $this->hasMany(Order::class,'user_id','id')->withDefault();
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }
    
    


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
}
