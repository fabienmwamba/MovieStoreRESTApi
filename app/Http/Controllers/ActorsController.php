<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\ActorRequest;
use App\Http\Controllers\Controller;
use App\Repositories\ActorRepository;

class ActorsController extends ApiController
{
    /**
     *  the actor's repository
     *
     *  @var mixed
     */
    protected $repository;

    public function __construct(ActorRepository $repository)
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

        $actors = $this->repository->getAll($limit);

        return $this->responseOk([
            'message' => 'success',
            'actors' => $actors,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActorRequest $request)
    {
        $actor = $this->repository->add($request);

        if (! $actor) {
            return 'could not create resource';
        }

        return $this->responseOk([
          'message' => 'actor successfully created',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $ActorId
     * @return \Illuminate\Http\Response
     */
    public function show($ActorId)
    {
        $actor = $this->repository->getById($ActorId);

        if (! $actor) {
          return $this->responseNotFound('Oops the actor was not found');
        }

        return $this->responseOk([
          'message' => 'success',
          'actor' => $actor
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $ActorId
     * @return \Illuminate\Http\Response
     */
    public function update(ActorRequest $request, $ActorId)
    {
        //TODO
        /**
         *  1. Validate the request
         * 2. Refactor to the logic to create a new actor to the
         */
        $actor = Actor::find($ActorId);

        if ($actor == null ) {
          return $this->responseNotFound('actor not found');
        }

        $actor->firstname = $request->input('firstname');
        $actor->lastname = $request->input('lastname');
        $actor->save();

        return $this->responseOk([
          'message' => 'actor updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $ActorId
     * @return \Illuminate\Http\Response
     */
    public function destroy($ActorId)
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
