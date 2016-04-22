<?php

namespace App;

use App\Actor;
use App\Category;
use Illuminate\Database\Eloquent\Model;
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

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
