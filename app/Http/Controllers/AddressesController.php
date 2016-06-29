<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Address;
use App\Http\Controllers\Controller;
use App\Repositories\AddressRepository;
use App\Transformers\AddressTransformer;

class AddressesController extends ApiController
{
    protected $repository;

    public function __construct(AddressRepository $repository)
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

        $addresses = $this->repository->getAll($limit);

        return $this->responseOk([
            'message' => 'success',
            'actors' => $addresses,
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
        //TODO Implement
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($addressId)
    {
        $address = $this->repository->getById($addressId);

        if (! $address) {
          return $this->responseNotFound('Oops the address was not found');
        }

        return $this->responseOk([
          'message' => 'success',
          'actor' => $address
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($addressId)
    {
        $address = $this->repository->delete($addressId);

        if (! $address) {
          return 'coul not delete address';
        }

        return $this->responseOk([
          'message' => 'address deleted successfully'
        ]);
    }
}
