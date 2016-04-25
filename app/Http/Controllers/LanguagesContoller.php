<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Language;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Transformers\LanguageTransformer;

class LanguagesContoller extends Controller
{
    /**
     *
     */
     protected $transformer;

     public function __construct(LanguageTransformer $transformer)
     {
        $this->transformer = $transformer;
     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'index language';
        // $limit = $request->input('limit') ? $request->input('limit') : 10;
        //
        // $languages = Language::paginate($limit);
        //
        // if ($languages == null) {
        //   return $this->responseNotFound('no language found');
        // }
        //
        // return $this->responseOk([
        //   'languages' => $this->transformer->tranformCollection($languages->toArray());
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
