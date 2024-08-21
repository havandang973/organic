<?php

namespace App\Services;

use App\Models\CompareProduct;
use Illuminate\Support\Facades\Auth;

/**
 * Class ProductService.
 */
class ProductService
{
    public function storeCompareProduct($request) {
        $data = $request->input();
        $productId = $data['product_id'];
        $userId = Auth::id();
    
        // Kiểm tra xem sản phẩm đã tồn tại trong bảng compare_products cho người dùng hiện tại chưa
        $exists = CompareProduct::where('product_id', $productId)
                                ->where('user_id', $userId)
                                ->exists();
    
        if (!$exists) {
            // Nếu sản phẩm chưa tồn tại, tạo mới
            CompareProduct::query()->create([
                'product_id' => $productId,
                'user_id' => $userId
            ]);
        }
    
        return;
    }    

    public function deleteCompareProduct($request) {
        $data = $request->input();

        return CompareProduct::query()->where('product_id', $data['product_id'])->delete();
    }
}
