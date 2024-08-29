<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
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

        if ($request->has('category')) {
            $query->where('category_id', $request->query('category'));
        }

        if ($request->has('categories')) {
            $query->whereIn('category_id', $request->input('categories'));
        }

        if ($request->has('brands')) {
            $query->whereIn('brand_id', $request->input('brands'));
        }

        if ($request->has('price_min') && $request->has('price_max')) {
            $query->whereBetween('price', [$request->input('price_min'), $request->input('price_max')]);
        }

        $products = $query->paginate(6);

        return view('product', compact('products', 'brands', 'categories'));
    }

    public function bestProduct()
    {
        $bestSellingProducts = $this->bestSellingProducts();
        $newProducts = $this->productRepo->getAllProduct()->orderBy('created_at', 'DESC')->take(8)->get();
        return view('index', compact('bestSellingProducts', 'newProducts'));
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

    public function bestSellingProducts()
    {
        $products = Order::where('status', 'COMPLETED')
            ->with('orderDetail.product') // Tải thông tin chi tiết đơn hàng và sản phẩm
            ->get()
            ->flatMap(fn($order) => $order->orderDetail) // Lấy tất cả chi tiết đơn hàng từ các đơn hàng thành công
            ->groupBy('product_id') // Nhóm theo sản phẩm
            ->sortByDesc(fn($group) => $group->sum('qty')) // Sắp xếp theo số lượng bán giảm dần
            ->take(6)
            ->map(fn($group) => $group->first()->product); // Chỉ trả về thông tin sản phẩm

        return $products;
    }

    public function search(Request $request)
    {
        $brands = Brand::query()->get();
        $categories = Category::query()->get();

        $query = $request->input('query');
        $products = Product::where('name', 'LIKE', "%{$query}%")->paginate(6);

        return view('product', compact('products', 'brands', 'categories'));
    }
}
