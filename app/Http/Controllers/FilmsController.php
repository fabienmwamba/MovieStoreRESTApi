<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Film;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Transformers\FilmTransformer;

class FilmsController extends ApiController
{
    protected $transformer;

    public function __construct(FilmTransformer $transformer)
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

        $films = Film::with('actors', 'categories')->paginate($limit);

        if ($films == null) {
          return $this->responseNotFound('no movie found');
        }

        return $this->responseOk([
            'films' => $this->transformer->transformCollection($films->toArray())
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
        $film = new Film();

        $film->title = $request->input('title');
        $film->description = $request->input('description');
        $film->rentalDuration = $request->input('rentalDuration');
        $film->rentalRate = $request->input('rentalRate');
        $film->replacementCost = $request->input('replacementCost');
        $film->releaseYear = $request->input('releaseYear');
        $film->length = $request->input('length');
        $film->rating = $request->input('rating');
        $film->language_id = $request->input('language_id');

        $film->save();

        return $this->responseOk([
          'message' => 'Film successfully created'
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
        $film = Film::find($id);

        if ($film == null) {
          return $this->responseNotFound('Oops the movie you requested was not found');
        }

        return $this->responseOk([
            'film'=> $this->transformer->transform($film)
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
        $this->validate($request, [
          'title' => 'required',
          'description' => 'required',
          'releaseYear' => 'required',
          'rentalDuration' => 'required',
          'rentalRate' => 'required',
          'length' => 'required',
          'replacementCost' => 'required',
          'rating' => 'required',
        ]);

        $film = Film::find($id);

        if ($film == null) {
          return $this->responseNotFound('the movie was not found');
        }

        $film->title = $request->input('title');
        // $film->description = $request->input('description');
        // $film->releaseYear = $request->input('releaseYear');
        // $film->rentalDuration = $request->input('rentalDuration');
        // $film->rentalRate = $request->input('rentalRate');
        // $film->length = $request->input('length');
        // $film->replacementCost = $request->input('replacementCost');
        // $film->rating = $request->input('rating');

        $film->save();

        return $this->responseOk([
          'message' => 'film successfully updated'
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
        $film = Film::find($id);

        if ($film == null) {
          return $this->responseNotFound('the film you are looking for was not found');
        }

        $film->delete();

        return $this->responseOk([
          'message' => 'film successfully deleted'
        ]);
    }
}
