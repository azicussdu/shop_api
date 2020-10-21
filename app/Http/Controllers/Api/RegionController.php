<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

/**
 * @group Region management
 * APIs for managing regions
 */
class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @authenticated
     * @queryParam per_page required The number of items per list. default = 15
     * @queryParam page required The number of items per list. default = 1
     * @apiResourceCollection Illuminate\Http\Resources\Json\JsonResource
     * @apiResourceModel App\Models\Region
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return JsonResource::collection(Region::paginate($request['per_page']));
    }

    /**
     * Store a newly created region in storage.
     * @autenticated
     * @bodyParam name required Name
     * @apiResourceModel App\Models\Region
     * @apiResource Illuminate\Http\Resources\Json\JsonResource
     * @param Request $request
     * @return JsonResource
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:255'
        ]);
        $region = Region::create([
            'name'=>$request['name']
        ]);
        return new JsonResource($region);
    }

    /**
     * Display the specified region.
     * @authenticated
     * @urlParam id required region Id
     * @apiResource Illuminate\Http\Resources\Json\JsonResource
     * @apiResourceModel App\Models\Region
     * @param $id
     * @return JsonResource
     */
    public function show($id)
    {
        return new JsonResource(Region::findOrFail($id));
    }

    /**
     * Update the specified Region in storage.
     * @authenticated
     * @urlParam id required Region's Id
     * @bodyParam name Name
     * @apiResource Illuminate\Http\Resources\Json\JsonResource
     * @apiResourceModel App\Models\Region
     * @param Request $request
     * @param $id
     * @return JsonResource
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $region = Region::findOrFail($id);
        $this->validate($request,[
            'name'=>'sometimes|max:255'
        ]);
        $region->update($request->all());
        return new JsonResource($region);
    }

    /**
     * Remove the specified region from storage.
     * @authenticated
     * @urlParam id required Region's Id To Be Deleted
     * @response {
     *  "message" : "Region Deleted"
     * }
     * @param  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $region = Region::findOrFail($id);
        $region->delete();
        return response()->json(['message'=> 'Region Deleted']);
    }
}
