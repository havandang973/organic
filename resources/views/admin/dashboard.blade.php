@extends('admin.index')

@section('content')
    <div class="container-fluid py-5">
        <div class="row">
            <div class="col">
                <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                    <div class="card-header">ĐƠN HÀNG THÀNH CÔNG</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $qtyOrderComplete }}</h5>
                        <p class="card-text">Đơn hàng giao dịch thành công</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                    <div class="card-header">ĐANG XỬ LÝ</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $qtyOrderPending }}</h5>
                        <p class="card-text">Số lượng đơn hàng đang xử lý</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                    <div class="card-header">DOANH SỐ</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalFormatted }} VNĐ</h5>
                        <p class="card-text">Doanh số hệ thống</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                    <div class="card-header">ĐƠN HÀNG HỦY</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $qtyOrderCancel }}</h5>
                        <p class="card-text">Số đơn bị hủy trong hệ thống</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- end analytic  -->
        <!-- Modal -->

        <!-- Form lọc theo thời gian -->
        <div class="card mb-4">
            <div class="card-header">
                Lọc doanh số
            </div>
            <div class="card-body">
                <form action="{{ route('admin.dashboard') }}" method="GET">
                    <div class="form-row">
                        <div class="col">
                            <label for="start_date">Ngày bắt đầu</label>
                            <input type="date" class="form-control" id="start_date" name="start_date"
                                value="{{ request('start_date') }}">
                        </div>
                        <div class="col">
                            <label for="end_date">Ngày kết thúc</label>
                            <input type="date" class="form-control" id="end_date" name="end_date"
                                value="{{ request('end_date') }}">
                        </div>
                        <div class="col align-self-end">
                            <button type="submit" class="btn btn-primary">Lọc</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Hiển thị thông báo doanh số -->
        @if (request('start_date') && request('end_date'))
            <div class="alert alert-info">
                {{ $salesMessage }}
            </div>
        @endif

        <div class="card">
            <div class="card-header font-weight-bold">
                Thống kê
            </div>

            <div class="card mb-4">
                <div class="card-body d-flex">
                    <!-- Nút mở modal sản phẩm bán chạy -->
                    <button type="button" class="btn btn-success mr-2" data-toggle="modal" data-target="#bestSellingProductsModal">
                        Sản Phẩm Bán Chạy
                    </button>
                    <!-- Nút mở modal sản phẩm bán chậm -->
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#slowSellingProductsModal">
                        Sản Phẩm Bán Chậm
                    </button>
                </div>
            </div>
            

            <!-- Modal sản phẩm bán chạy -->
            <div class="modal fade" id="bestSellingProductsModal" tabindex="-1" role="dialog"
                aria-labelledby="bestSellingProductsModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title" id="bestSellingProductsModalLabel">Các sản phẩm bán chạy nhất</h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Tên Sản Phẩm</th>
                                        <th>Số Lượng Bán</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bestSellingProducts as $item)
                                        <tr>
                                            <td>{{ $item['product']->name }}</td>
                                            <td>{{ $item['total_quantity_sold'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal sản phẩm bán chậm -->
            <div class="modal fade" id="slowSellingProductsModal" tabindex="-1" role="dialog"
                aria-labelledby="slowSellingProductsModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-warning text-white">
                            <h5 class="modal-title" id="slowSellingProductsModalLabel">Các sản phẩm bán chậm nhất</h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Tên Sản Phẩm</th>
                                        <th>Ngày nhập kho</th>
                                        <th>Số lượng còn lại</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($oldestProducts as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>{{ $item->max_amount }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card mb-4">
                <div class="card-body">
                    <div class="container-fluid py-5">
                        <form action="" method="GET">
                            <div class="row">
                                <!-- Biểu đồ Doanh số theo tháng -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select name="year_sales" id="year_sales" class="form-control"
                                            onchange="this.form.submit()">
                                            @for ($i = date('Y'); $i >= 2022; $i--)
                                                <option value="{{ $i }}"
                                                    {{ request('year_sales', 2024) == $i ? 'selected' : '' }}>
                                                    {{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <canvas id="salesChart" style="max-width: 100%; height: auto;"></canvas>
                                </div>

                                <!-- Biểu đồ Đơn hàng thành công -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select name="year_successful" id="year_successful" class="form-control"
                                            onchange="this.form.submit()">
                                            @for ($i = date('Y'); $i >= 2022; $i--)
                                                <option value="{{ $i }}"
                                                    {{ request('year_successful', 2024) == $i ? 'selected' : '' }}>
                                                    {{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <canvas id="successfulOrdersChart" style="max-width: 100%; height: auto;"></canvas>
                                </div>

                                <!-- Biểu đồ Khách hàng mới -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select name="year_customers" id="year_customers" class="form-control"
                                            onchange="this.form.submit()">
                                            @for ($i = date('Y'); $i >= 2022; $i--)
                                                <option value="{{ $i }}"
                                                    {{ request('year_customers', 2024) == $i ? 'selected' : '' }}>
                                                    {{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <canvas id="customersChart" style="max-width: 100%; height: auto;"></canvas>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        var ctxSales = document.getElementById('salesChart').getContext('2d');
        var ctxSuccess = document.getElementById('successfulOrdersChart').getContext('2d');
        var ctxCancel = document.getElementById('customersChart').getContext('2d');

        var successfulOrdersData = @json(array_values($successfulOrders));
        var salesData = @json(array_values($sales));
        var customersData = @json(array_values($customerRegistrations));

        var months = ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9",
            "Tháng 10", "Tháng 11", "Tháng 12"
        ];

        // Biểu đồ Doanh số
        new Chart(ctxSales, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Doanh số theo tháng',
                    data: salesData,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Biểu đồ Đơn hàng thành công
        new Chart(ctxSuccess, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'Đơn hàng thành công theo tháng',
                    data: successfulOrdersData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Kahcsh hàng mới
        new Chart(ctxCancel, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'Khách hàng mới',
                    data: customersData,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
