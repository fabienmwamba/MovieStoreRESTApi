<?php

namespace App\Http\Controllers;

use App\Store;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\StoreRepository;

class StoresController extends ApiController
{
    protected $repository;

    public function __construct(StoreRepository $repository)
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

        $stores = $this->repository->getAll($limit);

        return $this->responseOk([
            'message' => 'success',
            'stores' => $stores,
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
        $store = $this->repository->add($request);

        if (! $store) {
            return 'could not create resource';
        }

        return $this->responseOk([
          'message' => 'store successfully created',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($storeId)
    {
        $store = $this->repository->getById($storeId);

        if (! $store) {
          return $this->responseNotFound('Oops the actor was not found');
        }

        return $this->responseOk([
          'message' => 'success',
          'actor' => $store
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
        //TODO
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($storeId)
    {
        $store = $this->repository->delete($storeId);

        if (! $store) {
          return 'coul not delete movie';
        }

        return $this->responseOk([
          'message' => 'movie deleted successfully'
        ]);
    }
}
