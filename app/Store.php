<?php

namespace App;

use App\City;
use Illuminate\Database\Eloquent\Model;
class Store extends Model
{
    protected $fillable = [
      'name',
    ];

    public function City()
    {
        return $this->belongsTo(City::class);
    }
}
