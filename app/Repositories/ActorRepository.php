<?php
namespace App\Repositories;

use App\Models\Actor;
use App\Contracts\Repository;
use App\Repositories\Transformer;

/**
 *  Actor's Repository
 */
class ActorRepository extends Transformer implements Repository
{
    /**
     *  Return all actors paginate by the specified limit
     *
     */
    public function getAll($perPage = null)
    {
        $limit = $perPage ? $perPage : SELF::PER_PAGE;

        $actors = Actor::with('films')->paginate($limit);

        return $this->transformCollection($actors->toArray());
    }
    /**
     * Get an actor by his ID
     *
     *  @Return mixed
     */
    public function getById($id)
    {
        $actor = Actor::find($id);

        if ($actor == null) {
            return false;
        }

        return $this->transform($actor);
    }

    /**
     *  Add a new Actor
     *
     *  @Return boolean
     */
    public function add($request)
    {
        return Actor::create($request->all());

    }

    /**
     *  Update the specifeid actor
     *
     *
     */
    public function update($request, $id)
    {
        $actor = Actor::find($id);

        if (! $actor) {
            return false;
        }

        try {
          $actor->firstname = $request->input('firstname');
          $actor->lastname = $request->input('lastname');
          $actor->save();
        } catch (Exception $e) {
          //TODO cathc and log the exception for future reference and debugging
        }

        return true;
    }

    /**
     *  Transformer the return field instead of returning table field
     *
     */
    public function transform($actor)
    {
        return [
          'first_name'=>$actor['firstname'],
          'last_name'=>$actor['lastname'],
          'actor_films'=> $actor['films'],
        ];
    }

    /**
     *  Delete the specified actor
     *
     */
    public function delete($id)
    {
        $actor = Actor::find($id);

        if ($actor == null ) {
            return false;
        }

        try {
          $actor->delete();
        } catch (Exception $e) {
          //TODO catch and log exception for future reference
        }

        return true;
    }
}
