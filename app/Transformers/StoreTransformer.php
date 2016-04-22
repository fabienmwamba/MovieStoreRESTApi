<?php
namespace App\Transformers;

use App\Transformers\Transformer;

class StoreTransformer extends Transformer
{
    public function transform($store)
    {
        return [
            'store_name' => $store['name'],
            'store_city' => $store['city_id'],
        ];
    }
}
