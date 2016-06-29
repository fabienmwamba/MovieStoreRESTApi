<?php
namespace App\Repositories;

use App\Models\Store;
use App\Contracts\Repository;
use App\Repositories\Transformer;

/**
 *  Store's Repository
 */
class StoreRepository extends Transformer implements Repository
{
    /**
     *  Return all actors paginate by the specified limit
     *
     */
    public function getAll($perPage = null)
    {
        $limit = $perPage ? $perPage : SELF::PER_PAGE;

        $stores = Store::with('films')->paginate($limit);

        return $this->transformCollection($stores->toArray());
    }
    /**
     * Get an actor by his ID
     *
     *  @Return mixed
     */
    public function getById($id)
    {
        $store = Store::find($id);

        if ($store == null) {
            return false;
        }

        return $this->transform($store);
    }

    /**
     *  Add a new Store
     *
     *  @Return boolean
     */
    public function add($request)
    {
        return Store::create($request->all());

    }

    /**
     *  Update the specifeid actor
     *
     *
     */
    public function update($request, $id)
    {
      //TODO:: to be implemented
    }

    /**
     *  Transformer the return field instead of returning table field
     *
     */
    public function transform($store)
    {
        return [
          'store_name' => $store['name'],
          'store_city' => $store['city_id'],
        ];
    }

    /**
     *  Delete the specified actor
     *
     */
    public function delete($id)
    {
        $store = Store::find($id);

        if ($store == null ) {
            return false;
        }

        try {
          $store->delete();
        } catch (Exception $e) {
          //TODO catch and log exception for future reference
        }

        return true;
    }
}
