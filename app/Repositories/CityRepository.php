<?php
namespace App\Repositories;

use App\Models\City;
use App\Contracts\Repository;
use App\Repositories\Transformer;

/**
 *  City's Repository
 */
class CityRepository extends Transformer implements Repository
{
    /**
     *  Return all actors paginate by the specified limit
     *
     */
    public function getAll($perPage = null)
    {
        $limit = $perPage ? $perPage : SELF::PER_PAGE;

        $cities = City::with('addresses', 'stores')->paginate($limit);

        return $this->transformCollection($cities->toArray());
    }
    /**
     * Get an city by his ID
     *
     *  @Return mixed
     */
    public function getById($id)
    {
        $city = City::find($id);

        if ($city == null) {
            return false;
        }

        return $this->transform($city);
    }

    /**
     *  Add a new City
     *
     *  @Return boolean
     */
    public function add($request)
    {
        try {
          $city = new City();
          $city->city = $request->input('city');
          $city->country_id = $request->input('country_id');
          $city->save();
          return true;
        } catch (Exception $e) {
          //TODO: catch and log exception for further reference
        }
    }

    /**
     *  Update the specifeid city
     *
     *
     */
    public function update($request, $id)
    {
        //TODO to be implemented
    }

    /**
     *  Transformer the return field instead of returning table field
     *
     */
    public function transform($city)
    {
        return [
          'id' => $city['id'],
          'city_name' => $city['city'],
          'country_id' => $city['country_id'],
          'city_addresses' => $city['addresses'],
          'city_stores' => $city['stores'],
        ];
    }

    /**
     *  Delete the specified actor
     *
     */
    public function delete($id)
    {
        $city = City::find($id);

        if ($city == null ) {
            return false;
        }

        try {
          $city->delete();
          return true;
        } catch (Exception $e) {
          //TODO catch and log exception for future reference
        }
    }
}
