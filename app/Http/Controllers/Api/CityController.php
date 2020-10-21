<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

/**
 * @group City management
 * APIs for managing cities
 */
class CityController extends Controller
{
    /**
     * Display a listing of the city.
     * @authenticated
     * @queryParam page required The page number. default = 1
     * @queryParam per_page required The number of items per list. default = 15
     * @apiResourceCollection Illuminate\Http\Resources\Json\JsonResource
     * @apiResourceModel App\Models\City
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return JsonResource::collection(City::with('region')->latest()->paginate($request['per_page']));
    }

    /**
     * Store a newly created city in storage.
     * @authenticated
     * @bodyParam name string required City Name
     * @bodyParam region_id numeric required Region Id
     * @bodyParam zip_code string default zip code for addresses in city
     * @apiResource Illuminate\Http\Resources\Json\JsonResource
     * @apiResourceModel App\Models\City
     * @param Request $request
     * @return Response
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'region_id'=>'required|numeric|digits_between:1,20',
            'zip_code'=>'nullable|max:6',
            'name'=>'required|string|max:255'
        ]);
        return City::create([
            'region_id'=>$request['region_id'],
            'zip_code'=>$request['zip_code'],
            'name'=>$request['name']
        ]);
    }

    /**
     * Display the specified city.
     * @authenticated
     * @urlParam id required City Id
     * @apiResource Illuminate\Http\Resources\Json\JsonResource
     * @apiResourceModel App\Models\City
     * @param $id
     * @return JsonResource
     */
    public function show($id)
    {
        return new JsonResource(City::with('region')->findOrFail($id));
    }

    /**
     * @authenticated
     * @urlParam id required City Id
     * @bodyParam name string  City Name
     * @bodyParam region_id numeric  Region Id
     * @bodyParam zip_code string default zip code for addresses in city
     * @apiResource Illuminate\Http\Resources\Json\JsonResource
     * @apiResourceModel App\Models\City
     * @param Request $request
     * @param $id
     * @return JsonResource
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $city = City::findOrFail($id);
        $this->validate($request,[
            'region_id'=>'sometimes|numeric|digits_between:1,20',
            'zip_code'=>'sometimes|string|max:6',
            'name'=>'sometimes|string|max:255'
        ]);
        $city->update(array_filter($request->all()));
        return new JsonResource($city);
    }

    /**
     * Remove the specified city from storage.
     * @authenticated
     * @urlParam id required City Id
     * @response {
     *  "message" : "City Deleted"
     * }
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $city = City::findOrFail($id);
        $city->delete();
        return response()->json(['message'=> 'City Deleted']);
    }
}
