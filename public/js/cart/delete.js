var removeCart = document.querySelectorAll('.removeCart');
removeCart.forEach(function (btn) {
    btn.addEventListener('click', function (event) {
        event.preventDefault();
        var rowId = btn.getAttribute('data-row-id');

        axios.get('/carts/delete/' + rowId) // Use the link as the endpoint
            .then(function (response) {
                document.getElementById('cartItemCount').innerText = response.data.cartCount;
                alert('Xóa sản phẩm khỏi giỏ hàng thành công');
                btn.closest('.cart-item').remove();
            })
            .catch(function (error) {
                console.log(error);
            });
    });
});
