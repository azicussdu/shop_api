<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return City::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'region_id'=>'required|numeric|max:20',
            'zip_code'=>'nullable|size:6',
            'name'=>'required|string|max:255'


        ]);
        City::create([
            'region_id'=>$request['region_id'],
            'zip_code'=>$request['zip_code'],
            'name'=>$request['name']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return City::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $city = City::findOrFail($id);
        $this->validate($request,[
            'region_id'=>'required|numeric|max:20',
            'zip_code'=>'nullable|size:6',
            'name'=>'required|string|max:255'

        ]);
        $city->update($request->all());
        return ['message'=> 'City Updated'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = City::findOrFail($id);
        $city->delete();
        return ['message'=> 'City Deleted'];
    }
}
