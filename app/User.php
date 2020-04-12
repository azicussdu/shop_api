<?php

namespace App;

use App\Models\Order;
use App\Models\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

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
        'password', 'remember_token', 'role_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    protected $with = [
        'role'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function isAdmin(){
        return $this->role->name == 'admin';
    }

    public function isModerator(){
        return $this->role->name == 'moderator';
    }

    public function isUser(){
        return $this->role->name == 'user';
    }
}
