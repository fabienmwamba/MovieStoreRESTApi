<?php
namespace App\Repositories;

use App\Models\Category;
use App\Contracts\Repository;
use App\Repositories\Transformer;

/**
 *  Category's Repository
 */
class CategoryRepository extends Transformer implements Repository
{
    /**
     *  Return all actors paginate by the specified limit
     *
     */
    public function getAll($perPage = null)
    {
        $limit = $perPage ? $perPage : SELF::PER_PAGE;

        $categories = Category::with('films')->paginate($limit);

        return $this->transformCollection($categories->toArray());
    }
    /**
     * Get an actor by his ID
     *
     *  @Return mixed
     */
    public function getById($id)
    {
        $category = Category::find($id);

        if ($category == null) {
            return false;
        }

        return $this->transform($category);
    }

    /**
     *  Add a new Category
     *
     *  @Return boolean
     */
    public function add($request)
    {
        return Category::create($request->all());

    }

    /**
     *  Update the specifeid actor
     *
     *
     */
    public function update($request, $id)
    {
        $category = Category::find($id);

        if (! $category) {
            return false;
        }

        try {
          $category->firstname = $request->input('firstname');
          $category->lastname = $request->input('lastname');
          $category->save();
        } catch (Exception $e) {
          //TODO cathc and log the exception for future reference and debugging
        }

        return true;
    }

    /**
     *  Transformer the return field instead of returning table field
     *
     */
    public function transform($category)
    {
        return [
          'category_name' => $category['name'],
          'category_films' => $category['films']
        ];
    }

    /**
     *  Delete the specified actor
     *
     */
    public function delete($id)
    {
        $category = Category::find($id);

        if ($category == null ) {
            return false;
        }

        try {
          $category->delete();
        } catch (Exception $e) {
          //TODO catch and log exception for future reference
        }

        return true;
    }
}
