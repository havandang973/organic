document.addEventListener('DOMContentLoaded', function() {
    function getStatusText(status) {
        const statusTexts = {
            'PENDING': 'Đang xử lý',
            'CANCELED': 'Đã hủy',
            'COMPLETED': 'Đã hoàn thành',
            'DELIVERY': 'Đang giao hàng',
            'CONFIRMED': 'Đã xác nhận',
            'PAID': 'Đã thanh toán'
        };
        return statusTexts[status] || status;
    }

    function updateOrderStatuses() {
        axios.get('/api/check-order-status')
            .then(function(response) {
                // console.log(response)

                if (response.data) {
                    var orders = response.data.orders;

                    orders.forEach(function(order) {
                        var orderRow = document.querySelector('tr[data-order-id="' + order.id + '"]');
                        var statusSelect = document.querySelector('select[data-order-id="' + order.id + '"]');

                        if (orderRow) {
                            var statusCell = orderRow.querySelector('.order-status');
                            var btnCancel = orderRow.querySelector('.cancel-button');
                            if (order.status) {
                                statusCell.innerText = getStatusText(order.status);
                                statusCell.className = getStatusClass(order.status) + " order-status";
                            }
                        }

                        if (statusSelect) {
                            Array.from(statusSelect.options).forEach(option => {
                                option.selected = (option.value === order.status);
                            });
                        }
                    });
                } else {
                    console.error('Không thể cập nhật trạng thái đơn hàng:', response.data.message);
                }
            })
            .catch(function(error) {
                console.error('Có lỗi xảy ra:', error);
            });
    }

    function getStatusClass(status) {
        switch(status) {
            case 'PENDING':
                return 'text-warning';
            case 'CANCELED':
                return 'text-danger';
            case 'COMPLETED':
            case 'PAID':
                return 'text-success';
            case 'DELIVERY':
                return 'text-primary';
            case 'CONFIRMED':
                return 'text-info';
            default:
                return '';
        }
    }

    // Gọi hàm cập nhật trạng thái đơn hàng mỗi 3 giây
    setInterval(updateOrderStatuses, 3000);
});

document.addEventListener('DOMContentLoaded', function() {
    // Chọn tất cả các nút hủy có lớp 'cancel-button'
    var cancelButtons = document.querySelectorAll('.cancel-button');

    cancelButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            var orderId = button.querySelector('input[name="order-id"]').value;

            axios.post('/canceled/order/' + orderId)
                .then(function(response) {
                if (response.data.success) {
                    button.style.display = 'none';

                    var orderRow = button.closest('tr'); // Lấy hàng (tr) chứa nút hủy
                    var statusCell = orderRow.querySelector('.order-status');

                    statusCell.classList.remove('text-warning', 'text-success', 'text-primary');
                    statusCell.classList.add('text-danger');
                    statusCell.innerText = 'CANCELED'

                    console.log(statusCell)
                } else {
                    showNotification('Không thể hủy đơn hàng.');
                    console.error('Không thể hủy đơn hàng:', response.data.message);
                }
            }).catch(function(error) {
                console.error('Có lỗi xảy ra:', error);
            });
        });
    });
});
