<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CountryRepository;
use App\Http\Requests\CountryRequest;

class CountriesController extends ApiController
{
  /**
   * The data transformer used to tranform the country data.
   *
   * @var CountryTransformer
   */
    protected $repository;


    public function __construct(CountryRepository $repository)
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

        $countries = $this->repository->getAll($limit);

        return $this->responseOk([
            'message' => 'success',
            'countries' => $countries,
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
        $country = $this->repository->add($request);

        if (! $country) {
            return 'could not create resource';
        }

        return $this->responseOk([
          'message' => 'country successfully created',
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($countryId)
    {
        $country = $this->repository->getById($countryId);

        if (! $country) {
          return $this->responseNotFound('Oops the actor was not found');
        }

        return $this->responseOk([
          'message' => 'success',
          'actor' => $country
        ]);
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
        //TODO: to be implemented
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($countryId)
    {
        $country = $this->repository->delete($countryId);

        if (! $country) {
          return 'coul not delete actor';
        }

        return $this->responseOk([
          'message' => 'actor deleted successfully'
        ]);
    }
}
