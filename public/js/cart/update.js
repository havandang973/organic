var updateCart = document.querySelectorAll('.updateCart');
updateCart.forEach(function (btn) {
    btn.addEventListener('click', function (event) {
        event.preventDefault();

        var formData = new FormData(btn.closest('.updateCartForm'));

        axios.post('/carts/update', formData) // Use the link as the endpoint
            .then(function (response) {
                document.getElementById('amount').innerText = response.data.cartCount;
                showNotification('Cập nhật giỏ hàng thành công');
                updateTotal(response.data.total)
                document.getElementById('error-item').classList.add('d-none');
            })
            .catch(function (error) {
                document.getElementById('error-item').classList.remove('d-none');
                document.getElementById('error').innerText = "Số lượng sản phẩm không hợp lệ";
            });
    });
});

function updateTotal(total) {
    var itemTotal = document.getElementsByClassName('total');

    Array.from(itemTotal).forEach(function(e) {
        e.innerText = total + 'đ';
    });
}
