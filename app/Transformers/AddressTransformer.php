<?php
namespace App\Transformers;

use App\Transformers\Transformer;

class AddressTransformer extends Transformer
{
    public function transform($address)
    {
        return [
            'id' => $address['id'],
            'address1' => $address['address1'],
            'address1' => $address['address2'],
            'district' => $address['district'],
            'postal_code' => $address['postalCode'],
            'phone_number' => $address['phone'],
            'city_id' => $address['city_id'],
        ];
    }
}
