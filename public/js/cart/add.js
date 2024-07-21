
var addToCartBtns = document.querySelectorAll('.addToCartBtn')
var addToCartForm = document.querySelector('.addToCartForm')

addToCartBtns.forEach(function(btn) {
    btn.addEventListener('click', function () {
        var formData = new FormData(btn.closest('.addToCartForm'));

        axios.post(btn.closest('.addToCartForm').action, formData)
            .then(function (response) {
                document.getElementById('amount').innerText = response.data.cartCount;
                document.getElementById('error-amount') ? document.getElementById('error-amount').innerText = '' : ''

                console.log(response.data)
                showNotification('Thêm sản phẩm vào giỏ hàng thành công');
                // if(response.data.cartCount) {
                //     updateCartItems(response.data.cartContent);
                //     updateTotal(response.data.total)
                // }
            })
            .catch(function (error) {
                // showNotification('Sản phẩm này đã hết hàng.');
                document.getElementById('error-amount').innerText = error.response.data.message;
            });
    });
});


function updateCartItems(cartContent) {
    var cartItemsContainer = document.getElementById('cartItemsContainer');
    cartItemsContainer.innerHTML = '';

    for (var rowId in cartContent) {
        var product = cartContent[rowId];

        var cartItemHTML = `
            <div class="cart-item w-full flex mt-5 text-sm">
                <div class="w-1/3">
                    <a href="/products/${product.id}" class="">
                        <img src="${product.options.thumbnail}" alt="" class="">
                    </a>
                </div>
                <div class="w-1/2 space-y-2 ml-3">
                    <a href="/products/${product.id}" class="">
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
