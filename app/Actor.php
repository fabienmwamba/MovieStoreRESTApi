<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Film;

class Actor extends Model
{
    protected $fillable = [
      'firstname',
      'lastname'
    ];

    public function films()
    {
        return $this->belongsToMany(Film::class);
    }
}
