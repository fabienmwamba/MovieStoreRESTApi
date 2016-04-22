<?php
namespace App\Transformers;

use App\Transformers\Transformer;

class CityTransformer extends Transformer
{
    public function transform($city)
    {
        return [
          'id' => $city['id'],
          'city_name' => $city['city'],
          'country_id' => $city['country_id'],
          'city_addresses' => $city['addresses'],
        ];
    }
}
