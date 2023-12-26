<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

        toastr()->success('Thêm User thành công', ['timeOut' => 2000]);
        return view('admin.add.user');
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

        toastr()->success('Chỉnh sửa User thành công', ['timeOut' => 2000]);
        return redirect()->route('list.user');
    }

    public function index_delete(Request $request, $name) {
        $user = User::query()->where('name', $name)->first();
        return view('admin.delete.user', compact('user'));
    }

    public function delete(Request $request, $name)
    {
        $user = User::query()->where('name', $name)->first();

        $user->delete();

        toastr()->success('Xóa User thành công', ['timeOut' => 2000]);
        return redirect()->route('list.user');
    }

}
