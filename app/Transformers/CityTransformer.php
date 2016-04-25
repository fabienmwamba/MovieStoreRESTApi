<?php
namespace App\Transformers;

use App\Transformers\Transformer;

class CityTransformer extends Transformer
{
  /**
   * Transform the city's data
   *
   * @return array
   */
    public function transform($city)
    {
        return [
          'id' => $city['id'],
          'city_name' => $city['city'],
          'country_id' => $city['country_id'],
          'city_addresses' => $city['addresses'],
          'city_stores' => $city['stores'],
        ];
    }
}
