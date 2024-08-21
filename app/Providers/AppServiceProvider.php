<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\CompareProduct;
use Illuminate\Support\Facades\View;
use App\Models\Product;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.header', function ($view) {
            // Lấy danh sách danh mục
            $categories = Category::all();
    
            // Lấy số lượng sản phẩm trong danh sách so sánh của người dùng hiện tại
            $productIds = CompareProduct::where('user_id', auth()->id())
            ->pluck('product_id'); // Chỉ lấy cột product_id

            // Lọc các sản phẩm chưa bị xóa từ bảng products
            $amount = Product::whereIn('id', $productIds)
            ->whereNull('deleted_at') // Chỉ lấy các sản phẩm chưa bị xóa
            ->count();    
            
            $view->with('categories', $categories)
                 ->with('amount', $amount);
        });
    }
}
