var addToCartBtns = document.querySelectorAll('.addToCartBtn')
addToCartBtns.forEach(function(btn) {
    btn.addEventListener('click', function () {
        var formData = new FormData(btn.closest('.addToCartForm'));
        axios.post(btn.closest('.addToCartForm').action, formData)
            .then(function (response) {
                document.getElementById('cartItemCount').innerText = response.data.cartCount;
                alert('Thêm sản phẩm vào giỏ hàng thành công');
                // toastr().success('Thêm sản phẩm vào giỏ hàng thành công');

            })
            .catch(function (error) {
                console.error('Lỗi thêm sản phẩm vào giỏ hàng:', error);
            });
    });
});

// $('.addToCartBtn').on('click', function () {
//     var formData = new FormData($(this).closest('.addToCartForm')[0]);
//     $.ajax({
//         url: $(this).closest('.addToCartForm').attr('action'),
//         method: 'POST',
//         data: formData,
//         processData: false,
//         contentType: false,
//         success: function (response) {
//             $('#cartItemCount').text(response.cartCount);
//             console.log(response)
//             alert('Thêm sản phẩm vào giỏ hàng thành công');
//         },
//         error: function (error) {
//             console.error('Lỗi thêm sản phẩm vào giỏ hàng:', error);
//         }
//     });
// });

