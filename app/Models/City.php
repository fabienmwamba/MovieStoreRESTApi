<?php

namespace App\Models;

use App\Models\Store;
use App\Models\Address;
use App\Models\Country;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
      'city'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function stores()
    {
        return $this->hasMany(Store::class);
    }
}
