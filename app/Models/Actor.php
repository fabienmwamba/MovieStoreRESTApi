<?php

namespace App\Models;

use App\Models\Film;
use Illuminate\Database\Eloquent\Model;

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
