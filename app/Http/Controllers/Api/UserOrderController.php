<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order;
use App\Models\User;
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
class UserOrderController extends Controller
{
    /**
     * Display a listing of the order.
     * @authenticated
     * @queryParam page required The page number. default = 1
     * @queryParam per_page required The number of items per list. default = 15
     * @apiResourceCollection Illuminate\Http\Resources\Json\JsonResource
     * @apiResourceModel App\Models\Order
     * @param Request $request
     * @return JsonResource
     */
    public function index(Request $request)
    {
        $user= auth()->user();
        return new JsonResource($user->orders);
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

        $user= auth()->user();
        $this->validate($request,[
            'city_id'=>'required|numeric|digits_between:1,20',
            'zip_code'=>'required|max:6',
            'address'=>'required|max:255',
            'full_name'=>'required|max:255',
            'telephone_number'=>'required|max:255',
            'note'=>'nullable|max:255',
            //'user_id'=>'required|numeric|digits_between:1,20',
            'status'=>'required|in:0,1,2',
            // 'currency_id'=>'required|numeric|digits_between:1,10',
            //'address_id'=>'required|numeric|digits_between:1,20'
        ]);
        $address =  Address::create([
            'city_id'=>$request['city_id'],
            'zip_code'=>$request['zip_code'],
            'address'=>$request['address'],
            'full_name'=>$request['full_name'],
            'telephone_number'=>$request['telephone_number'],
            'note'=>$request['note'],
        ]);

        $order = Order::create([
            'user_id'=>$user['id'],
            'status'=>$request['status'],
            'currency_id'=>1,
            //'sum'=>$request['sum'],
            'address_id'=>$address['id'],
        ]);
        foreach ($request->input('products') as $product){
            $order->products()->attach([
                $product['id']=>['price'=>$product['price'], 'pieces'=>$product['pieces']]
            ]);
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
        $user= auth()->user();
        $order = Order::with(['products', 'currency', 'user', 'address'])->findOrFail($id);
       if($user['id']==$order['user_id']){
           return new JsonResource($order);
       }else{
           return new JsonResource(['error'=>'incorrect id']);
       }
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
        $user= auth()->user();
        $order = Order::findOrFail($id);
        if($user['id']==$order['user_id']) {
            $this->validate($request, [
                'user_id' => 'sometimes|numeric|digits_between:1,20',
                'status' => 'sometimes|in:0,1,2',
                'currency_id' => 'sometimes|numeric|digits_between:1,10',
                'address_id' => 'sometimes|numeric|digits_between:1,20',

            ]);
            $order->update(array_filter($request->all(), function ($value) {
                return !is_null($value);
            }));
            return new JsonResource($order);
        }
        else{
            return new JsonResource(['error'=>'incorrect id']);

        }
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
        $user = auth()->user();
        $order = Order::findOrFail($id);
        if($user['id']==$order['user_id']) {
            $order->delete();
            return response()->json(['message' => 'Order Deleted']);
        }else{
            return response()->json(['error'=>'incorrect id']);
        }
    }

    public function userAddresses(){
        $user =  auth()->user();
        return new JsonResource($user->addresses);
    }

}
