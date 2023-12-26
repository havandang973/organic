@extends('admin.index')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Sửa người dùng
            </div>
            <div class="card-body">
                <form action="{{route('edit.user', $user->name)}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Họ và tên</label>
                        <input class="form-control" type="text" name="name" id="name" value="{{$user->name}}">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" type="text" name="email" id="email" value="{{$user->email}}">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="form-group">
                        <label for="">Nhóm quyền</label>
                        <select class="form-control" id="" name="role">
                            <option>{{ $user->role }}</option>
                            <option>{{ $user->role === 'CUSTOMER' ? 'ADMIN' : 'CUSTOMER' }}
                        </select>
                    </div>

                    <x-primary-button class="bg-blue-500">
                        Lưu
                    </x-primary-button>
                    <a href="{{route('list.user')}}" class="btn text-xs uppercase font-semibold rounded-md border border-transparent text-white px-6 py-2 bg-red-500">Hủy</a>

                </form>
            </div>
        </div>
    </div>
@endsection
