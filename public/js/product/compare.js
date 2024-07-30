var addToCompareBtns = document.querySelectorAll('.addToCompareBtn')

addToCompareBtns.forEach(function(btn) {
    btn.addEventListener('click', function () {
        var formData = new FormData(btn.closest('.addToCompareForm'));

        axios.post(btn.closest('.addToCompareForm').action, formData)
            .then(function (response) {
                console.log(response)
                document.getElementById('amountCompare').innerText = response.data.compareProductAmount;
                localStorage.setItem('compareProductAmount', response.data.compareProductAmount);

                // document.getElementById('error-amount') ? document.getElementById('error-amount').innerText = '' : ''

            })
            .catch(function (error) {
                // showNotification('Sản phẩm này đã hết hàng.');
                document.getElementById('error-amount').innerText = error.response.data.message;
            });
    });
});

var removeCompares = document.querySelectorAll('.removeCompare');
removeCompares.forEach(function (btn) {
    btn.addEventListener('click', function (event) {
        var formData = new FormData(btn.closest('.formDeleteCompare'));

        axios.post(btn.closest('.formDeleteCompare').action, formData)
            .then(function (response) {
                console.log(response)
                localStorage.setItem('compareProductAmount', response.data.compareProductAmount);
                getCompareProductAmount();
                btn.closest('.item-compare').remove();
            })
            .catch(function (error) {
                console.log(error);
            });
    });
});

function getCompareProductAmount() {
    var compareProductAmount = localStorage.getItem('compareProductAmount');
    if (compareProductAmount !== null) {
        document.getElementById('amountCompare').innerText = compareProductAmount;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    getCompareProductAmount();
});
