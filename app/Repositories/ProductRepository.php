<?php

namespace App\Repositories;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model
use App\Models\Product;
/**
 * Class ProductRepository.
 */
class ProductRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        //return YourModel::class;
        return Product::class;
    }

    public function getAllProduct()
    {
        return $this->model->get();
    }

    public function getProductById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function getRandomProduct($amount)
    {
        return $this->model->get()->random($amount);
    }
}
