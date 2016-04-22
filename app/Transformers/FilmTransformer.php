<?php
namespace App\Transformers;

use App\Transformers\Transformer;

class FilmTransformer extends Transformer
{
    public function transform($film)
    {
        return [
          'id' => $film['id'],
          'movie_title' => $film['title'],
          'movie_description' => $film['description'],
          'movie_releaseYear' => $film['releaseYear'],
          'movie_rentalDuration' => $film['rentalDuration'],
          'movie_rentalRate' => $film['rentalRate'],
          'movie_length' => $film['length'],
          'movie_replacementCost' => $film['replacementCost'],
          'movie_rating' => $film['rating'],
          'movie_actors' => $film['actors'],
          'movie_categories' => $film['categories'],
        ];
    }
}
