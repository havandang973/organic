<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('index', compact('products'));
    }

    public function find($id) {
        $product = Product::query()->with('description')->find($id);
        $products = Product::all()->random(3);

        return view('productDetail', ['product' => $product, 'products' => $products]);
    }
}
