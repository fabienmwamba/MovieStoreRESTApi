<?php
namespace App\Transformers;

use App\Transformers\Transformer;

class LanguageTransformer extends Transformer
{
    /**
     * Transformer the language data into an array
     * @return array
     */
     public function transform($language)
     {
        return [
            'language_name' => $language['name'];
        ];
     }
}
