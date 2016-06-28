<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\ActorTransformer;

class ActorsController extends ApiController
{
    protected $transformer;

    public function __construct(ActorTransformer $transformer)
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
        $actors = Actor::with('films')->paginate($limit);
        // $actors = $this->repository->getAll();
        return $this->responseOk([
            'actors' => $this->transformer->transformCollection($actors->toArray()),
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
          'firstname' => 'required',
          'lastname' => 'required',
        ]);

        Actor::create($request->all());

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
    public function show($id)
    {
        // $actor = Actor::find($id)->toArray();
        // return $this->transformer->transform($actor);
        $actor = Actor::find($id);

        if ($actor == null) {
          return $this->responseNotFound('Oops the movie you requested was not found');
        }

        return $this->responseOk([
            'film'=> $this->transformer->transform($actor)
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
        $actor = Actor::find($id);

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $actor = Actor::find($id);

        if ($actor == null) {
          return $this->responseNotFound('actor not found');
        }

        $actor->delete();

        return $this->responseOk([
          'message' => 'actor deleted successfully'
        ]);
    }


}
