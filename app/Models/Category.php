<?php

namespace App\Models;

use App\Models\Film;
use Illuminate\Database\Eloquent\Model;

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
