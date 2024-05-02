function showAddressInfo(element) {
    var addressElements = document.querySelectorAll('.address');
    addressElements.forEach(function(addrElement) {
        addrElement.classList.remove('bg-sky-100');
    });

    element.classList.add('bg-sky-100')

    var name = element.querySelector('.name').textContent;
    var address = element.querySelector('.address-detail').textContent;
    var email = element.querySelector('.email').textContent;
    var telephone = element.querySelector('.telephone').textContent;

    document.querySelector('input[name="name"]').value = name;
    document.querySelector('input[name="address"]').value = address;
    document.querySelector('input[name="email"]').value = email;
    document.querySelector('input[name="phone"]').value = telephone;
}


