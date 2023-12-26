<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function index() {
        $products = $this->productRepo->getAllProduct();
//        dd($products);
//        $products = Product::all();
        return view('index', compact('products'));
    }

    public function find($id) {
//            $product = Product::query()->with('description')->findOrFail($id);
//            $products = Product::all()->random(3);

            $product = $this->productRepo->getProductById($id);
            $products = $this->productRepo->getRandomProduct(3);

            return view('productDetail', ['product' => $product, 'products' => $products]);
    }
}
