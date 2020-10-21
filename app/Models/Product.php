<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

/**
 * Class Product
 *
 * @property int $id
 * @property string $status
 * @property string $name
 * @property string $alias
 * @property string $description
 * @property string $content
 * @property int $brand_id
 * @property float $price
 * @property string $keywords
 * @property bool $is_hit
 * @property string $image
 * @property int $pieces_left
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 *
 * @property Brand $brand
 * @property Collection|Category[] $categories
 * @property Collection|FilterValue[] $filter_values
 * @property Collection|Order[] $orders
 * @property Collection|ProductImage[] $product_images
 *
 * @package App\Models
 */
class Product extends Model
{
	use SoftDeletes;
	protected $table = 'products';

	protected $casts = [
		'brand_id' => 'int',
		'price' => 'float',
		'is_hit' => 'bool',
		'pieces_left' => 'int'
	];

	protected $fillable = [
		'weight',
		'volume',
		'status',
		'name',
		'alias',
		'description',
		'content',
		'brand_id',
		'price',
		'keywords',
		'is_hit',
		'image',
		'pieces_left'
	];

	public function brand()
	{
		return $this->belongsTo(Brand::class);
	}

	public function categories()
	{
		return $this->belongsToMany(Category::class)
					->withPivot('id');
	}

	public function filter_values()
	{
		return $this->belongsToMany(FilterValue::class)
					->withPivot('id');
	}

	public function orders()
	{
		return $this->belongsToMany(Order::class)
					->withPivot('id', 'pieces', 'price');
	}

	public function product_images()
	{
		return $this->hasMany(ProductImage::class);
	}

    public function getImageAttribute($value)
    {
        return asset(Storage::url("images/product/".$value));
    }
}
