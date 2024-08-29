@extends('admin.index')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Danh sách khách hàng thân thiết
        </div>
        <div class="card-body">
            <!-- Filter Form -->
            <form method="GET" action="{{ route('list.customer') }}" class="form-inline mb-4" id="filterForm">
                <div class="form-group mr-2">
                    <label for="name" class="mr-2">Tên khách hàng</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ request('name') }}">
                </div>
                <div class="form-group mr-2">
                    <label for="email" class="mr-2">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ request('email') }}">
                </div>
                <div class="form-group mr-2">
                    <label for="order_count_min" class="mr-2">Số lượng đơn hàng tối thiểu</label>
                    <input type="number" class="form-control" id="order_count_min" name="order_count_min" value="{{ request('order_count_min') }}">
                </div>
                <div class="form-group mr-2">
                    <label for="order_count_max" class="mr-2">Số lượng đơn hàng tối đa</label>
                    <input type="number" class="form-control" id="order_count_max" name="order_count_max" value="{{ request('order_count_max') }}">
                </div>
                <div class="form-group mr-2">
                    <label for="month" class="mr-2">Tháng</label>
                    <select class="form-control" id="month" name="month">
                        <option value="">Chọn tháng</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ request('month') == $i ? 'selected' : '' }}>
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="form-group mr-2">
                    <label for="year" class="mr-2">Năm</label>
                    <select class="form-control" id="year" name="year">
                        <option value="">Chọn năm</option>
                        @foreach (range(2020, date('Y')) as $yearOption)
                            <option value="{{ $yearOption }}" {{ request('year') == $yearOption ? 'selected' : '' }}>
                                {{ $yearOption }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mr-2">
                    <label for="sort" class="mr-2">Sắp xếp theo số lượng đơn hàng</label>
                    <select class="form-control" id="sort" name="sort">
                        <option value="">Chọn sắp xếp</option>
                        <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Tăng dần</option>
                        <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Giảm dần</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Lọc</button>
                <button type="button" class="btn btn-danger ml-2" id="clearAll">Xóa tất cả</button>
            </form>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Tên khách hàng</th>
                        <th scope="col">Email</th>
                        <th scope="col">Số lượng đơn hàng</th>
                        <th scope="col">Ngày có đơn gần nhất</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td><span class="badge badge-success">{{ $customer->orders_count }}</span></td>
                            <td>{{ $customer->latest_order_date ? $customer->latest_order_date : 'Chưa có đơn' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.getElementById('clearAll').addEventListener('click', function() {
        document.getElementById('filterForm').reset();
        document.getElementById('filterForm').submit();
    });
</script>
@endsection
