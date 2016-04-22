<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Film;

class Category extends Model
{
    protected $fillable = [
      'name'
    ];

    public function films()
    {
        return $this->belongsToMany(Film::class);
    }
}
