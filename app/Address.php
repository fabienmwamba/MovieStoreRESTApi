<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\City;

class Address extends Model
{
    protected $fillable = [
      'address1',
      'address2',
      'district',
      'postalCode',
      'phone',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
