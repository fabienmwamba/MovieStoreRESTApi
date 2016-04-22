<?php
namespace App\Transformers;

use App\Transformers\Transformer;

class CategoryTransformer extends Transformer
{
    public function transform($category)
    {
        return [
          'category_name' => $category['name']
        ];
    }
}
