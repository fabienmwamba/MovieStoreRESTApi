<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CityRepository;

class CitiesController extends ApiController
{
  /**
   * The data transformer used to tranform the city data.
   *
   * @var CityTransformer
   */
    protected $repository;

    public function __construct(CityRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit');

        $cities = $this->repository->getAll($limit);

        return $this->responseOk([
            'message' => 'success',
            'actors' => $cities,
        ]);
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

        $city = $this->repository->add($request);

        if (! $city) {
            return 'could not create resource';
        }

        return $this->responseOk([
          'message' => 'actor successfully created',
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($cityId)
    {
        $city = $this->repository->getById($cityId);

        if (! $city) {
          return $this->responseNotFound('Oops the city was not found');
        }

        return $this->responseOk([
          'message' => 'success',
          'city' => $city
        ]);
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
    public function destroy($cityId)
    {
        $city = $this->repository->delete($cityId);

        if (! $city) {
          return 'coul not delete actor';
        }

        return $this->responseOk([
          'message' => 'city deleted successfully'
        ]);
    }
}
