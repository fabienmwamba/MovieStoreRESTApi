<?php

namespace App\Models;

use App\Models\Actor;
use App\Models\Category;
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
