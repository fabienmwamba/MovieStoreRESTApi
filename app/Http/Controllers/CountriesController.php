<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Country;
use App\Transformers\CountryTransformer;
use App\Http\Requests\CountryRequest;

class CountriesController extends ApiController
{
  /**
   * The data transformer used to tranform the country data.
   *
   * @var CountryTransformer
   */
    protected $transformer;

    /**
     * The data transformer used to tranform the city data.
     *
     * @var CityTransformer
     */
    protected $transformCity;

    public function __construct(CountryTransformer $transformer)
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

        $countries = Country::with('cities')->paginate($limit);

        return $this->responseOk([

            'countries' => $this->transformer->transformCollection($countries->toArray())
            
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
    public function store(CountryRequest $request)
    {
        //validate request
        //save the country to the databse
        //return response
        // $this->validate($request, ['country'=>'required']);
        if (Country::create($request->all())) {

          return $this->responseOk([

            'message' => 'Country created'

          ]);

        };

        return 'error';


    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $country = Country::find($id);

        if ($country == null) {

            return $this->responseNotFound('the country you are looking for was not found');

        }

        return $this->responseOk([

          'country' => $this->transformer->transform($country)

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

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CountryRequest $request, $id)
    {
        $country = Country::find($id);

        $country->country = $request->input('country');

        $country->save();

        return $this->responseOk([

          'message'=> 'Country updated successfully',

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
        $country = Country::find($id);

        if ($country == null) {

          return $this->responseNotFound('could not find the cound try with id ' . $id);

        }

        $country->delete();

        return $this->responseOk([

          'message' => 'Country deleted successfully',

        ]);
    }
}
