<form action="" method="POST" class="add_admin">
        @csrf
        <label for="ho_ten">Họ tên</label>
        <input type="text" name="ho_ten" id="ho_ten" value=""> 

        <label for="gioi_tinh">Giới tính</label>
        <input type="text" name="gioi_tinh" id="gioi_tinh" value=""> 
        
        <label for="sdt">sdt</label>
        <input type="text" name="sdt" id="sdt" value=""> 

        <label for="email">email</label>
        <input type="text" name="email" id="email" value=""> 

        <label for="dia_chi">địa chỉ</label>
        <input type="text" name="dia_chi" id="dia_chi" value=""> 

        <label for="password">password</label>
        <input type="text" name="password" id="password" value=""> 
        <input type="submit" name="" value="Thêm" >
</form>