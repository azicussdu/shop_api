<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;


/**
 * @group Order management
 * APIs for managing addresses
 */
class OrderController extends Controller
{
    /**
     * Display a listing of the order.
     * @authenticated
     * @queryParam page required The page number. default = 1
     * @queryParam per_page required The number of items per list. default = 15
     * @apiResourceCollection Illuminate\Http\Resources\Json\JsonResource
     * @apiResourceModel App\Models\Order
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return JsonResource::collection(Order::with(['user', 'address'])->latest()->paginate($request['per_page']));
    }

    /**
     * Store a newly created order in storage.
     * @authenticated
     * @bodyParam user_id numeric required User Id
     * @bodyParam status string required Status ,one of the 0,1,2
     * @bodyParam currency_id numeric required Currency Id
     * @bodyParam address_id numeric required Address Id
     * @bodyParam products array required Array of Products json objects with id,prices,pieces parameters
     * @apiResource Illuminate\Http\Resources\Json\JsonResource
     * @apiResourceModel App\Models\Order
     * @param Request $request
     * @return JsonResource
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'user_id'=>'required|numeric|digits_between:1,20',
//            'address_id'=>'required|numeric|digits_between:1,20'
        ]);
        $order = Order::create([
            'user_id'=>$request['user_id'],
            'status'=>1,
            'currency_id'=>1,
            'sum'=>$request['sum'],
//            'address_id'=>$request['address_id'],
        ]);
        $order->save();
        foreach ($request["products"] as $product){
            $op = new OrderProduct();
            $op->product_id = $product;
            $op->order_id = $order->id;
            $op->save();
        }
        return new JsonResource($order);
    }

    /**
     * Display the specified order.
     * @authenticated
     * @urlParam id required Order Id
     * @apiResource Illuminate\Http\Resources\Json\JsonResource
     * @apiResourceModel App\Models\Order
     * @param $id
     * @return JsonResource
     */
    public function show($id)
    {
        return new JsonResource(Order::with(['products', 'currency', 'user', 'address'])->findOrFail($id));
    }

    /**
     * Update the specified order in storage.
     * @authenticated
     * @urlParam id required Address's Id to be Updated
     * @bodyParam user_id numeric User Id
     * @bodyParam status enum[0,1,2] Status ,one of the 0,1,2
     * @bodyParam currency_id numeric  Currency Id
     * @bodyParam address_id numeric  Address Id
     * @apiResource Illuminate\Http\Resources\Json\JsonResource
     * @apiResourceModel App\Models\Order
     * @param Request $request
     * @param $id
     * @return JsonResource
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $this->validate($request,[
            'user_id'=>'sometimes|numeric|digits_between:1,20',
            'status'=>'sometimes|in:0,1,2',
            'currency_id'=>'sometimes|numeric|digits_between:1,10',
            'address_id'=>'sometimes|numeric|digits_between:1,20',

        ]);
        $order->update(array_filter($request->all(), function($value) {
            return !is_null($value);
        }));
        return new JsonResource($order);
    }

    /**
     * Remove the specified Order from storage.
     * @authenticated
     * @urlParam id  Order's Id to be Deleted
     * @response {
     *  "message" : "Order Deleted"
     * }
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return response()->json(['message'=>'Order Deleted']);
    }

}
