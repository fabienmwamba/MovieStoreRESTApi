<?php
namespace App\Transformers;

use App\Transformers\Transformer;

class CountryTransformer extends Transformer
{
    public function transform($country)
    {
        return [
            'country_name' => $country['country'],
            'country_cities' => $country['cities'],
        ];
    }
}
