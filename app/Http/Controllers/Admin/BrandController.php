<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index() {
        $brands = Brand::query()->latest('created_at')->get();

        return view('admin.brand', compact('brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Brand::create([
            'brand' => $request->name,
        ]);

        return redirect()->route('brand.product')->with('success', 'Thương hiệu đã được thêm thành công!');
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.edit.brand', compact('brand'));
    }

    // Cập nhật thương hiệu
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $brand = Brand::findOrFail($id);
        $brand->update([
            'brand' => $request->name,
        ]);

        return redirect()->route('brand.product')->with('success', 'Thương hiệu đã được cập nhật thành công!');
    }

    // Xóa thương hiệu
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        return redirect()->route('brand.product')->with('success', 'Thương hiệu đã được xóa thành công!');
    }
}
