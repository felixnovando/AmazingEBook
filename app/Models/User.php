<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    public $timestamps = false;

    protected $fillable = [
        'role_id',
        'gender_id',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'password',
        'display_picture_link',
        'delete_flag',
        'modified_at',
        'modified_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function role(){
        return $this->hasOne(Role::class, 'role_id', 'role_id');
    }

    public function gender(){
        return $this->hasOne(Gender::class, 'gender_id', 'gender_id');
    }

    public function order(){
        return $this->hasMany(Order::class, 'user_id', 'id');
    }

    public function cart(){
        return $this->hasMany(Cart::class, 'user_id', 'id');
    }
}
