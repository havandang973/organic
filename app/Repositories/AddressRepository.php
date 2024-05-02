<?php

namespace App\Repositories;

use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class AddressRepository.
 */
class AddressRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        //return YourModel::class;
        return Address::class;
    }

    public function getAllAddressByUserId($id)
    {
        return $this->model->where('user_id', $id)->get();
    }
}
