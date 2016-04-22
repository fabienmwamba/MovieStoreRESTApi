<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Actor;
class Film extends Model
{
    protected $fillable = [
      'title',
      'description',
      'releaseYear',
      'rentalDuration',
      'rentalRate',
      'length',
      'replacementCost',
      'rating',
    ];

    public function actors()
    {
        return $this->belongsToMany(Actor::class);
    }
}
