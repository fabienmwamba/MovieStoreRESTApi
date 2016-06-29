<?php
namespace App\Repositories;

use App\Models\Address;
use App\Contracts\Repository;
use App\Repositories\Transformer;

/**
 *  Address's Repository
 */
class AddressRepository extends Transformer implements Repository
{
    /**
     *  Return all addresses paginate by the specified limit
     *
     */
    public function getAll($perPage = null)
    {
        $limit = $perPage ? $perPage : SELF::PER_PAGE;

        $addresses = Address::paginate($limit);

        return $this->transformCollection($addresses->toArray());
    }
    /**
     * Get an address by his ID
     *
     *  @Return mixed
     */
    public function getById($id)
    {
        $address = Address::find($id);

        if ($address == null) {
            return false;
        }

        return $this->transform($address);
    }

    /**
     *  Add a new Address
     *
     *  @Return boolean
     */
    public function add($request)
    {
        return Address::create($request->all());

    }

    /**
     *  Update the specifeid address
     *
     *
     */
    public function update($request, $id)
    {
        $address = Address::find($id);

        if (! $address) {
            return false;
        }

        try {
          $address->firstname = $request->input('firstname');
          $address->lastname = $request->input('lastname');
          $address->save();
        } catch (Exception $e) {
          //TODO catch and log the exception for future reference and debugging
        }

        return true;
    }

    /**
     *  Transformer the return field instead of returning table field
     *
     */
    public function transform($address)
    {
        return [
          'id' => $address['id'],
          'address1' => $address['address1'],
          'address1' => $address['address2'],
          'district' => $address['district'],
          'postal_code' => $address['postalCode'],
          'phone_number' => $address['phone'],
          'city_id' => $address['city_id'],
        ];
    }

    /**
     *  Delete the specified address
     *
     */
    public function delete($id)
    {
        $address = Address::find($id);

        if ($address == null ) {
            return false;
        }

        try {
          $address->delete();
        } catch (Exception $e) {
          //TODO catch and log exception for future reference
        }

        return true;
    }
}
