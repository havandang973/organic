var getSelect = document.querySelectorAll('.status')

getSelect.forEach(function (opt) {
    opt.addEventListener('change', function () {
        var orderId = this.getAttribute('data-order-id');
        var newStatus = this.value

        console.log(newStatus)
        axios.post('/admin/edit/status/' + orderId, {status: newStatus})
            .then(function (response) {
                alert('Cập nhật trạng thái đơn hàng thành công');
            })
            .catch(function (error) {
                console.log(error)
            })
    })
})
