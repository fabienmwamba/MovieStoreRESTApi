<?php
namespace App\Transformers;

use App\Transformers\Transformer;

class CategoryTransformer extends Transformer
{
  /**
   * Transform the category data
   *
   * @return array
   */
    public function transform($category)
    {
        return [
          'category_name' => $category['name'],
          'category_films' => $category['films']
        ];
    }
}
