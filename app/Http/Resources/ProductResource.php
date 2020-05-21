<?php

namespace App\Http\Resources;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $price = $this['price'];
        if($request->exists('currency')){
            $currency = Currency::all()->firstWhere('code', $request['currency']);
            $price = $price/$currency['value'];
        }
        return [
            'id'=> $this['id'],
            'status' => $this['status'],
            'name' => $this['name'],
            'alias' => $this['alias'],
            'description' => $this['description'],
            'content' => $this['content'],
            'price' => round($price,2),
            'keywords' => $this['keywords'],
            'is_hit' => $this['is_hit'],
            'image' => $this['image'],
            'pieces_left' => $this['pieces_left'],
            'created_at' => $this['created_at'],
            'updated_at' => $this['updated_at'],
            'deleted_at' => $this['deleted_at'],
            'brand_id' => $this['brand_id'],
            'filter_values' => $this->whenLoaded('filter_values'),
            'categories' => $this->whenLoaded('categories'),
            'product_images' => $this->whenLoaded('product_images'),
            'brand' => $this->whenLoaded('brand'),
        ];
    }
}
