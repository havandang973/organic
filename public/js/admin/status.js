
var getSelect = document.querySelectorAll('.status')

getSelect.forEach(function (opt) {
    opt.addEventListener('change', function () {
        var orderId = this.getAttribute('data-order-id');
        var newStatus = this.value

        // console.log(newStatus)
        axios.post('/admin/edit/status/' + orderId, {status: newStatus})
            .then(function (response) {
                alert('Cập nhật trạng thái đơn hàng thành công');
            })
            .catch(function (error) {
                console.log(error)
            })
    })
})

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
                    // console.log(orders)
                    orders.forEach(function(order) {
                        var orderRow = document.querySelector('tr[data-order-id="' + order.id + '"]');
                        var statusSelect = document.querySelector('select[data-order-id="' + order.id + '"]');
                        // console.log(orderRow)

                        // if (orderRow) {
                        //     var statusCell = orderRow.querySelector('.order-status');
                        //     var btnCancel = orderRow.querySelector('.cancel-button');
                        //     if (order.status) {
                        //         console.log('1')
                        //         order.payment_method === "Thanh toán online" 
                        //         ? statusCell.innerText = getStatusText('CANCELED') :
                        //         statusCell.innerText = getStatusText(order.status);
                        //     }
                        // }

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


const BOT_TOKEN = '7380108854:AAG-ROVgI872GE19rWLF8ht_LwWfHlkbytc';
const CHAT_ID = '-4225862101';

function sendTelegramNotification(message) {
    const url = `https://api.telegram.org/bot${BOT_TOKEN}/sendMessage`;
    const params = {
        chat_id: CHAT_ID,
        text: message,
    };

    axios.post(url, params)
        .then(response => {
            console.log('Tin nhắn đã được gửi:', response.data);
        })
        .catch(error => {
            console.error('Có lỗi xảy ra khi gửi tin nhắn:', error);
        });
}

function checkForNewOrders() {
    console.log('check')
    axios.get('/api/check-order-new')
        .then(response => {
            console.log(response.data.newOrders, response.data.checkedAt);
            if (response.data.newOrders > 0) {
                sendTelegramNotification(`Có ${response.data.newOrders} đơn hàng mới. Lúc: ${response.data.checkedAt}`);
            }
        })
        .catch(error => {
            console.error('Có lỗi xảy ra khi kiểm tra đơn hàng mới:', error);
        });
}

setInterval(checkForNewOrders, 20000);