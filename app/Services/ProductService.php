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

        return CompareProduct::query()->create([
            'product_id' => $data['product_id'],
            'user_id' => Auth::id()
        ]);
    }

    public function deleteCompareProduct($request) {
        $data = $request->input();

        return CompareProduct::query()->where('product_id', $data['product_id'])->delete();
    }
}
