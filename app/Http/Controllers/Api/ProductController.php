<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Like;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

/**
 * @group Product management
 * APis for managing products
 */
class ProductController extends Controller
{
    /**
     * Display a listing of the product.
     * @authenticated
     * @queryParam page required The page number. default = 1
     * @queryParam per_page required The number of items per list. default = 15
     * @queryParam categories Category Ids
     * @queryParam filter_values Filter Value Ids
     * @queryParam brand Brand Id
     * @queryParam price_from Min Price
     * @queryParam price_to Max Price
     * @apiResourceCollection Illuminate\Http\Resources\Json\JsonResource
     * @apiResourceModel App\Models\Product
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $query = Product::query();
        if($request->has('categories'))
            $query->whereHas('categories',  function (Builder $query) use ($request) {
                $query->whereIn('categories.id', $request['categories']);
            });
        if($request->has('filter_values'))
            $query->whereHas('filter_values',  function (Builder $query) use ($request) {
                $query->whereIn('filter_values.id', $request['filter_values']);
            });
        if($request->has('brand'))
            $query->where('brand_id', $request['brand']);
        if($request->has('price_from'))
            $query->where('price', '>=', $request['price_from']);
        if($request->has('price_to'))
            $query->where('price', '<=', $request['price_to']);
        return ProductResource::collection($query->paginate($request['per_page']));
    }

    /**
     * Store a newly created product in storage.
     * @authenticated
     * @bodyParam name string required Product Name
     * @bodyParam alias string required Product Alias
     * @bodyParam description string Description
     * @bodyParam content string Content of Product page
     * @bodyParam brand_id numeric required Brand Id
     * @bodyParam price numeric required Product Price
     * @bodyParam keywords string Product keywords
     * @bodyParam image image required Product Image
     * @bodyParam product_images image.* Product Images
     * @bodyParam pieces_left numeric required Left pieces of Product
     * @bodyParam status enum[0,1] required Status of Product 0 - off, 1 - on
     * @apiResource Illuminate\Http\Resources\Json\JsonResource
     * @apiResourceModel App\Models\Product
     * @param Request $request
     * @return JsonResource
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'alias' => 'required|max:255|unique:products',
            'description' => 'nullable|max:255',
            'content' => 'nullable|max:1000',
            'status'=>'nullable|in:0,1',
            'brand_id' => 'required|numeric|digits_between:1,20',
            'price' => 'required|numeric|digits_between:1,18',
            'keywords' => 'nullable|max:255',
            'pieces_left' => 'required|numeric',
            'image'=>'required|image',
            'product_images.*'=>'image',
        ]);
        $name = $request->file('image')->hashName();
        $request->file('image')->storeAs('images/product', $name);
        $product = Product::create([
            'name' => $request['name'],
            'alias' => $request['alias'],
            'description' => $request['description'],
            'content' => $request['content'],
            'brand_id' => $request['brand_id'],
            'price' => $request['price'],
            'keywords' => $request['keywords'],
            'pieces_left' => $request['pieces_left'],
            'status' => $request['status'],
            'image' => $name
        ]);
        $product->filter_values()->sync($request['filters']);
        $product->categories()->sync($request['categories']);
        if($request->hasfile('product_images')) {
            foreach ($request->file('product_images') as $product_image) {
                $name = $product_image->hashName();
                $product_image->storeAs('images/product', $name);
                $product->product_images()->save(new ProductImage([
                    'image' => $name
                ]));
            }
        }
        return new JsonResource($product);
    }

    /**
     * Display the specified product.
     * @authenticated
     * @urlParam id required Product Id
     * @apiResource Illuminate\Http\Resources\Json\JsonResource
     * @apiResourceModel App\Models\Product
     * @param $id
     * @return JsonResource
     */
    public function show($id)
    {
        return new JsonResource(Product::with(['filter_values', 'categories', 'product_images'])->findOrFail($id));
    }

    /**
     * Update the specified product in storage.
     * @authenticated
     * @bodyParam name string Product Name
     * @bodyParam alias string Product Alias
     * @bodyParam description string Description
     * @bodyParam content string Content of Product page
     * @bodyParam brand_id numeric Brand Id
     * @bodyParam price numeric Product Price
     * @bodyParam keywords string Product keywords
     * @bodyParam pieces_left numeric Left pieces of Product
     * @bodyParam status enum[0,1] Status of Product 0 - off, 1 - on
     * @apiResource Illuminate\Http\Resources\Json\JsonResource
     * @apiResourceModel App\Models\Product
     * @param Request $request
     * @param int $id
     * @return JsonResource
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $this->validate($request,[
            'name' => 'sometimes|max:255',
            'alias' => 'sometimes|max:255|unique:products',
            'description' => 'sometimes|max:255',
            'content' => 'sometimes|max:1000',
            'brand_id' => 'sometimes|numeric|digits_between:1,20',
            'price' => 'sometimes|numeric|digits_between:1,18',
            'keywords' => 'sometimes|max:255',
            'pieces_left' => 'sometimes|numeric',
            'status' => 'sometimes|in:0,1',
        ]);
        $product->update(array_filter($request->all(), function($value) {
            return !is_null($value);
        }));
        return new JsonResource($product);
    }

    /**
     * Remove the specified product from storage.
     * @authenticated
     * @urlParam id required Product Id
     * @response {
     *  "message": "Product Deleted"
     * }
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['message'=>'Product Deleted'],  Response::HTTP_ACCEPTED);
    }


    /**
     * Store a newly created product in storage.
     * @authenticated
     * @bodyParam image image required Product Image
     * @apiResource Illuminate\Http\Resources\Json\JsonResource
     * @apiResourceModel App\Models\Product
     * @param Request $request
     * @param $id
     * @return JsonResource
     * @throws ValidationException
     */
    public function setImage(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $this->validate($request, [
            'image'=>'sometimes|image',
        ]);
        Storage::delete('images/product/'.$product->image);
        $name = 'no_image.jpg';
        if($request->hasfile('image')) {
            $name = $request->file('image')->hashName();
            $request->file('image')->storeAs('images/product', $name);
        }
        $product->update(['image'=>$name]);
        return new JsonResource($product);
    }

    /**
     * Likes the product for authenticated User
     * @authenticated
     * @bodyParam id numeric Product Id
     * @apiResource Illuminate\Http\Resources\Json\JsonResource
     * @apiResourceModel App\Models\User
     * @param int $id
     * @return JsonResponse
     */
    public function like($id)
    {
        $user = auth()->user();
        $user->likes()->attach($id);
        return response()->json(["message"=>"Liked"]);
    }

    /**
     * Unlikes the product for authenticated User
     * @authenticated
     * @bodyParam id numeric Product Id
     * @apiResource Illuminate\Http\Resources\Json\JsonResource
     * @apiResourceModel App\Models\User
     * @param int $id
     * @return JsonResponse
     */
    public function unlike($id)
    {
        $user = auth()->user();
        $user->likes()->detach($id);
        return response()->json(["message"=>"Unliked"]);
    }
    /**
     * Unlikes the product for authenticated User
     * @authenticated
     * @bodyParam id numeric Product Id
     * @apiResource Illuminate\Http\Resources\Json\JsonResource
     * @apiResourceModel App\Models\User
     * @param int $id
     * @return JsonResponse
     */
    public function isLiked($id)
    {
        $user = auth()->user();
        $exists = Like::where('user_id', $user['id'])->where('product_id', $id)->exists();
        return response()->json(['isLiked'=>$exists]);
    }
}
