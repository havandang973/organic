<?php

namespace App\Services;

use App\Models\Address;

/**
 * Class AddressService.
 */
class AddressService
{
    public function store($request) {
        $input = $request->input();
        return Address::query()->create($input);
    }

    public function delete($id) {
        $address = Address::query()->find($id);
        return $address->delete();
    }
}
