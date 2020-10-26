<?php


namespace App\Http\Controllers\Api;


use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;

class ConfigController
{
    public function configure(Request $request){
        if ($request->token == 'tairbek') {
            return Artisan::call($request->command);
        } else {
            return 'fail';
        }
    }

    public function passport(){
        Artisan::call('passport:install');
    }
}
