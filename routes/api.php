<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//Route::get('test', 'Api\PassportController@test');

Route::post('login', 'Api\PassportController@login');
Route::post('logout', 'Api\PassportController@logout');
Route::post('register', 'Api\PassportController@register');
Route::post('resetPassword', 'Api\PassportController@resetPassword');
Route::post('users/resetPassword', 'Api\UserController@resetPassword')->name('users.resetPassword');

Route::get('verify/{token}', 'Api\VerifyController@verifyEmail')->name('verify');
Route::get('reset/{token}', 'Api\VerifyController@resetPassword')->name('reset');

Route::get('filterGroups',   'Api\FilterGroupController@index')->name('filterGroups.index');
Route::get('filterGroups/{filterGroup}', 'Api\FilterGroupController@show')->name('filterGroups.show');

Route::get('products',   'Api\ProductController@index')->name('products.index');
Route::get('products/{product}', 'Api\ProductController@show')->name('products.show');

Route::get('categories', 'Api\CategoryController@index')->name('categories.index');
Route::get('categories/{category}', 'Api\CategoryController@show')->name('categories.show');

Route::middleware(['auth:api'])->group(function () {
    Route::apiResources([
        'userOrders' => 'Api\UserOrderController',
    ]);
    Route::get('users/addresses', 'Api\UserController@userAddresses');
    Route::get('users/likes', 'Api\UserController@userLikes');
    Route::get('users/orders', 'Api\UserController@userOrders');
    Route::get('users/profile', 'Api\UserController@userProfile');
    Route::get('products/{product}/like', 'Api\ProductController@isLiked');
    Route::post('products/{product}/like', 'Api\ProductController@like');
    Route::delete('products/{product}/like', 'Api\ProductController@unlike');
});
Route::middleware(['auth:api', 'can:isAdmin'])->group(function (){
    Route::post('products/{product}/setImage', 'Api\ProductController@setImage')->name('products.setImage');

    Route::post('products', 'Api\ProductController@store')->name('products.store');
    Route::match(['put', 'patch'],'products/{product}', 'Api\ProductController@update')->name('products.update');
    Route::delete('products/{product}', 'Api\ProductController@destroy')->name('products.destroy');

    Route::post('categories', 'Api\CategoryController@store')->name('categories.store');
    Route::match(['put', 'patch'],'categories/{category}', 'Api\CategoryController@update')->name('categories.update');
    Route::delete('categories/{category}', 'Api\CategoryController@destroy')->name('categories.destroy');

    Route::post('filterGroups', 'Api\FilterGroupController@store')->name('filterGroups.store');
    Route::match(['put', 'patch'],'filterGroups/{filterGroup}', 'Api\FilterGroupController@update')->name('filterGroups.update');
    Route::delete('filterGroups/{filterGroup}', 'Api\FilterGroupController@destroy')->name('filterGroups.destroy');

    Route::apiResources([
//        'products'=>'Api\ProductController',
        'users' => 'Api\UserController',
        'addresses' => 'Api\AddressController',
        'brands' =>'Api\BrandController',
//        'categories' =>'Api\CategoryController',
        'cities' => 'Api\CityController',
        'currencies' => 'Api\CurrencyController',
//        'filterGroups' => 'Api\FilterGroupController',
        'filterValues' => 'Api\FilterValueController',
        'orders' => 'Api\OrderController',
        'productImages' => 'Api\ProductImageController',
        'regions' => 'Api\RegionController',
        'roles' => 'Api\RoleController',
    ]);
});

