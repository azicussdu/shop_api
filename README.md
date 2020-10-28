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
##Make order
###http://rossonero.kz/api/make-order
```
post 
{
    "user_id" : 1,
    "latitude" : "123123",
    "longitude" : "123123",
    "products" : [1, 2, 3]
}
```

```
              'address'=>'required|max:255',
                            'longitude'=>'required|max:255',
                            'city_id'=>'required|max:255',
                            'latitude'=>'required|max:255',
                            'full_name'=>'required|max:255',
                            'telephone_number'=>'required|max:255',
                            'note'=>'nullable|max:255',

``` 



_______________________
Driver
   public function registerDriver(Request $request)
    {

        $user= User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'email_verification_token' => Str::random(32),
            'reset_password_token'=>'',
            'role_id' => 2

Route::get('orders',   'Api\OrderController@index')->name('order.index');
