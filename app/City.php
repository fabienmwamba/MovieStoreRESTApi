<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Country;
use App\Address;

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
}
