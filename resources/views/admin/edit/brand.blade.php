@extends('admin.index')

@section('content')
    <div id="content" class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        Chỉnh sửa thương hiệu
                    </div>
                    <div class="card-body">
                        <form action="{{ route('brand.update', $brand->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Tên thương hiệu</label>
                                <input class="form-control" type="text" name="name" id="name" value="{{ $brand->brand }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
