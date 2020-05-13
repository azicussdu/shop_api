<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderProduct
 *
 * @property int $id
 * @property int $product_id
 * @property int $order_id
 * @property int $pieces
 * @property float $price
 *
 * @property Order $order
 * @property Product $product
 *
 * @package App\Models
 */
class OrderProduct extends Model
{
	protected $table = 'order_product';
	public $timestamps = false;

	protected $casts = [
		'product_id' => 'int',
		'order_id' => 'int',
		'pieces' => 'int',
		'price' => 'float'
	];

	protected $fillable = [
		'product_id',
		'order_id',
		'pieces',
		'price'
	];

	public function order()
	{
		return $this->belongsTo(Order::class);
	}

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
