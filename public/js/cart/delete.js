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
                updateCart(response.data.total)
                if(response.data.total == 0) {
                    document.getElementById('total').remove();
                    document.querySelector('.updateCart').remove()
                }
            })
            .catch(function (error) {
                console.log(error);
            });
    });
});

function updateCart(total) {
    var itemTotal = document.getElementsByClassName('total');

    Array.from(itemTotal).forEach(function(e) {
        e.innerText = total;
    });
}
