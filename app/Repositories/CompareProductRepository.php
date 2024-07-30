<?php

namespace App\Repositories;

use App\Models\CompareProduct;
use Illuminate\Support\Facades\Auth;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class CompareProductRepository.
 */
class CompareProductRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return CompareProduct::class;
    }

    public function getAllProducIdtByUser()
    {
        $id = Auth::user()->id;
        return $this->model->where('user_id', $id)->distinct()->get('product_id');
    }

    public function countProductByUser()
    {
        $id = Auth::user()->id;
        return $this->model->where('user_id', $id)->distinct('product_id')->count();
    }
}
