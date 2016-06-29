<?php

namespace App\Models;

use App\Models\City;
use Illuminate\Database\Eloquent\Model;

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
