function toggleReadMore() {
    var content = document.querySelector('.hidden-content');
    var btn = document.querySelector('.about-btn');
    
    if (content.style.display === "none" || content.style.display === "") {
        content.style.display = "block"; // Hiện nội dung ẩn
        btn.innerText = "Ẩn"; // Thay đổi nút thành "Read Less"
    } else {
        content.style.display = "none"; // Ẩn nội dung
        btn.innerText = "Chi tiết"; // Thay đổi nút trở lại "Read More"
    }
}
