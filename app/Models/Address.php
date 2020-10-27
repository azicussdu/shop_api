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
 * Class Address
 *
 * @property int $id
 * @property int $city_id
 * @property string $zip_code
 * @property string $address
 * @property string $full_name
 * @property string $telephone_number
 * @property string $note
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 *
 * @property City $city
 * @property Collection|Order[] $orders
 *
 * @package App\Models
 */
class Address extends Model
{
	use SoftDeletes;
	protected $table = 'addresses';

	protected $casts = [
		'city_id' => 'int'
	];

	protected $fillable = [
		'address',
		'full_name',
		'telephone_number',
		'note',
         'latitude',
        'longitude'
	];

	protected $with = [
	    'city'
    ];

	protected $hidden = [
	    'city_id'
    ];

	public function city()
	{
		return $this->belongsTo(City::class);
	}

	public function orders()
	{
		return $this->hasMany(Order::class);
	}
}
