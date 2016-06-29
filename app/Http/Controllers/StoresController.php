<?php

namespace App\Http\Controllers;

use App\Store;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\StoreRepository;

class StoresController extends ApiController
{
    protected $transformer;

    public function __construct(StoreTransformer $transformer)
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
        // $limit = $request->input('limit') ? $request->input('limit') : 10;
        //
        // $stores = Store::paginate($limit);
        //
        // if ($stores == null) {
        //     return $this->responseNotFound('No Store found');
        // }
        //
        // return $this->responseOk([
        //   'stores' => $this->transformer->transformCollection($stores->toArray())
        // ]);
        $limit = $request->input('limit');

        $actors = $this->repository->getAll($limit);

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
        //TODO
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($storeId)
    {
        $store = Store::findOrFail($storeId);

        if ($store == null) {
            return $this->responseNotFound('the specified store was not found');
        }

        return $this->responseOk([
            'store'=>$this->transformer->transform($store)
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
        $actor = $this->repository->delete($ActorId);

        if (! $actor) {
          return 'coul not delete actor';
        }

        return $this->responseOk([
          'message' => 'actor deleted successfully'
        ]);
    }
}
