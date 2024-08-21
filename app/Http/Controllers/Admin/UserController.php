<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $users = User::paginate(5);
        return view('admin.list.user', compact('users'));
    }

    public function customer(Request $request)
{
    $query = User::withCount([
        'order as orders_count' => function ($query) {
            $query->where('status', 'COMPLETED');
        }
    ])
    ->having('orders_count', '>=', 3);

    // Apply filters
    if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->input('name') . '%');
    }

    if ($request->filled('email')) {
        $query->where('email', 'like', '%' . $request->input('email') . '%');
    }

    if ($request->filled('order_count_min')) {
        $query->having('orders_count', '>=', $request->input('order_count_min'));
    }

    if ($request->filled('order_count_max')) {
        $query->having('orders_count', '<=', $request->input('order_count_max'));
    }

    $customers = $query->get();

    foreach ($customers as $customer) {
        $customer->latest_order_date = $customer->order()->where('status', 'COMPLETED')->latest('created_at')->value('created_at');
    }

    return view('admin.list.customer', compact('customers'));
}


    public function add(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return view('admin.add.user')->with('success', 'Thêm User thành công');
    }

    public function index_edit(Request $request, $name) {
        $user = User::query()->where('name', $name)->first();
        return view('admin.edit.user', compact('user'));
    }

    public function edit(Request $request, $name) {
        $user = User::query()->where('name', $name)->first();

        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email:rfc,dns|unique:users,email,' . $user->id
            ]
        );
        $data = $request->all();
        $user->fill($data);
        $user->save();

        return redirect()->route('list.user')->with('success', 'Chỉnh sửa User thành công');
    }

    public function index_delete(Request $request, $name) {
        $user = User::query()->where('name', $name)->first();
        return view('admin.delete.user', compact('user'));
    }

    public function delete(Request $request, $name)
    {
        $user = User::query()->where('name', $name)->first();

        $user->delete();

        return redirect()->route('list.user')->with('success', 'Xóa User thành công');
    }

//    public function deletes(Request $request, $names)
//    {
//        User::query()->where('name', $names)->delete();
//
//        toastr()->success('Xóa tất cả user thành công', ['timeOut' => 2000]);
//        return redirect()->route('list.user');
//    }
}
