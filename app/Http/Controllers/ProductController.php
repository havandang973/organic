<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\CompareProductRepository;
use App\Services\ProductService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct(ProductRepository $productRepo, CompareProductRepository $compareProductRepo)
    {
        $this->productRepo = $productRepo;
        $this->compareProductRepo = $compareProductRepo;
    }

    public function index(Request $request)
    {
        $brands = Brand::query()->get();
        $categories = Category::query()->get();
        $query = $this->productRepo->getAllProduct();

        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }
        
        $products = $query->paginate(4);

        return view('product', compact('products', 'brands', 'categories'));
    }

    public function bestProduct()
    {
        $products = $this->productRepo->getAllProduct()->get();
        return view('index', compact('products'));
    }

    public function find($id)
    {
        //            $product = Product::query()->with('description')->findOrFail($id);
        //            $products = Product::all()->random(3);

        $product = $this->productRepo->getProductById($id);
        //            $products = $this->productRepo->getRandomProduct(7);
        $products = $this->productRepo->getAllProduct()->get();

        return view('product-details', ['product' => $product, 'products' => $products]);
    }

    public function showCompare(Request $request)
    {
        if (!Auth::check()) {
            return view('auth.login');
        }

        $productIds = $this->compareProductRepo->getAllProducIdtByUser();

        $query = Product::whereIn('id', $productIds);

        if ($request->has('sort_price') && $request->sort_price != '') {
            $sortOrder = $request->sort_price === 'asc' ? 'asc' : 'desc';
            $query->orderBy('price', $sortOrder);
        }

        if ($request->has('min_price') && $request->min_price != '') {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price') && $request->max_price != '') {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->paginate(5);

        return view('compare', compact('products'));
    }

    public function storeCompare(Request $request)
    {
        (new ProductService())->storeCompareProduct($request);

        $amount = $this->compareProductRepo->countProductByUser();

        return response()->json(['compareProductAmount' => $amount]);
    }

    public function deleteCompare(Request $request)
    {
        (new ProductService())->deleteCompareProduct($request);

        $amount = $this->compareProductRepo->countProductByUser();

        return response()->json(['compareProductAmount' => $amount]);
    }
}
