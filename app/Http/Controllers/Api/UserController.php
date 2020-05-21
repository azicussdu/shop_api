<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\ValidationException;

/**
 * @group User management
 * APIs for managing users
 */
class UserController extends Controller
{
    /**
     * Display a listing of the users.
     * @authenticated
     * @queryParam page required The page number. default = 1
     * @queryParam per_page required The number of items per list. default = 15
     * @apiResourceCollection Illuminate\Http\Resources\Json\JsonResource
     * @apiResourceModel App\Models\User
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return JsonResource::collection(User::latest()->paginate($request['per_page']));
    }

    /**
     * Store a newly created user in storage.
     * @authenticated
     * @bodyParam name string required User Name
     * @bodyParam email string required User Email
     * @bodyParam password string required User Password
     * @bodyParam role_id numeric Role Id
     * @apiResource Illuminate\Http\Resources\Json\JsonResource
     * @apiResourceModel App\Models\User
     * @param Request $request
     * @return JsonResource
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6',
            'role_id'=> 'sometimes|exists:roles,id'
        ]);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'role_id' => $request['role_id']
        ]);

        return new JsonResource($user);
    }

    /**
     * Display the specified user
     * @authenticated
     * @urlParam id required User Id
     * @apiResource Illuminate\Http\Resources\Json\JsonResource
     * @apiResourceModel App\Models\User
     * @param int $id
     * @return JsonResource
     */
    public function show($id)
    {
        $user = User::with(['role','orders'])->findOrFail($id);
        return new JsonResource($user);
    }

    /**
     * Update the specified user.
     * @authenticated
     * @urlParam id required User's Id to be Updated
     * @bodyParam name string User Name
     * @bodyParam password string User Password
     * @apiResource Illuminate\Http\Resources\Json\JsonResource
     * @apiResourceModel App\Models\User
     * @param Request $request
     * @param int $id
     * @return JsonResource
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->validate($request, [
            'name' => 'sometimes|string|max:191',
            'password' => 'sometimes|string|min:6'
        ]);
        $user->update(array_filter($request->all()));

        return new JsonResource($user);
    }

    /**
     * Remove the specified user from storage.
     * @authenticated
     * @urlParam id User's Id to be Deleted
     * @response {
     *  "message" : "User Deleted"
     * }
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message'=> 'User Deleted']);
    }
    /**
     * Resets the User Password by Email
     * @authenticated
     * @bodyParam email string User Email
     * @bodyParam password string  User Password
     * @apiResource Illuminate\Http\Resources\Json\JsonResource
     * @apiResourceModel App\Models\User
     * @param Request $request
     * @return JsonResponse|JsonResource
     * @throws ValidationException
     */
    public function resetPassword(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|string|email|max:191',
            'password' => 'required|string|min:6'
        ]);
        $user = User::firstWhere('email',$request['email']);
        if ($user->ready_to_reset==1){
            $user->update([
                'password'=>bcrypt($request['password']),
                'ready_to_reset'=>0
            ]);
            return new JsonResource($user);
        }else{
            return response()->json(['message'=>"Haven't verified email"]);
        }
    }
    /**
     * Display a listing of the user addresses.
     * @authenticated
     * @apiResourceCollection Illuminate\Http\Resources\Json\JsonResource
     * @apiResourceModel App\Models\Order
     * @return JsonResource
     */
    public function userAddresses(){
        $user =  auth()->user();
        return new JsonResource($user->addresses);
    }
    /**
     * Display a listing of the user liked products.
     * @authenticated
     * @apiResourceCollection Illuminate\Http\Resources\Json\JsonResource
     * @apiResourceModel App\Models\Order
     * @return JsonResource
     */
    public function userLikes(){
        $user =  auth()->user();
        return new JsonResource($user->likes);
    }
    /**
     * Display a listing of the user orders.
     * @authenticated
     * @apiResourceCollection Illuminate\Http\Resources\Json\JsonResource
     * @apiResourceModel App\Models\Order
     * @return JsonResource
     */
    public function userOrders(){
        $user =  auth()->user();
        return new JsonResource($user->orders);
    }
    /**
     * Display a listing of the user profile.
     * @authenticated
     * @apiResourceCollection Illuminate\Http\Resources\Json\JsonResource
     * @apiResourceModel App\Models\Order
     * @return JsonResource
     */
    public function userProfile(){
        $user = auth()->user();
        return new JsonResource($user);
    }
}
