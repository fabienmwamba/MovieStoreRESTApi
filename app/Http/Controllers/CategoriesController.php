<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;

class CategoriesController extends ApiController
{
  /**
   * The Hold the category's repository
   *
   * @var mixed
   */
    protected $repository;

    public function __construct(CategoryRepository $repository)
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

        $categories = $this->repository->getAll($limit);

        return $this->responseOk([
            'message' => 'success',
            'actors' => $categories,
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

        $category = $this->repository->add($request);

        if (! $category) {
            return 'could not create resource';
        }

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
    public function show($CategoryId)
    {
        $category = $this->repository->getById($CategoryId);

        if (! $category) {
          return $this->responseNotFound('Oops the category was not found');
        }

        return $this->responseOk([
          'message' => 'success',
          'actor' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $CategoryId)
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
    public function destroy($CategoryId)
    {
        $category = $this->repository->delete($CategoryId);

        if (! $category) {
          return 'coul not delete actor';
        }

        return $this->responseOk([
          'message' => 'category deleted successfully'
        ]);
    }
}
