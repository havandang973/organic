
// function updatePriceRange() {
//     let minValue = parseInt(priceRangeMin.value);
//     let maxValue = parseInt(priceRangeMax.value);

//     // Đảm bảo giá trị tối thiểu không lớn hơn giá trị tối đa
//     if (minValue > maxValue) {
//         [minValue, maxValue] = [maxValue, minValue];  // Hoán đổi giá trị
//     }

//     priceValue.textContent = `${minValue.toLocaleString('vi-VN')}₫ - ${maxValue.toLocaleString('vi-VN')}₫`;

//     filterProductsByPrice(minValue, maxValue);
// }

// function filterProductsByPrice(minPrice, maxPrice) {
//     const products = document.querySelectorAll('.product-item');

//     products.forEach(product => {
//         const productPrice = parseFloat(product.dataset.price);

//         if (productPrice >= minPrice && productPrice <= maxPrice) {
//             product.style.display = 'block';
//         } else {
//             product.style.display = 'none';
//         }
//     });
// }

// // Khởi tạo giá trị ban đầu và lọc sản phẩm khi người dùng thay đổi giá trị
// updatePriceRange();
// priceRangeMin.addEventListener('input', updatePriceRange);
// priceRangeMax.addEventListener('input', updatePriceRange);
// // Sắp xếp sản phẩm theo giá hoặc tên
const sortSelect = document.getElementById('sortSelect');
sortSelect.addEventListener('change', (event) => {
    const sortValue = event.target.value;
    let sortedProducts = [...document.querySelectorAll('.product-item')];

    if (sortValue === 'price_asc') {
        sortedProducts.sort((a, b) => parseFloat(a.dataset.price) - parseFloat(b.dataset.price));
    } else if (sortValue === 'price_desc') {
        sortedProducts.sort((a, b) => parseFloat(b.dataset.price) - parseFloat(a.dataset.price));
    } else if (sortValue === 'name_asc') {
        sortedProducts.sort((a, b) => a.dataset.name.localeCompare(b.dataset.name));
    } else if (sortValue === 'name_desc') {
        sortedProducts.sort((a, b) => b.dataset.name.localeCompare(a.dataset.name));
    }

    const productList = document.getElementById('productList');
    productList.innerHTML = '';
    sortedProducts.forEach(product => {
        productList.appendChild(product);
    });
});

// // Lắng nghe sự kiện thay đổi của bộ lọc thương hiệu
// const brandCheckboxes = document.querySelectorAll('input[name="brand"]');
// brandCheckboxes.forEach(checkbox => {
//     checkbox.addEventListener('change', filterBrandProducts);
// });

// function filterBrandProducts() {
//     const selectedBrands = [...document.querySelectorAll('input[name="brand"]:checked')].map(checkbox => checkbox.value);
//     const products = document.querySelectorAll('.product-item');

//     products.forEach(product => {
//         const productBrand = product.dataset.brand;
//         const matchesBrand = selectedBrands.length === 0 || selectedBrands.includes(productBrand);

//         if (matchesBrand) {
//             product.style.display = 'block';
//         } else {
//             product.style.display = 'none';
//         }
//     });
// }

// //lọc danh mục
// const categoryCheckboxes = document.querySelectorAll('input[name="category"]');
// categoryCheckboxes.forEach(checkbox => {
//     checkbox.addEventListener('change', filterCategoryProducts);
// });

// function filterCategoryProducts() {
//     const selectedCategories = [...document.querySelectorAll('input[name="category"]:checked')].map(checkbox => checkbox.value);
//     const products = document.querySelectorAll('.product-item');

//     products.forEach(product => {
//         const productCategory = product.dataset.category;
//         const matchesCategory = selectedCategories.length === 0 || selectedCategories.includes(productCategory);

//         if (matchesCategory) {
//             product.style.display = 'block';
//         } else {
//             product.style.display = 'none';
//         }
//     });
// }

const priceRangeMin = document.getElementById('priceRangeMin');
const priceRangeMax = document.getElementById('priceRangeMax');
const priceValue = document.getElementById('priceValue');


document.addEventListener('DOMContentLoaded', () => {
    const filterForm = document.getElementById('filterForm');

    // Lắng nghe sự thay đổi trên các checkbox danh mục
    document.querySelectorAll('input[name="categories[]"]').forEach(checkbox => {
        checkbox.addEventListener('change', updateFilters);
    });

    // Lắng nghe sự thay đổi trên các checkbox thương hiệu
    document.querySelectorAll('input[name="brands[]"]').forEach(checkbox => {
        checkbox.addEventListener('change', updateFilters);
    });

    // Lắng nghe sự thay đổi trên các thanh trượt giá
    document.querySelectorAll('input[name="price_min"], input[name="price_max"]').forEach(input => {
        input.addEventListener('input', updatePriceRange);
    });

    function updateFilters() {
        filterForm.submit(); // Gửi yêu cầu khi có sự thay đổi
    }

    function updatePriceRange() {
        const minPrice = document.getElementById('priceRangeMin').value;
        const maxPrice = document.getElementById('priceRangeMax').value;
        document.getElementById('priceValue').textContent = `${minPrice}₫ - ${maxPrice}₫`;
        updateFilters(); // Gửi yêu cầu khi có sự thay đổi
    }
});
