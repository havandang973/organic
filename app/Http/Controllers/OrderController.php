<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {
        return view('order');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|',
            'address' => 'required|',
            'email' => 'required|email:rfc,dns',
            'phone' => 'required|numeric|',
        ]);

        $data = $request->all();

//        Order::query()->create($data);
        return view('order', compact('data'));
    }
}
