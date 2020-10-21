<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\ValidationException;

/**
 * @group Address management
 * APIs for managing addresses
 */
class AddressController extends Controller
{
    /**
     * Display a listing of the address.
     * @authenticated
     * @queryParam page required The page number. default = 1
     * @queryParam per_page required The number of items per list. default = 15
     * @apiResourceCollection Illuminate\Http\Resources\Json\JsonResource
     * @apiResourceModel App\Models\Address
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return JsonResource::collection(Address::Latest()->paginate($request['per_page']));
    }

    /**
     * Store a newly created address in storage.
     * @authenticated
     * @bodyParam city_id numeric required City Id
     * @bodyParam zip_code string required Zip Code
     * @bodyParam address string required Address
     * @bodyParam full_name string required Full Name of Customer
     * @bodyParam telephone_number string required Number of Customer
     * @bodyParam note string Notes
     * @apiResource Illuminate\Http\Resources\Json\JsonResource
     * @apiResourceModel App\Models\Address
     * @param Request $request
     * @return JsonResource
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'address'=>'required|max:255',
            'full_name'=>'required|max:255',
            'telephone_number'=>'required|max:255',
            'note'=>'nullable|max:255'
        ]);
        $address=  Address::create([
            'address'=>$request['address'],
            'full_name'=>$request['full_name'],
            'telephone_number'=>$request['telephone_number'],
            'note'=>$request['note'],
        ]);
        return  new JsonResource($address);
    }

    /**
     * Display the specified address.
     * @authenticated
     * @urlParam id required Address Id
     * @apiResource Illuminate\Http\Resources\Json\JsonResource
     * @apiResourceModel App\Models\Address
     * @param $id
     * @return JsonResource
     */
    public function show($id)
    {
        return new JsonResource(Address::findOrFail($id));
    }

    /**
     * Update the specified address in storage.
     * @authenticated
     * @urlParam id required Address's Id to be Updated
     * @bodyParam city_id numeric  City Id
     * @bodyParam zip_code string  Zip Code
     * @bodyParam address string  Address
     * @bodyParam full_name string  Full Name of Customer
     * @bodyParam telephone_number string  Number of Customer
     * @bodyParam note string Notes
     * @apiResource Illuminate\Http\Resources\Json\JsonResource
     * @apiResourceModel App\Models\Address
     * @param Request $request
     * @param $id
     * @return JsonResource
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $address = Address::findOrFail($id);
        $this->validate($request,[
            'address'=>'sometimes|max:255',
            'full_name'=>'sometimes|max:255',
            'telephone_number'=>'sometimes|max:255',
            'note'=>'sometimes|max:255'
        ]);
        $address->update(array_filter($request->all()));
        return new JsonResource($address);
    }

    /**
     * Remove the specified address from storage.
     * @authenticated
     * @urlParam id Address's Id to be Deleted
     * @response {
     *  "message" : "Address Deleted"
     * }
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $address = Address::findOrFail($id);
        $address->delete();
        return response()->json(['message'=>'Address Deleted']);
    }
}
