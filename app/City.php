<?php

namespace App;

use App\Store;
use App\Address;
use App\Country;
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
