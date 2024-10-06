const initialize = () => {
  setActiveSidebarItem();
}

const setActiveSidebarItem = () => {
  const currentURL = window.location.href; // Lấy toàn bộ URL hiện tại
  const sidebarLinks = document.querySelectorAll('.sidebar-item a');
  console.log(currentURL)
  sidebarLinks.forEach(link => {
    const href = link.href; // Lấy URL đầy đủ của href từ thẻ a

    // So khớp URL đầy đủ thay vì chỉ so khớp đường dẫn
    if (currentURL === href) {
      link.parentElement.classList.add('active');
    } else {
      link.parentElement.classList.remove('active');
    }
  });
};

document.addEventListener("DOMContentLoaded", () => initialize());

