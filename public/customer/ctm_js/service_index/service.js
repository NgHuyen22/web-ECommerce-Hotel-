document.getElementById('service_booking').addEventListener('submit',function(event){
    const ngaySD = document.getElementById('ngay_su_dung').value;
    const dv = document.querySelectorAll('input[name = "id_dv[]"]');
    let dvSelected = false;
    let slValid = true;

   dv.forEach(function(service) {
        if (service.checked) {
            dvSelected = true; // Có ít nhất một dịch vụ được chọn
            const serviceIndex = service.getAttribute('data-index'); // Lấy index của dịch vụ
            const sl = document.querySelector(`#items_attribute_${serviceIndex} input[name="so_luong[]"]`);

            // Kiểm tra nếu số lượng của dịch vụ đó có được điền không
            if (!sl || sl.value === "") {
                slValid = false; // Nếu bỏ trống số lượng, thì invalid
            }
        }
    });

    if(ngaySD === "" || !dvSelected || !slValid ){
        event.preventDefault(); 
        Swal.fire({
            icon: 'error',
            text: 'Vui lòng không để trống thông tin.',
            showConfirmButton: false,
            timer: 2000
        });
    }

});