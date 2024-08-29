<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Repositories\CompareProductRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function index(Request $request) {
        $query = Product::query();

        if ($request->filled('code')) {
            $query->where('code', 'like', '%' . $request->code . '%');
        }

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('max_amount_min')) {
            $query->where('max_amount', '>=', $request->max_amount_min);
        }

        if ($request->filled('max_amount_max')) {
            $query->where('max_amount', '<=', $request->max_amount_max);
        }

        $products = $query->latest('created_at')->paginate(5);
        $lowStockProducts = Product::where('max_amount', '<', 10)->latest('created_at')->get();

        return view('admin.list.product', compact('products', 'lowStockProducts'));
    }

    public function index_add() {
        $categories = Category::query()->get();
        $brands = Brand::query()->get();

        return view('admin.add.product', compact('categories', 'brands'));
    }

    public function index_edit(Request $request, $name) {
        $product = Product::query()->where('name', $name)->first();
        $categories = Category::query()->get();
        $brands = Brand::query()->get();

        return view('admin.edit.product', compact('product', 'categories', 'brands'));
    }

    public function create(Request $request) {
//        dd($request->all());
        $request->validate([
            'name' => ['required'],
            'price' => ['required', 'numeric'],
            'discount' => ['required', 'numeric'],
            'code' => ['required'],
            'img' => ['required'],
            'brand_id' => ['required'],
            'color' => ['required'],
            'origin' => ['required'],
            'max_amount' => ['required', 'numeric'],
            'category_id' => ['required'],
            'describe' => ['required'],
        ]);

        $input = $request->all();
        $input['amount'] = 1;
        if($request->hasFile('img')) {
            $file = $request->file('img');

            $fileName = $file->getClientOriginalName();

            $path = $file->move('uploads', $file->getClientOriginalName());

            $img = 'uploads/'. $fileName;

            $input['thumbnail'] = $img;
        }

        Product::query()->create($input);

//        Product::query()->create([
//            'name' => $request->name,
//            'price' => $request->price,
//            'discount' => $request->discount,
//            'code' => $request->code,
//            'thumbnail' => $request->img,
//            'brand' => $request->brand,
//            'color' => $request->color,
//            'origin' => $request->origin,
//            'max_amount' => $request->max,
//            'describe' => $request->describe_detail,
//        ]);

        return redirect()->route('list.product')->with('success', 'Thêm sản phẩm thành công');
    }

    public function edit(Request $request, $name) {
        $product = Product::query()->where('name', $name)->first();

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric|min:1',
            'discount' => 'nullable|numeric',
            'code' => 'required|unique:products,code,' . $product->id,
            'color' => 'required',
            'origin' => 'required',
            'max_amount' => 'required|numeric',
            'describe' => 'required',
            'img' => 'nullable|image',
        ], [
            'name.required' => 'Tên sản phẩm là bắt buộc.',
            'price.required' => 'Giá sản phẩm là bắt buộc.',
            'price.numeric' => 'Giá sản phẩm phải là số.',
            'price.min' => 'Giá sản phẩm phải lớn hơn 0.',
            'discount.numeric' => 'Giảm giá phải là số.',
            'code.required' => 'Mã sản phẩm là bắt buộc.',
            'code.unique' => 'Mã sản phẩm đã tồn tại.',
            'color.required' => 'Màu sắc là bắt buộc.',
            'origin.required' => 'Nguồn gốc là bắt buộc.',
            'max_amount.required' => 'Số lượng tối đa là bắt buộc.',
            'max_amount.numeric' => 'Số lượng tối đa phải là số.',
            'describe.required' => 'Mô tả sản phẩm là bắt buộc.',
            'img.image' => 'Ảnh sản phẩm phải là định dạng hình ảnh hợp lệ.',
        ]);        
        
        $data = $request->all();

        if ($request->hasFile('img')) {
            // Xóa ảnh cũ 
            if ($product->thumbnail && file_exists(public_path($product->thumbnail))) {
                unlink(public_path($product->thumbnail));
            }
    
            // Lưu ảnh mới
            $imageName = $request->img->getClientOriginalName();
            $request->img->move(public_path('uploads/'), $imageName);
            $data['thumbnail'] = 'uploads/'.$imageName;
        }
        
        $product->fill($data);
        $product->save();

        return redirect()->route('list.product')->with('success', 'Chỉnh sửa sản phẩm thành công');
    }

    public function delete(Request $request, $name) {
        $product = Product::query()->where('name', $name)->first();

//        dd($product->currentPage());
        $product->delete();

        return redirect()->back()->with('success', 'Xóa sản phẩm thành công');
    }
}
