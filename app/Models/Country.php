<?php

namespace App\Models;

use App\Models\City;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'country'
    ];
    //

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
