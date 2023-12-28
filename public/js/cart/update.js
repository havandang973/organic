var updateCart = document.querySelectorAll('.updateCart');
updateCart.forEach(function (btn) {
    btn.addEventListener('click', function (event) {
        event.preventDefault();

        var formData = new FormData(btn.closest('.updateCartForm'));

        axios.post('/carts/update', formData) // Use the link as the endpoint
            .then(function (response) {
                document.getElementById('cartItemCount').innerText = response.data.cartCount;
                alert('Cập nhật giỏ hàng thành công');
                updateTotal(response.data.total)
                document.getElementById('error-item').classList.add('hidden');
            })
            .catch(function (error) {
                document.getElementById('error-item').classList.remove('hidden');
                document.getElementById('error').innerText = "Số lượng sản phẩm phải lớn hơn 0";
            });
    });
});

