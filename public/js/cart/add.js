var addToCartBtns = document.querySelectorAll('.addToCartBtn')
addToCartBtns.forEach(function(btn) {
    btn.addEventListener('click', function () {
        var formData = new FormData(btn.closest('.addToCartForm'));

        axios.post(btn.closest('.addToCartForm').action, formData)
            .then(function (response) {
                document.getElementById('cartItemCount').innerText = response.data.cartCount;
                if(response.data.cartCount) {
                    alert('Thêm sản phẩm vào giỏ hàng thành công');
                    updateCartItems(response.data.cartContent, response.data.total);
                    updateTotal(response.data.total)
                }
            })
            .catch(function (error) {
                console.error('Lỗi thêm sản phẩm vào giỏ hàng:', error);
            });
    });
});


function updateCartItems(cartContent, total) {
    var cartItemsContainer = document.getElementById('cartItemsContainer');

    cartItemsContainer.innerHTML = '';

    for (var rowId in cartContent) {
        var product = cartContent[rowId];

        var cartItemHTML = `
            <div class="cart-item w-full flex mt-5 text-sm">
                <div class="w-1/3">
                    <a href="${product.options.thumbnail}" class="">
                        <img src="${product.options.thumbnail}" alt="" class="">
                    </a>
                </div>
                <div class="w-1/2 space-y-2 ml-3">
                    <a href="${product.options.thumbnail}" class="">
                        <div class="text-blue-500 font-bold">${product.options.discount}đ
                            <span class="mx-2 text-gray-400 line-through">${product.price}₫</span>
                        </div>
                        <div class="text-black font-bold">${product.name}</div>
                    </a>
                    <div class="">
                        <span class="">Số lượng: ${product.qty}</span>
                    </div>
                </div>
            </div>`;

        cartItemsContainer.innerHTML += cartItemHTML;
    }
}



