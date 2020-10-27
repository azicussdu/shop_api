#Api for E-commerce
##login
###http://rossonero.kz/api/login
```
POST 
{
'email', 'password'
}
```

##register
###http://rossonero.kz/api/register
```
POST 
{
'name' => 'required|string|max:191',
'email' => 'required|string|email|max:191|unique:users',
'password' => 'required|string|min:6'
}
```

##Список продуктов
###http://rossonero.kz/api/products
```
get 
{
}
```


##Конкретный продукт
###http://rossonero.kz/api/products/{id}
```
get 
{
}
```


##Список категорий
###http://rossonero.kz/api/categories
```
get 
{
}
```


##Товары категории
###http://rossonero.kz/api/categories/{id}
```
get 
{
}
```
```
Route::get('users/addresses', 'Api\UserController@userAddresses');    Route::get('users/likes', 'Api\UserController@userLikes');
Route::get('users/orders', 'Api\UserController@userOrders');
Route::get('users/profile', 'Api\UserController@userProfile');
```
