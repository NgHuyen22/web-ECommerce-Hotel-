document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.form-check-input');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            // Ẩn tất cả các items_attribute trước
            document.querySelectorAll('.items_attribute').forEach(item => {
                item.style.display = 'none';
            });

            // Kiểm tra checkbox nào được chọn
            let anyChecked = false; // Biến để kiểm tra xem có checkbox nào được chọn hay không

            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    anyChecked = true; // Nếu có checkbox được chọn, gán biến thành true
                    const index = checkbox.getAttribute('data-index'); // Lấy giá trị thuộc tính
                    const itemToShow = document.getElementById(`items_attribute_${index}`);
                    if (itemToShow) {
                        itemToShow.style.display = 'block'; // Hiển thị phần tử tương ứng
                    }
                }
            });

            // Nếu không có checkbox nào được chọn, ẩn tất cả các items_attribute
            if (!anyChecked) {
                document.querySelectorAll('.items_attribute').forEach(item => {
                    item.style.display = 'none'; // Ẩn tất cả nếu không có checkbox nào được chọn
                });
            }
        });
    });
});