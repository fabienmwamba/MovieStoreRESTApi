<?php
namespace App\Transformers;

use App\Transformers\Transformer;

class CountryTransformer extends Transformer
{
  /**
   * transform the the country's data.
   *
   * @return Array
   */
    public function transform($country)
    {
        return [
            'country_name' => $country['country'],
            'country_cities' => $country['cities'],
        ];
    }
}
