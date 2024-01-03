const imageInput = document.getElementById('imageInput');
const imageInputLabel = document.getElementById('imageInputLabel');
const productImage = document.getElementById('productImage');

imageInput.addEventListener('change', function (e) {
    const file = e.target.files[0]; // Lấy tệp đã chọn
    if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            // Đặt src của thẻ img thành đường dẫn dữ liệu của tệp đã chọn
            productImage.src = e.target.result;
            productImage.style.display = 'block'; // Hiển thị thẻ img
        };

        reader.readAsDataURL(file); // Đọc tệp dưới dạng dữ liệu URL
    }
});

