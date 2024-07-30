<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
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

    public function index_edit(Request $request, $name) {
        $product = Product::query()->where('name', $name)->first();
        return view('admin.edit.product', compact('product'));
    }

    public function create(Request $request) {
        $request->validate([
            'name' => ['required'],
            'price' => ['required', 'numeric'],
            'discount' => ['required', 'numeric'],
            'code' => ['required'],
            'img' => ['required'],
            'brand' => ['required'],
            'color' => ['required'],
            'origin' => ['required'],
            'max_amount' => ['required', 'numeric'],
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

        toastr()->success('Thêm sản phẩm thành công', ['timeOut' => 2000]);
        return redirect()->route('list.product');
    }

    public function edit(Request $request, $name) {
        $product = Product::query()->where('name', $name)->first();

//        $request->validate(
//            [
//                'name' => 'required',
//                'email' => 'required|email:rfc,dns|unique:users,email,' . $user->id
//            ]
//        );
        $data = $request->all();
        $product->fill($data);
        $product->save();

        toastr()->success('Chỉnh sửa sản phẩm thành công', ['timeOut' => 2000]);
        return redirect()->route('list.product');
    }

    public function delete(Request $request, $name) {
        $product = Product::query()->where('name', $name)->first();

//        dd($product->currentPage());
        $product->delete();

        toastr()->success('Xóa sản phẩm thành công', ['timeOut' => 2000]);
        return redirect()->back();
    }
}
