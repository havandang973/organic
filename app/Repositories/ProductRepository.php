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
        return $this->model->query();
    }

    public function getProductById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function getRandomProduct($amount)
    {
        return $this->model->get()->random($amount);
    }

//    public function getDistinctBrands()
//    {
//        return $this->model->select('brand')->distinct()->pluck('brand');
//    }

//    public function getDistinctCategory()
//    {
//        return $this->model->select('category')->distinct()->pluck('category');
//    }
}
