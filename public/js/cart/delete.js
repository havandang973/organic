var removeCart = document.querySelectorAll('.removeCart');
removeCart.forEach(function (btn) {
    btn.addEventListener('click', function (event) {
        event.preventDefault();
        var rowId = btn.getAttribute('data-row-id');

        axios.get('/carts/delete/' + rowId) // Use the link as the endpoint
            .then(function (response) {
                document.getElementById('amount').innerText = response.data.cartCount;
                showNotification('Xóa sản phẩm khỏi giỏ hàng thành công.');
                btn.closest('.cart-item').remove();
                updateTotal(response.data.total)

                if(response.data.total == 0) {
                    document.getElementById('checkout').remove();
                    document.querySelector('.updateCart').remove()
                }
            })
            .catch(function (error) {
                console.log(error);
            });
    });
});

function updateTotal(total) {
    var itemTotal = document.getElementsByClassName('total');

    Array.from(itemTotal).forEach(function(e) {
        e.innerText = total + 'đ';
    });
}

function reloadPage(amount) {
    amount === 0 ? location.reload() : ''
}
