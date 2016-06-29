<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Film;
use App\Http\Requests;
use App\Http\Requests\FilmRequest;
use App\Http\Controllers\Controller;
use App\Repositories\FilmRepository;

class FilmsController extends ApiController
{
    protected $repository;

    public function __construct(FilmRepository $repository)
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

        $films = $this->repository->getAll($limit);

        return $this->responseOk([
            'message' => 'success',
            'actors' => $films,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FilmRequest $request)
    {
        $film = $this->repository->add($request);

        if (! $film) {
            return 'could not create resource';
        }

        return $this->responseOk([
          'message' => 'movie successfully created',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($filmId)
    {
        $film = $this->repository->getById($filmId);

        if (! $film) {
          return $this->responseNotFound('Oops the movie was not found');
        }

        return $this->responseOk([
          'message' => 'success',
          'actor' => $film
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $filmId)
    {
        //TODO: implemts update method
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($filmId)
    {
        $film = $this->repository->delete($filmId);

        if (! $film) {
          return 'coul not delete actor';
        }

        return $this->responseOk([
          'message' => 'movie deleted successfully'
        ]);
    }
}
