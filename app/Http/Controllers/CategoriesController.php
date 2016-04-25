<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Transformers\CategoryTransformer;

class CategoriesController extends ApiController
{
  /**
   * The data transformer used to transform data
   *
   * @var CategoryTransformer
   */
    protected $transformer;

    public function __construct(CategoryTransformer $transformer)
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
        $limit = $request->input('limit') ? $request->input('limit') :10;

        $categories = Category::with('films')->paginate($limit);

        if ($categories == null) {
          return $this->responseNotFound('Oops no category found');
          # code...
        }

        return $this->responseOk([
            'categories' => $this->transformer->transformCollection($categories->toArray())
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
        $this->validate($request, ['name'=>'required']);

        Category::create($request->all());

        return $this->responseOk([
          'message' => 'category successfully created',
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
        $category = Category::find($id);

        if ($category == null) {
          return $this->responseNotFound('category not found!');
        }

        return $this->responseOk([
          'category' => $this->transformer->transform($category)
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
        $this->validate($request, ['name'=>'required']);
        $category = Category::find($id);

        if ($category == null) {
          return $this->responseNotFound('category not found');
        }

        $category->name = $request->input('name');

        $category->save();

        return $this->responseOk([
          'message' => 'category successfully updated'
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
        $category = Category::find($id);

        if ($category == null) {
          return $this->responseNotFound('category not found');
        }
        $category->delete();

        return $this->responseOk([
          'message' => 'category successfully deleted'
        ]);
    }
}
