<?php
namespace App\Repositories;

use App\Models\Film;
use App\Contracts\Repository;
use App\Repositories\Transformer;

/**
 *  Film's Repository
 */
class FilmRepository extends Transformer implements Repository
{
    /**
     *  Return all actors paginate by the specified limit
     *
     */
    public function getAll($perPage = null)
    {
        $limit = $perPage ? $perPage : SELF::PER_PAGE;

        $films = Film::with('actors', 'categories')->paginate($limit);

        return $this->transformCollection($films->toArray());
    }
    /**
     * Get an actor by his ID
     *
     *  @Return mixed
     */
    public function getById($id)
    {
        $film = Film::find($id);

        if ($film == null) {
            return false;
        }

        return $this->transform($film);
    }

    /**
     *  Add a new Film
     *
     *  @Return boolean
     */
    public function add($request)
    {
        try {
          $film = new Film();
          $film->title = $request->input('title');
          $film->description = $request->input('description');
          $film->rentalDuration = $request->input('rentalDuration');
          $film->rentalRate = $request->input('rentalRate');
          $film->replacementCost = $request->input('replacementCost');
          $film->releaseYear = $request->input('releaseYear');
          $film->length = $request->input('length');
          $film->rating = $request->input('rating');
          $film->language_id = $request->input('language_id');
          return true;
        } catch (Exception $e) {
          //TODO: catch and log exception for further reference
        }

    }

    /**
     *  Update the specifeid actor
     *
     *
     */
    public function update($request, $id)
    {
        $film = Film::find($id);

        if (! $film) {
            return false;
        }

        try {
          $film->firstname = $request->input('firstname');
          $film->lastname = $request->input('lastname');
          $film->save();
        } catch (Exception $e) {
          //TODO cathc and log the exception for future reference and debugging
        }

        return true;
    }

    /**
     *  Transformer the return field instead of returning table field
     *
     */
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

    /**
     *  Delete the specified actor
     *
     */
    public function delete($id)
    {
        $film = Film::find($id);

        if ($film == null ) {
            return false;
        }

        try {
          $film->delete();
        } catch (Exception $e) {
          //TODO catch and log exception for future reference
        }

        return true;
    }
}
