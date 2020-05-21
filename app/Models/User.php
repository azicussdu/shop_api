<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * Class User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon $email_verified_at
 * @property string $password
 * @property string $remember_token
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Collection|Order[] $orders
 * @property Collection|Product[] $likes
 * @property Collection|Role[] $roles
 * @property Collection|Address[] $addresses
 *
 * @package App\Models
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;

    protected $table = 'users';

	protected $dates = [
		'email_verified_at'
	];

	protected $hidden = [
		'password',
		'remember_token',
        'role_id'
	];

	protected $fillable = [
		'name',
		'email',
		'email_verified_at',
        'email_verified',
        'email_verification_token',
        'ready_to_reset',
        'reset_password_token',
		'password',
		'remember_token'
	];

    protected $with = [
        'role'
    ];

    public function orders(){
        return $this->hasMany(Order::class)->with('products');
    }
    public function addresses(){
        return $this->belongsToMany(Address::class, 'orders');
    }
    public function likes(){
        return $this->belongsToMany(Product::class, 'likes', 'user_id', 'product_id');
    }
	public function role(){
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
