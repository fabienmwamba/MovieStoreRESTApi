<?php
namespace App\Repositories;

use App\Models\Country;
use App\Contracts\Repository;
use App\Repositories\Transformer;

/**
 *  Country's Repository
 */
class CountryRepository extends Transformer implements Repository
{
    /**
     *  Return all actors paginate by the specified limit
     *
     */
    public function getAll($perPage = null)
    {
        $limit = $perPage ? $perPage : SELF::PER_PAGE;

        $countries = Country::with('cities')->paginate($limit);

        return $this->transformCollection($countries->toArray());
    }
    /**
     * Get an actor by his ID
     *
     *  @Return mixed
     */
    public function getById($id)
    {
        $country = Country::find($id);

        if ($country == null) {
            return false;
        }

        return $this->transform($country);
    }

    /**
     *  Add a new Country
     *
     *  @Return boolean
     */
    public function add($request)
    {
        return Country::create($request->all());

    }

    /**
     *  Update the specifeid actor
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
    public function transform($country)
    {
        return [
          'country_name' => $country['country'],
          'country_cities' => $country['cities'],
        ];
    }

    /**
     *  Delete the specified actor
     *
     */
    public function delete($id)
    {
        $country = Country::find($id);

        if ($country == null ) {
            return false;
        }

        try {
          $country->delete();
        } catch (Exception $e) {
          //TODO catch and log exception for future reference
        }

        return true;
    }
}
