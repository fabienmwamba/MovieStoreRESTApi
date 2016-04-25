<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Transformers\CityTransformer;
use App\City;

class CitiesController extends ApiController
{
  /**
   * The data transformer used to tranform the city data.
   *
   * @var CityTransformer
   */
    protected $transformer;

    public function __construct(CityTransformer $transformer)
    {
        $this->transformer = $transformer;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit') ? $request->input('limit') : 10;

        $cities = City::with('addresses', 'stores')->paginate($limit);

        return $this->responseOk([

            'cities' => $this->transformer->transformCollection($cities->toArray())

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

          'city' => 'required',

        ]);

        $city = new City();

        $city->city = $request->input('city');

        $city->country_id = $request->input('country_id');

        $city->save();

        return $this->responseOk([

          'message' => 'city created successfully!'

        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $city = City::find($id);

        if ($city == null) {

          return $this->responseNotFound('the city you are looking for was not found!');

        }

        return $this->responseOk([

          'city' => $this->transformer->transform($city)

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $city = City::find($id);

        if ($city == null) {
          return $this->responseNotFound('the city was not found');
        }
        $city->city = $request->input('city');
        $city->save();

        return $this->responseOk([
          'message' => 'the city was updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = City::find($id);

        if ($city == null) {

          return $this->responseNotFound('the resource to delete was not found');

        }

        $city->delete();

        return $this->responseOk([

          'message' => 'the city was deleted successfully'

        ]);
    }
}
