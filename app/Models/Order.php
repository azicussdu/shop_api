<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Order
 *
 * @property int $id
 * @property int $user_id
 * @property string $status
 * @property int $currency_id
 * @property int $address_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 *
 * @property Address $address
 * @property Currency $currency
 * @property User $user
 * @property Collection|Product[] $products
 *
 * @package App\Models
 * @method static where(string $string, $id)
 */
class Order extends Model
{
	use SoftDeletes;
	protected $table = 'orders';

	protected $casts = [
		'user_id' => 'int',
		'currency_id' => 'int',
		'address_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'status',
		'currency_id',
		'address_id'
	];
    protected $with = [
        'products'
    ];

	public function address()
	{
		return $this->belongsTo(Address::class);
	}

	public function currency()
	{
		return $this->belongsTo(Currency::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function products()
	{
		return $this->belongsToMany(Product::class)
					->withPivot('id', 'pieces', 'price')->with('categories');
	}
}
